<!--this is the template for mccn or mcnn node info table-->
	<h2 align="center">{type} &nbsp {name}</h2>
	<h3 align="center">基本信息</h3>
	<div class="row"><div class="span10 offset1">
	<table class="table table-hover table-bordered">
		<tr>
			<th>节点ID</th>
			<td id="id">{id}</td>
			<th>节点类型</th>
			<td>{type}</td>
		</tr>
		<tr>
			<th>所属集群</th>
			<td>{owner}</td>
			<th>部署位置</th>
			<td>{latlong}</td>
		</tr>
		<tr>
			<th>开机时间</th>
			<td>{boottime}</td>
			<th>报告时间</th>
			<td>{reported}</td>
		</tr>
	</table>
	</div></div>

	<h3 align="center">业务信息</h3>
	<div class="row"><div class="span10 offset1">
	<table class="table table-hover table-bordered">
		<tr>
			<th>ICE适配器</th>
			<td>{ice_adapter}</td>
			<th>ICE协议</th>
			<td>{ice_protocal}</td>
		</tr>
		<tr>
			<th>ICE IP</th>
			<td>{ice_ip}</td>
			<th>ICE端口</th>
			<td>{ice_port}</td>
		</tr>
		<tr>
			<th>连接数</th>
			<td>{link_net_num}</td>
			<th>当前状态</th>
			<td>{down}</td>
		</tr>
		<tr>
			<th>业务类型号</th>
			<td colspan="3">{stype}</td>
		</tr>
		<tr>
			<th>相关节点</th>
			<td colspan="3">{arr}</td>
		</tr>
	</table>
	{button}
	</div></div>

	<h3 align="center">物理信息</h3>
	<div class="row"><div class="span10 offset1">
	<table class="table table-hover table-bordered">
		<tr>
			<th>CPU数量</th>
			<td>{cpu_num}</td>
			<th>CPU频率MHz</th>
			<td>{cpu_speed_MHz}</td>
		</tr>
		<tr>
			<th>总内存MB</th>
			<td>{mem_total_MB}</td>
			<th>总硬盘GB</th>
			<td>{disk_total_GB}</td>
		</tr>
	</table>
	</div></div>


	<script>
$("button#edit_srv_submit").click(function(){
		var related = new Array();
		var id = $("p#name").attr("value");
		var i = 0;
		$("input#srv.checkbox").each(function(){
			if($(this).is(':checked'))
			{
			related[i]=$(this).attr("value");
			i += 1;
			}
			});
		$.post("php/update_srv.php",{
related:related,
id:id
},function(data){
	$("input#styple.input-xxlarge").attr("value",data);
});
		$("div#edit_srv").dialog("close");
		});

$("button#edit_srv_cancel").click(function(){
		$("div#edit_srv").dialog("close");
		});

	$("button#save_mcnn").click(function(){
		var related=new Array();
		var stype=$("input#styple").val();
		var id=$("td#id").text();
		var i=0;
		$("input:checkbox").each(function(){
			if($(this).is(':checked'))
			{
				related[i]=$(this).attr("id");
				i += 1;
			}
		});
		$.post("php/update_mcnn.php",{
				stype:stype,
				related:related,
				id:id
			},function(data){
			if(data=="true")
				alert("保存成功");
			else
				//alert(data);
				alert("请再次尝试");
			});
	});
$("button#edit_srv").click(function(){
		var id = $(this).val();
		$.post("php/srv_list.php",{
node:id},function(data){
		$("div#srv_list").empty();
		$("div#srv_list").append(data);
});
		$("div#edit_srv").dialog("open");
		});
	</script>
