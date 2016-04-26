<?php
include "php/net_body.php";
include "db_ip.php";

$username=$_COOKIE["dpi_user"];
$password=$_COOKIE["dpi_password"];

$db_ip = DB_IP();
$dbc=new MongoClient($db_ip);
$collection=$dbc->List->user;
$user=$collection->findone(array("name"=>$username));
$tpl=new TemplatePower("template/template.tpl");
$tpl->prepare();

//check user
if($username=="" || $user==NULL || ($password!=$user["passwd"]))
{
	setcookie("dpi_user","",time()-3600,'/');
	setcookie("dpi_password","",time()-3600,'/');
	header("Location:index.php");
}
elseif($user["su"]!="1")
{
	$tpl->assign("webpage",webpage2());
	$tpl->assign("hello",after_log());
}
else
{
	$tpl->assign("webpage",webpage3());
	$tpl->assign("hello",after_log());
}
$tpl->assign("file_include",'<script type="text/javascript" src="js/net.js"></script>');
$tpl->assign("main_body",net_body());

$tpl->printToScreen();
?>
