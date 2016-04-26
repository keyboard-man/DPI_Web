<!--this is the template for dpi node info table-->
<h2 align="center">DPI {name}</h2>
<h3 align="center">基本信息</h3>
<div class="row"><div class="span10 offset1">
<table class="table table-hover table-bordered">
	<tr>
		<th>节点ID</th>
		<td id="id">{id}</td>
		<th>节点IP</th>
		<td>{ip}</td>
	</tr>
	<tr>
		<th>节点端口</th>
		<td>{port}</td>
		<th>节点动作</th>
		<td>{action}</td>
	</tr>
</table>
<div class="pull-right">
<button class="btn-info" type="button" id="dpi_delete"><i class="icon-remove"></i>删除</button>
<button class="btn-info" type="button" id="dpi_save"><i class="icon-ok"></i>保存</button>
</div>
</div></div>
<script>
	$("button#li").click(function(){
		var value=$(this).val();
		switch(value)
		{
		case "0":
			$("p#action").html('添加动作<span class="caret"></span>');
			break;
		case "1":
			$("P#action").html('删除动作<span class="caret"></span>');
			break;
		case "2":
			$("p#action").html('编辑动作<span class="caret"></span>');
			break;
		default:
			$("p#action").html('未知动作<span class="caret"></span>');
		}
	});

	$("button#dpi_delete").click(function(){
		var dpi_id=$("td#id").text();
		var r=confirm("确定删除该DPI设备？");
		if(r==true)
		{
			$.post("php/delete_dpi.php",{
					id:dpi_id
				},function(data){
				if(data=="true")
				{
					alert("删除成功");
					window.location.assign("node.php");
				}
				else
					alert("请再次尝试");
				});
		}
	});
	
	$("button#dpi_save").click(function(){
		var id=$("td#id").text();
		var ip=$("input#ip").val();
		var port=$("input#port").val();
		var action=change($("p#action").text());
		$.post("php/update_dpi.php",{
				id:id,
				ip:ip,
				port:port,
				action:action
			},function(data){
			if(data=="true")
			{
				alert("保存成功");
			}
			else
				alert("请再次尝试");
			});
	});
</script>
