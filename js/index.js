function logInit()
{
	$("input#log_user").val("");
	$("input#log_passwd").val("");
}

$(document).ready(function()
{
	logInit();

	$("button#log_sub").click(function(){
		var user=$("input#log_user").val();
		var passwd=$("input#log_passwd").val();
		if(user=="" || passwd=="")
			alert("请输入用户名和密码");
		else
		{
			$.post("php/login.php",
				{user:user,passwd:passwd},
				function(data){
				if(data=="null")
					alert("用户不存在！");
				else if(data=="pwr")
					alert("密码错误！");
				else if(data=="true")
					window.location.assign("index.php");
			});
		}
	});

});
