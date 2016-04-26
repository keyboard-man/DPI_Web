<?php
include "./ice/Client.php";
include "../db_ip.php";
$ic = new WebToMCCN;
$dpi = new CmdTxRxICE_Dpi;
$user = $_COOKIE["dpi_user"];
$pass = $_COOKIE["dpi_password"];
$db_ip = DB_IP();
$dbc = new MongoClient($db_ip);
$collection = $dbc->List->node;

$info = $collection->findone(array("node_name"=>$_POST["dpi"]));
$dpi->ip = ip2long($info["ip"]);
$dpi->port = (int)$info["port"];
$dpi->id = $info["id"];

	//单业务类
	$cmd = new CmdTxRxICE_CmdDelSrvTypeRuleContent;
	$temp = new CmdTxRxICE_RespDelSrvTypeRuleContent;
	$cmd->pubInfo->usr->name = $user;
	$cmd->pubInfo->usr->pwd = $pass;
	$cmd->pubInfo->dpiList = array($dpi);
	$cmd->pubInfo->srvId = (int)$_POST["srvid"];

	$cmd->srvId = (int)$_POST["srvid"];

	$temp = $ic->mccnDelSrvTypeRuleContentI($cmd);

	//log
$collection = $dbc->List->cmd;
$collection->update(array("cmd"=>"del1"),array('$set'=>array("result"=>array("exCode"=>$temp->exInfo->exCode))));

	//echo to web
	if($temp->exInfo->exCode == 1)
	{
		echo "无权向该DPI发送";
	}
	elseif($temp->exInfo->exCode == 0)
	{
		echo "有权访问";
	}
	else
		echo "超时错误";
?>
