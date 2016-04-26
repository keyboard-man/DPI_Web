<?php
include "php/index_body.php";
include "db_ip.php";

$username=$_COOKIE['dpi_user'];
$password=$_COOKIE['dpi_password'];
$db_ip = DB_IP();
$dbc=new MongoClient($db_ip);
$db=$dbc->List->user;
$user=$db->findone(array("name"=>$username));
$tpl = new TemplatePower("template/template.tpl");
$tpl->prepare();

//check user
if($username=="" || $user==NULL || ($password!=$user["passwd"]))
{
	$tpl->assign("webpage",webpage1());
	$tpl->assign("hello",before_log());
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
$tpl->assign("file_include",'<script type="text/javascript" src="js/index.js"></script>');
$tpl->assign("main_body",index_body());
$tpl->assign("special_style",'
	<style>
	 .marketing-legacy .row {
		         margin-bottom: 9px;
				       }
      .marketing-legacy h1 {
		          margin: 60px 0 10px;
				          font-size: 60px;
				          font-weight: 200;
						          line-height: 1;
						          letter-spacing: -1px;
								        }
      .marketing-legacy {
		          color: #5a5a5a;
				        }
      .marketing-legacy h2,
		        .marketing-legacy h3 {
					        font-weight: 300;
							      }
      .marketing-legacy h2 {
		          font-size: 22px;
				          line-height: 36px;
				          margin: 0;
						        }
      .marketing-legacy p {
		          margin-right: 10px;
				        }
      .marketing-legacy .bs-icon {
		          float: left;
				          margin: 7px 10px 0 0;
				          opacity: .8;
						        }
      .marketing-legacy .small-bs-icon {
		          float: left;
				          margin: 4px 5px 0 0;
				        }
      .marketing-legacy .marketing-byline {
		          margin-bottom: 40px;
				          font-size: 20px;
				          font-weight: 300;
						          line-height: 1.25;
						          color: #999;
								        }
</style>
	');

$tpl->printToScreen();
?>
