<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html charset=utf-8"/>
<script src="jquery-1.8.0.js"></script>
<link rel="stylesheet" type="text/css" href="jquery-ui/jquery-ui.css" />
<link rel="stylesheet" type="text/css" href="jquery-ui/jquery-ui.structure.css" />
<link rel="stylesheet" type="text/css" href="jquery-ui/jquery-ui.theme.css" />
<script src="go.js"> </script>
<script src="jquery-ui/jquery-ui.js" type="text/javascript"></script>
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
	title:'节点详细信息',
	positon:["right","top"]
/*    buttons:{
		"确定":function(){
			      //关闭当前Dialog
		  jQuery(this).dialog("close");
		    }
}*/
}); 

    // 获取鼠标悬浮文本框信息
    function tooltipTextConverter(thing) {
      var str = "";
      str += "name: " + thing.key;
      return str;
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
		jQuery.post("doubleClick.php", { name:clicked },
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
		//{ background: "#44CCFF" },
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
   var nodeDataArray = [
	   { key: "mccn", img:"sf_img/person.png"},
	   { key: "mcnn", img:"sf_img/computer.png"},
	   { key: "dpi", img:"sf_img/phone.png"},
	];

	//define a link Dataarray
    var linkDataArray = [
	   { from: "mccn", to: "mcnn" },
       { from: "mccn", to: "dpi" },
    ];
/*   var nodeDataArray = [
	   { key: "person", img:"sf_img/person.png"},
	   { key: "computer", img:"sf_img/computer.png"},
	   { key: "phone", img:"sf_img/phone.png"},
	   { key: "disk", img:"sf_img/disk.png"},
	   { key: "surf", img:"sf_img/surf.png"},
	   { key: "call", img:"sf_img/call.png"},
	];

	//define a link Dataarray
    var linkDataArray = [
	   { from: "person", to: "computer" },
       { from: "person", to: "phone" },
       { from: "computer", to: "disk" },
       { from: "computer", to: "surf" },
       { from: "phone", to: "surf" },
       { from: "phone", to: "call", } ,  //增加routing: go.Link.Orthogonal连线是90度折线;(默认:go.Link.Normal直线)
    ];
 */
    // create the GraphLinksModel
    myDiagram.model = new go.GraphLinksModel( nodeDataArray , linkDataArray ) ;
  }
</script>

</head>
<body onload="init()">
<div style=" margin: 10px auto; padding: 20px">
  <div id="myDiagram" style="float:left; border: solid 1px black; width:1370px; height:700px"></div>
</div>
<div id="dialogDiv" style="display:none;width:350px;height:350px"></div> 

</body>
</html>
