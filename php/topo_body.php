<?php
include "common.php";
include "topo_info.php";
require_once "db_ip.php";

function list_info()
{
	$dbc = new MongoClient(DB_IP());
	$collection = $dbc->List->node;
	$node = $collection->find();
	$node_info = array();
	foreach($node as $doc)
	{
		if($doc["node_type"] == 1)
		{
			$node_info[$doc['node_name']] = '节点名称：'.$doc["node_name"].'\n节点ID： '.$doc["id"].'\n所属集群：'.$doc["owner"].'\n部署位置：'.$doc["latlong"].'\n开机时间：'.$doc["boottime"];
		}
		elseif($doc["node_type"] == 2)
		{
			$node_info[$doc['node_name']] = '节点名称：'.$doc["node_name"].'\n节点ID： '.$doc["id"].'\n所属集群：'.$doc["owner"].'\n部署位置：'.$doc["latlong"].'\n开机时间：'.$doc["boottime"].'\n===========================================\n管控业务列表\n';
			$collection = $dbc->List->server;
			for($i=0;$i<count($doc["srv_type"]);$i++)
			{
				$srv = $collection->findone(array("key"=>(int)$doc["srv_type"][$i]));
				$node_info[$doc['node_name']] .= ($i+1).':'.$srv["value"].';\n';
			}
		}
		else
		{
			$collection = $dbc->Stat->Service;
			$srv_info = $collection->find(array("dpi_name"=>$doc["node_name"],"is_acl_legal"=>"yes"));
			$node_info[$doc['node_name']] = '节点名称：'.$doc["node_name"].'\n节点ID:   '.$doc["id"].'\n节点IP：  '.$doc["ip"].'\n节点端口：'.$doc["port"].'\n===========================================\n管控业务信息列表\n';
			foreach($srv_info as $srv)
			{
				if($srv["pass"] == 0)
					$node_info[$doc['node_name']] .= '业务名称：'.$srv["srv_name"].'----通过     速率：'.$srv['speed'].'\n';
				else
					$node_info[$doc['node_name']] .= '业务名称：'.$srv["srv_name"].'----阻断     速率：'.$srv['speed'].'\n';
			}
		}
	}
	
	$result = "";
	foreach($node_info as $k => $v)
	{
		$result .='list["'.$k.'"] = "'.$v.'";
		';
	}
	return $result;
}

function topo_body()
{

	$result ='
		<script id="code">
function init() {
	//创建diagram
	var $ = go.GraphObject.make;
	myDiagram = $(go.Diagram, "myDiagram",  // create a Diagram for the DIV HTML element
{
	initialContentAlignment: go.Spot.Center,  // center the content
		"undoManager.isEnabled": true,  // enable undo & redo
		"toolManager.mouseWheelBehavior": go.ToolManager.WheelZoom, // zoom in or out
		layout: $(go.LayeredDigraphLayout,
{ direction: 90,
layerSpacing: 10,
columnSpacing: 15,
setsPortSpots: false })
});

jQuery("div#dialogDiv").dialog({ 
	hide:true, //点击关闭是隐藏,如果不加这项,关闭弹窗后再点就会出错. 
	autoOpen:false, 
	//height:300, 
	width:250, 
	modal:true, 
	title:"节点详细信息",
	positon:["right","top"]
/*    buttons:{
		"确定":function(){
			      //关闭当前Dialog
		  jQuery(this).dialog("close");
		    }
}*/
}); 

function tooltipTextConverter(thing) {
	var list = new Array();'.
		list_info().'
return list[thing.key];
}
// 定义鼠标悬浮文本框模板
var tooltiptemplate =
	$(go.Adornment, "Auto",
	$(go.Shape, "Rectangle",
		{ fill: "whitesmoke", stroke: "black" }),
		$(go.TextBlock,
		{ font: "bold 8pt Helvetica, bold Arial, sans-serif",
		wrap: go.TextBlock.WrapFit,
		margin: 5 },
		new go.Binding("text", "", tooltipTextConverter))
	);

	//双击节点
	function nodeDoubleClick(event, node) {
		var clicked = node.data.key;
		//if (clicked == "mccn") alert("hello"); 
		jQuery.post("php/doubleClick.php", { name:clicked },
			function(data){
				jQuery("#dialogDiv").empty();
				jQuery("#dialogDiv").append(data);
				jQuery("#dialogDiv").dialog("open");					
			})
 	}

// 定义节点模板
myDiagram.nodeTemplate =
	$(go.Node, "Vertical",  // the arrangement style of node when exits more than two attribute(text,pictute...)
	{ doubleClick: nodeDoubleClick },
	{ deletable: false, toolTip: tooltiptemplate },
	//new go.Binding("location", "loc", go.Point.parse),  // creat location property for next use of "loc"
	$(go.Picture,
	{ maxSize: new go.Size(50, 50) },
	new go.Binding("source", "img")),
		$(go.TextBlock,
	{ margin: 3 },  // some room around the text
	// TextBlock.text is bound to Node.data.key
	new go.Binding("text", "key"))
);

	/* 设置箭头及连线
	// define a simple Link template
	diagram.linkTemplate =
	  $(go.Link,
		$(go.Shape),  // the link shape
		$(go.Shape,   // the arrowhead
		  { toArrow: "OpenTriangle", fill: null })
	  );
	 */

//define a node DataArray 
var nodeDataArray = '.nodeDataArray().';

//define a link Dataarray
var linkDataArray = '.linkDataArray().';

// create the GraphLinksModel
myDiagram.model = new go.GraphLinksModel( nodeDataArray , linkDataArray ) ;
}
</script>
<div class="span10" style=" margin: 10px auto; padding: 20px">
  <div id="myDiagram" style="float:left; border: solid 1px black; width:1200px; height:600px"></div>
  </div>
<div id="dialogDiv" style="display:none;width:350px;height:350px"></div> 
  ';

	return $result;
}
//echo list_info();
?>
