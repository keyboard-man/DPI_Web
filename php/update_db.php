<?php
require_once "../db_ip.php";

$dbc = new MongoClient(DB_IP());
$db = $dbc->Stat;
$cs = $db->Service;
$cc = $db->chart;

$float = $cs->distinct("srv_name",array("pass"=>0));
$num = count($float);

for($i=0;$i<$num;$i++)
{
	$recode = $cs->findone(array("srv_name"=>$float[$i],"pass"=>0,"is_acl_legal"=>"yes"));
	$data = $recode["speed"];
	$time = $recode["time"];
	$date = date("H:i:s",$time);
	$old_recode = $cc->findone(array($float[$i]."0"=>array('$exists'=>1)));
	$arr = $old_recode[$float[$i]."0"];
	$time_arr = $old_recode["time"];
	for($j=9;$j>0;$j--)
	{
		$arr[$j] = $arr[$j-1];
		$time_arr[$j] = $time_arr[$j-1];
	}
	$arr[0] = $data;
	$time_arr[0] = $date;
	$cc->update(array($float[$i]."0"=>array('$exists'=>1)),array('$set'=>array($float[$i]."0"=>$arr,"time"=>$time_arr)));

	$recode = $cs->findone(array("srv_name"=>$float[$i],"pass"=>0,"is_acl_legal"=>"no"));
	$data = $recode["speed"];
	$time = $recode["time"];
	$date = date("H:i:s",$time);
	$old_recode = $cc->findone(array($float[$i]."1"=>array('$exists'=>1)));
	$arr = $old_recode[$float[$i]."1"];
	$time_arr = $old_recode["time"];
	for($j=9;$j>0;$j--)
	{
		$arr[$j] = $arr[$j-1];
		$time_arr[$j] = $time_arr[$j-1];
	}
	$arr[0] = $data;
	$time_arr[0] = $date;
	$cc->update(array($float[$i]."1"=>array('$exists'=>1)),array('$set'=>array($float[$i]."1"=>$arr,"time"=>$time_arr)));

}
?>
