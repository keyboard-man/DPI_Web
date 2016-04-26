<?php
include "common.php";
include "db_ip.php";
$db_ip = DB_IP();
$dbc=new MongoClient($db_ip);
$collection=$dbc->List->user;

function su_list()
{
	global $collection;
	$su_list = $collection->find(array("su"=>"1"));
	$su_list->sort(array("name"=>1));
	$result = '<ul>
		';
	foreach($su_list as $doc)
	{
		$result.='<li><button class="btn-link" value="'.$doc["name"].'" id="list">'.$doc["name"].'</button></li>
			';
	}
	$result.='
		</ul>';

	return $result;
}

function normal_list()
{
	global $collection;
	$normal_list = $collection->find(array("su"=>array('$ne'=>"1")));
	$normal_list->sort(array("name"=>1));
	$result = '<ul>
		';
	foreach($normal_list as $doc)
	{
		$result.='<li><button class="btn-link" value="'.$doc["name"].'" id="list">'.$doc["name"].'</button></li>
			';
	}
	$result.='
		</ul>';

	return $result;
}

function user_body()
{
	$result='
		<!--this is the body of user page-->
<form class="form-search">
<div class="row-fluid">
<div class="input-append" style="margin-top:5px">
	<input type="text" class="span10 search-query" placeholder="请输入查询的用户名" id="user_search">
	<button type="button" class="btn" id="user_search">查找</button>
</div>
</div>
</form>
<div class="row-fluid">
	<div class="span3" id="list" style="background-color:#CCCCCC">
	<h4 style="text-align:center">用户列表</h4>
	<table class="table table-bordered" >
	<tr><td>
		<div class="according-heading">
		<a class="according-toggle" data-toggle="collapse" href="#su"><button type="button" class="btn btn-block btn-info">管理员</button></a>
		</div>
		<div class="accordion-body in collapse" style="height:auto" id="su"><div class="accordion-inner">
		<div class="row-fluid">
			'.su_list().'
		</div>
		</div></div>
	</td></tr>
	<tr><td>
		<div class="according-heading">
		<a class="according-toggle" data-toggle="collapse" href="#normal"><button type="button" class="btn btn-block btn-info">普通用户</button></a>
		</div>
		<div class="according-body in collapse" style="height:auto" id="normal"><div class="accordion-inner">
		<div class="row-fluid">
			'.normal_list().'
		</div>
		</div></div>
	</td></tr>
	</table>

	</div>
	<div class="span9" id="content" style="background-color:#99CCCC">
	<h4 style="text-align:center">请在左侧选择用户名</h4>
	</div>
</div>
<!--
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
-->
		';

	return $result;
}
?>
