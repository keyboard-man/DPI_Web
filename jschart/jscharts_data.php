<?php
//include "db_ip.php";

//$db_ip = DB_IP();
//$dbc=new MongoClient($db_ip);
$dbc=new MongoClient("192.168.1.111");
$collection=$dbc->Stat->Service;   
$srvName=$collection->distinct("srv_name",array("pass"=>0));//去重
$srvName_amount=count($srvName); //去重后的记录条数
$jschart_collection=$dbc->jschart->chartData; 
for($l=0;$l<2*$srvName_amount;$l++)  //新建数据库初始化
	{
	$jschart_collection->insert(array("chart_".$l=>""));
	}

//$chartAmount=$chartDoc->count();
function chart_info()
{
	global $collection,$jschart_collection,$srvName_amount,$srvName;
	$result = "";
	for($i=1;$i<=$srvName_amount;$i++)//第一行表，第二行表....
	{
		$j=2*$i-1;
		$k=2*$i;
		$Doc=$jschart_collection->findone(array("chart_".$j=>array('$exists'=>true)));
		$dataStr=$Doc["chart_".$j];
		$chartDoc=$collection->findone(array("srv_name"=>$srvName[$i],"is_acl_legal"=>"yes","pass"=>0));
			
		if(substr_count($dataStr,"[")==0)  //子串在字符串中出现的次数
		{
			$dataStr.="[".$chartDoc["time"].",".$chartDoc["speed"]."]";
		}elseif(substr_count($dataStr,"[")>0&&substr_count($dataStr,"[")<10)
		{
			$dataStr.=",[".$chartDoc["time"].",".$chartDoc["speed"]."]";
		}else
	   	{
			$dataStr=strchr($dataStr,",["); //从子串在字符串中第一次出现的位置开始截取
			$dataStr=strchr($dataStr,"[");
			$dataStr.=",[".$chartDoc["time"].",".$chartDoc["speed"]."]";
		}
		$jschart_collection->update(array("chart_".$j=>$Doc["chart_".$j]),array("chart_".$j=>$dataStr));    //保存数据到新建的数据库
		
		$titleName=$chartDoc["srv_name"]."  合法";
		$result='
			<div id="chartcontainer_'.$j.'" style="float:left; border: solid 1px black; width:400px; height:320px"></div>
			<script  type="text/javascript ">
			var myData_'.$j.' =new Array('.$dataStr.');//折线图上的点  
			var myChart_'.$j.' = new JSChart("chartcontainer_'.$j.'", "line");

			myChart_'.$j.'.setTitle("'.$titleName.'");// title标题  
			myChart_'.$j.'.setDataArray(myData_'.$j.');  
			myChart_'.$j.'.setAxisNameX("时间/s");
			myChart_'.$j.'.setAxisNameY("包速率");
			myChart_'.$j.'.setAxisValuesAngle(30); //横轴标注倾斜30度
			myChart_'.$j.'.setAxisValuesNumberX(8);//横轴设置8个点
			myChart_'.$j.'.setIntervalStartY(0);   //纵轴起点坐标为0
			//setSize(integer x, integer y);//坐标图尺寸
			//myChart.setIntervalX(10, 50);//
			//myChart.setIntervalStartX(10);
			//myChart.setIntervalEndX(50);
			myChart_'.$j.'.draw(); 
			</script>
				';
		$Doc=$jschart_collection->findone(array("chart_".$k=>array('$exists'=>true)));
		$dataStr=$Doc["chart_".$k];
		$chartDoc=$collection->findone(array("srv_name"=>$srvName[$i],"is_acl_legal"=>"no","pass"=>0));
		if(substr_count($dataStr,"[")==0)
		{
			$dataStr.="[".$chartDoc["time"].",".$chartDoc["speed"]."]";
		}elseif(substr_count($dataStr,"[")>0&&substr_count($dataStr,"[")<10)
		{
			$dataStr.=",[".$chartDoc["time"].",".$chartDoc["speed"]."]";
		}else
	   	{
			$dataStr=strchr($dataStr,",[");
			$dataStr=strchr($dataStr,"[");
			$dataStr.=",[".$chartDoc["time"].",".$chartDoc["speed"]."]";
		}		
		$jschart_collection->update(array("chart_".$k=>$Doc["chart_".$k]),array("chart_".$k=>$dataStr));   //保存数据到数据库

		$titleName=$chartDoc["srv_name"]."  非法";
		$result.='
			<div id="chartcontainer_'.$k.'" style="float:left; border: solid 1px black; width:400px; height:320px"></div> <br/>
			<script  type="text/javascript ">
			var myData_'.$k.' =new Array('.$dataStr.');//折线图上的点  
			var myChart_'.$k.' = new JSChart("chartcontainer_'.$k.'", "line");

			myChart_'.$k.'.setTitle("'.$titleName.'");// title标题  
			myChart_'.$k.'.setDataArray(myData_'.$k.');  
			myChart_'.$k.'.setAxisNameX("time/s");
			myChart_'.$k.'.setAxisNameY("包速率");
			myChart_'.$k.'.setAxisValuesAngle(30);
			myChart_'.$k.'.setAxisValuesNumberX(8);
			myChart_'.$k.'.setIntervalStartY(0);
			//setSize(integer x, integer y);
			//myChart.setIntervalX(10, 50);
			//myChart.setIntervalStartX(10);
			//myChart.setIntervalEndX(50);
			myChart_'.$k.'.draw(); 
			</script>
				';
	}
	return $result;
}
?>
