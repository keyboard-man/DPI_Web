<?php
include "./ice/Client.php";
include "../db_ip.php";
$ic = new WebToMCCN;
$dpi = new CmdTxRxICE_Dpi;
$db_ip = DB_IP();
$dbc = new MongoClient($db_ip);
$collection = $dbc->List->node;

$user = $_COOKIE["dpi_user"];
$pass = $_COOKIE["dpi_password"];

$info = $collection->findone(array("node_name"=>$_POST["dpi"]));
$dpi->ip = ip2long($info["ip"]);
$dpi->port = (int)$info["port"];
$dpi->id = $info["id"];

	//单个业务类统计查询
	$cmd = new CmdTxRxICE_CmdQrySrvTypeRule;
	$temp = new CmdTxRxICE_RespQrySrvTypeRule;
	$cmd->pubInfo->usr->name = $user;
	$cmd->pubInfo->usr->pwd = $pass;
	$cmd->pubInfo->dpiList = array($dpi);
	$cmd->pubInfo->srvId = (int)$_POST["srvid"];

	$cmd->srvId = (int)$_POST["srvid"];

	$temp = $ic->mccnQrySrvTypeRuleI($cmd);

	//log
$collection = $dbc->List->cmd;
$collection->update(array("cmd"=>"ser2"),array('$set'=>array("result"=>array("exCode"=>$temp->exInfo->exCode,"ruleCount"=>$temp->ruleCount,"hitCount"=>$temp->hitCount))));

	//echo to web
	if($temp->exInfo->exCode == 1)
	{
		echo "无权向该DPI发送";
	}
	elseif($temp->exInfo->exCode == 0)
	{
		echo "规则数：".$temp->ruleCount." 命中数：".$temp->hitCount;
	}
	else
	{
		echo "超时错误";
	}
?>
