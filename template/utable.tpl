<!--this is the template for user table-->
<div class="row-fluid">
<table class="table table-bordered" style="background-color:#99CCCC">
<tr><td>
<h3>用户信息</h3>
</td></tr>
<tr><td>
	&nbsp &nbsp&nbsp &nbsp&nbsp &nbsp&nbsp &nbsp
	用户名：<input class="input-medium" type="text" disabled="disabled" style="height:30px" value={user_name}>
	&nbsp &nbsp&nbsp &nbsp&nbsp &nbsp&nbsp &nbsp
	&nbsp &nbsp&nbsp &nbsp&nbsp &nbsp&nbsp &nbsp
	权限：<div class="btn-group"><button class="btn dropdown-toggle" data-toggle="dropdown" style="height:30px"><p id="auth">{auth}<span class="caret"></span></p></button>
	<ul class="dropdown-menu"><li><button class="btn btn-link" id="li" value="0">&nbsp &nbsp 普通用户&nbsp &nbsp</button></li>
	<li><button class="btn btn-link" id="li" value="1">&nbsp &nbsp 管理员 &nbsp &nbsp</button></li></ul></div>
</div>
</td></tr>
<tr><td>
<div class="row-fluid">
	<div class="accordion-heading text-center">
	<a class="accordion-toggle" data-toggle="collapse" href="#mccn" style="text-align:center"><strong class="pull-center">MCCN</strong></a>
	</div>
	<div class="accordion-body in collapse" style="height:auto" id="mccn"><div class="accordion-inner">
	<div class="row-fluid">
{mccn_list}
	</div>
	</div></div>
</div>
</td></tr>
<tr><td>
<div class="row-fluid">
	<div class="accordion-heading text-center">
	<a class="accordion-toggle" data-toggle="collapse" href="#mcnn" style="text-align:center"><strong class="pull-center">MCNN</strong></a>
	</div>
	<div class="accordion-body in collapse" style="height:auto" id="mcnn"><div class="accordion-inner">
	<div class="row-fluid">
{mcnn_list}
	</div>
	</div></div>
</div>
</td></tr>
<tr><td>
<!--
<div class="row-fluid">
	<div class="accordion-heading text-center">
	<a class="accordion-toggle" data-toggle="collapse" href="#dpi" style="text-align:center"><strong class="pull-center">DPI</strong></a>
	</div>
	<div class="accordion-body in collapse" style="height:auto" id="dpi"><div class="accordion-inner">
	<div class="row-fluid">
{dpi_list}
	</div>
	</div></div>
</div>
</td></tr>
<tr><td>
-->
<div class="pull-right">
	<button class="btn-info" type="button" id="delete" value={user_name}><i class="icon-remove"></i>删除用户</button>
	<button class="btn-info" type="button" id="save" value={user_name}><i class="icon-ok"></i>保存</button>
</div>
</td></tr>
</table>
<script>
$("button#li").click(function(){
	var value = $(this).val();
	switch(value)
	{
	case "0":
		$("p#auth").html('普通用户<span class="caret"></span>');
		break;
	case "1":
		$("p#auth").html('管理员<span class="caret"></span>');
		break;
	default:
		$("p#auth").html('未知用户<span class="caret"></span>');
	}
});

$("button#delete").click(function(){
	var user=$(this).val();
	var r=confirm("确定删除该用户？");
	if(r==true)
	{
		$.post("php/delete_user.php",{
			user:user
			},function(data){
			if(data=="true")
			{
				alert("删除成功");
				window.location.assign("user.php");
			}
			else
				alert("请再次尝试");
			});
	}
});

function get_auth(str)
{
	switch(str)
	{
		case "管理员":
			return "1";
			break;
		default:
			return "0";
	}
}

$("button#save").click(function(){
	var control=new Array();
	var id=$(this).val();
	var auth=get_auth($("p#auth").text());
	var i=0;
	$("input:checkbox").each(function(){
		if($(this).is(':checked'))
		{
		control[i]=$(this).attr("id");
		i+=1;
		}
	});
	$.post("php/update_user.php",{
			control:control,
			auth:auth,
			id:id
		},function(data){
		if(data=="true")
		{
			alert("保存成功");
			window.location.assign("user.php");
		}
		else
			alert("请再次尝试");
	});
});
</script>
