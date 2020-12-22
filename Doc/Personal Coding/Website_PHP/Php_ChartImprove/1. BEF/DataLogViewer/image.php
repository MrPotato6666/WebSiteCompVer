<?php session_start(); 
include 'color.php';
include 'machine.php';
include 'timeslot.php';
$page=isset($_GET["page"])?$_GET["page"]:1;
$file=isset($_GET["file"])?$_GET["file"]:0;
$timeslot=isset($_GET["timeslot"])?$_GET["timeslot"]:0;
$MachineName=isset($_GET["MachineName"])?$_GET["MachineName"]:"HT4";

//header("Content-type: image/png");

// file format is Y2005M10D06_data.csv
$showday=mktime(0, 0, 0, date("m")  , (date("d")+$file), date("Y"));
if(substr($MachineName, 0, 3) == "RSA" || substr($MachineName, 0, 3) == "SPD" || substr($MachineName, 0, 3) == "SPA")
	$filename = "DataLog".date("Ymd",$showday).".xls";
else if(substr($MachineName, 0, 3) == "AVI")
	$filename = date("\YY\Mm\Dd",$showday)."10Min_date.csv"; 
else		//Include ME2
	$filename = date("\YY\Mm\Dd",$showday)."_data.csv"; 
//echo $filename."<br>";	//No info output here //echo it in showimage.php
$fileopened=false;

//include 'LogPath.php';
if($MachineName == "HT4")
	$LogPath = "\\\\10.12.110.14\\WebData\\$filename";
else if($MachineName == "HT5")
	$LogPath = "\\\\10.12.110.15\\WebData\\$filename";
else if($MachineName == "HT6")
	$LogPath = "\\\\10.12.110.16\\WebData\\$filename";
else if($MachineName == "HT7")
	$LogPath = "\\\\10.12.110.17\\WebData\\$filename";
else if($MachineName == "HT8")
	$LogPath = "\\\\10.12.110.18\\WebData\\$filename";
else if($MachineName == "SUV1")
	$LogPath = "\\\\10.8.120.44\\WebData\\$filename";
else if($MachineName == "LT1")
	$LogPath = "\\\\10.12.110.11\\WebData\\$filename";
else if($MachineName == "LT2")
	$LogPath = "\\\\10.12.110.12\\WebData\\$filename";
else if($MachineName == "RSA")
	$LogPath = "\\\\ATMRSA\\LogFile\\$filename";
else if($MachineName == "RSA2")
	$LogPath = "\\\\ATMRSA2\\ESG Log\\LogFile\\$filename";
else if($MachineName == "SPD1")
	$LogPath = "\\\\10.12.110.156\\NiPdPlatingLine\\LogFileDir\\$filename";
else if($MachineName == "SPD2")
	$LogPath = "\\\\10.12.110.189\\NiPdPlatingLine\\LogFileDir\\$filename";
else if($MachineName == "RPD")
	$LogPath = "\\\\10.12.110.130\\New D Drive\\WebRoot\\DataLog\\$filename";
else if($MachineName == "SPA1")
	$LogPath = "\\\\spa1onload\\LogFileDir\\$filename";
else if($MachineName == "SPA2")
	$LogPath = "\\\\spa2onload\\LogFileDir\\$filename";
else if($MachineName == "SPA3")
	$LogPath = "\\\\spa3onload\\LogFileDir\\$filename";
else if($MachineName == "SPA4")
	$LogPath = "\\\\spa4onload\\LogFileDir\\$filename";
else if($MachineName == "SPA6")
	$LogPath = "\\\\spa6onload\\LogFileDir\\$filename";
else if($MachineName == "ATMME2")
	$LogPath = "\\\\atmme2onld\\WebRoot\\DataLog\\$filename";
else if($MachineName == "AVI02")
	$LogPath = "\\\\lisst-atm002-h\\Webroot\\DataLog\\$filename";
else if($MachineName == "AVI03")
	$LogPath = "\\\\lisst-atm003-h\\Webroot\\DataLog\\$filename";
else if($MachineName == "AVI04")
	$LogPath = "\\\\lisst-atm004-v2\\Webroot\\DataLog\\$filename";
else if($MachineName == "AVI05")
	$LogPath = "\\\\lisst-atm005-v2\\Webroot\\DataLog\\$filename";
else if($MachineName == "AVI07")
	$LogPath = "\\\\lisst-atm007-v2\\Webroot\\DataLog\\$filename";
else if($MachineName == "AVI08")
	$LogPath = "\\\\lisst-atm008-v2\\Webroot\\DataLog\\$filename";
else if($MachineName == "AVI09")
	$LogPath = "\\\\lisst-atm009-v2\\Webroot\\DataLog\\$filename";
else if($MachineName == "AVI10")
	$LogPath = "\\\\lisst-atm010-v2\\Webroot\\DataLog\\$filename";
