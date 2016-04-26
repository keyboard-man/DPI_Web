<?php
require_once("../db_ip.php");

$db_ip = DB_IP();
$dbc = new MongoClient($db_ip);
$db = $dbc->Stat;
$collection = $db->Service;

$id = $_POST["id"];
if($id!="all")
{
$cursor = $collection->find(array("pass"=>0,"srv_name"=>$id))->sort(array("dpi_name"=>1));

$result = '<table class="table table-hover table-bordered">
	<tr>
	<th>DPI名称</th><th>业务名称</th><th>流量状态</th><th>通断控制</th>
	</tr>
	';
$i=0;
foreach($cursor as $doc)
{
		if($doc["is_acl_legal"] == "yes")
			$legal = "正常";
		else
			$legal = "非法";
		$i++;
		$pass_or_stop = '<div id="pass_or_stop'.$i.'">
				   	     <span style="font-size:14px">通过</span>
						 <button id="stop" class="btn btn-danger" onclick="stop()">阻断</button></div>';
		$result .= '<tr><td>'.$doc["dpi_name"].'</td><td>'.$doc["srv_name"].'</td><td>'.$legal.'</td><td>'.$pass_or_stop.'</td></tr>
			';

}
$result .= '</table>';
}
else
{
$cursor = $collection->find(array("pass"=>0))->sort(array("dpi_name"=>1));

$result = '<table class="table table-hover table-bordered">
	<tr>
	<th>DPI名称</th><th>业务名称</th><th>流量状态</th><th>通断控制</th>
	</tr>
	';
$i = 0;
foreach($cursor as $doc)
{
		if($doc["is_acl_legal"] == "yes")
			$legal = "正常";
		else
			$legal = "非法";
		$name = $doc["srv_name"].$legal;
		$i++;
		$pass_or_stop = '<div id="pass_or_stop'.$i.'">
				   	     <span style="font-size:14px">通过</span>
						 <button id="stop" class="btn btn-danger" onclick="stop()">阻断</button></div>';
		$result .= '<tr><td>'.$doc["dpi_name"].'</td><td>'.$doc["srv_name"].'</td><td>'.$legal.'</td><td>'.$pass_or_stop.'</td></td></tr>
			';

}
$result .= '</table>';
}
echo $result;
?>
