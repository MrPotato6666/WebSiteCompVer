
// VisualStockManagerDlg.cpp : implementation file
//

#include "stdafx.h"
#include "VisualStockManagerDlg.h"
#include "afxdialogex.h"
#include "BarcodeEntry.h"
#include "ProductDetailsEntry.h"
#include "AdvancedCheckOut.h"
#include <string>

#ifdef _DEBUG
#define new DEBUG_NEW
#endif


// CAboutDlg dialog used for App About

class CAboutDlg : public CDialogEx
{
public:
	CAboutDlg();

// Dialog Data
#ifdef AFX_DESIGN_TIME
	enum { IDD = IDD_ABOUTBOX };
#endif

	protected:
	virtual void DoDataExchange(CDataExchange* pDX);    // DDX/DDV support

// Implementation
protected:
	DECLARE_MESSAGE_MAP()
};

CAboutDlg::CAboutDlg() : CDialogEx(IDD_ABOUTBOX)
{
}

void CAboutDlg::DoDataExchange(CDataExchange* pDX)
{
	CDialogEx::DoDataExchange(pDX);
}

BEGIN_MESSAGE_MAP(CAboutDlg, CDialogEx)
END_MESSAGE_MAP()


// CVisualStockManagerDlg dialog



CVisualStockManagerDlg::CVisualStockManagerDlg(CWnd* pParent /*=NULL*/)
	: CDialogEx(IDD_VISUALSTOCKMANAGER_DIALOG, pParent)
{
	m_hIcon = AfxGetApp()->LoadIcon(IDR_MAINFRAME);
	pApp = (CVisualStockManagerApp*)AfxGetApp();
	if(pApp)
		pApp->StockManageApp.InitInstances();
}

void CVisualStockManagerDlg::DoDataExchange(CDataExchange* pDX)
{
	CDialogEx::DoDataExchange(pDX);
	DDX_Control(pDX, IDC_LIST1, m_lbMessage);
	DDX_Control(pDX, IDC_BUTTON1, m_btnBarcode);
}

BEGIN_MESSAGE_MAP(CVisualStockManagerDlg, CDialogEx)
	ON_WM_SYSCOMMAND()
	ON_WM_PAINT()
	ON_WM_QUERYDRAGICON()
	ON_STN_CLICKED(IDC_STATIC_TITLE, &CVisualStockManagerDlg::OnStnClickedStaticTitle)
	ON_BN_CLICKED(IDC_BUTTON1, &CVisualStockManagerDlg::OnEnterBarCode)
	ON_BN_CLICKED(IDC_BUTTON4, &CVisualStockManagerDlg::LookupImage)
	ON_BN_CLICKED(IDC_BUTTON3, &CVisualStockManagerDlg::CheckOutMultiple)
	ON_BN_CLICKED(IDC_BUTTON2, &CVisualStockManagerDlg::CheckOutInstant)
	ON_BN_CLICKED(IDC_BUTTON5, &CVisualStockManagerDlg::AdvancedCheckOut)
END_MESSAGE_MAP()


// CVisualStockManagerDlg message handlers

BOOL CVisualStockManagerDlg::OnInitDialog()
{
	CDialogEx::OnInitDialog();
	m_pDlgFont = new CFont();
	m_pDlgFont->CreatePointFont(100, _T("Times New Roman"), NULL);
	GetDlgItem(IDC_STATIC_TITLE)->SetFont(m_pDlgFont);

	// Add "About..." menu item to system menu.

	// IDM_ABOUTBOX must be in the system command range.
	ASSERT((IDM_ABOUTBOX & 0xFFF0) == IDM_ABOUTBOX);
	ASSERT(IDM_ABOUTBOX < 0xF000);

	CMenu* pSysMenu = GetSystemMenu(FALSE);
	if (pSysMenu != NULL)
	{
		BOOL bNameValid;
		CString strAboutMenu;
		bNameValid = strAboutMenu.LoadString(IDS_ABOUTBOX);
		ASSERT(bNameValid);
		if (!strAboutMenu.IsEmpty())
		{
			pSysMenu->AppendMenu(MF_SEPARATOR);
			pSysMenu->AppendMenu(MF_STRING, IDM_ABOUTBOX, strAboutMenu);
		}
	}

	// Set the icon for this dialog.  The framework does this automatically
	//  when the application's main window is not a dialog
	SetIcon(m_hIcon, TRUE);			// Set big icon
	SetIcon(m_hIcon, FALSE);		// Set small icon

	// TODO: Add extra initialization here

	return TRUE;  // return TRUE  unless you set the focus to a control
}

