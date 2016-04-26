// 获取鼠标悬浮文本框信息
var str = "";
var value = "this is value";

function setstring()
{
	str = value;
}

function tooltipTextConverter(thing) {
	jQuery.post("php/mousehorve.php",{node:thing.key},
			function(data){
				value =  data;
			});
	str = value;
  return str;
}
