<?
$totalpagenum=12;						
$lowerbound["A"]=0;						$upperbound["A"]=150;
$lowerbound["V"]=0;						$upperbound["V"]=30;
$lowerbound["LPM"]=0;						$upperbound["LPM"]=40;
$lowerbound["M/Min"]=0;						$upperbound["M/Min"]=8;
$lowerbound[chr(176)."C"]=0;					$upperbound[chr(176)."C"]=220;
$lowerbound[chr(176)."C(Oven)"]=0;				$upperbound[chr(176)."C(Oven)"]=240;
$unitmin["V"]=0;   					
$unitmin["LPM"]=0;					
$unitmin["M/Min"]=0;						$unitmax["M/Min"]=2.5;
$unitmin[chr(176)."C"]=0;				
$unitmin[chr(176)."C(Oven)"]=0;			
						
$pagetitle[1]="L1 Current";						
$pagesize[1]=5;						
$pageitem[1][1]="L1 EC Current";			$ItemFactor[1][1]=1;			$ItemUnit[1][1]="A";
$pageitem[1][2]="L1 Ag Strike Current";		$ItemFactor[1][2]=1;			$ItemUnit[1][2]="A";
$pageitem[1][3]="L1 Cu Current";			$ItemFactor[1][3]=1;			$ItemUnit[1][3]="A";
$pageitem[1][4]="L1 BS Current";			$ItemFactor[1][4]=1;			$ItemUnit[1][4]="A";
$pageitem[1][5]="L1 KOH Current";			$ItemFactor[1][5]=1;			$ItemUnit[1][5]="A";
						
$pagetitle[2]="L2 Current";						
$pagesize[2]=5;						
$pageitem[2][1]="L2 EC Current";			$ItemFactor[2][1]=1;			$ItemUnit[2][1]="A";
$pageitem[2][2]="L2 Cu Current";			$ItemFactor[2][2]=1;			$ItemUnit[2][2]="A";
$pageitem[2][3]="L2 Ag Strike Current";		$ItemFactor[2][3]=1;			$ItemUnit[2][3]="A";
$pageitem[2][4]="L2 BS Current";			$ItemFactor[2][4]=1;			$ItemUnit[2][4]="A";
$pageitem[2][5]="L2 KOH Current";			$ItemFactor[2][5]=1;			$ItemUnit[2][5]="A";
						
$pagetitle[3]="L3 Current";						
$pagesize[3]=5;						
$pageitem[3][1]="L3 EC Current";			$ItemFactor[3][1]=1;			$ItemUnit[3][1]="A";
$pageitem[3][2]="L3 Cu Current";			$ItemFactor[3][2]=1;			$ItemUnit[3][2]="A";
$pageitem[3][3]="L3 Ag Strike Current";		$ItemFactor[3][3]=1;			$ItemUnit[3][3]="A";
$pageitem[3][4]="L3 BS Current";			$ItemFactor[3][4]=1;			$ItemUnit[3][4]="A";
$pageitem[3][5]="L3 KOH Current";			$ItemFactor[3][5]=1;			$ItemUnit[3][5]="A";
						
$pagetitle[4]="L1 Voltage";						
$pagesize[4]=5;						
$pageitem[4][1]="L1 EC Voltage";			$ItemFactor[4][1]=1;			$ItemUnit[4][1]="V";
$pageitem[4][2]="L1 Ag Strike Voltage";		$ItemFactor[4][2]=1;			$ItemUnit[4][2]="V";
$pageitem[4][3]="L1 Cu Voltage";			$ItemFactor[4][3]=1;			$ItemUnit[4][3]="V";
$pageitem[4][4]="L1 BS Voltage";			$ItemFactor[4][4]=1;			$ItemUnit[4][4]="V";
$pageitem[4][5]="L1 KOH Voltage";			$ItemFactor[4][5]=1;			$ItemUnit[4][5]="V";
						
$pagetitle[5]="L2 Voltage";						
$pagesize[5]=5;						
$pageitem[5][1]="L2 EC Voltage";			$ItemFactor[5][1]=1;			$ItemUnit[5][1]="V";
$pageitem[5][2]="L2 Cu Voltage";			$ItemFactor[5][2]=1;			$ItemUnit[5][2]="V";
$pageitem[5][3]="L2 Ag Strike Voltage";		$ItemFactor[5][3]=1;			$ItemUnit[5][3]="V";
$pageitem[5][4]="L2 BS Voltage";			$ItemFactor[5][4]=1;			$ItemUnit[5][4]="V";
$pageitem[5][5]="L2 KOH Voltage";			$ItemFactor[5][5]=1;			$ItemUnit[5][5]="V";
						
