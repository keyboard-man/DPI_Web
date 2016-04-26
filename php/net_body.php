<?php
include "common.php";

function net_body()
{
	$result =' 
		<div class="row-fluid" style="height:20px">
		<br />
		</div>
		<div class="row-fluid">
			<div class="span3" id="list" style="background-color:#CCCCCC">
			<h4 style="text-align:center">管控命令列表</h4>
			<br />
			<br />
			<button class="btn btn-info btn-block" id="add" value="0">添加类命令</button>
			<button class="btn btn-info btn-block" id="edit" value="1">查询类命令</button>
			<button class="btn btn-info btn-block" id="delete" value="2">删除类命令</button>
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
			</div>

			<div class="span9" id="content" style="background-color:#99CCCC">
			<h4 style="text-align:center">请在左侧选择命令类型</h4>
			</div>

		</div>
<script>
$("button.btn-block").click(function(){
	var value=$(this).val();
	$.post("php/net_info.php",{
			id:value
		},function(data){
			$("div#content").empty();
			$("div#content").append(data);
	});
});
</script>
		';

	return $result;
}
?>
