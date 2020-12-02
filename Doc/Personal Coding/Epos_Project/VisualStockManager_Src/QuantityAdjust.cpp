// QuantityAdjust.cpp : implementation file
//

#include "stdafx.h"
#include "VisualStockManager.h"
#include "QuantityAdjust.h"
#include "afxdialogex.h"


// CQuantityAdjust dialog

IMPLEMENT_DYNAMIC(CQuantityAdjust, CDialogEx)

CQuantityAdjust::CQuantityAdjust(CWnd* pParent /*=NULL*/)
	: CDialogEx(IDD_QUANTITY, pParent)
	, m_szQuantityAdj(_T(""))
{

}

CQuantityAdjust::~CQuantityAdjust()
{
}

void CQuantityAdjust::DoDataExchange(CDataExchange* pDX)
{
	CDialogEx::DoDataExchange(pDX);
	DDX_Text(pDX, IDC_QUANTITYADJ, m_szQuantityAdj);
	DDX_Control(pDX, IDC_SPIN_QUANTITYADJ, m_cSpinCtrl);
}

BOOL CQuantityAdjust::OnInitDialog()
{
	CDialogEx::OnInitDialog();

	m_cSpinCtrl.SetRange(0, 10000);
	return true;
}

BEGIN_MESSAGE_MAP(CQuantityAdjust, CDialogEx)
END_MESSAGE_MAP()


// CQuantityAdjust message handlers
