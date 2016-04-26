<?php
include "../db_ip.php";
$id=$_POST["id"];
$ip=$_POST["ip"];
$port=$_POST["port"];
$action=$_POST["action"];
$db_ip = DB_IP();
$dbc=new MongoClient($db_ip);
$collection=$dbc->List->node;

$set=array();
$set["ip"]=$ip;
$set["port"]=$port;
$set["action"]=$action;

$collection->update(array("id"=>$id),array('$set'=>$set));

echo "true";
?>
