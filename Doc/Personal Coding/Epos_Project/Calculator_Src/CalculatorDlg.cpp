
// CalculatorDlg.cpp : implementation file
//

#include "stdafx.h"
#include "Calculator.h"
#include "CalculatorDlg.h"
#include "afxdialogex.h"

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

UINT DisplayMessagaThread(LPVOID pParam)
{
	CCalculatorDlg* pCalculatorDlg = (CCalculatorDlg*)pParam;
	if(!pCalculatorDlg->IsKindOf(RUNTIME_CLASS(CCalculatorDlg)) || pCalculatorDlg == NULL)
	{
		return 1;
	}
	int nIndex;
	
	while (1)
	{
		//nIndex = pCalculatorDlg->m_pListBox.AddString(pCalculatorDlg->m_szValue);
		//pCalculatorDlg->m_pListBox.SendMessageW(nIndex, 0);
		pCalculatorDlg->m_pListBox.AddString(pCalculatorDlg->m_szValue);
		Sleep(1000);
	}

	return 1;
}

// CCalculatorDlg dialog

CCalculatorDlg::CCalculatorDlg(CWnd* pParent /*=NULL*/)
	: CDialogEx(IDD_CALCULATOR_DIALOG, pParent)
{
	m_hIcon = AfxGetApp()->LoadIcon(IDR_MAINFRAME);
	//m_szValue = "0";
	 
}

void CCalculatorDlg::DoDataExchange(CDataExchange* pDX)
{
	CDialogEx::DoDataExchange(pDX);
	DDX_Control(pDX, IDC_LIST1, m_pListBox);
}

BEGIN_MESSAGE_MAP(CCalculatorDlg, CDialogEx)
	ON_WM_SYSCOMMAND()
	ON_WM_PAINT()
	ON_WM_QUERYDRAGICON()
	ON_LBN_SELCHANGE(IDC_LIST1, &CCalculatorDlg::OnLbnSelchangeList1)
	ON_BN_CLICKED(IDC_BUTTON1, &CCalculatorDlg::OnBnClickedButton1)
	ON_BN_CLICKED(IDC_BUTTON2, &CCalculatorDlg::OnBnClickedButton2)
	ON_BN_CLICKED(IDC_BUTTON3, &CCalculatorDlg::OnBnClickedButton3)
	ON_BN_CLICKED(IDC_BUTTON4, &CCalculatorDlg::OnBnClickedButton4)
	ON_BN_CLICKED(IDC_BUTTON5, &CCalculatorDlg::OnBnClickedButton5)
	ON_BN_CLICKED(IDC_BUTTON6, &CCalculatorDlg::OnBnClickedButton6)
	ON_BN_CLICKED(IDC_BUTTON7, &CCalculatorDlg::OnBnClickedButton7)
	ON_BN_CLICKED(IDC_BUTTON8, &CCalculatorDlg::OnBnClickedButton8)
	ON_BN_CLICKED(IDC_BUTTON9, &CCalculatorDlg::OnBnClickedButton9)
	ON_BN_CLICKED(IDC_BUTTON10, &CCalculatorDlg::OnBnClickedButton10)
END_MESSAGE_MAP()


// CCalculatorDlg message handlers

BOOL CCalculatorDlg::OnInitDialog()
{
	CDialogEx::OnInitDialog();
	m_pFont.CreatePointFont(350, _T("Maiandra GD"));
	m_pListBox.SetFont(&m_pFont);

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

	m_pDisplayThread = AfxBeginThread(DisplayMessagaThread, this, THREAD_PRIORITY_NORMAL);
	// TODO: Add extra initialization here

	return TRUE;  // return TRUE  unless you set the focus to a control
}

void CCalculatorDlg::OnSysCommand(UINT nID, LPARAM lParam)
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

void CCalculatorDlg::OnPaint()
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
HCURSOR CCalculatorDlg::OnQueryDragIcon()
{
	return static_cast<HCURSOR>(m_hIcon);
}

void CCalculatorDlg::OnLbnSelchangeList1()
{
	//m_pListBox.PostMessage(nIndex, 0);
}

void CCalculatorDlg::OnBnClickedButton1()
{
	// TODO: Add your control notification handler code here
	m_szValue.AppendFormat(_T("1"));
}

void CCalculatorDlg::OnBnClickedButton2()
{
	// TODO: Add your control notification handler code here
	m_szValue.AppendFormat(_T("2"));
}


void CCalculatorDlg::OnBnClickedButton3()
{
	// TODO: Add your control notification handler code here
	m_szValue.AppendFormat(_T("3"));
}


void CCalculatorDlg::OnBnClickedButton4()
{
	// TODO: Add your control notification handler code here
	m_szValue.AppendFormat(_T("4"));
}


void CCalculatorDlg::OnBnClickedButton5()
{
	// TODO: Add your control notification handler code here
	m_szValue.AppendFormat(_T("5"));
}


void CCalculatorDlg::OnBnClickedButton6()
{
	// TODO: Add your control notification handler code here
	m_szValue.AppendFormat(_T("6"));
}


void CCalculatorDlg::OnBnClickedButton7()
{
	// TODO: Add your control notification handler code here
	m_szValue.AppendFormat(_T("7"));
}


void CCalculatorDlg::OnBnClickedButton8()
{
	// TODO: Add your control notification handler code here
	m_szValue.AppendFormat(_T("8"));
}


void CCalculatorDlg::OnBnClickedButton9()
{
	// TODO: Add your control notification handler code here
	m_szValue.AppendFormat(_T("9"));
}


void CCalculatorDlg::OnBnClickedButton10()
{
	// TODO: Add your control notification handler code here
	m_szValue = "";
}
