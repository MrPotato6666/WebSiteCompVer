// BarcodeEntry.cpp : implementation file
//

#include "stdafx.h"
#include "VisualStockManager.h"
#include "BarcodeEntry.h"
#include "afxdialogex.h"


// BarcodeEntry dialog

IMPLEMENT_DYNAMIC(BarcodeEntry, CDialogEx)

UINT BarcodeThread(LPVOID pParam)
{
	BarcodeEntry* pBarcodeEntry = (BarcodeEntry*)pParam;
	if (pBarcodeEntry == NULL || !pBarcodeEntry->IsKindOf(RUNTIME_CLASS(BarcodeEntry)))
	{
		return 1;
	}
	while (!pBarcodeEntry->m_bExit)
	{
		if (pBarcodeEntry->m_szTempBarcode.GetLength() >= 5)
		{
			CWnd *pWnd = CWnd::FindWindowW(NULL, _T("Barcode Entry"));
			SendMessageA((HWND)*pWnd, WM_COMMAND, 1, NULL);
			pBarcodeEntry->m_bExit = true;
		}
		Sleep(100);
	}
	return 0;
}

BarcodeEntry::BarcodeEntry(CWnd* pParent /*=NULL*/)
	: CDialogEx(IDD_BARCODE_ENTRY, pParent)
	, m_szBarcode(_T(""))
{
	m_szTempBarcode = "";
	m_ptBarcodeThread = NULL;
	m_bExit = false;
}

BarcodeEntry::~BarcodeEntry()
{
	/*if (m_ptBarcodeThread != NULL)
	{
		WaitForSingleObject(m_ptBarcodeThread->m_hThread, 100);
	}*/
}

void BarcodeEntry::DoDataExchange(CDataExchange* pDX)
{
	CDialogEx::DoDataExchange(pDX);
	DDX_Text(pDX, IDC_BARCODE, m_szBarcode);
}

BOOL BarcodeEntry::OnInitDialog()
{
	CDialogEx::OnInitDialog();

	//m_ptBarcodeThread = AfxBeginThread(BarcodeThread, this, THREAD_PRIORITY_ABOVE_NORMAL);
	return true;
}

void BarcodeEntry::OnEnChangeBarcode()
{
	// TODO:  If this is a RICHEDIT control, the control will not
	// send this notification unless you override the CDialogEx::OnInitDialog()
	// function and call CRichEditCtrl().SetEventMask()
	// with the ENM_CHANGE flag ORed into the mask.

	// TODO:  Add your control notification handler code here
	//m_cBarcode.GetWindowTextW(m_szTempBarcode);
	GetDlgItem(IDC_BARCODE)->GetWindowTextW(m_szTempBarcode);

}

void BarcodeEntry::OnOK()
{
	m_bExit = true;

	CDialog::OnOK(); // This will close the dialog and DoModal will return.
}

void BarcodeEntry::OnCancel()
{
	// TODO: Add extra cleanup here

	m_bExit = true;

	CDialog::OnCancel();
}

BEGIN_MESSAGE_MAP(BarcodeEntry, CDialogEx)
	ON_EN_CHANGE(IDC_BARCODE, &BarcodeEntry::OnEnChangeBarcode)
END_MESSAGE_MAP()


// BarcodeEntry message handlers

