<?php
include "common.php";
include "uuid.php";
include "db_ip.php";
$name=$_COOKIE["dpi_user"];
$db_ip = DB_IP();
$dbc=new MongoClient($db_ip);
$db=$dbc->List;
$collection=$db->user;
$user=$collection->findone(array("name"=>$name));

function mccn_list()
{
	global $db,$user;
	$collection=$db->node;
	$list=$collection->find(array("node_type"=>1));
	$list->sort(array("node_name"=>1));
	$result='<ul>
		';
	foreach($list as $doc)
	{
		//if(in_array($doc["id"],$user["in_control"]) || $user["su"]=="1")
		$result.='<li><button class="btn-link" value="'.$doc["node_name"].'" id="list">'.$doc["node_name"].'</button></li>
			';
	}
	$result.='
		</ul>';

	return $result;
}

function mcnn_list()
{
	global $db,$user;
	$collection=$db->node;
	$list=$collection->find(array("node_type"=>2));
	$list->sort(array("node_name"=>1));
	$result='<ul>
		';
	foreach($list as $doc)
	{
		if(in_array($doc["id"],$user["in_control"]) || $user["su"]=="1")
		$result.='<li><button class="btn-link" value="'.$doc["node_name"].'" id="list">'.$doc["node_name"].'</button></li>
			';
	}
	$result.='
		</ul>';

	return $result;
}

function dpi_list()
{
	global $db,$user;
	$collection=$db->user;
	$user_name = $_COOKIE["dpi_user"];
	$user = $collection->findone(array("name"=>$user_name));
	$mcnn_list = $user["in_control"];
	$collection = $db->node;
	$dpi_list = array();

	for($i=0;$i<sizeof($mcnn_list);$i++)
	{
		$mcnn = $collection->findone(array("id"=>$mcnn_list[$i]));
		$dpi_list = array_merge($mcnn["related_node"],$dpi_list);
	}
	$dpi_list = array_unique($dpi_list);
	$result='<ul>
		';
	foreach($dpi_list as $k=>$v)
	{
		$doc = $collection->findone(array("id"=>$v));
		$result.='<li><button class="btn-link" value="'.$doc["node_name"].'" id="list">'.$doc["node_name"].'</button></li>
			';
	}
	if($user["su"]=="1")
	{
		$dpi_list = $collection->find(array("node_type"=>3));
		$dpi_list->sort(array("node_name"=>1));
		foreach($dpi_list as $doc)
			$result.='<li><button class="btn-link" value="'.$doc["node_name"].'" id="list">'.$doc["node_name"].'</button></li>
				';
		$result.='
			</ul>
			<button class="btn-info offset3" type="button" id="add_dpi"><i class="icon-plus"></i>添加新DPI</button>
			';
	}
	else
		$result.='
			</ul>
			<button class="btn offset3" type="button" id="add_dpi" disabled="disabled"><i class="icon-plus"></i>添加新DPI</button>
			';

	return $result;
}

function node_body()
{
	$result = '
		<form class="form-search">
		<div class="row-fluid">
		<div class="input-append" style="margin-top:5px">
			<input type="text" class="span10 search-query" placeholder="请输入查询节点名称" id="node_search">
			<button type="button" class="btn" id="node_search">查找</button>
		</div>
		</div>
		</form>
		<div class="row-fluid">
			<div class="span3" id="list" style="background-color:#CCCCCC">
			<h4 style="text-align:center">节点列表</h4>
			<table class="table table-bordered">
			<tr><td>
				<div class="according-heading">
				<a class="according-toggle" data-toggle="collapse" href="#mccn"><button type="button" class="btn-block btn-info">MCCN</button></a>
				</div>
				<div class="accordion-body in collapse" style="height:auto" id="mccn"><div class="accordion-inner">
				<div class="row-fluid">
					'.mccn_list().'
				</div>
				</div></div>
			</td></tr>

			<tr><td>
				<div class="according-heading">
				<a class="according-toggle" data-toggle="collapse" href="#mcnn"><button type="button" class="btn-block btn-info">MCNN</button></a>
				</div>
				<div class="according-body in collapse" style="height:auto" id="mcnn"><div class="accordion-inner">
				<div class="row-fluid">
					'.mcnn_list().'
				</div>
				</div></div>
			</td></tr>

			<tr><td>
				<div class="according-heading">
				<a class="according-toggle" data-toggle="collapse" href="#dpi"><button type="button" class="btn-block btn-info">DPI</button></a>
				</div>
				<div class="according-body in collapse" style="height:auto" id="dpi"><div class="accordion-inner">
				<div class="row-fluid">
					'.dpi_list().'
				</div>
				</div></div>
			</td></tr>
			</table>

			</div>
			<div class="span9" id="content" style="background-color:#99CCCC">
			<h4 style="text-align:center">请在左侧选择查询节点</h4>
			</div>
		</div>

		<!--add dpi dialog-->
		<div class="row" id="add_dpi">
		&nbsp &nbsp &nbsp &nbsp ID:&nbsp<input type="text" disabled="disabled" value="'.uuid().'" style="height:30px;width:400px" id="add_dpi_id"><br />
		&nbsp &nbsp &nbsp &nbsp 名称:&nbsp<input type="text" class="input-medium" style="height:30px" id="add_dpi_name">&nbsp &nbsp IP:&nbsp<input type="text" class="input-medium" style="height:30px" id="add_dpi_ip"><br />
		&nbsp &nbsp &nbsp &nbsp 端口:&nbsp<input type="text" class="input-medium" style="height:30px" id="add_dpi_port">
		&nbsp &nbsp 动作:&nbsp<div class="btn-group"><button class="btn dropdown-toggle" data-toggle="dropdown" style="height:30px"><p id="add_action">添加动作<span class="caret"></span></p></button>
		<ul class="dropdown-menu"><li><button class="btn btn-link" id="add_li" value="0">&nbsp &nbsp 添加动作&nbsp &nbsp</button></li>
		<li><button class="btn btn-link" id="add_li" value="1">&nbsp &nbsp 删除动作 &nbsp &nbsp</button></li>
		<li><button class="btn btn-link" id="add_li" value="2">&nbsp &nbsp 编辑动作 &nbsp &nbsp </button></li></ul></div><br />
		<br /><br /><br /><br /><br />
		<button type="button" class="btn-info offset1" id="add_dpi_sub">保存</button>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp<button type="button" class="btn-info" id="add_dpi_cancel">取消</button>
		</div>
	<!--edit serve type-->
	<div class="row-fluid" id="edit_srv" >
	<div id="srv_list"></div>
	<button type="button" class="offset1 btn-info" id="edit_srv_submit">确定</button>
	<button type="button" class="offset2 btn-info" id="edit_srv_cancel">取消</button>
	</div>
	<script>
	$("div#edit_srv").dialog({
autoOpen:false,
width:200,
modal:true,
title:"编辑业务类"
});
</script>
		';

	return $result;
}
//echo mccn_list();
//echo mcnn_list();
//echo dpi_list();
?>
