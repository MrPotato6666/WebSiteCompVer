#include "stdafx.h"
#include <string>
#include "StockManage.h"
#include "VisualStockManagerDlg.h"
#include "VisualStockManager.h"

const CString gszStockFilePath = _T("..\\Debug\\Stock.xls");
const CString gszLogFilePath = _T("..\\Debug\\LogFile\\");
/*const CString gszDays[] = {	_T("Monday"),
							_T("Tuesday"),
							_T("Wednesday"),
							_T("Thursday"),
							_T("Friday"),
							_T("Saturday"),
							_T("Sunday"),
};*/

CStockManage::CStockManage()
{
	m_szBarcode = "";
	m_szProductName = "";
	m_szProdescrp = "";
	m_nQuantity = 0;
	m_nProdRow = 0;
}

CStockManage::~CStockManage()
{


}

BOOL CStockManage::InitInstances()
{
	BOOL bResult = false;
	CString szMsg;
	book = xlCreateBook();
	if (book)
	{
		if (book->load(gszStockFilePath))
		{
			sheet = book->getSheet(0);
			bResult = true;
		}
		else
		{
			szMsg.Format(_T("Fail to Open File : %s "), book->errorMessage());
			DisplayMessage(szMsg);
		}
	}
	return bResult;
}

void CStockManage::DisplayMessage(const CString& szMessage)
{
	CTime tmTime = CTime::GetCurrentTime();
	CString			szText;
	CVisualStockManagerApp* pApp = (CVisualStockManagerApp*)AfxGetApp();

	szText.Format(_T("%d:%02d:%02d, %s"), tmTime.GetHour(), tmTime.GetMinute(), tmTime.GetSecond(),
		szMessage);

//	CVisualStockManagerDlg* pView = (CVisualStockManagerDlg*)(pApp->m_pMainWnd)->GetActiveWindow(); //might nid to change since not only one dialog
//	CWnd* pWnd = CWnd::FindWindowW(NULL, _T("VisualStockManager"));	
	CVisualStockManagerDlg* pWnd = (CVisualStockManagerDlg*)CWnd::FindWindowW(NULL, _T("VisualStockManager"));
	if(pWnd)
		pWnd->DisplayMessage(szMessage);
}

BOOL CStockManage::BarcodeProcess()
{
	BOOL bResult = false;
	CString szMsg;
	if (sheet)
	{
		for (int row = sheet->firstRow(); row < sheet->lastRow(); ++row)
		{
			CString szReadback;
			szReadback = sheet->readStr(row, sheet->firstCol());
			if (szReadback == m_szBarcode)
			{
				bResult = true;
				m_nProdRow = row;
				m_szProductName = sheet->readStr(row, sheet->firstCol() + 1);
				m_szProdescrp = sheet->readStr(row, sheet->firstCol() + 2);
				m_nQuantity = sheet->readNum(row, sheet->firstCol() + 3);
			}
		}
	}
	
	return bResult;
}

BOOL CStockManage::DataWrite(int nRow, CString szProductName, CString szProdescrip, CString szQuantity, CString szOldQuantity, CString szBarcode)
{
	BOOL bResult = true;
	int row;
	CString szMsg, szFileName;
	CStdioFile fin;
	CTime cCurrentDate = CTime::GetCurrentTime();
	
	if (nRow == -1) //New Product Check, different messsge format to save in log
		row = sheet->lastRow();
	else
		row = nRow;

	if (sheet)
	{
		CT2CA pszConvertedAnsiString(szQuantity);
		string std(pszConvertedAnsiString);
		m_nQuantity = stoi(std);
		if (szProductName != "")
		{
			sheet->writeStr(row, sheet->firstCol(), szBarcode);
			sheet->writeStr(row, sheet->firstCol() + 1, szProductName);
			sheet->writeStr(row, sheet->firstCol() + 2, szProdescrip);
		}
		
		sheet->writeNum(row, sheet->firstCol() + 3, m_nQuantity);
		
	}
	if (book->save(gszStockFilePath))
	{
		CString szDate;
		DisplayMessage(_T("File : Stock.xls has been modified"));
		szFileName.Format(_T("%sY%dM%2d_LogFile.xls"), gszLogFilePath, cCurrentDate.GetYear(), cCurrentDate.GetMonth());
		szDate.Format(_T("%4d%2d%2d, %02d:%02d:%02d"), cCurrentDate.GetYear(), cCurrentDate.GetMonth(), cCurrentDate.GetDay(), cCurrentDate.GetHour(), cCurrentDate.GetMinute(), cCurrentDate.GetSecond());
		if (fin.Open(szFileName, CFile::modeNoTruncate | CFile::modeCreate | CFile::modeWrite | CFile::typeText))
		{
			fin.Seek(0, CFile::end);

			if (nRow != -1)
				szMsg.Format(_T("D%d %02d:%02d:%02d : Product : %s (Barcode: %s) - Quantity Changed From %s to %s\n"), cCurrentDate.GetDay(), cCurrentDate.GetHour(), cCurrentDate.GetMinute(), cCurrentDate.GetSecond(), szProductName, szBarcode, szOldQuantity, szQuantity);
			else
				szMsg.Format(_T("%s, New Product : %s, Barcode : %s, Quantity : %s Has Been Check In\n"), szDate,  szProductName, szBarcode, szQuantity);
			fin.WriteString(szMsg);
			fin.Close();
		}
	}
	else
	{
			szMsg.Format(_T("Fail to Save File : %s "), book->errorMessage());
			DisplayMessage(szMsg);
	}


	return bResult;
}

BOOL CStockManage::ImageLoad(CString szBarcode)
{
	BOOL bResult = false;
	int nResult;
	CString szImage;
	szImage.Format(L"..\\Debug\\images\\%s.png", szBarcode);
	nResult = (int)ShellExecute(NULL, L"open", szImage, NULL, NULL, SW_SHOWMINNOACTIVE);
	if (nResult > 32)
		bResult = true;
	return bResult;
}
