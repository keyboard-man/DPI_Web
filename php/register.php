<?php
include "../db_ip.php";
$username = $_POST["username"];
$pass = $_POST["pass"];

$db_ip = DB_IP();
$dbc = new MongoClient($db_ip);
$collection = $dbc->List->user;

$user = $collection->findone(array("name"=>$username));
if($user!=NULL)
	echo "usererror";
else
{
	$collection->insert(array("name"=>$username,"passwd"=>$pass));
	echo "true";
}
?>