void CVisualStockManagerDlg::OnSysCommand(UINT nID, LPARAM lParam)
{
	if ((nID & 0xFFF0) == IDM_ABOUTBOX)
	{
		CAboutDlg dlgAbout;
		dlgAbout.DoModal();
	}
	else
	{
		CDialogEx::OnSysCommand(nID, lParam);
	}
}

// If you add a minimize button to your dialog, you will need the code below
//  to draw the icon.  For MFC applications using the document/view model,
//  this is automatically done for you by the framework.

void CVisualStockManagerDlg::OnPaint()
{
	if (IsIconic())
	{
		CPaintDC dc(this); // device context for painting

		SendMessage(WM_ICONERASEBKGND, reinterpret_cast<WPARAM>(dc.GetSafeHdc()), 0);

		// Center icon in client rectangle
		int cxIcon = GetSystemMetrics(SM_CXICON);
		int cyIcon = GetSystemMetrics(SM_CYICON);
		CRect rect;
		GetClientRect(&rect);
		int x = (rect.Width() - cxIcon + 1) / 2;
		int y = (rect.Height() - cyIcon + 1) / 2;

		// Draw the icon
		dc.DrawIcon(x, y, m_hIcon);
	}
	else
	{
		CDialogEx::OnPaint();
	}
}

// The system calls this function to obtain the cursor to display while the user drags
//  the minimized window.
HCURSOR CVisualStockManagerDlg::OnQueryDragIcon()
{
	return static_cast<HCURSOR>(m_hIcon);
}

void CVisualStockManagerDlg::OnStnClickedStaticTitle()
{
	// TODO: Add your control notification handler code here
}

void CVisualStockManagerDlg::OnEnterBarCode()
{
	// TODO: Add your control notification handler code here
	BarcodeEntry dlgBarcode;
	ProductDetailsEntry dlgProductDetails(1);
	BOOL bResult = false;

	//m_btnBarcode.GetWindowTextW(dlgBarcode.m_szBarcode);
	if (dlgBarcode.DoModal() == IDOK)
	{
		CString szMsg;
		szMsg.Format(_T("Barcode : %s has been enter"), dlgBarcode.m_szBarcode);
		DisplayMessage(szMsg);
		if (pApp)
		{
			pApp->StockManageApp.m_szBarcode = dlgBarcode.m_szBarcode;
			bResult = pApp->StockManageApp.BarcodeProcess();
		}
		if (!bResult)
		{
			if (AfxMessageBox(_T("New Barcode Enter\n Do You Want To Add Into System Storage? "), MB_YESNO | MB_ICONINFORMATION) == IDYES)
			{
				if (dlgProductDetails.DoModal() == IDOK)
				{
					pApp->StockManageApp.DataWrite(-1, dlgProductDetails.m_szProductName, dlgProductDetails.m_szProdescrip, dlgProductDetails.m_szQuantity, _T("0"), dlgProductDetails.m_szBarcode);
				}
			}
		}else
		{
			szMsg.Format(_T("Product Details\n"
				"Barcode: %s\n"
				"Product Name: %s\n"
				"Product Description: %s\n"
				"Quantity: %d\n"
				"Do You Want To Change Product Details? "), pApp->StockManageApp.m_szBarcode, pApp->StockManageApp.m_szProductName, pApp->StockManageApp.m_szProdescrp, pApp->StockManageApp.m_nQuantity);
			if (AfxMessageBox(szMsg, MB_YESNO | MB_ICONINFORMATION) == IDYES)
			{
				dlgProductDetails.m_szBarcode = pApp->StockManageApp.m_szBarcode;
				dlgProductDetails.m_szProductName = pApp->StockManageApp.m_szProductName;
				dlgProductDetails.m_szProdescrip = pApp->StockManageApp.m_szProdescrp;
				CString szMessage;
				szMessage.Format(_T("%d"), pApp->StockManageApp.m_nQuantity);
				dlgProductDetails.m_szQuantity = szMessage;
				if (dlgProductDetails.DoModal() == IDOK)
				{
					pApp->StockManageApp.DataWrite(pApp->StockManageApp.m_nProdRow, dlgProductDetails.m_szProductName, dlgProductDetails.m_szProdescrip, dlgProductDetails.m_szQuantity, szMessage, dlgProductDetails.m_szBarcode);
				}
			}
		}
	}
	//m_btnBarcode.SetWindowTextW(dlgBarcode.m_szBarcode);
}

