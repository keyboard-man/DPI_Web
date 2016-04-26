<?php
include "common.php";
include "db_ip.php";

$db_ip = DB_IP();
$dbc=new MongoClient($db_ip);
$db=$dbc->Stat;

function float_list()
{
	global $db;
	$collection = $db->Service;
	$float = array();
	$float = $collection->distinct("srv_name");
	$num = count($float);
	$result = '<ul>
		';
	for($i=0;$i<$num;$i++)
	{
		$result .= '<li><button class="btn-link" value="'.$float[$i].'" id="float">'.$float[$i].'</button></li>
			';
	}
	$result .= '
		</ul>';

	return $result;
}

function float_chart()
{
	global $db;
	$collection = $db->Service;
	$float = $collection->distinct("srv_name",array("pass"=>0));
	$num = count($float);

	$collection = $db->chart;
	$collection->remove();
	$init_arr = array(0,0,0,0,0,0,0,0,0,0);
	$init_time = array("-","-","-","-","-","-","-","-","-","-");
	for($i=0;$i<$num;$i++)
	{
		$collection->insert(array($float[$i]."0"=>$init_arr,"time"=>$init_time));
		$collection->insert(array($float[$i]."1"=>$init_arr,"time"=>$init_time));
	}

	$result = '';

	for($i=0;$i<$num;$i++)
	{
		$j = 2*$i;
		$k = 2*$i+1;
		$title = $float[$i]."合法流";
		$show = $collection->findone(array($float[$i]."0"=>array('$exists'=>1)));
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
			$changed_time .= 'chart'.$j.'.setLabelX(['.$a.','.$b.']);
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
		$show = $collection->findone(array($float[$i]."1"=>array('$exists'=>1)));
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
			$changed_time .= 'chart'.$k.'.setLabelX(['.$a.','.$b.']);
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
	return $result;
}

function float_table()
{
	global $db;
	$collection = $db->Service;
	$cursor = $collection->find(array("pass"=>0))->sort(array("dpi_name"=>1));
	$result = '';
	foreach($cursor as $doc)
	{
		if($doc["is_acl_legal"] == "yes")
			$legal = "正常";
		else
			$legal = "非法";
		$pass_or_stop = '<div id="pass_or_stop">
				   	     <span style="font-size:14px">通过</span>
						 <button id="stop" class="btn btn-danger" onclick="stop()">阻断</button></div>';
		$result .= '<tr><td>'.$doc["dpi_name"].'</td><td>'.$doc["srv_name"].'</td><td>'.$legal.'</td><td>'.$pass_or_stop.'</td></tr>
			';
	}
	return $result;
}

function float_body()
{
	$list = float_list();
	$result ='
		<form class="form-search">
	<div class="row-fluid">
		<div class="input-append" style="margin-top:5px">
			<input type="text" class="span10 search-query" placeholder="请输入查询业务名称" id="float_search">
			<button type="button" class="btn" id="float_search">查找</button>
		</div>
		<!--	<button class="pull-right" class="btn" id="refresh">刷新</button> -->
	</div>
		</form>
	<div class="row-fluid">
			<div class="span3" id="list" style="background-color:#CCCCCC;height:700px;overflow:auto">
			<h4 style="text-align:center">业务列表</h4>
			<table class="table table-bordered">
			<tr><td>
				<div class="according-heading">
				<a class="according-toggle" data-toggle="collapse" href="#float"><button type="button" class="btn-block btn-info">点击收拢/展开</button></a>
				</div>
				<div class="accordion-body in collapse" style="height:auto" id="float"><div class="accordion-inner">
				<div class="row-fluid">
					'.$list.'
				</div>
				</div></div>
			</td></tr>
			</table>
		</div>

		<div class="span9" id="content" style="background-color:#99CCCC;height:700px" flag="all">
		<h4 style="text-align:center">float_info</h4>
		<div class="row-fluid">
		<div class="span12">
			<div style="height:320px;overflow:auto;" id="chart">
			'.float_chart().'
			</div>
		</div>
		<h4 style="text-align:center">float_table</h4>
		<div class="row-fluid">
		<div class="span12">
			<div style="height:300px;overflow:auto;" id="table">
			<table class="table table-hover table-bordered">
				<tr>
				<th>DPI名称</th><th>业务名称</th><th>流量状态</th><th>通断控制</th>
				</tr>
				'.float_table().'
			</table>
			</div>
		</div>
		</div>
		</div>
		</div>
	</div>

		';

	return $result;
}
//echo float_list();
//echo float_body();
//echo float_chart();
?>
