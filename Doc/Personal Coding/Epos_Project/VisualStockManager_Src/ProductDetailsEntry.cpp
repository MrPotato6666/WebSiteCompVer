// ProductDetailsEntry.cpp : implementation file
//

#include "stdafx.h"
#include "VisualStockManager.h"
#include "ProductDetailsEntry.h"
#include "afxdialogex.h"


// ProductDetailsEntry dialog

IMPLEMENT_DYNAMIC(ProductDetailsEntry, CDialogEx)

ProductDetailsEntry::ProductDetailsEntry(int nDiagOpt, CWnd* pParent /*=NULL*/)
	: CDialogEx(IDD_PRODUCTDETAIL_FILLIN, pParent)
	, m_szProductName(_T(""))
	, m_szProdescrip(_T(""))
	, m_szQuantity(_T(""))
	, m_szBarcode(_T(""))
{
	m_nDiagOption = nDiagOpt;
}

ProductDetailsEntry::~ProductDetailsEntry()
{
}

void ProductDetailsEntry::DoDataExchange(CDataExchange* pDX)
{
	CDialogEx::DoDataExchange(pDX);
	DDX_Text(pDX, IDC_EDIT_PRODUCTNAME, m_szProductName);
	DDX_Text(pDX, IDC_EDIT_PRODESCRIP, m_szProdescrip);
	DDX_Text(pDX, IDC_EDIT_QTY, m_szQuantity);
	DDX_Text(pDX, IDC_EDIT_BARCODE, m_szBarcode);
	DDX_Control(pDX, IDC_EDIT_PRODUCTNAME, m_cProductName);
	DDX_Control(pDX, IDC_EDIT_PRODESCRIP, m_cProdescrip);
	DDX_Control(pDX, IDC_EDIT_BARCODE, m_cBarcode);
	DDX_Control(pDX, IDC_SPIN_QUANTITY, m_cSpinCtrl);
}

BOOL ProductDetailsEntry::OnInitDialog()
{
	CDialogEx::OnInitDialog();

	m_cSpinCtrl.SetRange(0, 10000);
	if (m_nDiagOption != 1)
	{
		CEdit *pEdit;
		pEdit  = (CEdit*)GetDlgItem(IDC_EDIT_PRODUCTNAME);
		pEdit->SetReadOnly();
		pEdit = (CEdit*)GetDlgItem(IDC_EDIT_PRODESCRIP);
		pEdit->SetReadOnly();
		pEdit = (CEdit*)GetDlgItem(IDC_EDIT_BARCODE);
		pEdit->SetReadOnly();
	}
	

	return true;
}
BEGIN_MESSAGE_MAP(ProductDetailsEntry, CDialogEx)
END_MESSAGE_MAP()


// ProductDetailsEntry message handlers
