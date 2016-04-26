	<!DOCTYPE html>
	<!--This is a template for the DPI webpage-->
	<html>
	<head>
		<meta charset="utf-8">
		<!--base file to be include -->
		<script type="text/javascript" src="js/jquery-2.0.2.min.js"></script>
		<script type="text/javascript" src="js/jquery.cookie.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/jquery-ui-1.10.3.custom.min.js"></script>
		<script type="text/jacascript" src="js/jquery.ui.datepicker-zh-CN.js"></script>
		<script type="text/javascript" src="js/common.js"></script>
		<link rel="stylesheet" href="css/bootstrap.min.css" />
		<link rel="stylesheet" href="css/jquery-ui-1.10.3.custom.min.css" />
		<link rel="stylesheet" href="css/bootstrap-responsive.min.css" />
		<link rel="stylesheet" href="css/docs.css" />

		{file_include}

		<style>
			body
			{
				padding-top:40px;
			}
			#foot
			{
				text-align:center;
				border-top:1px solid;
				margin-top:50px;
			}
		</style>
		{special_style}
	</head>

	<body onload="init()">
		<!--navbar-->
		<div class="navbar navbar-inverse navbar-fixed-top">
			<div class="navbar-inner">
			<div class="container">
				<a class="brand" href="#"><i><strong style="color:#EFEFEF">DPI管理系统</strong></i></a>
				<ul class="nav">
					{webpage}
				</ul>
				<ul class="nav pull-right">
					{hello}
				</ul>
			</div>
			</div>
		</div>
		
		<!--main body-->
		<div class="container">
			<div class="row-fluid">
				{main_body}
			</div>
		</div>

		<!--change_pwd-->
		<div class="row-fluid" id="change_pwd" style="display:none"> 
			&nbsp &nbsp<input type="password" class="input-medium" id="ch_pass" placeholder="原密码" style="height:25px"><br />
			&nbsp &nbsp<input type="password" class="input-medium" id="ch_new_pass" placeholder="新密码" style="height:25px"><br />
			&nbsp &nbsp<input type="password" class="input-medium" id="ch_new_pass_again" placeholder="再次输入新密码" style="height:25px"><br />
			&nbsp &nbsp<button type="button" class="btn-info" id="ch_submit">确定</button>&nbsp &nbsp &nbsp &nbsp&nbsp &nbsp<button type="button" class="btn-info" id="ch_cancel">取消</button>
		</div>

		<!--register-->
		<div class="row-fluid" id="register" style="display:none">
			&nbsp &nbsp<input type="text" class="input-medium" placeholder="用户名" style="height:25px" id="reg_user"><br />
			&nbsp &nbsp<input type="password" class="input-medium" placeholder="密码" style="height:25px" id="reg_pass"><br />
			&nbsp &nbsp<input type="password" class="input-medium" placeholder="确认密码" style="height:25px" id="reg_pass_again"><br />
			&nbsp &nbsp<button type="button" class="btn-info" id="reg_submit">确定</button>&nbsp &nbsp &nbsp &nbsp&nbsp &nbsp<button type="button" class="btn-info" id="reg_cancel">取消</button>
		</div>

		<!--footbar-->
		<div class="row" id="foot">
			<p>Copyright © VIM, Privacy Statement Terms and Conditions</p>
			<p>All right reserved</p>
			<p><img src="img/email.png" />Contact us:<a href="http://vim.ustc.edu.cn">vim.ustc.edu.cn</a></p>
		</div>
	</body>
</html>
