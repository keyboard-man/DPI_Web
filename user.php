<?php
include "php/user_body.php";

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
	header("Location:index.php");
}
else
{
	$tpl->assign("webpage",webpage3());
	$tpl->assign("hello",after_log());
}
$tpl->assign("file_include",'<script type="text/javascript" src="js/user.js"></script>');
$tpl->assign("main_body",user_body());

$tpl->printToScreen();
?>
