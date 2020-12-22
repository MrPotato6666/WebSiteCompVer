<html>
<body leftmargin="0" topmargin="0" bgcolor=white onload="scrollBy(30000,0)">
<script type="text/javascript" src="../js/echarts.min.js"></script>
<div id="container" style="height: 100%"></div>
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
	//echo "<img src='image.php?MachineName=$_GET[MachineName]&file=$_GET[file]&page=$_GET[page]&timeslot=$_GET[timeslot]&".strip_tags(SID)."'>";


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
			$time[$row]="\"".$data[0]."\"";
			//$time[$row] = str_replace(":",".",$data[0]);
			//echo $row." - ".$time[$row];
			for ($i=1;$i<=$pagesize[$page];$i++)
			{
				if ($targetCol[$i]!=0)	//$i is the index in the pageitem, $targetCol[$i] is the index of pageitem in the log file
				{
					$value[$i-1][$row]=is_numeric($data[$targetCol[$i]])?$data[$targetCol[$i]]:-1;
					if (!isset($unitmax[$ItemUnit[$page][$i]]))
						if ($value[$i-1][$row]>$valuemax[$ItemUnit[$page][$i]])
							$valuemax[$ItemUnit[$page][$i]]=$value[$i-1][$row];
					if (!isset($unitmin[$ItemUnit[$page][$i]]))
						if ($value[$i-1][$row]<$valuemin[$ItemUnit[$page][$i]])
							$valuemin[$ItemUnit[$page][$i]]=$value[$i-1][$row];
					//echo " - ".$value[$i-1][$row];
					if($value[$i-1][$row] > 900)
						$value[$i-1][$row] = -10.0;
				}
				else
				{
					$value[$i-1][$row]=-1;
				}
			}
		}
	}
	//echo "bbbbb".$value[1][1]."aaaaa".$value[1][2]."aaaaa".$value[1][3]."aaaaa";
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
		//$im = @imagecreate(400, 200)   or die("Cannot Initialize new GD image stream2");
		//$background_color = imagecolorallocate($im, 0,0,0);
		//$text_color = imagecolorallocate($im, 255, 255, 255);
		//imagestring($im,10,0,0,"No Data Logged ",$text_color);
		//imagestring($im,10,0,20,"on $filename from $starttime[$timeslot] to $stoptime[$timeslot]",$text_color);
		
		//imagepng($im);
		//imagedestroy($im);
		//$_SESSION['unitcount']=-1;
		echo "No Data Logged on".$filename;
		return;
	}
	//sort($value);
	//echo $value[0][1];
	
	$txtTitle = "['".$pageitem[$page][1]."'";
	for ($i=2;$i<=$pagesize[$page];$i++)
	{
		$txtTitle = $txtTitle.",'".$pageitem[$page][$i]."'";
	}
	$txtTitle = $txtTitle."]";
