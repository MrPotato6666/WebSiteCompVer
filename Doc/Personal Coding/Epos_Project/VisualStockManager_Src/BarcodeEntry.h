#pragma once
#include "afxwin.h"


// BarcodeEntry dialog

class BarcodeEntry : public CDialogEx
{
	DECLARE_DYNAMIC(BarcodeEntry)

public:
	BarcodeEntry(CWnd* pParent = NULL);   // standard constructor
	virtual ~BarcodeEntry();

// Dialog Data
#ifdef AFX_DESIGN_TIME
	enum { IDD = IDD_BARCODE_ENTRY };
#endif

protected:
	virtual void DoDataExchange(CDataExchange* pDX);    // DDX/DDV support
	virtual BOOL OnInitDialog();
	virtual void OnCancel();
	virtual void OnOK();

	CWinThread* m_ptBarcodeThread;
	DECLARE_MESSAGE_MAP()
public:
	CString m_szBarcode;
	afx_msg void OnEnChangeBarcode();
	CString m_szTempBarcode;
	BOOL m_bExit;
};
