<?
include 'color.php';
include 'machine.php';

header("Content-type: image/png");
$page=isset($_GET["page"])?$_GET["page"]:1;

$imageH=3+18*$pagesize[$page];
$imageW=150;
$plotX=5;
$plotY=0;
$plotH=$imageH-2*$plotY;
$plotW=$imageW-2*$plotX;

$im = @imagecreate($imageW*100, $imageH)   or die("Cannot Initialize new GD image stream");
$background_color = imagecolorallocate($im, $R['bg'], $G['bg'], $B['bg']);
$textcolor=imagecolorallocate($im, 200, 200, 200);
$linecolor= imagecolorallocate($im,200,200,100);
for ($i=1;$i<=$pagesize[$page];$i++)
	$color[$i] = imagecolorallocate($im, $R[$i], $G[$i], $B[$i]);

for ($i=1;$i<=$pagesize[$page];$i++)
{
	if (!$D[$i])
	{
		imagesetthickness($im,1);
		imageline($im,$plotX,$plotY+18*$i-5,$plotX+$imageW/5,$plotY+18*$i-5,$color[$i]);
	}
	else
	{
		imagesetthickness($im,2);
		$style=array($color, $color[$i], IMG_COLOR_TRANSPARENT ); 
		ImageSetStyle($im, $style); 
		imageline($im,$plotX,$plotY+18*$i-5,$plotX+$imageW/5,$plotY+18*$i-5,IMG_COLOR_STYLED);
	}
	imagesetthickness($im,1);
	imagestring($im,3,$plotX+$imageW/5,$plotY+18*$i-10,$pageitem[$page][$i],$textcolor);
}

imagepng($im);
imagedestroy($im);

?>