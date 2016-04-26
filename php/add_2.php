<?php
include "./ice/Client.php";
include "../db_ip.php";
$ic = new WebToMCCN;
$dpi = new CmdTxRxICE_Dpi;
$db_ip = DB_IP();
$dbc = new MongoClient($db_ip);
$collection = $dbc->List->cmd;
$collection->update(array("cmd"=>"add2"),array('$set'=>array("srvId"=>$_POST["srvid"],"dpi"=>$_POST["dpi"],"des"=>$_POST["des"])));
$collection = $dbc->List->node;

$user = $_COOKIE["dpi_user"];
$pass = $_COOKIE["dpi_password"];
//$user = "admin";
//$pass = "123456";

$file = fopen("conf/add_2.conf","r");
$arr = array();
while(!feof($file))
{
	$line = fgets($file);
	$str = explode(":",$line,2);
	if(count($str)>1)
	{
		//find the conf
		$temp = explode(";",$str[1]);
		$arr[trim($str[0])] = trim($temp[0]);
	}
}
$info = $collection->findone(array("node_name"=>$_POST["dpi"]));
$dpi->ip = ip2long($info["ip"]);
$dpi->port = (int)$info["port"];
$dpi->id = $info["id"];

	$cmd = new CmdTxRxICE_CmdAddFullAcl;
	$temp = new CmdTxRxICE_RespAddFullAcl;
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
	$cmd->acl->stvId = 0;
	
	$temp = $ic->mccnAddFullAclI($cmd);

	//log
$collection = $dbc->List->cmd;
$collection->update(array("cmd"=>"add2"),array('$set'=>array("result"=>array("exCode"=>$temp->exInfo->exCode,"rstCode"=>$temp->rstCode))));

	//echo to web
	if($temp->exInfo->exCode == 1)
	{
		echo "无权向该DPI发送";
	}
	elseif($temp->exInfo->exCode == 0)
	{
		switch($temp->rstCode)
		{
			case 0x0:
				echo "操作成功";
				break;
			case 0x1:
				echo "规则已满";
				break;
			case 0x2:
				echo "规则以存在，重新开始老化";
				break;
			case 0x3:
				echo "规则不存在";
				break;
			case 0x4:
				echo "无效的RCP Flag";
				break;
			case 0x5:
				echo "无效的消息类型";
				break;
			case 0x6:
				echo "无效的消息代码";
				break;
			case 0x7:
				echo "无效用户";
				break;
			case 0x8:
				echo "无效口令";
				break;
			case 0x9:
				echo "当前查询未完成";
				break;
			case 0xa:
				echo "当前保存未完成";
				break;
			case 0xb:
				echo "操作请求被禁止";
				break;
			default:
				echo "未知错误";
		}
	}
	else
	{
		echo "超时错误";
	}

?>
