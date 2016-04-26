<?php
include "../db_ip.php";
$node = $_POST["node"];
$name = $_COOKIE["dpi_user"];

$db_ip = DB_IP();
$dbc = new MongoClient($db_ip);
$query = array();
$query["node_name"] = new MongoRegex("/".$node."/");

$collection = $dbc->List->node;
$cursor = $collection->find($query);
$collection = $dbc->List->user;
$user = $collection->findone(array("name"=>$name));
$result = '<h4 style="text-align:center">未找到相关节点，请重新检索</h4>';
if($cursor != NULL)
{
	$result = '<h4 style="text-align:center">请在如下列表中选择节点</h4>
		<div class="offset5">
		<ul>
		';
	foreach($cursor as $doc)
	{
		if(in_array($doc["id"],$user["in_control"]) || $user["su"]=="1")
			$result.='<li><button class="btn-link" value="'.$doc["node_name"].'" id="list">'.$doc["node_name"].'</button></li>
			';
	}
	$result .= '
		</ul>
		</div>';
}

echo $result;

$script='
	<script>
$("button.btn-link").click(function(){
	var id = $(this).val();
	$.post("php/node_info.php",
		{id:id},
		function(data){
			$("div#content").empty();
			$("div#content").append(data);
		});
	});
	</script>
';
echo $script;
?>
