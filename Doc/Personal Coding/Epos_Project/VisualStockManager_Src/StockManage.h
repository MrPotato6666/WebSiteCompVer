#pragma once
#include "libxl.h"

using namespace std;
using namespace libxl;

class CStockManage 
{


public:
	CStockManage();
	~CStockManage();
	BOOL InitInstances();
	void DisplayMessage(const CString& szMessage);
	BOOL BarcodeProcess();
	BOOL DataWrite(int nRow, CString szProductName, CString szProdescrip, CString szQuantity, CString szOldQuantity, CString szBarcode);
	BOOL ImageLoad(CString szBarcode);
	CString m_szBarcode, m_szProductName, m_szProdescrp;
	int m_nQuantity, m_nProdRow;
	Book* book;
	Sheet* sheet;

};