$pagetitle[6]="L3 Voltage";						
$pagesize[6]=5;						
$pageitem[6][1]="L3 EC Voltage";			$ItemFactor[6][1]=1;			$ItemUnit[6][1]="V";
$pageitem[6][2]="L3 Cu Voltage";			$ItemFactor[6][2]=1;			$ItemUnit[6][2]="V";
$pageitem[6][3]="L3 Ag Strike Voltage";		$ItemFactor[6][3]=1;			$ItemUnit[6][3]="V";
$pageitem[6][4]="L3 BS Voltage";			$ItemFactor[6][4]=1;			$ItemUnit[6][4]="V";
$pageitem[6][5]="L3 KOH Voltage";			$ItemFactor[6][5]=1;			$ItemUnit[6][5]="V";
						
$pagetitle[7]="L0 Cur&Vol";						
$pagesize[7]=2;						
$pageitem[7][1]="BS(Tank) Current";			$ItemFactor[7][1]=1;			$ItemUnit[7][1]="A";
$pageitem[7][2]="BS(Tank) Voltage";			$ItemFactor[7][2]=1;			$ItemUnit[7][2]="V";
						
$pagetitle[8]="Flow Rate";						
$pagesize[8]=6;						
$pageitem[8][1]="L1 DI";      			$ItemFactor[8][1]=1;			$ItemUnit[8][1]="LPM";
$pageitem[8][2]="L2 DI";      			$ItemFactor[8][2]=1;			$ItemUnit[8][2]="LPM";
$pageitem[8][3]="L3 DI";      			$ItemFactor[8][3]=1;			$ItemUnit[8][3]="LPM";
$pageitem[8][4]="L1 RO";      			$ItemFactor[8][4]=1;			$ItemUnit[8][4]="LPM";
$pageitem[8][5]="L2 RO";      			$ItemFactor[8][5]=1;			$ItemUnit[8][5]="LPM";
$pageitem[8][6]="L3 RO";      			$ItemFactor[8][6]=1;			$ItemUnit[8][6]="LPM";
						
$pagetitle[9]="Run Speed";						
$pagesize[9]=3;						
$pageitem[9][1]="L1 Run Speed";			$ItemFactor[9][1]=1;			$ItemUnit[9][1]="M/Min";
$pageitem[9][2]="L2 Run Speed";			$ItemFactor[9][2]=1;			$ItemUnit[9][2]="M/Min";
$pageitem[9][3]="L3 Run Speed";			$ItemFactor[9][3]=1;			$ItemUnit[9][3]="M/Min";
						
$pagetitle[10]="Normal Tem.";						
$pagesize[10]=7;						
$pageitem[10][1]="EC(1) Tem.";			$ItemFactor[10][1]=1;			$ItemUnit[10][1]=chr(176)."C";
$pageitem[10][2]="EC(2) Tem.";			$ItemFactor[10][2]=1;			$ItemUnit[10][2]=chr(176)."C";
$pageitem[10][3]="Ag Strike Tem.";   		$ItemFactor[10][3]=1;			$ItemUnit[10][3]=chr(176)."C";
$pageitem[10][4]="Ag Tem.";    			$ItemFactor[10][4]=1;			$ItemUnit[10][4]=chr(176)."C";
$pageitem[10][5]="M07 Water Tem.";   		$ItemFactor[10][5]=1;			$ItemUnit[10][5]=chr(176)."C";
$pageitem[10][6]="BS Tem.";	      		$ItemFactor[10][6]=1;			$ItemUnit[10][6]=chr(176)."C";
$pageitem[10][7]="M11 Water Tem.";   		$ItemFactor[10][7]=1;			$ItemUnit[10][7]=chr(176)."C";
						
$pagetitle[11]="Other Tem.";						
$pagesize[11]=4;						
$pageitem[11][1]="Cu PreDip Tem.";   		$ItemFactor[11][1]=1;			$ItemUnit[11][1]=chr(176)."C";
$pageitem[11][2]="L1/L2 Cu  Tem.";   		$ItemFactor[11][2]=1;			$ItemUnit[11][2]=chr(176)."C";
$pageitem[11][3]="L3 Cu Tem.";			$ItemFactor[11][3]=1;			$ItemUnit[11][3]=chr(176)."C";
$pageitem[11][4]="KOH Tem.";   			$ItemFactor[11][4]=1;			$ItemUnit[11][4]=chr(176)."C";
						
$pagetitle[12]="Tem.(Oven)";						
$pagesize[12]=3;						
$pageitem[12][1]="L1 Oven Tem.";			$ItemFactor[12][1]=1/3;			$ItemUnit[12][1]=chr(176)."C(Oven)";
$pageitem[12][2]="L2 Oven Tem.";			$ItemFactor[12][2]=1/3;			$ItemUnit[12][2]=chr(176)."C(Oven)";
$pageitem[12][3]="L3 Oven Tem.";			$ItemFactor[12][3]=1/3;			$ItemUnit[12][3]=chr(176)."C(Oven)";

?>