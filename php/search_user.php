<?php
include "../db_ip.php";
$user=$_POST["user"];
$db_ip = DB_IP();
$dbc=new MongoClient($db_ip);
$collection=$dbc->List->user;
$query=array();
$query["name"]=new MongoRegex("/".$user."/");

$cursor=$collection->find($query);
$result='<h4 style="text-align:center">未找到相关用户，请重新检索</h4>';
if($cursor != NULL)
{
	$result='<h4 style="text-align:center">请在如下列表中选择用户</h4>
		<div class="offset5">
		<ul>
		';
	foreach($cursor as $doc)
	{
		$result.='<li><button class="btn-link" value="'.$doc["name"].'" id="list">'.$doc["name"].'</button></li>
			';
	}
	$result.='
		</ul>
		</div>';
}

echo $result;
$script='
<script>
$("button.btn-link").click(function(){
	var id=$(this).val();
	$.post("php/user_info.php",
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
