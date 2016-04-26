<?php
include "../db_ip.php";
$user=$_POST["user"];
$db_ip = DB_IP();
$dbc=new MongoClient($db_ip);
$collection=$dbc->List->user;

$collection->remove(array("name"=>$user));

echo "true";
?>
