<?php
include "class.TemplatePower.inc.php";
include "../db_ip.php";
$id=$_POST["id"];
//$id="0";

$tpl=new TemplatePower("../template/ctable.tpl");
$tpl->prepare();
//read config file
$db_ip = DB_IP();
$dbc = new MongoClient($db_ip);
$collection = $dbc->List->node;

function dpi_list($cmd_type)
{
	global $dbc;
	$user_name = $_COOKIE["dpi_user"];
	$collection = $dbc->List->user;
	$user = $collection->findone(array("name"=>$user_name));
	$collection = $dbc->List->node;
	$mcnn_list = $user["in_control"];
	$result = '';
	$dpi_list = array();
	for($i=0;$i<sizeof($mcnn_list);$i++)
	{
		$mcnn = $collection->findone(array("id"=>$mcnn_list[$i]));
		$dpi_list=array_merge($mcnn["related_node"],$dpi_list);
	}
	$dpi_list=array_unique($dpi_list);
	foreach($dpi_list as $k=>$v)
	{
		$dpi = $collection->findone(array("id"=>$v));
		$result.='<li><button class="btn btn-link" id="li" value="'.$dpi["node_name"].'" name="'.$cmd_type.'_dpi" dpi_id="'.$dpi["id"].'">&nbsp &nbsp &nbsp '.$dpi["node_name"].'&nbsp &nbsp &nbsp</button></li>';
	}
	
	if($user["su"]=="1")
	{
		$dpi_list = $collection->find(array("node_type"=>3));
		$dpi_list->sort(array("node_name"=>1));
		foreach($dpi_list as $dpi)
			$result.='<li><button class="btn btn-link" id="li" value="'.$dpi["node_name"].'" name="'.$cmd_type.'_dpi" dpi_id="'.$dpi["id"].'">&nbsp &nbsp &nbsp '.$dpi["node_name"].'&nbsp &nbsp &nbsp</button></li>';
	}

	if($result=="")
		$result = "&nbsp &nbsp无可选DPI设备";
	return $result;
}

$type = "";
$method_1="";
$pro_1="";
$name_1="";
$id_1="";
$des_1="";
$method_2="";
$pro_2="";
$name_2="";
$id_2="";
$des_2="";
$method_3="";
$pro_3="";
$name_3="";
$id_3="";
$des_3="";


