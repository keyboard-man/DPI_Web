<?php
include "./ice/Client.php";
include "../db_ip.php";
$ic = new WebToMCCN;
$dpi = new CmdTxRxICE_Dpi;
$db_ip = DB_IP();
$dbc = new MongoClient($db_ip);
$collection = $dbc->List->cmd;
$collection->update(array("cmd"=>"ser1"),array('$set'=>array("srvId"=>$_POST["srvid"],"dpi"=>$_POST["dpi"],"des"=>$_POST["des"])));
$collection = $dbc->List->node;

$user = $_COOKIE["dpi_user"];
$pass = $_COOKIE["dpi_password"];

$file = fopen("conf/ser_1.conf","r");
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
$info = $collection->findone(array("node_name"=>$arr["dpi"]));
$dpi->ip = ip2long($info["ip"]);
$dpi->port = (int)$info["port"];
$dpi->id = $info["id"];

	//单个业务类内容查询
	$cmd = new CmdTxRxICE_CmdQrySrvTypeRuleContent;
	$temp = new CmdTxRxICE_RespQrySrvTypeRuleContent;
	$cmd->pubInfo->usr->name = $user;
	$cmd->pubInfo->usr->pwd = $pass;
	$cmd->pubInfo->dpiList = array($dpi);
	$cmd->pubInfo->srvId = (int)$arr["srv_id"];

	$cmd->srvId = (int)$arr["srv_id"];

	$temp = $ic->mccnQrySrvTypeRuleContentI($cmd);

$collection = $dbc->List->cmd;
$collection->update(array("cmd"=>"ser1"),array('$set'=>array("result"=>array("exCode"=>$temp->exInfo->exCode))));

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
	{
		echo "超时错误";
	}
?>
