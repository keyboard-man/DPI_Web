<?php
include "../db_ip.php";
//include "ice/Publisher.php";

$id=$_POST["id"];
$ip=$_POST["ip"];
$port=$_POST["port"];
$name=$_POST["name"];
$action=$_POST["action"];
$db_ip = DB_IP();
$dbc=new MongoClient($db_ip);
$collection=$dbc->List->node;

/*
$publisher = new Publisher;
$node = new Subs_PubSubDpi;
$node->id = $id;
$node->ip = $ip;
$node->port = $port;
$node->mantype = (int)$action;
$publisher->subsDpiInfoI(array($node));
 */

$collection->insert(array("action"=>$action,"node_name"=>$name,"id"=>$id,"ip"=>$ip,"port"=>$port,"node_type"=>3));

echo "true";
?>
