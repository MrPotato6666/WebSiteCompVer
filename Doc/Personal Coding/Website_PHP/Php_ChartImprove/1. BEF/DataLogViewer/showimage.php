<html>
<body leftmargin="0" topmargin="0" bgcolor=black onload="scrollBy(30000,0)">
<?
$page=isset($_GET["page"])?$_GET["page"]:1;
$file=isset($_GET["file"])?$_GET["file"]:0;
$timeslot=isset($_GET["timeslot"])?$_GET["timeslot"]:0;
$MachineName=isset($_GET["MachineName"])?$_GET["MachineName"]:"HT4";

if (isset($_GET["file"])&&isset($_GET["page"])&&isset($_GET["timeslot"]))
{
	session_start();
	//echo $MachineName;
	//$showday=mktime(0, 0, 0, date("m")  , (date("d")+$file), date("Y"));
	//if(substr($MachineName, 0, 3) == "AVI")
	//	$filename = date("\YY\Mm\Dd",$showday)."10Min_date.csv"; 
	//echo $filename;
	echo "<img src='image.php?MachineName=$_GET[MachineName]&file=$_GET[file]&page=$_GET[page]&timeslot=$_GET[timeslot]&".strip_tags(SID)."'>";
}
else
{
	echo "Invalid Access!";
}
?>
</body>
</html>