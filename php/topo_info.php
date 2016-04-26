<?php
include "db_ip.php";

$db_ip = DB_IP();
$dbc=new MongoClient($db_ip);
$topocollection=$dbc->List->node;
$toponode=$topocollection->find();

function nodeDataArray(){
	global $toponode;
	$nodeArray = "[";
	foreach ($toponode as $doc){
		
		if($doc['node_type']==1){
			$img_path="img/mccn.png";
		}else if($doc['node_type']==2){
			$img_path="img/mcnn.png";
		}else $img_path="img/dpi.png";

		$nodeArray.='{key:"'.$doc['node_name'].'",img:"'.$img_path.'"},';

	}
	$nodeArray.="]";
	return $nodeArray;
}

function linkDataArray(){
	global $toponode,$topocollection;
	$toponode = $topocollection->find(array("node_type"=>array('$ne'=>3)));
	$linkArray = "[";
	foreach ($toponode as $doc){
		$relatedNodeArray = $doc['related_node'];
		$relatedNodeArray_amount = count($relatedNodeArray);
		if($relatedNodeArray_amount==0)  continue;
		else{
			for($i=0;$i<$relatedNodeArray_amount;$i++){
				$relatedArrayDoc=$topocollection->findone(array("id"=>$relatedNodeArray[$i]));
				$linkArray.='{from:'.'"'.$doc['node_name'].'",to:"'.$relatedArrayDoc['node_name'].'"},';
			}		
		}
	}
	$linkArray.="]";
	return $linkArray;

}
//echo nodeDataArray();
//echo linkDataArray();
?>
