<?php
include "./ice/Client.php";
include "../db_ip.php";
$db_ip = DB_IP();
$ic = new WebToMCCN;
$dpi = new CmdTxRxICE_Dpi;
$dbc = new MongoClient($db_ip);
$collection = $dbc->List->node;

$user = $_COOKIE["dpi_user"];
$pass = $_COOKIE["dpi_password"];

$info = $collection->findone(array("node_name"=>$_POST["dpi"]));
$dpi->ip = ip2long($info["ip"]);
$dpi->port = (int)$info["port"];
$dpi->id = $info["id"];

	//全部统计查询
	$cmd = new CmdTxRxICE_CmdQryAllRuleCount;
	$temp = new CmdTxRxICE_RespQryAllRuleCount;
	$cmd->pubInfo->usr->name = $user;
	$cmd->pubInfo->usr->pwd = $pass;
	$cmd->pubInfo->dpiList = array($dpi);
	$cmd->pubInfo->srvId = (int)$_POST["srvid"];

	$temp = $ic->mccnQryAllRuleCountI($cmd);
	
	//log
$collection = $dbc->List->cmd;
$collection->update(array("cmd"=>"ser3"),array('$set'=>array("result"=>array("exCode"=>$temp->exInfo->exCode,"ruleCount"=>$temp->ruleCount))));

	//echo to web
	if($temp->exInfo->exCode == 1)
	{
		echo "无权向该DPI发送";
	}
	elseif($temp->exInfo->exCode == 0)
	{
		echo "规则数：".$temp->ruleCount;
	}
	else
		echo "超时错误";
?>
