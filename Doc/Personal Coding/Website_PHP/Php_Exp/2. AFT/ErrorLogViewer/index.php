<?
include 'machine.php';
include 'errorcode.php';
$file=isset($_GET["file"])?$_GET["file"]:0;
$line=isset($_GET["line"])?$_GET["line"]:1;
$errorcode=isset($_GET["errorcode"])?$_GET["errorcode"]:-1;
$stat=isset($_GET["stat"])?$_GET["stat"]:0;
$mode=isset($_GET["mode"])?$_GET["mode"]:-1;
$show=isset($_GET["show"])?$_GET["show"]:0;
?>
<html>

<frameset cols="15%,*"border=0>
	<frame src="control.php?file=<?=$file?>&line=<?=$line?>&errorcode=<?=$errorcode?>&mode=<?=$mode?>" frameborder=0 noresize></frame>
	<frame src="plot.php?file=<?=$file?>&line=<?=$line?>&errorcode=<?=$errorcode?>&stat=<?=$stat?>&mode=<?=$mode?>&show=<?=$show?>" frameborder=0 scrolling=no name="plot" noresize></frame>
</frameset>
</html>
