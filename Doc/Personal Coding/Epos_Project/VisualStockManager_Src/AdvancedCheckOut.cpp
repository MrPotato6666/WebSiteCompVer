// AdvancedCheckOut.cpp : implementation file
//

#include "stdafx.h"
#include "VisualStockManager.h"
#include "AdvancedCheckOut.h"
#include "afxdialogex.h"
#include "QuantityAdjust.h"
#include <string>


// CAdvancedCheckOut dialog

IMPLEMENT_DYNAMIC(CAdvancedCheckOut, CDialogEx)

UINT AdvBarcodeThread(LPVOID pParam)
{
	CAdvancedCheckOut* pAdvBarcodeEntry = (CAdvancedCheckOut*)pParam;
	if (pAdvBarcodeEntry == NULL || !pAdvBarcodeEntry->IsKindOf(RUNTIME_CLASS(CAdvancedCheckOut)))
	{
		return 1;
	}
	while (!pAdvBarcodeEntry->m_bExit)
	{
		pAdvBarcodeEntry->AdvBarcodeCheckList();
		Sleep(100);
	}
	return 0;
}

CAdvancedCheckOut::CAdvancedCheckOut(CWnd* pParent /*=NULL*/)
	: CDialogEx(IDD_ADVANCEDCHECKOUT, pParent)
{
	m_ptAdvBarcodeThread = NULL;
	m_bExit = false;
	m_nItemRow = -1;
}

CAdvancedCheckOut::~CAdvancedCheckOut()
{
	if (m_ptAdvBarcodeThread != NULL)
	{
		WaitForSingleObject(m_ptAdvBarcodeThread->m_hThread, 100);
	}
}

void CAdvancedCheckOut::DoDataExchange(CDataExchange* pDX)
{
	CDialogEx::DoDataExchange(pDX);
	DDX_Control(pDX, IDC_LIST1, m_cListCtrl);
}

BOOL CAdvancedCheckOut::OnInitDialog()
{
	CDialogEx::OnInitDialog();
	m_pDlgFont = new CFont();
	m_pDlgFont->CreatePointFont(100, _T("Times New Roman"), NULL);
	GetDlgItem(IDC_STATIC_ADVBARCODE)->SetFont(m_pDlgFont);

	m_cListCtrl.InsertColumn(0, _T("No"), LVCFMT_LEFT, 100);
	m_cListCtrl.InsertColumn(1, _T("Barcode"), LVCFMT_LEFT, 100);
	m_cListCtrl.InsertColumn(2, _T("Product"), LVCFMT_CENTER, 260);
	m_cListCtrl.InsertColumn(3, _T("Quantity"), LVCFMT_LEFT, 100);
	m_cListCtrl.SetExtendedStyle(LVS_EX_FULLROWSELECT | LVS_EX_GRIDLINES | LVS_EX_AUTOSIZECOLUMNS | LVS_EX_TWOCLICKACTIVATE);

	m_ptAdvBarcodeThread = AfxBeginThread(AdvBarcodeThread, this, THREAD_PRIORITY_ABOVE_NORMAL);
	return true;
}

void CAdvancedCheckOut::OnEnChangeAdvanchkoutbarcode()
{
	// TODO:  If this is a RICHEDIT control, the control will not
	// send this notification unless you override the CDialogEx::OnInitDialog()
	// function and call CRichEditCtrl().SetEventMask()
	// with the ENM_CHANGE flag ORed into the mask.

	// TODO:  Add your control notification handler code here
	GetDlgItem(IDC_AdvanChkOutBarcode)->GetWindowTextW(m_szTempAdvBarcode);
}

void CAdvancedCheckOut::AdvBarcodeCheckList()
{
	if (m_szTempAdvBarcode.GetLength() >= 5)
	{
		CVisualStockManagerApp* pApp = (CVisualStockManagerApp*)AfxGetApp();
		CString szMsg;
		CString szItem, szTempItem, szTempQuantity, szNumOfProd;
		BOOL bResult = false;

		szItem = m_szTempAdvBarcode;
		pApp->StockManageApp.m_szBarcode = m_szTempAdvBarcode;
		bResult = pApp->StockManageApp.BarcodeProcess();
		if (!bResult)
		{
			szMsg.Format(_T("No Product With Barcode : %s "), m_szTempAdvBarcode);
			AfxMessageBox(szMsg, MB_OK | MB_ICONEXCLAMATION);
			GetDlgItem(IDC_AdvanChkOutBarcode)->SetWindowTextW(_T(""));
			return;
		}

		GetDlgItem(IDC_AdvanChkOutBarcode)->SetWindowTextW(_T(""));

		int nItem, nQuantity;
		for (int i = 0; i < m_cListCtrl.GetItemCount(); i++)
		{
			szTempItem = m_cListCtrl.GetItemText(i, 1);
			if (szTempItem == szItem)
			{
				szTempQuantity = m_cListCtrl.GetItemText(i, 3);
				CT2CA pszConvertedAnsiString(szTempQuantity);
				string std(pszConvertedAnsiString);
				nQuantity = stoi(std);
				nQuantity += 1;
				szTempQuantity.Format(_T("%d"), nQuantity);
				m_cListCtrl.SetItemText(i, 3, szTempQuantity);
				return;
			}
		}
		szNumOfProd.Format(_T("%d"), m_cListCtrl.GetItemCount() + 1);
		nItem = m_cListCtrl.InsertItem(m_cListCtrl.GetItemCount(), szNumOfProd);
		m_cListCtrl.SetItemText(nItem, 1, szItem);
		m_cListCtrl.SetItemText(nItem, 2, pApp->StockManageApp.m_szProductName);
		m_cListCtrl.SetItemText(nItem, 3, _T("1"));
	}
}

