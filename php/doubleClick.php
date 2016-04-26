<?php
include "../db_ip.php";
$name = $_POST["name"];

$db_ip = DB_IP();
$dbc=new MongoClient($db_ip);
$topocollection1=$dbc->List->node;
$toponode1=$topocollection1->findone(array("node_name"=>$name));
$result="<ul>";
if (($toponode1["node_type"]==1)||($toponode1["node_type"]==2)){
	$result.="<li>node_name:".$toponode1["node_name"]."</li><li>node_type:".$toponode1["node_type"]."</li> </ul>";

}else{
	$topocollection2=$dbc->Stat->Service;
	$toponode2=$topocollection2->find(array("dpi_name"=>$name));
	foreach($toponode2 as $doc){
		if($doc["is_acl_legal"]=="yes"){
			$result.="<li>dpi_name:".$doc["dpi_name"]." srv_name:".$doc["srv_name"]." is_acl_legal:yes srv_state:".$doc["srv_state"]." speed:".$doc["speed"]."</li>";
		
		}
	
	}
	$result.="</ul>";
}
	echo $result;
?>
