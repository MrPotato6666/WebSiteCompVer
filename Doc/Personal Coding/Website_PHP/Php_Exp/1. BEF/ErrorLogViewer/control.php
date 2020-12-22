<?
$line=isset($_GET["line"])?$_GET["line"]:1;
$file=isset($_GET["file"])?$_GET["file"]:0;
$errorcode=isset($_GET["errorcode"])?$_GET["errorcode"]:0;
$mode=isset($_GET["mode"])?$_GET["mode"]:-1;
include 'machine.php';
include 'errorcode.php';
?>
<html>
<body bgcolor=black leftmargin="0" topmargin="0" text=yellow link=yellow vlink=yellow alink=yellow>
<FIELDSET>
<LEGEND><font color="yellow"><b>Filter</b></font></LEGEND>
<?
echo "<li><a href='index.php?file=0&line=-1&errorcode=-1&stat=0&mode=-1&show=20' target=_top><font face='arial'>Lastest 20</font></a><br>";
?>
</FIELDSET>
<br>
<FIELDSET>
<LEGEND><font color="yellow"><b>Filter</b></font></LEGEND>
<?
echo "<li><a href='index.php?file=$file&line=-1&errorcode=-1&stat=0&mode=-1' target=_top><font face='arial'>All Error</font></a><br>";
echo "<li><a href='index.php?file=$file&line=0&errorcode=-1&stat=0&mode=-1' target=_top><font face='arial'>Common Error</font></a><br>";
for ($i=1;$i<=$total_line_num;$i++)
{
	echo "<li><a href='index.php?file=$file&line=$i&errorcode=-1&stat=0&mode=-1' target=_top><font face='arial'>Line ".$i." Only</font></a><br>";
}
for ($i=1;$i<=$total_line_num;$i++)
{
	echo "<li><a href='index.php?file=$file&line=$i&errorcode=-1&stat=0&mode=0' target=_top><font face='arial'>Line ".$i." Normal Mode</font></a><br>";
	echo "<li><a href='index.php?file=$file&line=$i&errorcode=-1&stat=0&mode=1' target=_top><font face='arial'>Line ".$i." Motion Mode</font></a><br>";
}
?>
</FIELDSET>
<?
echo "<FIELDSET><LEGEND><span style=\"color:#ffff00;\"><b>View by Month</b></span></LEGEND>";
for ($i=0;$i>=-5;$i--)
{
	echo "<li><a href='index.php?file=$i&line=$line&errorcode=$errorcode&stat=0&mode=$mode' target=_top><font face='arial'>";
	echo date("Y\-m",mktime(0, 0, 0, date("m")+$i , (date("d")), date("Y")));
	echo "</font></a>";
}
echo "<br></FIELDSET>";
echo "<FIELDSET><LEGEND<span style=\"color:#ffff00;\"><b>Monthly Statistic</b></span></LEGEND>";
for ($i=0;$i>=-5;$i--)
{
	echo "<li><a href='index.php?file=$i&line=$line&errorcode=-1&stat=1&mode=$mode' target=_top><font face='arial'>";
	echo date("Y\-m",mktime(0, 0, 0, date("m")+$i , (date("d")), date("Y")));
	echo "</font></a>";
}
echo "<br></FIELDSET>";

?>
</body>
</html>
