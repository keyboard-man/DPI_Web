<?php
include "../db_ip.php";
//include "ice/Publisher.php";

$related=$_POST["related"];
$stype=$_POST["stype"];
$id=$_POST["id"];
$db_ip = DB_IP();
$dbc=new MongoClient($db_ip);
$collection=$dbc->List->node;
$set=array();
$set["related_node"]=$related;
/*
$publisher = new Publisher;
$publisher->subsMcnnSrvInfoI($id,$arr);
 */
$collection->update(array("id"=>$id),array('$set'=>$set));
echo "true";
?>
