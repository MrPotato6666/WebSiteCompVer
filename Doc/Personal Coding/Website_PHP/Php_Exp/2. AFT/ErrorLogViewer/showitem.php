<?
header('Content-Type:   text/html;   charset=UTF-8');   

$line=isset($_GET["line"])?$_GET["line"]:1;
$file=isset($_GET["file"])?$_GET["file"]:0;
$errorcode=isset($_GET["errorcode"])?$_GET["errorcode"]:0;
$stat=isset($_GET["stat"])?$_GET["stat"]:0;
$mode=isset($_GET["mode"])?$_GET["mode"]:-1;
$show=isset($_GET["show"])?$_GET["show"]:0;
if (($show>0)&&(1*$file==0))
	echo "<meta http-equiv=\"Refresh\" content=\"60\">\n";
?>
<html>
<META http-equiv="Content-Type" content="text/html; charset=UTF-8">
<body leftmargin="0" topmargin="0" bgcolor=black text=yellow link=yellow vlink=yellow alink=yellow>
<?

if (isset($_GET["file"])&&isset($_GET["line"])&&isset($_GET["errorcode"]))
{////////////////////////////////////////////////////////////////////////
	
$showday=mktime(0, 0, 0, date("m")+$file ,date("d"), date("Y"));
$filename = date("\YY\Mm",$showday)."_error.csv"; 
$fileopened=false;
if (($handle = fopen("c:\\WebRoot\\ErrorLog\\$filename", "r"))&&(($data = fgetcsv($handle, 10000, ",")) !== FALSE))
	$fileopened=true;
else
	$fileopened=false;

if ($fileopened)
{//-----------------------------------------------------------------------	
include "loaderrmsg.php";

$num = count($data);	set_time_limit(90);
$item_num=0;
$tmp_line=$line*1;
$tmp_errorcode=$errorcode*1;		
while(($data = fgetcsv($handle, 2000, ",")) !== FALSE)
{// while get data
//Time	Error Code	Line	Product	Description	Mode	Remarks
if (count($data)>=6)
{
	$bFound=false;
	if ($errorcode<0)
	{
		$tmp_num=$data[2]*1;
		if (($tmp_line==$tmp_num)||($tmp_line==-1))
			$bFound=true;
	}
	else
	{
		$tmp_num=$data[1]*1;
		if ($tmp_errorcode==$tmp_num)
			$bFound=true;		
	}
	if (($mode==0)&&($bFound))
	{
		if ($data[5]!="PROCESS")
			$bFound=false;
	}
	else if (($mode==1)&&($bFound))
	{
		if ($data[5]!="STANDBY")
			$bFound=false;
	}
	else if (($mode==2)&&($bFound))
	{
		if ($data[5]!="IDLE")
			$bFound=false;
	}
	if ($bFound)
	{
		if ($stat==0)
		{
			$item_num++;
			$list_time[$item_num]		=$data[0];
			$list_err_code[$item_num]	=$data[1];
			$list_line[$item_num]		=$data[2];
			$list_product[$item_num]	=$data[3];
			$list_description[$item_num]	=$data[4];
			$list_mode[$item_num]		=$data[5];
			$list_remark[$item_num]		="";
			for ($i=9;$i<count($data);$i++)
				$list_remark[$item_num].=$data[$i]." ";
		}
		else
		{
			$item_num++;
			$tmp_num=$data[1];
			$description[$tmp_num]=$data[4];
			if (isset($err[$tmp_num]))
				$err[$tmp_num]++;
			else
				$err[$tmp_num]=1;
		}
	}
}
}// end while get data
echo "<H3><b>";
echo "Time : ".date("\YY \Mm",$showday)." | ";
if ($errorcode<0)
{
	if ($tmp_line==-1)
		echo "All Errors | ";
	else if ($tmp_line==0)
		echo "Errors for both lines | ";
	else
		echo "Errors for Line $tmp_line | ";
}
else
{
	echo "Error Code = $errorcode | ";
}
if ($mode==0)
	echo "Process Mode | ";
else if ($mode==1)
	echo "Standby Mode | ";
else if ($mode==2)
	echo "Idle Mode	| ";
if ($show>0)
	echo "Show Last $show Errors Only";
else
	echo "Total : $item_num";
echo "</b></H3>";
echo "<table border=1>";
if ($stat==0)
{
	echo "<tr><td>Time</td><td>Error Code</td><td>Line</td><td>Mode</td><td>Product</td></tr>";
	$end_point=1;
	if ($show>0) $end_point=$item_num-$show;
	$row_index=0;
	for ($i=$item_num;$i>=$end_point;--$i)
	{
		$row_index++;
		if ($row_index%2==0)
			echo "<tr>";
		else
			echo "<tr bgcolor='#222222'>";
		echo "<td rowspan=2 width=80><font face='arial' color='gray'>".$list_time[$i]."</font></td>";
		echo "<td rowspan=2 width=50>";
		if ($errorcode<0)
			echo "<a href='index.php?file=$file&line=$line&errorcode=$list_err_code[$i]' target=_top><font face='arial' color='white'>$list_err_code[$i]</font></a>";
		else
			echo "<font face='arial' color='white'>".$list_err_code[$i]."</font>";
		echo "</td>";
		echo "<td><font face='arial' color='gray'>".$list_line[$i]."</font></td>";
		echo "<td><font face='arial' color='gray'>".$list_mode[$i]."</font></td>";
		echo "<td><font face='arial' color='gray'>".$list_product[$i]."</font></td>";
		echo "</tr>";
		if ($row_index%2==0)
			echo "<tr>";
		else
			echo "<tr bgcolor='#222222'>";			
		if (isset($errmsg[$list_err_code[$i]]))
			echo "<td colspan=2><font face='arial' color='yellow'>".$errmsg[$list_err_code[$i]]."</font></td>";
		else
			echo "<td colspan=2><font face='arial' color='yellow'>".$list_description[$i]."</font></td>";
		echo "<td colspan=1><font face='arial' color='yellow'>".$list_remark[$i]."</font></td>";
		echo "</tr>";
	}
}//if ($stat==0)
else // ($stat!=0)
{
	arsort($err);
	echo "<tr><td>Error Code</td><td>Error Count</td><td>Description</td></tr>";	
	$row_index=0;
	foreach ($err as $key => $value )
	{
		$row_index++;
		if ($row_index%2==0)
			echo "<tr>";
		else
			echo "<tr bgcolor='#222222'>";
		echo "<td>";
		echo "<a href='index.php?file=$file&line=$line&errorcode=$key' target=_top>$key</a>";
		echo "</td>";
		echo "<td>$value</td>";
		if (isset($errmsg[$key]))
			echo "<td colspan=2><font face='arial' color='yellow'>".$errmsg[$key]."</font></td>";
		else
			echo "<td colspan=2><font face='arial' color='yellow'>".$description[$key]."</font></td>";
		echo "</tr>";
	}
	
} // ($stat!=0)
echo "</table>";
	
}//-----------------------------------------------------------------------
else
{
	echo "Cannot Open $filename";
}	
}////////////////////////////////////////////////////////////////////////
else
{
	echo "Invalid Access!";
}
?>
</body>
</html>