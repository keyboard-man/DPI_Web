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

$file = fopen("conf/del_3.conf","r");
$arr = array();
while(!feof($file))
{
	$line = fgets($file);
	$str = explode(":",$line,2);
	if(count($str)>1)
	{
		$temp = explode(";",$str[1]);
		$arr[trim($str[0])] = trim($temp[0]);
	}
}
$info = $collection->findone(array("node_name"=>$_POST["dpi"]));
$dpi->ip = ip2long($info["ip"]);
$dpi->port = (int)$info["port"];
$dpi->id = $info["id"];

	//单规则
	$cmd = new CmdTxRxICE_CmdDelSglRule;
	$temp = new CmdTxRxICE_RespDelSglRule;
	$cmd->pubInfo->usr->name = $user;
	$cmd->pubInfo->usr->pwd = $pass;
	$cmd->pubInfo->dpiList = array($dpi);
	$cmd->pubInfo->srvId = (int)$_POST["srvid"];

	$cmd->acl->ruleDirection = (int)$arr["ruleDirection"];
	$cmd->acl->srcIP = ip2long($arr["srcIP"]);
	$cmd->acl->dstIP = ip2long($arr["dstIP"]);
	$cmd->acl->srcPort = (int)$arr["srcPort"];
	$cmd->acl->dstPort = (int)$arr["dstPort"];
	$cmd->acl->protocalId = (int)$arr["protocalID"];
	$cmd->acl->srcIPMask = ip2long($arr["srcIPMask"]);
	$cmd->acl->dstIPMask = ip2long($arr["dstIPMask"]);
	$cmd->acl->srcPortMask = (int)$arr["srcPortMask"];
	$cmd->acl->dstPortMask = (int)$arr["dstPortMask"];
	$cmd->acl->protocalIdMask = (int)$arr["protocalIDMask"];

	$temp = $ic->mccnDelSglRuleI($cmd);

	//log
$collection = $dbc->List->cmd;
$collection->update(array("cmd"=>"del3"),array('$set'=>array("result"=>array("exCode"=>$temp->exInfo->exCode,"ruleCount"=>$temp->ruleCount))));

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
