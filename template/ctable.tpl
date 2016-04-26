<!-- this is the template for net commond table-->
<h2 align="center">{title}</h2>
<h3 align="center">{commond1}</h3>
<div class="row"><div class="span10 offset1">
<table class="table table-hover table-bordered">
	<tr>
		<th>{method}</th>
		<td>{method_1}</td>
		<th>业务类</th>
		<td><input style="height:25px" type="input" class="input" placeholder="请输入业务号" value="{profession_1}" id="srvid1"></td>
	</tr>
	<tr>
		<th>DPI名称</th>
		<td>
			<div class="btn-group"><button class="btn dropdown-toggle" data-toggle="dropdown" style="height:25px"><p id="1_dpi">{name_1}<span class="caret"></span></p></button>
			<ul class="dropdown-menu">
				{dpi_list1}
			</ul>
			</div>
		</td>
		<th>DPI ID</th>
		<td id="1_id">{id_1}</td>
	</tr>
	<tr>
		<th>描述</th>
		<td colspan="3">
		<textarea rows="2" class="span12" id="des1">{describe_1}</textarea>
		</td>
	</tr>
	{result_1}
</table>
<div class="pull-right">
	<button type="button" class="btn btn-info" value="{value}_1" id="button1"><i class="icon-play"></i>运行</button>
</div>
</div></div>

<h3 align="center">{commond2}</h3>
<div class="row"><div class="span10 offset1">
<table class="table table-hover table-bordered">
	<tr>
		<th>{method}</th>
		<td>{method_2}</td>
		<th>业务类</th>
		<td><input style="height:25px" type="input" class="input" value="{profession_2}" id="srvid2"></td>
	</tr>
	<tr>
		<th>DPI名称</th>
		<td>
			<div class="btn-group"><button class="btn dropdown-toggle" data-toggle="dropdown" style="height:25px"><p id="2_dpi">{name_2}<span class="caret"></span></p></button>
			<ul class="dropdown-menu">
				{dpi_list2}
			</ul>
			</div>
		</td>
		<th>DPI ID</th>
		<td id="2_id">{id_2}</td>
	</tr>
	<tr>
		<th>描述</th>
		<td colspan="3">
		<textarea rows="2" class="span12" id="des2">{describe_2}</textarea>
		</td>
	</tr>
	{result_2}
</table>
<div class="pull-right">
	<button type="button" class="btn btn-info" value="{value}_2" id="button2"><i class="icon-play"></i>运行</button>
</div>
</div></div>

<h3 align="center">{commond3}</h3>
<div class="row"><div class="span10 offset1">
<table class="table table-hover table-bordered">
	<tr>
		<th>{method}</th>
		<td>{method_3}</td>
		<th>业务类</th>
		<td><input style="height:25px" type="input" class="input" value="{profession_3}" id="srvid3"></td>
	</tr>
	<tr>
		<th>DPI名称</th>
		<td>
			<div class="btn-group"><button class="btn dropdown-toggle" data-toggle="dropdown" style="height:25px"><p id="3_dpi">{name_3}<span class="caret"></span></p></button>
			<ul class="dropdown-menu">
				{dpi_list3}
			</ul>
			</div>
		</td>
		<th>DPI ID</th>
		<td id="3_id">{id_3}</td>
	</tr>
	<tr>
		<th>描述</th>
		<td colspan="3">
		<textarea rows="2" class="span12" id="des3">{describe_3}</textarea>
		</td>
	</tr>
	{result_3}
</table>
<div class="pull-right">
	<button type="button" class="btn btn-info" value="{value}_3" id="button3"><i class="icon-play"></i>运行</button>
</div>
</div></div>
<script>
$("button#button1").click(function(){
	var type = $(this).val();
	var srvid = $("input#srvid1").val();
	var dpi = $("p#1_dpi").text();
	var des = $("textarea#des1").val();
	var file = "php/"+type+".php";
	$.post(file,
		{
			srvid:srvid,
			dpi:dpi,
			des:des
		},function(data){
		alert(data);	
	});
});

$("button#button2").click(function()
{
	var type = $(this).val();
	var srvid = $("input#srvid2").val();
	var dpi = $("p#2_dpi").text();
	var des = $("textarea#des2").val();
	var file = "php/"+type+".php";
	$.post(file,
		{
			srvid:srvid,
			dpi:dpi,
			des:des
		},function(data){
		alert(data);	
	});
});

$("button#button3").click(function()
{
	var type = $(this).val();
	var srvid = $("input#srvid3").val();
	var dpi = $("p#3_dpi").text();
	var des = $("textarea#des3").val();
	var file = "php/"+type+".php";
	$.post(file,
		{
			srvid:srvid,
			dpi:dpi,
			des:des
		},function(data){
		alert(data);	
	});
});
$("button#li").click(function(){
	var id = $(this).val();
	var button = $(this).attr("name");
	var dpi_id = $(this).attr("dpi_id");
	switch(button)
	{
		case "1_dpi":
			$("p#1_dpi").html(id+'<span class="caret"></span>');
			$("td#1_id").html(dpi_id);
			break;
		case "2_dpi":
			$("p#2_dpi").html(id+'<span class="caret"></span>');
			$("td#2_id").html(dpi_id);
			break;
		case "3_dpi":
			$("p#3_dpi").html(id+'<span class="caret"></span>');
			$("td#3_id").html(dpi_id);
	}
});
</script>
