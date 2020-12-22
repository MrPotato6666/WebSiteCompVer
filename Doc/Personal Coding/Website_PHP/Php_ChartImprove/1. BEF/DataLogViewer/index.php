<?
$MachineName=isset($_GET["MachineName"])?$_GET["MachineName"]:"HT4";
include 'machine.php';
include 'timeslot.php';
date_default_timezone_set('Asia/Singapore');
session_start();
$file=isset($_GET["file"])?$_GET["file"]:0;
$page=isset($_GET["page"])?$_GET["page"]:1;
$timeslot=isset($_GET["timeslot"])?$_GET["timeslot"]:0;
$mode=isset($_GET["mode"])?$_GET["mode"]:0;

if(!empty($_POST['name'])){ 
	$file = $_POST['name'];
	//echo "@@";
}

//if (($machine=="SUV" || $machine == "HT")&&($timeslot==0)&&($mode==0))
if (($timeslot==0)&&($mode==0))
	$timeslot=(Integer)(date("G")/(24/$totaltimeslot))+1;
if ($page>$totalpagenum) $page=$totalpagenum;
if ($timeslot>$totaltimeslot) $timeslot=$totaltimeslot;

?>
<html>
<? if ( ($file==0) && (($timeslot==0)||($timeslot==((Integer)(date("G")/6)+1))) )
{
	//if(!isset($_SESSION['unitcount']))
	//	echo "<META HTTP-EQUIV=Refresh CONTENT=\"1\">\n";
	//else
	echo "<META HTTP-EQUIV=Refresh CONTENT=\"300\">\n";
}
?>
<frameset cols="260,*" border=0>
	<frame src="control.php?MachineName=<?=$MachineName?>&file=<?=$file?>&page=<?=$page?>&timeslot=<?=$timeslot?>&mode=<?=$mode?>" frameborder=0 noresize></frame>
	<frame src="plot.php?MachineName=<?=$MachineName?>&file=<?=$file?>&page=<?=$page?>&timeslot=<?=$timeslot?>" frameborder=0 scrolling=no name="plot" noresize></frame>
	<?/*<frame src="blank.html" frameborder=0 scrolling=no noresize></frame>*/?>
</frameset>
</html>
