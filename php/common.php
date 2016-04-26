<?php
include "class.TemplatePower.inc.php";

function webpage1()
//this is the navbar before login
{
	$result = '
		<ul class="nav">
		<li><a href="index.php"><div style="color:#FFFFFF">首页</div></a></li>
		</ul>
		';

	return $result;
}

function webpage2()
//this is navbar after usr login
{
	$result = '
		<ul class="nav">
			<li><a href="index.php"><div style="color:#FFFFFF">首页</div></a></li>
			<li><a href="node.php"><div style="color:#FFFFFF">节点管理</div></a></li>
			<li><a href="net.php"><div style="color:#FFFFFF">网络管控</div></a></li>
			<li><a href="topo.php"><div style="color:#FFFFFF">拓扑展示</div></a></li>
			<li><a href="float.php"><div style="color:#FFFFFF">业务信息</div></a></li>
		</ul>
		';

	return $result;
}

function webpage3()
//this is navbar after super user login
{
	$result = '
		<ul class="nav">
			<li><a href="index.php"><div style="color:#FFFFFF">首页</div></a></li>
			<li><a href="node.php"><div style="color:#FFFFFF">节点管理</div></a></li>
			<li><a href="net.php"><div style="color:#FFFFFF">网络管控</div></a></li>
			<li><a href="user.php"><div style="color:#FFFFFF">用户管理</div></a></li>
			<li><a href="topo.php"><div style="color:#FFFFFF">拓扑展示</div></a></li>
			<li><a href="float.php"><div style="color:#FFFFFF">业务信息</div></a></li>
		</ul>
		';

	return $result;
}

function helloworld()
//accord to time say different hello to user.
{
	date_default_timezone_set('PRC');
	$date=date("H");
	$time=(int)$date;
	if($time<=10 && $time>=6)
		return "上午好！";
	elseif($time<=13 && $time>=11)
		return "中午好！";
	elseif($time>=14 && $time<=17)
		return "下午好！";
	elseif($time>=18 && $time<=21)
		return "晚上好！";
	else
		return "夜深了，请注意休息~";

}

function before_log()
{
	$result ='
		<ul class="nav pull-right">
		<li><a style="color:orange">'.helloworld().'</a></li>
		<input type="text" class="input-medium" placeholder="用户名" style="height:25px;margin-top:5px" id="log_user">
		<input type="password" class="input-medium" placeholder="密码" style="height:25px;margin-top:5px" id="log_passwd">
		<button type="button" style="height:25px;margin-top:5px;margin-bottom:10px" id="log_sub">登录</button>
		<button type="button" style="height:25px;margin-top:5px;margin-bottom:10px" id="reg">注册</button>
		</ul>
		';

	return $result;
}

function username()
{
	return $_COOKIE["dpi_user"];
}
function after_log()
{
	$result = '
		<ul class="nav pull-right">
		<li><a style="color:orange">'.helloworld().'</a></li>
		<li><a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" style="color:#FFFFFF"><i class="icon-user icon-white"></i>'.username().'<b class="caret"></b></a>
		<ul class="dropdown-menu" role="menu" aria-laberlledby="drop5">
		<li id="change_pwd"><a href="#"><i class="icon-edit"></i>修改密码</a></li>
		<li id="logout"><a href="php/logout.php"><i class="icon-circle-arrow-left"></i>注销登录</a></li>
		</ul>
		</li>
		</ul>
';

	return $result;
}

?>
