<?php
include "../db_ip.php";
$old=$_POST["old"];
$new=$_POST["new"];
$username=$_COOKIE["dpi_user"];

$db_ip = DB_IP();
$dbc=new MongoClient($db_ip);
$collection=$dbc->List->user;
$user=$collection->findone(array("name"=>$username));

if($user==NULL || $user["passwd"]!=$old)
	echo "false";
elseif($user["passwd"]==$old)
{
	$collection->update(array("name"=>$username),array('$set'=>array("passwd"=>$new)));
	echo "true";
}
?>
