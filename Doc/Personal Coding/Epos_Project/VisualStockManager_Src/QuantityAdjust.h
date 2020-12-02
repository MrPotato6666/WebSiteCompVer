#pragma once
#include "afxcmn.h"


// CQuantityAdjust dialog

class CQuantityAdjust : public CDialogEx
{
	DECLARE_DYNAMIC(CQuantityAdjust)

public:
	CQuantityAdjust(CWnd* pParent = NULL);   // standard constructor
	virtual ~CQuantityAdjust();

// Dialog Data
#ifdef AFX_DESIGN_TIME
	enum { IDD = IDD_QUANTITY };
#endif

protected:
	virtual void DoDataExchange(CDataExchange* pDX);    // DDX/DDV support
	virtual BOOL OnInitDialog();

	DECLARE_MESSAGE_MAP()
public:
	CString m_szQuantityAdj;
	CSpinButtonCtrl m_cSpinCtrl;
};