void CAdvancedCheckOut::OnOK()
{
	CVisualStockManagerApp* pApp = (CVisualStockManagerApp*)AfxGetApp();
	CString szTempQuantity, szTempOldQuantity;
	int nQuantity;
	for (int i = 0; i < m_cListCtrl.GetItemCount(); i++)
	{		
		pApp->StockManageApp.m_szBarcode = m_cListCtrl.GetItemText(i, 1);
		pApp->StockManageApp.BarcodeProcess();

		szTempQuantity = m_cListCtrl.GetItemText(i, 3);
		CT2CA pszConvertedAnsiString(szTempQuantity);
		string std(pszConvertedAnsiString);
		nQuantity = stoi(std);
		szTempOldQuantity.Format(_T("%d"), pApp->StockManageApp.m_nQuantity);
		szTempQuantity.Format(_T("%d"), pApp->StockManageApp.m_nQuantity - nQuantity);

		pApp->StockManageApp.DataWrite(pApp->StockManageApp.m_nProdRow, _T(""), _T(""), szTempQuantity, szTempOldQuantity, _T(""));
	}
	m_bExit = true;


	CDialog::OnOK();
}

void CAdvancedCheckOut::OnLvnItemchangedList1(NMHDR *pNMHDR, LRESULT *pResult)
{
	LPNMLISTVIEW pNMLV = reinterpret_cast<LPNMLISTVIEW>(pNMHDR);
	// TODO: Add your control notification handler code here

	if (pNMLV->uNewState&LVIS_FOCUSED && pNMLV->uNewState&LVIS_SELECTED) //bitwise AND unewState(3 = 0x00011); LVIS_FOCUSED = 0x0001; LVIS_SELECTED = 0x0010;
	{
		m_cListCtrl.SetItemState(pNMLV->iItem, LVIS_SELECTED|LVIS_FOCUSED, 0x000F);	
		m_nItemRow = pNMLV->iItem;
	}
	*pResult = 0;
}

void CAdvancedCheckOut::OnLvnItemActivateList1(NMHDR *pNMHDR, LRESULT *pResult)
{
	LPNMITEMACTIVATE pNMIA = reinterpret_cast<LPNMITEMACTIVATE>(pNMHDR);
	CQuantityAdjust dlgQuantityAdjust;
	int nQuantity;
	CString szQuantity;
	// TODO: Add your control notification handler code here
	dlgQuantityAdjust.m_szQuantityAdj = m_cListCtrl.GetItemText(pNMIA->iItem, 3);
	if (dlgQuantityAdjust.DoModal() == IDOK)
	{
		if (dlgQuantityAdjust.m_szQuantityAdj != "")
		{
			CT2CA pszConvertedAnsiString(dlgQuantityAdjust.m_szQuantityAdj);
			string std(pszConvertedAnsiString);
			nQuantity = stoi(std);
			szQuantity.Format(_T("%d"), nQuantity);
			m_cListCtrl.SetItemText(pNMIA->iItem, 3, szQuantity);
		}
	}
	*pResult = 0;
}


void CAdvancedCheckOut::OnBnClickedDelete()
{
	CString szTempNo;
	int nTempNo;
	// TODO: Add your control notification handler code here
	if (m_nItemRow != -1)
	{
		m_cListCtrl.DeleteItem(m_nItemRow);
		for (int i = m_nItemRow; i < m_cListCtrl.GetItemCount(); i++)
		{
			szTempNo = m_cListCtrl.GetItemText(i, 0);
			CT2CA pszConvertedAnsiString(szTempNo);
			string std(pszConvertedAnsiString);
			nTempNo = stoi(std);
			nTempNo -= 1;
			szTempNo.Format(_T("%d"), nTempNo);
			m_cListCtrl.SetItemText(i, 0, szTempNo);
		}
	}
}

void CAdvancedCheckOut::OnCancel()
{
	// TODO: Add extra cleanup here

	m_bExit = true;

	CDialog::OnCancel();
}

BEGIN_MESSAGE_MAP(CAdvancedCheckOut, CDialogEx)
	ON_EN_CHANGE(IDC_AdvanChkOutBarcode, &CAdvancedCheckOut::OnEnChangeAdvanchkoutbarcode)
	ON_NOTIFY(LVN_ITEMCHANGED, IDC_LIST1, &CAdvancedCheckOut::OnLvnItemchangedList1)
	ON_NOTIFY(LVN_ITEMACTIVATE, IDC_LIST1, &CAdvancedCheckOut::OnLvnItemActivateList1)
	ON_BN_CLICKED(IDC_DELETE, &CAdvancedCheckOut::OnBnClickedDelete)
END_MESSAGE_MAP()


// CAdvancedCheckOut message handlers