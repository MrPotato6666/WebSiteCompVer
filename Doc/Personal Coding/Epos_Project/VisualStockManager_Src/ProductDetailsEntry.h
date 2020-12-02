#pragma once
#include "afxcmn.h"
#include "afxwin.h"

// ProductDetailsEntry dialog

class ProductDetailsEntry : public CDialogEx
{
	DECLARE_DYNAMIC(ProductDetailsEntry)

public:
	ProductDetailsEntry(int nDiagOpt, CWnd* pParent = NULL);   // standard constructor
	virtual ~ProductDetailsEntry();

// Dialog Data
#ifdef AFX_DESIGN_TIME
	enum { IDD = IDD_PRODUCTDETAIL_FILLIN };
#endif

protected:
	virtual void DoDataExchange(CDataExchange* pDX);    // DDX/DDV support
	virtual BOOL OnInitDialog();
	int m_nDiagOption;

	DECLARE_MESSAGE_MAP()
public:
	CString m_szProductName;
	CString m_szProdescrip;
	CString m_szQuantity;
	CString m_szBarcode;
//	CSpinButtonCtrl m_cQuantityAdjust;
	CEdit m_cProductName;
	CEdit m_cProdescrip;
	CEdit m_cBarcode;
	CSpinButtonCtrl m_cSpinCtrl;
};
