<?php
include "../db_ip.php";
$id=$_POST["id"];
$db_ip = DB_IP();
$dbc=new MongoClient($db_ip);
$collection=$dbc->List->node;
$collection->remove(array("id"=>$id));

echo "true";
?>
