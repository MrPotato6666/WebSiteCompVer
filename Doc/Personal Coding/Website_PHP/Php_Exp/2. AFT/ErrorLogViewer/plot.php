<html>
<?php
$stat=isset($_GET["stat"])?$_GET["stat"]:0;
$mode=isset($_GET["mode"])?$_GET["mode"]:-1;
$show=isset($_GET["show"])?$_GET["show"]:0;
if (isset($_GET["file"])&&isset($_GET["line"])&&isset($_GET["errorcode"]))
{
	echo "<frameset cols='20,*' border=0>\n";
	echo "<frame scrolling=no noresize frameborder=0 src='yaxis.html'></frame>\n";
	echo "<frame scrolling=auto noresize frameborder=0 src='showitem.php?file=$_GET[file]&line=$_GET[line]&errorcode=$_GET[errorcode]&stat=$stat&mode=$mode&show=$show'></frame>\n";
	echo "</frameset>\n";
	
}
?>
</html>