
// VisualStockManagerDlg.h : header file
//

#pragma once
#include "afxwin.h"
#include "VisualStockManager.h"


// CVisualStockManagerDlg dialog
class CVisualStockManagerDlg : public CDialogEx
{
// Construction
public:
	CVisualStockManagerDlg(CWnd* pParent = NULL);	// standard constructor

// Dialog Data
#ifdef AFX_DESIGN_TIME
	enum { IDD = IDD_VISUALSTOCKMANAGER_DIALOG };
#endif

	protected:
	virtual void DoDataExchange(CDataExchange* pDX);	// DDX/DDV support


// Implementation
protected:
	HICON m_hIcon;
	CFont *m_pDlgFont;

	// Generated message map functions
	virtual BOOL OnInitDialog();
	afx_msg void OnSysCommand(UINT nID, LPARAM lParam);
	afx_msg void OnPaint();
	afx_msg HCURSOR OnQueryDragIcon();
	DECLARE_MESSAGE_MAP()
public:
	CListBox m_lbMessage;

	afx_msg void OnStnClickedStaticTitle();
	afx_msg void OnEnterBarCode();
	void DisplayMessage(const CString& szMessage);
	CButton m_btnBarcode;
	afx_msg void LookupImage();
	afx_msg void CheckOutMultiple();
	CVisualStockManagerApp* pApp;
	afx_msg void CheckOutInstant();
	afx_msg void AdvancedCheckOut();
};