else if($MachineName == "AVI11")
	$LogPath = "\\\\lisst-atm011-v2\\Webroot\\DataLog\\$filename";
else if($MachineName == "AVI12")
	$LogPath = "\\\\lisst-atm012-v2\\Webroot\\DataLog\\$filename";
else if($MachineName == "AVI13")
	$LogPath = "\\\\lisst-atm013-v2\\Webroot\\DataLog\\$filename";
else if($MachineName == "AVI14")
	$LogPath = "\\\\lisst-atm014-v2\\Webroot\\DataLog\\$filename";
else if($MachineName == "AVI15")
	$LogPath = "\\\\lisst-atm015-v2\\Webroot\\DataLog\\$filename";
else if($MachineName == "AVI16")
	$LogPath = "\\\\lisst-atm016-v2\\Webroot\\DataLog\\$filename";
else if($MachineName == "AVI17")
	$LogPath = "\\\\lisst-atm017-v2\\Webroot\\DataLog\\$filename";
else if($MachineName == "AVI18")
	$LogPath = "\\\\lisst-atm018-v2\\Webroot\\DataLog\\$filename";
else if($MachineName == "AVI19")
	$LogPath = "\\\\lisst-atm019-v2\\Webroot\\DataLog\\$filename";
else if($MachineName == "AVI20")
	$LogPath = "\\\\lisst-atm020-v2\\Webroot\\DataLog\\$filename";
else if($MachineName == "AVI21")
	$LogPath = "\\\\lisst-atm021-v2\\Webroot\\DataLog\\$filename";
else if($MachineName == "AVI22")
	$LogPath = "\\\\lisst-atm022-v2\\Webroot\\DataLog\\$filename";
else if($MachineName == "AVI23")
	$LogPath = "\\\\lisst-atm023-v2\\Webroot\\DataLog\\$filename";
else if($MachineName == "AVI24")
	$LogPath = "\\\\lisst-atm024-v2\\Webroot\\DataLog\\$filename";
else if($MachineName == "AVI25")
	$LogPath = "\\\\lisst-atm025-v2\\Webroot\\DataLog\\$filename";
if(substr($MachineName, 0, 3) == "RSA" || substr($MachineName, 0, 3) == "SPD" || substr($MachineName, 0, 3) == "SPA")
	$Delimiter = "\t";
else	//Include ME2
	$Delimiter = ",";
if (($handle = fopen($LogPath, "r"))&&(($data = fgetcsv($handle, 10000, $Delimiter)) !== FALSE))
	$fileopened=true;
else 
{
	//or Y2005M10D06.csv 
	$filename = date("\YY\Mm\Dd",$showday).".csv"; 
	//include 'LogPath.php';	
	if (($handle = fopen($LogPath, "r"))&&(($data = fgetcsv($handle, 10000, $Delimiter)) !== FALSE))
		$fileopened=true;
}

if ($fileopened)
{
	$num = count($data); 
	if(substr($MachineName, 0, 3) == "RSA")
	{
		//$data[16] = "CuS_L1B_Read(Cur)";
		//$data[16] = trim($data[16]);
		//$pageitem[1][1] = " CuS_L1B_Read(Cur)";
		//if($data[16]==$pageitem[1][1])
		//	$IsEqual = "Equal";
		//else
		//	$IsEqual = "Not Equal";
		//echo $data[16]."#".$pageitem[1][1]."#".$IsEqual."#";
	}
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
	while(($data = fgetcsv($handle, 2000, $Delimiter)) !== FALSE)
	{
		//$dtat = trim($data);
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
				if ($targetCol[$i]!=0)	//$i is the index in the pageitem, $targetCol[$i] is the index of pageitem in the log file
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
	
	
	$imageH=570;
	$plotW=$row*2;
	if ($plotW<=580)
		$plotW=580;	
	$imageW=$plotW+10;
	$space=$plotW/$row;
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
		imageline($im,0,$i,$plotW,$i,$gridcolorY);
	for ($i=1;$i<=$plotW;$i+=10*$space)
		imageline($im,$i,$y0,$i,$y0+$plotH,$gridcolorX);
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
	for($j=1;$j<$row;$j++)
		if ($j%20==1)
			imagestringup($im,5, $space*$j-5,$imageH,  $time[$j], $textcolor);
			
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
	//echo 'fopen failed. reason: ', $php_errormsg; //Can not use
	$im = @imagecreate(400, 200)   or die("Cannot Initialize new GD image stream2");
	$background_color = imagecolorallocate($im, 0,0,0);
	$text_color = imagecolorallocate($im, 255, 255, 255);
	imagestring($im,10,0,0,"No Data Logged on $filename",$text_color);
	imagepng($im);
	imagedestroy($im);
	$_SESSION['unitcount']=-1;
}
?>
