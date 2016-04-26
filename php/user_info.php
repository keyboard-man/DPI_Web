<?php
include "class.TemplatePower.inc.php";
include "../db_ip.php";
$db_ip = DB_IP();
$id=$_POST["id"];
$dbc=new MongoClient($db_ip);
$collection=$dbc->List->user;
$user=$collection->findone(array("name"=>$id));
$collection=$dbc->List->node;

function su($name)
{
	if($name["su"]=="1")
		return "管理员";
	else
		return "普通用户";
}

function mccn()
{
	global $user,$collection;
	$list=$collection->find(array("node_type"=>1));
	$result='';
	foreach($list as $doc)
	{
		//if(in_array($doc["id"],$user["in_control"]) || $user["su"]=="1")
		{
			$result.='<input type="checkbox" class="checkbox" id="'.$doc["id"].'" checked="checked" disabled="disabled">&nbsp &nbsp'.$doc["node_name"].':'.$doc["id"].'<br />';
		}
		//else
		//	$result.='<input type="checkbox" class="checkbox" id="'.$doc["id"].'">&nbsp &nbsp'.$doc["node_name"].':'.$doc["id"].'<br />';
	}
	return $result;
	//return "mccn";
}

function mcnn()
{
	global $user,$collection;
	$list=$collection->find(array("node_type"=>2));
	$list->sort(array("node_name"=>1));
	$result='';
	foreach($list as $doc)
	{
		if(in_array($doc["id"],$user["in_control"]) || $user["su"]=="1")
			$result.='<input type="checkbox" class="checkbox" id="'.$doc["id"].'" checked="checked">&nbsp &nbsp'.$doc["node_name"].':'.$doc["id"].'<br />';
		else
			$result.='<input type="checkbox" class="checkbox" id="'.$doc["id"].'">&nbsp &nbsp'.$doc["node_name"].':'.$doc["id"].'<br />';
	}
	return $result;
	//return "mcnn";
}
/*
function dpi()
{
	global $user,$collection;
	$list=$collection->find(array("node_type"=>3));
	$result='';
	foreach($list as $doc)
	{
		if(in_array($doc["id"],$user["in_control"]) || $user["su"]=="1")
			$result.='<input type="checkbox" class="checkbox" id="'.$doc["id"].'" checked="checked">&nbsp &nbsp'.$doc["node_name"].':'.$doc["id"].'<br />';
		else
			$result.='<input type="checkbox" class="checkbox" id="'.$doc["id"].'">&nbsp &nbsp'.$doc["node_name"].':'.$doc["id"].'<br />';
	}
	return $result;
	//return "dpi";
}
 */
$tpl=new TemplatePower("../template/utable.tpl");
$tpl->prepare();

$tpl->assign("user_name",'"'.$id.'"');
$tpl->assign("auth",su($user));
$tpl->assign("mccn_list",mccn());
$tpl->assign("mcnn_list",mcnn());
//$tpl->assign("dpi_list",dpi());

$tpl->printToScreen();
//mccn();
?>