if($id=="0")
{
	$collection = $dbc->List->cmd;
	$cmd = $collection->findone(array("cmd"=>"add1"));
	$collection = $dbc->List->node;
	$info = $collection->findone(array("node_name"=>$cmd["dpi"]));
	$id_1 = $info["id"];

	$tpl->assign("method","添加方式");
	$tpl->assign("method_1","AddTag");
	$tpl->assign("profession_1",$cmd["srvId"]);
	$tpl->assign("name_1",$cmd["dpi"]);
	$tpl->assign("id_1",$id_1);
	$tpl->assign("describe_1",$cmd["des"]);
	$tpl->assign("dpi_list1",dpi_list("1"));

	$collection = $dbc->List->cmd;
	$cmd = $collection->findone(array("cmd"=>"add2"));
	$collection = $dbc->List->node;
	$info = $collection->findone(array("node_name"=>$cmd["dpi"]));
	$id_2 = $info["id"];

	$tpl->assign("method_2","AddFullAcl");
	$tpl->assign("profession_2",$cmd["srvId"]);
	$tpl->assign("name_2",$cmd["dpi"]);
	$tpl->assign("id_2",$id_2);
	$tpl->assign("describe_2",$cmd["des"]);
	$tpl->assign("dpi_list2",dpi_list("2"));

	$collection = $dbc->List->cmd;
	$cmd = $collection->findone(array("cmd"=>"add3"));
	$collection = $dbc->List->node;
	$info = $collection->findone(array("node_name"=>$cmd["dpi"]));
	$id_3 = $info["id"];

	$tpl->assign("method_3","AddSmpAcl");
	$tpl->assign("profession_3",$cmd["srvId"]);
	$tpl->assign("name_3",$cmd["dpi"]);
	$tpl->assign("id_3",$id_3);
	$tpl->assign("describe_3",$cmd["des"]);
	$tpl->assign("dpi_list3",dpi_list("3"));

	$tpl->assign("value","add");
	$tpl->assign("commond1","添加标签");
	$tpl->assign("commond2","添加完全ACL规则");
	$tpl->assign("commond3","添加简单ACL规则");

	$collection = $dbc->List->cmd;
	$doc = $collection->findone(array("cmd"=>"add1"));
	$tpl->assign("result_1",'<tr><th colspan="4" style="text-align:center">运行结果</th></tr>
		<tr><th>exCode</th><td>'.$doc["result"]["exCode"].'</td>
		<th>rstCode</th><td>'.$doc["result"]["rstCode"].'</td></tr>');

	$doc = $collection->findone(array("cmd"=>"add2"));
	$tpl->assign("result_2",'<tr><th colspan="4" style="text-align:center">运行结果</th></tr>
		<tr><th>exCode</th><td>'.$doc["result"]["exCode"].'</td>
		<th>rstCode</th><td>'.$doc["result"]["rstCode"].'</td></tr>');

	$doc = $collection->findone(array("cmd"=>"add3"));
	$tpl->assign("result_3",'<tr><th colspan="4" style="text-align:center">运行结果</th></tr>
		<tr><th>exCode</th><td>'.$doc["result"]["exCode"].'</td>
		<th>rstCode</th><td>'.$doc["result"]["rstCode"].'</td></tr>');
}
elseif($id=="1")
{
	$collection = $dbc->List->cmd;
	$cmd = $collection->findone(array("cmd"=>"ser1"));
	$collection = $dbc->List->node;
	$info = $collection->findone(array("node_name"=>$cmd["dpi"]));
	$id_1 = $info["id"];

	$tpl->assign("method","查询方式");
	$tpl->assign("method_1","QryTag");
	$tpl->assign("profession_1",$cmd["srvId"]);
	$tpl->assign("name_1",$cmd["dpi"]);
	$tpl->assign("id_1",$id_1);
	$tpl->assign("describe_1",$cmd["des"]);
	$tpl->assign("dpi_list1",dpi_list("1"));

	$collection = $dbc->List->cmd;
	$cmd = $collection->findone(array("cmd"=>"ser2"));
	$collection = $dbc->List->node;
	$info = $collection->findone(array("node_name"=>$cmd["dpi"]));
	$id_2 = $info["id"];

	$tpl->assign("method_2","QrySrvTypeRule");
	$tpl->assign("profession_2",$cmd["srvId"]);
	$tpl->assign("name_2",$cmd["dpi"]);
	$tpl->assign("id_2",$id_2);
	$tpl->assign("describe_2",$cmd["des"]);
	$tpl->assign("dpi_list2",dpi_list("2"));

	$collection = $dbc->List->cmd;
	$cmd = $collection->findone(array("cmd"=>"ser3"));
	$collection = $dbc->List->node;
	$info = $collection->findone(array("node_name"=>$cmd["dpi"]));
	$id_3 = $info["id"];

	$tpl->assign("method_3","QryStatSrvType");
	$tpl->assign("profession_3",$cmd["srvId"]);
	$tpl->assign("name_3",$cmd["dpi"]);
	$tpl->assign("id_3",$id_3);
	$tpl->assign("describe_3",$cmd["des"]);
	$tpl->assign("dpi_list3",dpi_list("3"));

	$tpl->assign("value","ser");
	$tpl->assign("commond1","查询标签");
	$tpl->assign("commond2","查询业务类型规则");
	$tpl->assign("commond3","查询所有规则数");

	$collection = $dbc->List->cmd;
	$doc = $collection->findone(array("cmd"=>"ser1"));
	$tpl->assign("result_1",'<tr><th colspan="4" style="text-align:center">运行结果</th></tr>
		<tr><th>exCode</th><td>'.$doc["result"]["exCode"].'</td>
		<th>rstCode</th><td>--</td></tr>');

	$doc = $collection->findone(array("cmd"=>"ser2"));
	$tpl->assign("result_2",'<tr><th colspan="4" style="text-align:center">运行结果</th></tr>
		<tr><th>ruleCount</th><td>'.$doc["result"]["ruleCount"].'</td>
		<th>hitCount</th><td>'.$doc["result"]["hitCount"].'</td></tr>');

	$doc = $collection->findone(array("cmd"=>"ser3"));
	$tpl->assign("result_3",'<tr><th colspan="4" style="text-align:center">运行结果</th></tr>
		<tr><th>exCode</th><td>'.$doc["result"]["exCode"].'</td>
		<th>ruleCount</th><td>'.$doc["result"]["ruleCount"].'</td></tr>');
}
elseif($id=="2")
{
	$collection = $dbc->List->cmd;
	$cmd = $collection->findone(array("cmd"=>"del1"));
	$collection = $dbc->List->node;
	$info = $collection->findone(array("node_name"=>$cmd["dpi"]));
	$id_1 = $info["id"];

	$tpl->assign("method","删除方式");
	$tpl->assign("method_1","DelTag");
	$tpl->assign("profession_1",$cmd["srvId"]);
	$tpl->assign("name_1",$cmd["dpi"]);
	$tpl->assign("id_1",$id_1);
	$tpl->assign("describe_1",$cmd["des"]);
	$tpl->assign("dpi_list1",dpi_list("1"));

	$collection = $dbc->List->cmd;
	$cmd = $collection->findone(array("cmd"=>"del2"));
	$collection = $dbc->List->node;
	$info = $collection->findone(array("node_name"=>$cmd["dpi"]));
	$id_2 = $info["id"];

	$tpl->assign("method_2","DelSrvTypeRuleContent");
	$tpl->assign("profession_2",$cmd["srvId"]);
	$tpl->assign("name_2",$cmd["dpi"]);
	$tpl->assign("id_2",$id_2);
	$tpl->assign("describe_2",$cmd["des"]);
	$tpl->assign("dpi_list2",dpi_list("2"));

	$collection = $dbc->List->cmd;
	$cmd = $collection->findone(array("cmd"=>"del3"));
	$collection = $dbc->List->node;
	$info = $collection->findone(array("node_name"=>$cmd["dpi"]));
	$id_3 = $info["id"];

	$tpl->assign("method_3","DelSglRule");
	$tpl->assign("profession_3",$cmd["srvId"]);
	$tpl->assign("name_3",$cmd["dpi"]);
	$tpl->assign("id_3",$id_3);
	$tpl->assign("describe_3",$cmd["des"]);
	$tpl->assign("dpi_list3",dpi_list("3"));

	$tpl->assign("value","del");
	$tpl->assign("commond1","删除标签");
	$tpl->assign("commond2","删除业务类型规则内容");
	$tpl->assign("commond3","删除单条规则");

	$collection = $dbc->List->cmd;
	$doc = $collection->findone(array("cmd"=>"del1"));
	$tpl->assign("result_1",'<tr><th colspan="4" style="text-align:center">运行结果</th></tr>
		<tr><th>exCode</th><td>'.$doc["result"]["exCode"].'</td>
		<th>rstCode</th><td>--</td></tr>');

	$doc = $collection->findone(array("cmd"=>"del2"));
	$tpl->assign("result_2",'<tr><th colspan="4" style="text-align:center">运行结果</th></tr>
		<tr><th>exCode</th><td>'.$doc["result"]["exCode"].'</td>
		<th>ruleCount</th><td>'.$doc["result"]["ruleCount"].'</td></tr>');

	$doc = $collection->findone(array("cmd"=>"del3"));
	$tpl->assign("result_3",'<tr><th colspan="4" style="text-align:center">运行结果</th></tr>
		<tr><th>exCode</th><td>'.$doc["result"]["exCode"].'</td>
		<th>ruleCount</th><td>'.$doc["result"]["ruleCount"].'</td></tr>');
}

$tpl->printToScreen();
?>
