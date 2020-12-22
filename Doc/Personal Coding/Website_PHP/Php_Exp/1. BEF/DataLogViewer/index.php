<?
include 'machine.php';
include 'timeslot.php';
$file=isset($_GET["file"])?$_GET["file"]:0;
$page=isset($_GET["page"])?$_GET["page"]:1;
$timeslot=isset($_GET["timeslot"])?$_GET["timeslot"]:0;

//if (($machine=="sr")&&($timeslot==0))
//	$timeslot=(Integer)(date("G")/(24/$totaltimeslot))+1;
if ($page>$totalpagenum) $page=$totalpagenum;
if ($timeslot>$totaltimeslot) $timeslot=$totaltimeslot;

?>
<html>
<? if ( ($file==0) && (($timeslot==0)||($timeslot==((Integer)(date("G")/6)+1))) )
	echo "<META HTTP-EQUIV=Refresh CONTENT=\"300\">\n";
?>
<frameset cols="180,*" border=0>
	<frame src="control.php?file=<?=$file?>&page=<?=$page?>&timeslot=<?=$timeslot?>" frameborder=0 noresize></frame>
	<frame src="plot.php?file=<?=$file?>&page=<?=$page?>&timeslot=<?=$timeslot?>" frameborder=0 scrolling=no name="plot" noresize></frame>
	<?/*<frame src="blank.html" frameborder=0 scrolling=no noresize></frame>*/?>
</frameset>
</html>
