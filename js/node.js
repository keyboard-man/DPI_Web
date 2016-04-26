function search_Init()
{
	$("input#node_search").val("");
}

function add_dpi_Init()
{
	$("input#add_dpi_ip").val("");
	$("input#add_dpi_port").val("");
}

function change(string)
{
	switch(string)
	{
		case "添加动作":
			return 0;
		case "删除动作":
			return 1;
		case "编辑动作":
			return 2;
		default:
			return -1;
	}
}

$(document).ready(function()
{
	search_Init();
	$("button#node_search").click(function(){
		//search the node
		var info = $("input#node_search").val();
		if(info!="")
		$.post("php/search_node.php",
			{node:info},
			function(data){
				$("div#content").empty();
				$("div#content").append(data);
			});
	});

	$("button#list").click(function(){
		var id = $(this).val();
		$.post("php/node_info.php",
			{id:id},
			function(data){
				$("div#content").empty();
				$("div#content").append(data);
			});
	});

	$("button#add_dpi").click(function(){
		add_dpi_Init();
		$("div#add_dpi").dialog("open");
	});

	$("button#add_dpi_sub").click(function(){
		var ip = $("input#add_dpi_ip").val();
		var port = $("input#add_dpi_port").val();
		var name = $("input#add_dpi_name").val();
		var action = change($("p#add_action").text());
		if(ip=="" || port=="" || name=="")
			alert("请输入内容");
		else
			$.post("php/add_dpi.php",
				{
					id:$("input#add_dpi_id").val(),
					ip:ip,
					port:port,
					action:action,
					name:name
				},function(data){
					if(data=="true")
					{
						alert("插入成功");
						$("div#add_dpi").dialog("close");
						window.location.assign("node.php");
					}
					else
					{
						alert("请再次尝试！");
						add_dpi_Init();
					}
				});
	});

	$("button#add_dpi_cancel").click(function(){
		$("div#add_dpi").dialog("close");
	});

	$("button#add_li").click(function(){
		var value = $(this).val();
		switch(value)
		{
			case "0":
				$("p#add_action").html('添加动作<span class="caret"></span>');
				break;
			case "1":
				$("p#add_action").html('删除动作<span class="caret"></span>');
				break;
			case "2":
				$("p#add_action").html('编辑动作<span class="caret"></span>');
				break;
			default:
				$("p#add_action").html('未知动作<span class="caret"></span>');
		}
	});

	$("div#add_dpi").dialog({
		autoOpen:false,
		width:480,
		modal:true,
		title:"添加新DPI"
	});
});
