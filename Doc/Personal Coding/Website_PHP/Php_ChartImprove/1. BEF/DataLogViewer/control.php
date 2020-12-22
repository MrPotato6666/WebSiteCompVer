<?
date_default_timezone_set('Asia/Singapore');
$page=isset($_GET["page"])?$_GET["page"]:1;
$file=isset($_GET["file"])?$_GET["file"]:0;
$timeslot=isset($_GET["timeslot"])?$_GET["timeslot"]:0;
$mode=isset($_GET["mode"])?$_GET["mode"]:0;
$MachineName=isset($_GET["MachineName"])?$_GET["MachineName"]:"HT4";
//echo $_POST['dateselect'];
if(!empty($_POST['name'])){ 
	$file = $_POST['name'];
	echo "@@";
}
//echo "file".$file;
//echo "page".$page;
include 'machine.php';
include 'timeslot.php';
?>
<html>
<body bgcolor=black leftmargin="0" topmargin="0" text=yellow link=yellow vlink=yellow alink=yellow>
<head>
	<link rel="stylesheet" href="../css/plot.css?v=1">
</head>
<a href="../../../" target=_top>Home</a>&nbsp;&nbsp;<a href='../../ats.html' target=_top>ATS Home</a>&nbsp;&nbsp;<a href='../../atm.html' target=_top>ATM Home</a>
<FIELDSET>
<LEGEND><b>PARAMETER</b></LEGEND>
<?
for ($i=1;$i<=$totalpagenum;$i++)
{
	//echo "<li><font size=2><a href='index.php?MachineName=$MachineName&file=$file&page=$i' target=_top>".$pagetitle[$i]."</a></font><br>";
	echo "<li><a href='index.php?MachineName=$MachineName&file=$file&page=$i&timeslot=$timeslot&mode=$mode' target=_top>".$pagetitle[$i]."</a><br>";
}
?>
</FIELDSET>
<?
if($mode == 0)
{
	//echo(date("G"));
	echo "<FIELDSET><LEGEND><b>".date("Y\-m\-d")."</b></LEGEND>";
	$timeslot=(Integer)(date("G")/(24/$totaltimeslot))+1;
	echo "<li><a href='index.php?file=0&page=$page&timeslot=0&mode=$mode' target=_top>";
	echo "$starttime[$timeslot] - ".date("G:i:00");
	echo "</a>";
	for ($i=$timeslot-1;$i>=1;$i--)
	{
		echo "<li><a href='index.php?file=0&page=$page&timeslot=$i&mode=$mode' target=_top>";
		echo "$starttime[$i] - $stoptime[$i]";
		echo "</a>";
	}
	echo "<br></FIELDSET>";
	echo "<FIELDSET><LEGEND><b>".date("Y\-m\-d",strtotime("-1 day"))."</b></LEGEND>";
	for ($i=$totaltimeslot;$i>=$timeslot;$i--)
	{
		echo "<li><a href='index.php?MachineName=$MachineName&file=-1&page=$page&timeslot=$i&mode=$mode' target=_top>";
		echo "$starttime[$i] - $stoptime[$i]";
		echo "</a>";
	}
	echo "<br></FIELDSET>";
}
//else if (($machine=="SUV" || $machine == "HT") && $mode==1)
else if($mode == 1)
{
	echo "<FIELDSET><LEGEND><b>DATE</b></LEGEND>";
	for ($i=0;$i>=-4;$i--)
	{
		echo "<li><a href='index.php?MachineName=$MachineName&file=$i&page=$page&mode=$mode' target=_top>";
		echo date("Y\-m\-d",mktime(0, 0, 0, date("m")  , (date("d")+$i), date("Y")));
		echo "</a>";
	}
	echo "<br></FIELDSET>";
	
}
echo "<image src='legend.php?MachineName=$MachineName&page=$page'>";
if($machine != "SPA")	//TODO for SPA
	include 'statictics.php';

echo "<br>";
echo "<br>";
list($year, $month, $day, $hour, $minute, $second)= explode(':', date('Y:m:d:h:i:s'));
//echo '<form action='.$_SERVER['PHP_SELF'].' method="POST">';
echo "<div class='formstyle'>";
echo '<form action="/DataLogViewer/index.php?MachineName='.$MachineName.'&file='.$file.'&page='.$page.'&mode='.$mode.'" method="POST" target="_parent">';
echo "<select name='name' style='width:80pt'>";
echo "<option value=0> Select...         </option>";
for($i=0; $i<=31; $i++){
	$timestamp = mktime($hour, $minute, $second, $month, $day-$i, $year);
	$date = date('Y-m-d', $timestamp);
	echo "<option value='-$i'> $date </option>";
}
echo "</select>";
echo '<input type="submit" name="submit" value="Submit">';
echo "</form>";
echo "</div>";
?>
</body>
</html>
