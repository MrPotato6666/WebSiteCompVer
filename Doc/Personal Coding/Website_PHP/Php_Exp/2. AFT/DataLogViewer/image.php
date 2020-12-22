<?php session_start(); 
include 'color.php';
include 'machine.php';
include 'timeslot.php';
$page=isset($_GET["page"])?$_GET["page"]:1;
$file=isset($_GET["file"])?$_GET["file"]:0;
$timeslot=isset($_GET["timeslot"])?$_GET["timeslot"]:0;



//header("Content-type: image/png");

// file format is Y2005M10D06_data.csv
date_default_timezone_set("Asia/Shanghai"); 
$showday=mktime(0, 0, 0, date("m")  , (date("d")+$file), date("Y"));
$filename = date("\YY\Mm\Dd",$showday)."_data.csv"; 
$fileopened=false;
if (($handle = fopen("c:\\WebRoot\\DataLog\\$filename", "r"))&&(($data = fgetcsv($handle, 10000, ",")) !== FALSE))
	$fileopened=true;
else 
{
	//or Y2005M10D06.csv 
	$filename = date("\YY\Mm\Dd",$showday).".csv"; 
	if (($handle = fopen("c:\\WebRoot\\DataLog\\$filename", "r"))&&(($data = fgetcsv($handle, 10000, ",")) !== FALSE))
		$fileopened=true;
}
if ($fileopened)
{
	$num = count($data);
	
	set_time_limit(90);
	for ($i=1;$i<=$pagesize[$page];$i++)
	{
		$valuemax[($ItemUnit[$page][$i])]=-1;
		$valuemin[$ItemUnit[$page][$i]]=999;
	
		$targetCol[$i]=0;
		for ($c=0; $c < $num; $c++) {
			if($pageitem[$page][$i]==$data[$c]) {
				$targetCol[$i]=$c;
				break;
			}
		}
	}
	
	$row=0;
	//$readlinecount=0;
	while(($data = fgetcsv($handle, 2000, ",")) !== FALSE)
	{
		//$readlinecount++;
		if (strtotime($data[0])>strtotime($stoptime[$timeslot]))
			break;
		else if (strtotime($data[0])>=strtotime($starttime[$timeslot]))
		{
			$row++;
			$time[$row]=$data[0];
			//echo $row." - ".$time[$row];
			for ($i=1;$i<=$pagesize[$page];$i++)
			{
				if ($targetCol[$i]!=0)
				{
					$value[$i][$row]=is_numeric($data[$targetCol[$i]])?$data[$targetCol[$i]]:-1;
					if (!isset($unitmax[$ItemUnit[$page][$i]]))
						if ($value[$i][$row]>$valuemax[$ItemUnit[$page][$i]])
							$valuemax[$ItemUnit[$page][$i]]=$value[$i][$row];
					if (!isset($unitmin[$ItemUnit[$page][$i]]))
						if ($value[$i][$row]<$valuemin[$ItemUnit[$page][$i]])
							$valuemin[$ItemUnit[$page][$i]]=$value[$i][$row];
					//echo " - ".$value[$i][$row];
				}
				else
				{
					$value[$i][$row]=-1;
				}
			}
		}
	}
	foreach($valuemax as $UNIT => $MAX)
	{
		if (isset($unitmax[$UNIT]))
			$valuemax[$UNIT]=$unitmax[$UNIT];
		if (isset($unitmin[$UNIT]))
			$valuemin[$UNIT]=$unitmin[$UNIT];
		if (isset($upperbound[$UNIT]))
			$valuemax[$UNIT]=($upperbound[$UNIT]<$valuemax[$UNIT])?$upperbound[$UNIT]:$valuemax[$UNIT];
		if (isset($lowerbound[$UNIT]))
			$valuemin[$UNIT]=($lowerbound[$UNIT]<$valuemax[$UNIT])?$lowerbound[$UNIT]:$valuemax[$UNIT];
	}
	if ($row==0)
	{
		$im = @imagecreate(400, 200)   or die("Cannot Initialize new GD image stream2");
		$background_color = imagecolorallocate($im, 0,0,0);
		$text_color = imagecolorallocate($im, 255, 255, 255);
		imagestring($im,10,0,0,"No Data Logged ",$text_color);
		imagestring($im,10,0,20,"on $filename from $starttime[$timeslot] to $stoptime[$timeslot]",$text_color);
		
		imagepng($im);
		imagedestroy($im);
		$_SESSION['unitcount']=-1;
		return;
	}	
	
	if ($machine=="nipd" && ($page==8 ||$page==9))
	{
		$imageH=570;
		$plotW=600;
		if ($plotW<=600)
			$plotW=600;	
		$imageW=$plotW+10;
		$space=$plotW/$row;
		if($space>1)
			$space=1;
	}
	else
	{
		$imageH=570;
		$plotW=$row*2;
		if ($plotW<=580)
			$plotW=580;	
		$imageW=$plotW+10;
		$space=$plotW/$row;
	}
	$im = @imagecreate($imageW, $imageH)   or die("Cannot Initialize new GD image stream");
	$background_color = imagecolorallocate($im, $R['bg'], $G['bg'], $B['bg']);
	$textcolor= imagecolorallocate($im,200,200,100);
	for ($i=1;$i<=$pagesize[$page];$i++)
		$color[$i] = imagecolorallocate($im, $R[$i], $G[$i], $B[$i]);
	$gridcolorX = imagecolorallocate($im, 0, 120, 0);
	$gridcolorY = imagecolorallocate($im, 0, 125, 0);
	
	$plotH=460;
	$y0=40;
	
	set_time_limit(90);
	//plot grid
	for ($i=$y0;$i<=$plotH+$y0;$i+=$plotH/4)
		imageline($im,0,$i,$plotW+10,$i,$gridcolorY);
	if ($machine=="nipd" && ($page==8 ||$page==9) )
	{
		for ($i=1;$i<=$plotW+1;$i+=20)
			imageline($im,$i,$y0,$i,$y0+$plotH,$gridcolorX);
	}
	else
	{
		for ($i=1;$i<=$plotW;$i+=10*$space)
			imageline($im,$i,$y0,$i,$y0+$plotH,$gridcolorX);
	}
	
	//plot data
	for ($i=1;$i<=$pagesize[$page];$i++)
	{
		if ($targetCol[$i]!=0)
		{
			$MIN=$valuemin[$ItemUnit[$page][$i]];
			$MAX=$valuemax[$ItemUnit[$page][$i]];
			if($MAX==$MIN) { $MAX++; $MIN--; }
			for($j=1;$j<$row;$j++)
			{
				$x1=$j*$space+$space/2;
				$x2=($j+1)*$space+$space/2;
				$y1=$plotH-($value[$i][$j]-$MIN)/($MAX-$MIN)*$plotH+$y0;
				$y2=$plotH-($value[$i][$j+1]-$MIN)/($MAX-$MIN)*$plotH+$y0;
				if (!$D[$i])
				{
					imagesetthickness($im,1);
					imageline($im, $x1, $y1, $x2, $y2, $color[$i]);
				}
				else
				{
					imagesetthickness($im,2);
					$style=array( IMG_COLOR_TRANSPARENT ,$color[$i], IMG_COLOR_TRANSPARENT ); 
					ImageSetStyle($im, $style);
					imageline($im, $x1, $y1, $x2, $y2, IMG_COLOR_STYLED);
				}
			}
		}
		else
			imagestring($im,5,5,50+$i*30,"Cannot find parameter : ".$pageitem[$page][$i],$textcolor);	
	}
	imagesetthickness ($im,1);
	//plot time
	if ($machine=="nipd" && ($page==8 ||$page==9))
	{
		for($j=1;$j<$row+1;$j++)
		{
			$spc=40/$space;
			$spc=(integer)$spc;
			if ($j%$spc==1)
				imagestringup($im,5, $j/$spc*40-5,$imageH,  $time[$j], $textcolor);
		}
	}
	else
	{
		for($j=1;$j<$row;$j++)
		if ($j%20==1)
			imagestringup($im,5, $space*$j-5,$imageH,  $time[$j], $textcolor);
	}
			
	$titlestring=$filename."  -  ".$pagetitle[$page];
	if ( ($file==0) && (($timeslot==0)||($timeslot==((Integer)(date("G")/(24/$totaltimeslot))+1))) )
			$titlestring.=" ($starttime[$timeslot] - ".date("G:i:s").")";
	else
		$titlestring.=" ($starttime[$timeslot]-$stoptime[$timeslot])";
	
	for($i=10;$i<$imageW;$i+=600)
	{
		imagestring($im,5,$i,2,$titlestring,$textcolor);	
	}
	//imagestring($im,3,20,30,"read line count = ".$readlinecount,$textcolor);
	imagepng($im);
	imagedestroy($im);
	
	$_SESSION['unitcount']=0;
	foreach($valuemax as $UNIT => $MAX)
	{
		$_SESSION['unitcount']++;
		$_SESSION['maxvalue'][$_SESSION['unitcount']]=sprintf("%.1f%s",$MAX,$UNIT);
		$_SESSION['midvalue'][$_SESSION['unitcount']]=sprintf("%.1f%s",(($MAX+$valuemin[$UNIT])/2),$UNIT);
		$_SESSION['minvalue'][$_SESSION['unitcount']]=sprintf("%.1f%s",$valuemin[$UNIT],$UNIT);
	}
	if ($_SESSION['unitcount']==0)
		$_SESSION['unitcount']=-1;
	//echo $_SESSION['maxvalue']."<br>";
	//echo $_SESSION['midvalue']."<br>";
	//echo $_SESSION['minvalue']."<br>";
		
}
else
{
	$im = @imagecreate(400, 200)   or die("Cannot Initialize new GD image stream2");
	$background_color = imagecolorallocate($im, 0,0,0);
	$text_color = imagecolorallocate($im, 255, 255, 255);
	imagestring($im,10,0,0,"No Data Logged on $filename",$text_color);
	imagepng($im);
	imagedestroy($im);
	$_SESSION['unitcount']=-1;
}
?>
