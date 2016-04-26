<?php

/*************************************************************************
	> File Name: webClient.php
	> Author: John Rambo
    > mail: rambo@mail.ustc.edu.cn
	> Created Time: 2013年10月10日 星期五 10时23分06秒
 ************************************************************************/
require_once 'Ice.php';
require_once 'comm.php';
require_once 'cmd2mccn.php';

class WebToMCCN
{
	private $ICE;
	private $base;
	private $initial;

	//构造函数，连接mccn的ICE服务器
	function __construct()
	{
		$this->ICE = Ice_initialize();
		try
		{
			//$this->base = $this->ICE->stringToProxy("CmdToMccn:default -h 172.31.128.111 -p 22222");
			$this->base = $this->ICE->stringToProxy("CmdToMccn:default -h 192.168.1.111 -p 22222");
			$this->initial = CmdTxRxICE_CmdToMCCNPrxHelper::checkedCast($this->base);
			//echo "connect ok!\n";
		}
		catch(Ice_LocalException $ex)
		{
			print_r($ex);
		}
	}

	//实现cmd2mccn中的各个函数
	function mccnAddSmpAclI($cmd)
	{
		$result = new CmdTxRxICE_RespAddSmpAcl;
		try
		{
			$result = $this->initial->mccnAddSmpAcl($cmd);
		}
		catch(Ice_LocalException $ex)
		{
			print_r($ex);
		}
		
		return $result;
	}

	function mccnAddFullAclI($cmd)
	{
		$result = new CmdTxRxICE_RespAddFullAcl;
		try
		{
			$result = $this->initial->mccnAddFullAcl($cmd);
		}
		catch(Ice_LocalException $ex)
		{
			print_r($ex);
		}

		return $result;
	}

	function mccnQrySrvTypeRuleI($cmd)
	{
		$result = new CmdTxRxICE_RespQrySrvTypeRule;
		try
		{
			$result = $this->initial->mccnQrySrvTypeRule($cmd);
		}
		catch(Ice_LocalException $ex)
		{
			print_r($ex);
		}
		return $result;
	}

	function mccnQrySrvTypeRuleContentI($cmd)
	{
		$result = new CmdTxRxICE_RespQrySrvTypeRuleContent;
		try
		{
			$result = $this->initial->mccnQrySrvTypeRuleContent($cmd);
		}
		catch(Ice_LocalException $ex)
		{
			print_r($ex);
		}
		return $result;
	}

	function mccnQryStatSrvTypeI($cmd)
	{
		$result = new CmdTxRxICE_RespQryStatSrvType;
		try
		{
			$result = $this->initial->mccnQryStatSrvType($cmd);
		}
		catch(Ice_LocalException $ex)
		{
			print_r($ex);
		}
		return $result;
	}

	function mccnQryStatRuleTypeI($cmd)
	{
		$result = new CmdTxRxICE_RespQryStatRuleType;
		try
		{
			$result = $this->initial->mccnQryStatRuleType($cmd);
		}
		catch(Ice_LocalException $ex)
		{
			print_r($ex);
		}
		return $result;
	}

	function mccnQrySglRltRuleContentI($cmd)
	{
		$result = new CmdTxRxICE_RespQrySglRltRuleContent;
		try
		{
			$result = $this->initial->mccnQrySglRltRuleContent($cmd);
		}
		catch(Ice_LocalException $ex)
		{
			print_r($ex);
		}
		return $result;
	}


	function mccnQrySglRltRuleCountI($cmd)
	{
		$result = new CmdTxRxICE_RespQrySglRltRuleCount;
		try
		{
			$result = $this->initial->mccnQrySglRltRuleCount($cmd);
		}
		catch(Ice_LocalException $ex)
		{
			print_r($ex);
		}
		return $result;
	}

	function mccnQryNetRuleContentI($cmd)
	{
		$result = new CmdTxRxICE_RespQryNetRuleContent;
		try
		{
			$result = $this->initial->mccnQryNetRuleContent($cmd);
		}
		catch(Ice_LocalException $ex)
		{
			print_r($ex);
		}
		return $result;
	}

	function mccnQryNetRuleCountI($cmd)
	{
		$result = new CmdTxRxICE_RespQryNetRuleCount;
		try
		{
			$result = $this->initial->mccnQryNetRuleCount($cmd);
		}
		catch(Ice_LocalException $ex)
		{
			print_r($ex);
		}
		return $result;
	}

	function mccnQryAllRuleContentI($cmd)
	{
		$result = new CmdTxRxICE_RespQryAllRuleContent;
		try
		{
			$result = $this->initial->mccnQryAllRuleContent($cmd);
		}
		catch(Ice_LocalException $ex)
		{
			print_r($ex);
		}
		return $result;
	}
	
	function mccnQryAllRuleCountI($cmd)
	{
		$result = new CmdTxRxICE_RespQryAllRuleCount;
		try
		{
			$result = $this->initial->mccnQryAllRuleCount($cmd);
		}
		catch(Ice_LocalException $ex)
		{
			print_r($ex);
		}
		return $result;
	}

	function mccnDelSrvTypeRuleContentI($cmd)
	{
		$result = new CmdTxRxICE_RespDelSrvTypeRuleContent;
		try
		{
			$result = $this->initial->mccnDelSrvTypeRuleContent($cmd);
		}
		catch(Ice_LocalException $ex)
		{
			print_r($ex);
		}
		return $result;
	}

	function mccnDelRuleTypeI($cmd)
	{
		$result = new CmdTxRxICE_RespDelRuleType;
		try
		{
			$result = $this->initial->mccnDelRuleType($cmd);
		}
		catch(Ice_LocalException $ex)
		{
			print_r($ex);
		}
		return $result;
	}

