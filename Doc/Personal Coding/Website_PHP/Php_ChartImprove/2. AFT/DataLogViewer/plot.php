<html>
<?php
date_default_timezone_set('Asia/Singapore');
if (isset($_GET["file"])&&isset($_GET["page"])&&isset($_GET["timeslot"])&&isset($_GET["MachineName"]))
{
	session_start();
	$_SESSION['unitcount']=0;
	//$_SESSION['lastaccess']=$_SESSION['accesstime'];
	echo "<frameset cols='10,*' border=0>\n";
	//echo "<frame scrolling=no noresize frameborder=0 src='yaxis.php?MachineName=$_GET[MachineName]&file=$_GET[file]&page=$_GET[page]&".strip_tags(SID)."'></frame>\n";
	echo "<frame></frame>\n";
	echo "<frame scrolling=auto noresize frameborder=0 src='showimage.php?MachineName=$_GET[MachineName]&file=$_GET[file]&page=$_GET[page]&timeslot=$_GET[timeslot]&".strip_tags(SID)."'></frame>\n";
	echo "</frameset>\n";
	
}
?>
</html>