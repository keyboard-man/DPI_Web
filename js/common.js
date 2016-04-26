function change_pwd_Init()
{
	$("input#ch_pass").val("");
	$("input#ch_new_pass").val("");
	$("input#ch_new_pass_again").val("");
}

function reg_Init()
{
	$("input#reg_user").val("");
	$("input#reg_pass").val("");
	$("input#reg_pass_again").val("");
}

function check_pass()
{
	var pass = $("input#ch_new_pass").val();
	var pass_again = $("input#ch_new_pass_again").val();
	if(pass != pass_again)
		return false;
	else
		return true;
}

$(document).ready(function(){
	change_pwd_Init();
	reg_Init();

	$("li#logout").click(function(){
		$.get("php/logout.php",function(data){
			if(data=="true")
			{
				window.location.assign("index.php");
			}
		});
	});

	$("button#ch_cancel").click(function(){
		$("div#change_pwd").dialog("close");
	});

	$("button#ch_submit").click(function(){
		var pass = $("input#ch_pass").val();
		var pass_new = $("input#ch_new_pass").val();
		var pass_new_again = $("input#ch_new_pass_again").val();
		
		if(pass=="" || pass_new=="" || pass_new_again=="")
			alert("不能为空");
		else
		{
			if(check_pass()!=true)
				alert("两次密码不一致");
			else
			{
				$.post("php/change_pwd.php",
					{old:pass,new:pass_new},
					function(data){
						if(data!="true")
						{
							alert("原密码错误！");
							change_pwd_Init();
						}
						else
						{
							alert("修改成功！");
							$.cookie("dpi_password",pass_new,{path:'/'});
							$("div#change_pwd").dialog("close");
						}
					});
			}
		}
	});

	$("button#reg_cancel").click(function(){
		$("div#register").dialog("close");
	});

	$("button#reg_submit").click(function(){
		var user = $("input#reg_user").val();
		var pass = $("input#reg_pass").val();
		var pass_again = $("input#reg_pass_again").val();

		if(user=="" || pass=="" || pass_again=="")
			alert("不能为空");
		else if(pass != pass_again)
		{
			alert("两次密码不一致");
			reg_Init();
		}
		else
			$.post("php/register.php",
				{username:user,pass:pass},
				function(data){
					if(data=="usererror")
					{
						alert("该用户已存在");
						reg_Init();
					}
					else if(data=="true")
					{
						alert("注册成功，请登录");
						$("div#register").dialog("close");
					}
					else
					{
						alert("请再次尝试");
						reg_Init();
					}
				});
	});

	$("li#change_pwd").click(function(){
		change_pwd_Init();
		$("div#change_pwd").dialog("open");
	});
	
	$("button#reg").click(function(){
		reg_Init();
		$("div#register").dialog("open");
	});

	$("div#change_pwd").dialog({
		autoOpen:false,
		width:200,
		modal:true,
		title:"修改密码"
	});

	$("div#register").dialog({
		autoOpen:false,
		width:200,
		modal:true,
		title:"注册"
	});
});
