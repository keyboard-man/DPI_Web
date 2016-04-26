<?php
require_once("../db_ip.php");
$dbc = new MongoClient(DB_IP());
$db = $dbc->List;

$node = $_POST["node"];
//$node = "mcnn_1";

$collection = $db->node;
$node_info = $collection->findone(array("node_name"=>$node));
$node_srv = array(); 
$node_srv = $node_info["srv_type"];
//var_dump($node_srv);

$collection = $db->server;
$server_list = $collection->find();

$result = '<p id="name" value="'.$node.'" />';

foreach($server_list as $doc)
{
	if(in_array($doc["key"],$node_srv))
	{
		$result .= '&nbsp &nbsp&nbsp &nbsp&nbsp &nbsp<input type="checkbox" class="checkbox" checked="checked" id="srv" value="'.$doc["key"].'"/>'.$doc["value"].'<br />';
	}
	else
	{
		$result .= '&nbsp &nbsp&nbsp &nbsp&nbsp &nbsp<input type="checkbox" class="checkbox" id="srv" value="'.$doc["key"].'"/>'.$doc["value"].'<br />';
	}
}

echo $result;
?>
