<?php
//include "jschart_data.php";

$chart_result='
		<!DOCTYPE html>
		<html>
		<head>
		<meta http-equiv="Content-Type" content="text/html charset=utf-8"/>
		<script type="text/javascript" src="jquery-1.8.0.js"></script>
		<script type="text/javascript" src="jscharts.js"> </script>
		</head>

		<body >
		<div style=" margin: 10px auto; padding: 20px">

		<script  type="text/javascript ">
		function chart_post()
			{
				$.post("jscharts_post.php",
				{},
				function(data)
				{
					document.write(data);	
					alert(data);
				});	
			}
		var interval;  
		interval = setInterval(function() { chart_post() }, 3000);  //3秒循环调用执行chart_info()函数  
		//clearInterval(interval);   //清除延时程序  
		</script>
		</div>
		</body>
		</html>
			';
echo $chart_result;
?>
