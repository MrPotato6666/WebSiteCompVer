#pragma once
#include "afxcmn.h"
#include "afxwin.h"
#include "VisualStockManager.h"


// CAdvancedCheckOut dialog

class CAdvancedCheckOut : public CDialogEx
{
	DECLARE_DYNAMIC(CAdvancedCheckOut)

public:
	CAdvancedCheckOut(CWnd* pParent = NULL);   // standard constructor
	virtual ~CAdvancedCheckOut();

// Dialog Data
#ifdef AFX_DESIGN_TIME
	enum { IDD = IDD_ADVANCEDCHECKOUT };
#endif


protected:
	virtual void DoDataExchange(CDataExchange* pDX);    // DDX/DDV support
	virtual BOOL OnInitDialog();
	virtual void OnOK();
	virtual void OnCancel();

	CFont *m_pDlgFont;
	CWinThread* m_ptAdvBarcodeThread;
	int m_nItemRow;

	DECLARE_MESSAGE_MAP()
public:
	BOOL m_bExit;
	CString m_szTempAdvBarcode;
	CListCtrl m_cListCtrl;

	afx_msg void OnEnChangeAdvanchkoutbarcode();
	void AdvBarcodeCheckList();
	afx_msg void OnLvnItemchangedList1(NMHDR *pNMHDR, LRESULT *pResult);
	afx_msg void OnLvnItemActivateList1(NMHDR *pNMHDR, LRESULT *pResult);
	afx_msg void OnBnClickedDelete();
};
