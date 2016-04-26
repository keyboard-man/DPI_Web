<?php
include "../db_ip.php";

$node = $_POST["node"];

$db_ip = DB_IP();
$dbc = new MongoClient($db_ip);
$collection = $dbc->List->node;

$node_info = $collection->findone(array("node_name"=>$node));
if($node_info["node_type"] != 3)
{
	$result = '节点名称：'.$node_info["node_name"].'
节点id：'.$node_info["id"].'
所属集群：'.$node_info["owner"].'
部署位置：'.$node_info["latlong"].'
开机时间：'.$node_info["boottime"];
	echo $result;
}
else
{
	$result = '节点名称：'.$node_info["node_name"].'
节点id：'.$node_info["id"].'
节点IP:   '.$node_info["ip"].'
节点端口：'.$node_info["port"];

	echo $result;
}
//echo "123";
?>
