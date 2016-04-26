<?
include "class.TemplatePower.inc.php";
include "../db_ip.php";
$id = $_POST["id"];
//$id = "dpi_1";

$db_ip = DB_IP();
$dbc = new MongoClient($db_ip);
$collection = $dbc->List->node;
$node = $collection->findone(array("node_name"=>$id));
$type = $node["node_type"];

function stypeval()
{
	global $node;
	$dbcc = new MongoClient(DB_IP());
	$sercollection = $dbcc->List->server;
	$result = "";
	for($i=0;$i<count($node["srv_type"])-1;$i++)
	{
		$server = $sercollection->findone(array("key"=>(int)$node["srv_type"][$i]));
		$result.=$server["value"].",";
	}
	$server = $sercollection->findone(array("key"=>(int)$node["srv_type"][$i]));
	$result.=$server["value"];

	return $result;
}

function arrlist()
{
	global $node,$dbc,$collection;
	$dpi_list = $collection->find(array("node_type"=>3));
	$user_name = $_COOKIE["dpi_user"];
	$collection=$dbc->List->user;
	$user = $collection->findone(array("name"=>$user_name));
	$result = "";
	if($user["su"]=="1")
	{
		foreach($dpi_list as $doc)
		{
			$select = 0;
			for($i=0;$i<count($node["related_node"]);$i++)
			{
				if($node["related_node"][$i] == $doc["id"])
				{
					$select = 1;
					break;
				}
			}
			if($select == 1)
			{
				$result.='&nbsp &nbsp<input type="checkbox" class="checkbox" checked="checked" id="'.$doc["id"].'"/>'.$doc["node_name"].":".$doc["id"].'<br />';
			}
			else
				$result.='&nbsp &nbsp<input type="checkbox" class="checkbox" id="'.$doc["id"].'"/>'.$doc["node_name"].":".$doc["id"].'<br />';
		}
	}
	else
	{
		foreach($dpi_list as $doc)
		{
			$select = 0;
			for($i=0;$i<count($node["related_node"]);$i++)
			{
				if($node["related_node"][$i] == $doc["id"])
				{
					$select = 1;
					break;
				}
			}
			if($select == 1)
			{
				$result.='&nbsp &nbsp<input type="checkbox" class="checkbox" checked="checked" id="'.$doc["id"].'" disabled="disabled"/>'.$doc["node_name"].":".$doc["id"].'<br />';
			}
			else
				$result.='&nbsp &nbsp<input type="checkbox" class="checkbox" id="'.$doc["id"].'" disabled="disabled"/>'.$doc["node_name"].":".$doc["id"].'<br />';
		}

	}

	if($result=="")
		$result = "NULL";
	return $result;
}

function select()
{
	global $node;
	$result='
		<div class="btn-group"><button class="btn dropdown-toggle" data-toggle="dropdown" style="height:30px"><p id="action">';
	switch($node["action"])
	{
	case 0:
		$result.="添加动作";
		break;
	case 1:
		$result.="删除动作";
		break;
	case 2:
		$result.="编辑动作";
		break;
	default:
		$result.="未知动作";
	}
	$result.='<span class="caret"></span></p></button>
		<ul class="dropdown-menu"><li><button class="btn btn-link" id="li" value="0">&nbsp &nbsp 添加动作&nbsp &nbsp</button></li>
		<li><button class="btn btn-link" id="li" value="1">&nbsp &nbsp 删除动作 &nbsp &nbsp</button></li>
		<li><button class="btn btn-link" id="li" value="2">&nbsp &nbsp 编辑动作 &nbsp &nbsp</button></li></ul></div>
		';

	return $result;
}

if($type == 1 || $type == 2)
{
	$tpl = new TemplatePower("../template/mtable.tpl");
	$tpl->prepare();
	if($nodeinfo["down"] == 0)
		$down = "运行";
	else
		$down = "宕机";
	$stype = "";
	for($i=0;$i<count($node["srv_type"]);$i++)
	{
		$stype = $stype.$node["srv_type"][$i]."  ";
	}
	if($stype=="")
		$stype = "NULL";

	$arr = "";
	for($i=0;$i<count($node["related_node"]);$i++)
	{
		$arr = $arr.$node["related_node"][$i]."<br />";
	}
	if($arr == "")
		$arr = "NULL";

	if($type == 1)
		$typename = "MCCN";
	else
		$typename = "MCNN";
	$tpl->assign("type",$typename);
	$tpl->assign("name",$id);
	$tpl->assign("id",$node["id"]);

	if($node["owner"] == "")
		$tpl->assign("owner","--");
	else
		$tpl->assign("owner",$node["owner"]);

	if($node["latlong"] == "")
		$tpl->assign("latlong","--");
	else
		$tpl->assign("latlong",$node["latlong"]);

	if($node["boottime"]=="")
		$tpl->assign("boottime","--");
	else
		$tpl->assign("boottime",$node["boottime"]);

	if($node["reported"]=="")
		$tpl->assign("reported","--");
	else
		$tpl->assign("reported",$node["reported"]);

	if($node["ice_adapter"]=="")
		$tpl->assign("ice_adapter","--");
	else
		$tpl->assign("ice_adapter",$node["ice_adapter"]);

	if($node["ice_protocal"]=="")
		$tpl->assign("ice_protocal","--");
	else
		$tpl->assign("ice_protocal",$node["ice_protocal"]);

	if($node["ice_ip"]=="")
		$tpl->assign("ice_ip","--");
	else
		$tpl->assign("ice_ip",$node["ice_ip"]);

	if($node["ice_port"]=="")
		$tpl->assign("ice_port","--");
	else
		$tpl->assign("ice_port",$node["ice_port"]);

	$tpl->assign("link_net_num",$node["link_net_num"]);
	$tpl->assign("down",$down);
	if($node["node_type"] == 2)
	{
		$tpl->assign("stype",'<input type="text" class="input-xxlarge" style="height:30px" value="'.stypeval().'" id="styple" disabled="disabled" placeholder="输入业务号1-16，用逗号分隔"> <button class="btn-info pull-right" type="button" id="edit_srv" value="'.$_POST["id"].'"><i class="icon-edit"></i>编辑</button>');
		$tpl->assign("arr",arrlist());
		$tpl->assign("button",'<button class="btn-info pull-right" type="button" id="save_mcnn"><i class="icon-ok"></i>保存</button>');
	}
	else
	{
		$tpl->assign("stype",$stype);
		$tpl->assign("arr",$arr);
	}
	$tpl->assign("cpu_num",$node["cpu_num"]);
	$tpl->assign("cpu_speed_MHz",$node["cpu_speed_MHz"]);
	$tpl->assign("mem_total_MB",$node["mem_total_MB"]);
	$tpl->assign("disk_total_GB",$node["disk_total_GB"]);

}
else
{
	$tpl = new TemplatePower("../template/dtable.tpl");
	$tpl->prepare();

	$tpl->assign("name",$id);
	$tpl->assign("id",$node["id"]);
	$tpl->assign("ip",'<input type="text" style="height:30px" value="'.$node["ip"].'" id="ip" >');
	$tpl->assign("port",'<input type="text" style="height:30px" value="'.$node["port"].'" id="port">');
	$tpl->assign("action",select());
}

$tpl->printToScreen();
unset($tpl);
?>
