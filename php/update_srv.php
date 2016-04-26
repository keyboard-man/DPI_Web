<?php
require_once("../db_ip.php");

$related = $_POST["related"];
$id = $_POST["id"];
//$related = array(1,2,3);
//$id = "mcnn_1";

$dbc = new MongoClient(DB_IP());
$collection = $dbc->List->node;

$set = array();
$set["srv_type"] = $related;
$set["srv_type"] = array_unique($set["srv_type"]);

$collection->update(array("node_name"=>$id),array('$set'=>$set));

$collection = $dbc->List->server;
$result = '';
for($i=0;$i<count($related)-1;$i++)
{
	$server = $collection->findone(array("key"=>(int)$related[$i]));
	$result .= $server["value"].",";
}
$server = $collection->findone(array("key"=>(int)$related[$i]));
$result .= $server["value"];
echo $result;
?>