	function mccnDelSglRuleI($cmd)
	{
		$result = new CmdTxRxICE_RespDelSglRule;
		try
		{
			$result = $this->initial->mccnDelSglRule($cmd);
		}
		catch(Ice_LocalException $ex)
		{
			print_r($ex);
		}
		return $result;
	}

	function mccnDelSglRuleRelatedI($cmd)
	{
		$result = new CmdTxRxICE_RespDelSglRuleRelated;
		try
		{
			$result = $this->initial->mccnDelSglRuleRelated($cmd);
		}
		catch(Ice_LocalException $ex)
		{
			print_r($ex);
		}
		return $result;
	}

	function mccnDelNetRuleI($cmd)
	{
		$result = new CmdTxRxICE_RespDelNetRule;
		try
		{
			$result = $this->initial->mccnDelNetRule($cmd);
		}
		catch(Ice_LocalException $ex)
		{
			print_r($ex);
		}
		return $result;
	}

	function mccnDelAllRuleI($cmd)
	{
		$result = new CmdTxRxICE_RespDelAllRule;
		try
		{
			$result = $this->initial->mccnDelAllRule($cmd);
		}
		catch(Ice_LocalException $ex)
		{
			print_r($ex);
		}
		return $result;
	}

	function mccnQuitI($cmd)
	{
		$result = new CmdTxRxICE_RespQuit;
		try
		{
			$result = $this->initial->mccnQuit($cmd);
		}
		catch(Ice_LocalException $ex)
		{
			print_r($ex);
		}
		return $result;
	}


}
//以下代码供测试用
//$test = new WebToMCCN;
//$cmd = new CmdTxRxICE_CmdAddSmpAcl;
//$resp = new CmdTxRxICE_RespAddSmpAcl;
//$resp = $test->mccnAddSmpAclI($cmd);
//print_r($resp);
//$cmd2 = new CmdTxRxICE_CmdAddFullAcl;
//$test->mccnAddFullAclI($cmd2);
//echo "addFullAcl passed\n";

/*
$cmd3 = new CmdTxRxICE_CmdQrySrvTypeRule;
$test->mccnQrySrvTypeRuleI($cmd3);
echo "qrySrvTypeRule passed\n";

$cmd4 = new CmdTxRxICE_CmdQrySrvTypeRuleContent;
$test->mccnQrySrvTypeRuleContentI($cmd4);
echo "qrySrvTypeRuleContent passed\n";

$cmd5 = new CmdTxRxICE_CmdQryStatSrvType;
$test->mccnQryStatSrvTypeI($cmd5);
echo "qryStatSrvType passed\n";

$cmd6 = new CmdTxRxICE_CmdQrystatRuleType;
$test->mccnQryStatRuleTypeI($cmd6);
echo "qryStatRuleType passed\n";

$cmd7 = new CmdTxRxICE_CmdQrySglRltRuleContent;
$test->mccnQrySglRltRuleContentI($cmd7);
echo "qrySglRltRuleContent passed\n";

$cmd8 = new CmdTxRxICE_CmdQrySglRltRuleCount;
$test->mccnQrySglRltRuleCountI($cmd8);
echo "qrySglRltRuleCount passed\n";

$cmd9 = new CmdTxRxICE_CmdQryNetRuleContent;
$test->mccnQryNetRuleContentI($cmd9);
echo "qryNetRuleContent passed\n";

$cmd10 = new CmdTxRxICE_CmdQryAllRuleContent;
$test->mccnQryAllRuleContentI($cmd10);
echo "qryAllRuleContent passed\n";

$cmd11 = new CmdTxRxICE_CmdQryAllRuleCount;
$test->mccnQryAllRuleCountI($cmd11);
echo "qryAllRuleCount passed\n";

$cmd12 = new CmdTxRxICE_CmdDelSrVTypeRuleContent;
$test->mccnDelSrvTypeRuleContentI($cmd12);
echo "delSrvTypeRuleContent passed\n";

$cmd13 = new CmdTxRxICE_CmdDelRuleType;
$test->mccnDelRuleTypeI($cmd13);
echo "delRuleType passed\n";

$cmd14 = new CmdTxRxICE_CmdDelSglRule;
$test->mccnDelSglRuleI($cmd14);
echo "delSglRule passed\n";

$cmd15 = new CmdTxRxICE_CmdDelSglRuleRelated;
$test->mccnDelSglRuleRelatedI($cmd15);
echo "delSglRuleRelated passed\n";

$cmd16 = new CmdTxRxICE_CmdDelNetRule;
$test->mccnDelNetRuleI($cmd16);
echo "delNetRule passed\n";

$cmd17 = new CmdTxRxICE_CmdDelAllRule;
$test->mccnDelAllRuleI($cmd17);
echo "delAllRule passed\n";

$cmd18 = new CmdTxRxICE_CmdQuit;
$test->mccnQuitI($cmd18);
echo "quit passed\n";
 */
/*
$dpi = new CmdTxRxICE_Dpi;
$dpi->ip = ip2long("192.168.1.1");
$dpi->port = 456;
$dpi->id = "be35a180-03bf-c6a5-8509-e539378fcf18";
$cmd->pubInfo->usr->name = "admin";
$cmd->pubInfo->usr->pwd = "admin";
$cmd->pubInfo->srvId = 2;
$cmd->pubInfo->dpiList = array($dpi);
$resp = $test->mccnAddSmpAclI($cmd);
print_r($resp);
echo $resp->exInfo->exCode;
 */
?>