?>
<script type="text/javascript"> var data=<?php $value?></script>
<script type="text/javascript" src="js/echarts.min.js"></script>
<script type="text/javascript">
	var dom = document.getElementById("container");
	var myChart = echarts.init(dom);
	var app = {};
	option = null;
	var xTime = [<?echo implode(",",$time) ?>];
	var y1 = 	[<?echo implode(",",$value[0])?>];
	<?if($pagesize[$page] > 1) {?>
		var y2 =	[<?echo implode(",",$value[1])?>];
	<?}?>
	<?if($pagesize[$page] > 2) {?>
		var y3 =	[<?echo implode(",",$value[2])?>];
	<?}?>
	<?if($pagesize[$page] > 3) {?>
		var y4 =	[<?echo implode(",",$value[3])?>];
	<?}?>
	<?if($pagesize[$page] > 4) {?>
		var y5 =	[<?echo implode(",",$value[4])?>];
	<?}?>
	<?if($pagesize[$page] > 5) {?>
		var y6 =	[<?echo implode(",",$value[5])?>];
	<?}?>
	<?if($pagesize[$page] > 6) {?>
		var y7 =	[<?echo implode(",",$value[6])?>];
	<?}?>
	<?if($pagesize[$page] > 7) {?>
		var y8 =	[<?echo implode(",",$value[7])?>];
	<?}?>
	<?if($pagesize[$page] > 8) {?>
		var y9 =	[<?echo implode(",",$value[8])?>];
	<?}?>
	<?if($pagesize[$page] > 9) {?>
		var y10 =	[<?echo implode(",",$value[9])?>];
	<?}?>
	<?if($pagesize[$page] > 10) {?>
		var y11 =	[<?echo implode(",",$value[10])?>];
	<?}?>
	<?if($pagesize[$page] > 11) {?>
		var y12 =	[<?echo implode(",",$value[11])?>];
	<?}?>
	<?if($pagesize[$page] > 12) {?>
		var y13 =	[<?echo implode(",",$value[12])?>];
	<?}?>
	<?if($pagesize[$page] > 13) {?>
		var y14 =	[<?echo implode(",",$value[13])?>];
	<?}?>
	<?if($pagesize[$page] > 14) {?>
		var y15 =	[<?echo implode(",",$value[14])?>];
	<?}?>
	option = {
			title: {
				text: <? echo "'".$MachineName."-".$pagetitle[$page]."-".date("\YY \Mm \Dd",$showday)."'" ?>
			},
			tooltip: {
				trigger: 'axis'
			},
			legend: {
				top: 30,
				data:<?echo $txtTitle?>
			},
			grid: {
				left: '3%', right: '4%', bottom: '3%', containLabel: true
			},
			xAxis: {
				//data: data.map(function (item) {
			   //     return item[0];
				//})
				//data: sss.map(function (item) {
				//    return item[0];
				//})
				type: 'category',
				boundaryGap: false,
				data:xTime
			},
			yAxis: {
				type: 'value',
				splitLine: {
					show: false
				}
			},
        toolbox: {
            left: 'right',
            feature: {
                dataZoom: {
					title: {
						zoom: 'zoom',
						back: 'back'
					},
                    yAxisIndex: 'none'
                },
                restore: {
					title: 'restore'
				},
                saveAsImage: {
					title: 'SaveAsImage'
				}
            }
        },
			dataZoom: [{
				startValue: '2014-06-01'
			}, {
				type: 'inside'
			}],
			series: [
				{
					name: <? echo "'".$pageitem[$page][1]."'" ?>,
					type: 'line',
					//stack: 'Total',
					data:y1
				}
				<?if($pagesize[$page] > 1) {?>
				,{
					name: <? echo "'".$pageitem[$page][2]."'" ?>,
					type: 'line',
					//stack: 'Total',
					data:y2
				}
				<?}?>
				<?if($pagesize[$page] > 2) {?>
				,{
					name: <? echo "'".$pageitem[$page][3]."'" ?>,
					type: 'line',
					//stack: 'Total',
					data:y3
				}
				<?}?>
				<?if($pagesize[$page] > 3) {?>
				,{
					name: <? echo "'".$pageitem[$page][4]."'" ?>,
					type: 'line',
					//stack: 'Total',
					data:y4
				}
				<?}?>
				<?if($pagesize[$page] > 4) {?>
				,{
					name: <? echo "'".$pageitem[$page][5]."'" ?>,
					type: 'line',
					//stack: 'Total',
					data:y5
				}
				<?}?>
				<?if($pagesize[$page] > 5) {?>
				,{
					name: <? echo "'".$pageitem[$page][6]."'" ?>,
					type: 'line',
					//stack: 'Total',
					data:y6
				}
				<?}?>
				<?if($pagesize[$page] > 6) {?>
				,{
					name: <? echo "'".$pageitem[$page][7]."'" ?>,
					type: 'line',
					//stack: 'Total',
					data:y7
				}
				<?}?>
				<?if($pagesize[$page] > 7) {?>
				,{
					name: <? echo "'".$pageitem[$page][8]."'" ?>,
					type: 'line',
					//stack: 'Total',
					data:y8
				}
				<?}?>
				<?if($pagesize[$page] > 8) {?>
				,{
					name: <? echo "'".$pageitem[$page][9]."'" ?>,
					type: 'line',
					//stack: 'Total',
					data:y9
				}
				<?}?>
				<?if($pagesize[$page] > 9) {?>
				,{
					name: <? echo "'".$pageitem[$page][10]."'" ?>,
					type: 'line',
					//stack: 'Total',
					data:y10
				}
				<?}?>
				<?if($pagesize[$page] > 10) {?>
				,{
					name: <? echo "'".$pageitem[$page][11]."'" ?>,
					type: 'line',
					//stack: 'Total',
					data:y11
				}
				<?}?>
				<?if($pagesize[$page] > 11) {?>
				,{
					name: <? echo "'".$pageitem[$page][12]."'" ?>,
					type: 'line',
					//stack: 'Total',
					data:y12
				}
				<?}?>
				<?if($pagesize[$page] > 12) {?>
				,{
					name: <? echo "'".$pageitem[$page][13]."'" ?>,
					type: 'line',
					//stack: 'Total',
					data:y13
				}
				<?}?>
				<?if($pagesize[$page] > 13) {?>
				,{
					name: <? echo "'".$pageitem[$page][14]."'" ?>,
					type: 'line',
					//stack: 'Total',
					data:y14
				}
				<?}?>
				<?if($pagesize[$page] > 14) {?>
				,{
					name: <? echo "'".$pageitem[$page][15]."'" ?>,
					type: 'line',
					//stack: 'Total',
					data:y15
				}
				<?}?>
			]
		};
	if (option && typeof option === "object") {
		myChart.setOption(option, true);
	}
</script>
<?	
}
	else
	{
		echo 'fopen failed. reason: ', $php_errormsg; //Can not use
		//$im = @imagecreate(400, 200)   or die("Cannot Initialize new GD image stream2");
		//$background_color = imagecolorallocate($im, 0,0,0);
		//$text_color = imagecolorallocate($im, 255, 255, 255);
		//imagestring($im,10,0,0,"No Data Logged on $filename",$text_color);
		//imagepng($im);
		//imagedestroy($im);
		//$_SESSION['unitcount']=-1;
	}
}
else
{
	echo "Invalid Access!";
}
?>
</body>
</html>