<?php
include "../db_ip.php";
$user=$_POST["id"];
$control=$_POST["control"];
$auth=$_POST["auth"];
$db_ip = DB_IP();
$dbc=new MongoClient($db_ip);
$collection=$dbc->List->user;

$set=array();
$set["in_control"]=$control;
$set["su"]=$auth;
$collection->update(array("name"=>$user),array('$set'=>$set));

echo "true";
//echo $user;
?>
