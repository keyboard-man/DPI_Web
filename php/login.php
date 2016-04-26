<?php
include "../db_ip.php";
$username=$_POST["user"];
$passwd=$_POST["passwd"];

$db_ip = DB_IP();
$dbc=new MongoClient($db_ip);
$collection=$dbc->List->user;
$user=$collection->findone(array("name"=>$username));

if($user == NULL)
	echo "null";
elseif($user["passwd"] != $passwd)
	echo "pwr";
elseif($user["passwd"] == $passwd)
{
	setcookie("dpi_user",$username,time()+3600*2,'/');
	setcookie("dpi_password",$passwd,time()+3600*2,'/');
	echo "true";
}
?>
