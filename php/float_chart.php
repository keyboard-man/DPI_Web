<?php
require_once("../db_ip.php");

$flag = $_POST["flag"];
//$flag = "央视1套";
$dbc = new MongoClient(DB_IP());
$db = $dbc->Stat;
$cs = $db->Service;
$cc = $db->chart;

$result = '';
if($flag=="all")
{
	//画所有图
	$float = $cs->distinct("srv_name",array("pass"=>0));
	$num = count($float);

	$result = '';
	for($i=0;$i<$num;$i++)
	{
		$j = 2*$i;
		$k = 2*$i+1;

		$title = $float[$i]."合法流";
		$show = $cc->findone(array($float[$i]."0"=>array('$exists'=>1)));
		$show_data = $show[$float[$i]."0"];
		$show_time = $show["time"];
		$changed_data = "";
		foreach($show_data as $a=>$b)
		{
			$changed_data .= ",[".$a.",".$b."]";
		}
		$changed_data = substr($changed_data,1);
		$changed_time = "";
		foreach($show_time as $a=>$b)
		{
			$changed_time .= 'chart'.$j.'.setLabelX(['.$a.',\''.$b.'\']);
			';
		}
		$changed_time .= 'chart'.$j.'.setShowXValues(false);';
		$result .= '<div class="row-fluid">';
		$result .= '
			<div class="span5" id="chart'.$j.'" style="float:left;border:solid 1px black;height:310px;width:400px">
			<script type="text/javascript">
var data'.$j.' = new Array('.$changed_data.');
var chart'.$j.' = new JSChart("chart'.$j.'","line");

chart'.$j.'.setTitle("'.$title.'");
chart'.$j.'.setDataArray(data'.$j.');
chart'.$j.'.setAxisNameX("time");
chart'.$j.'.setAxisNameY("包速率");
chart'.$j.'.setAxisValuesNumberX(10);
chart'.$j.'.setIntervalStartY(0);
'.$changed_time.'
chart'.$j.'.setAxisValuesAngle(30);
chart'.$j.'.draw();
</script>
</div>
';
		$title = $float[$i].'非法流';
		$show = $cc->findone(array($float[$i]."1"=>array('$exists'=>1)));
		$show_data = $show[$float[$i]."1"];
		$show_time = $show["time"];
		$changed_data = "";
		foreach($show_data as $a=>$b)
		{
			$changed_data .= ",[".$a.",".$b."]";
		}
		$changed_data = substr($changed_data,1);
		$changed_time = "";
		foreach($show_time as $a=>$b)
		{
			$changed_time .= 'chart'.$k.'.setLabelX(['.$a.',\''.$b.'\']);
			';
		}
		$changed_time .= 'chart'.$k.'.setShowXValues(false);';
		$result .= '
			<div class="span5" id="chart'.$k.'" style="float:right;border:solid 1px black;height:310px;width:400px">
			<script type="text/javascript">
var data'.$k.' = new Array('.$changed_data.');
var chart'.$k.' = new JSChart("chart'.$k.'","line");

chart'.$k.'.setTitle("'.$title.'");
chart'.$k.'.setDataArray(data'.$k.');
chart'.$k.'.setAxisNameX("time");
chart'.$k.'.setAxisNameY("包速率");
chart'.$k.'.setAxisValuesNumberX(10);
chart'.$k.'.setIntervalStartY(0);
'.$changed_time.'
chart'.$k.'.setAxisValuesAngle(30);
chart'.$k.'.draw();
</script>
</div>
';
$result .= '
	</div>
	<br/>
	<br/>';
	}
}
else
{
	//画flag指定的图

	$title = $flag."合法流";
	$show = $cc->findone(array($flag.'0'=>array('$exists'=>1)));
	$show_data = $show[$flag.'0'];
	$changed_data = "";
	foreach($show_data as $a=>$b)
	{
		$changed_data .= ",[".$a.",".$b."]";
	}
	$changed_data = substr($changed_data,1);

	$result .= '<div class="row-fluid">';
	$result .= '
		<div class="span5" id="chart0" style="float:left;border:solid 1px black;height:300px;width:400px">
		<script type="text/javascript">
var data0 = new Array('.$changed_data.');
var chart0 = new JSChart("chart0","line");

chart0.setTitle("'.$title.'");
chart0.setDataArray(data0);
chart0.setAxisNameX("time");
chart0.setAxisNameY("包速率");
chart0.setAxisValuesNumberX(10);
chart0.setIntervalStartY(0);
chart0.draw();
</script>
</div>
';
	
	$title = $flag."非法流";
	$show = $cc->findone(array($flag.'1'=>array('$exists'=>1)));
	$show_data = $show[$flag.'1'];
	$changed_data = "";
	foreach($show_data as $a=>$b)
	{
		$changed_data .= ",[".$a.",".$b."]";
	}
	$changed_data = substr($changed_data,1);
	$result .= '
		<div class="span5" id="chart1" style="float:right;border:solid 1px black;height:300px;width:400px">
		<script type="text/javascript">
var data1 = new Array('.$changed_data.');
var chart1 = new JSChart("chart1","line");

chart1.setTitle("'.$title.'");
chart1.setDataArray(data1);
chart1.setAxisNameX("time");
chart1.setAxisNameY("包速率");
chart1.setAxisValuesNumberX(10);
chart1.setIntervalStartY(0);
chart1.draw();
</script>
</div>
';
$result .= '
	</div>
	<br />
	<br />';
}

echo $result;
?>