void CVisualStockManagerDlg::CheckOutMultiple()
{
	// TODO: Add your control notification handler code here
	BOOL bResult = false;
	BarcodeEntry dlgBarcode;
	ProductDetailsEntry dlgProductDetails(2);
	CString szMsg, szTempQuantity, szTempOldQuantity;
	int nTempQuantity;

	if(pApp)
	{
		if (dlgBarcode.DoModal() == IDOK)
		{
			pApp->StockManageApp.m_szBarcode = dlgBarcode.m_szBarcode;
			bResult = pApp->StockManageApp.BarcodeProcess();

			if (bResult == false)
			{
				szMsg.Format(_T("Barcode : %s not found"), dlgBarcode.m_szBarcode);
				DisplayMessage(szMsg);
				return;
			}
			dlgProductDetails.m_szBarcode = pApp->StockManageApp.m_szBarcode;
			dlgProductDetails.m_szProductName = pApp->StockManageApp.m_szProductName;
			dlgProductDetails.m_szProdescrip = pApp->StockManageApp.m_szProdescrp;

			if (dlgProductDetails.DoModal() == IDOK)
			{
				if (dlgProductDetails.m_szQuantity != "")
				{
					CT2CA pszConvertedAnsiString(dlgProductDetails.m_szQuantity);
					string std(pszConvertedAnsiString);
					nTempQuantity = stoi(std);
					nTempQuantity = pApp->StockManageApp.m_nQuantity - nTempQuantity;
					szTempOldQuantity.Format(_T("%d"), pApp->StockManageApp.m_nQuantity);
					szTempQuantity.Format(_T("%d"), nTempQuantity);

					pApp->StockManageApp.DataWrite(pApp->StockManageApp.m_nProdRow, _T(""), _T(""), szTempQuantity, szTempOldQuantity, _T(""));
				}
			}
		}
	}
}

void CVisualStockManagerDlg::CheckOutInstant()
{
	// TODO: Add your control notification handler code here
	BOOL bResult = false;
	BarcodeEntry dlgBarcode;
	//BarcodeEntry* dlgBarcode1 = new BarcodeEntry();
	ProductDetailsEntry dlgProductDetails(2);
	CString szMsg, szTempQuantity, szTempOldQuantity;

	if (pApp)
	{
		//dlgBarcode1->Create(IDD_BARCODE_ENTRY, this);
		//CWnd *pWnd = CWnd::FindWindowW(NULL, _T("Barcode Entry"));
		//CWnd *pWnd1 = CWnd::FindWindowExW(*pWnd, NULL, NULL, _T("OK"));
		//Sleep(1000);
		//SendMessageA((HWND)*pWnd, WM_COMMAND, 1, NULL);
		if (dlgBarcode.DoModal() == IDOK)
		{
			pApp->StockManageApp.m_szBarcode = dlgBarcode.m_szBarcode;
			bResult = pApp->StockManageApp.BarcodeProcess();

			if (bResult == false)
			{
				szMsg.Format(_T("Barcode : %s not found"), dlgBarcode.m_szBarcode);
				DisplayMessage(szMsg);
				return;
			}
			szTempOldQuantity.Format(_T("%d"), pApp->StockManageApp.m_nQuantity);
			szTempQuantity.Format(_T("%d"), pApp->StockManageApp.m_nQuantity - 1);

			pApp->StockManageApp.DataWrite(pApp->StockManageApp.m_nProdRow, _T(""), _T(""), szTempQuantity, szTempOldQuantity, _T(""));
		}
	}
}

void CVisualStockManagerDlg::AdvancedCheckOut()
{
	// TODO: Add your control notification handler code here
	CAdvancedCheckOut dlgAdvanChkOut;
	INT_PTR nResponse = dlgAdvanChkOut.DoModal();
}

void CVisualStockManagerDlg::LookupImage()
{
	// TODO: Add your control notification handler code here
	CString szMsg;
	BarcodeEntry dlgBarcode;
	if (dlgBarcode.DoModal() == IDOK)
	{
		szMsg.Format(_T("%s.png "), dlgBarcode.m_szBarcode);
		if (pApp)
		{
			if (!pApp->StockManageApp.ImageLoad(dlgBarcode.m_szBarcode))
			{
				szMsg.Append(_T("fail to load"));
			}
			else
			{
				szMsg.Append(_T("sucess to load"));
			}
			DisplayMessage(szMsg);
		}
	}
}

void CVisualStockManagerDlg::DisplayMessage(const CString& szMessage)
{
	INT nIndex = m_lbMessage.AddString(szMessage);
	m_lbMessage.PostMessage(LB_SETCURSEL, nIndex, 0);
	m_lbMessage.PostMessage(LB_SETCURSEL, -1, 0);
}