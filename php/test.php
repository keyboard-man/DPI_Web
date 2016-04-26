<?php
/*
$dbc = new MongoClient("localhost");
$db = $dbc->Stat;
$collection = $db->Service;
for($i=1;$i<=10;$i++)
{
$collection->update(array("srv_name"=>"央视".$i."套"),array('$set'=>array("srv_name"=>"央视".$i."套","dpi_name"=>"dpi_1","pass"=>0,"is_acl_legal"=>"yes","speed"=>50,"time"=>time())));
$collection->update(array("srv_name"=>"央视".$i."套"),array('$set'=>array("srv_name"=>"央视".$i."套","dpi_name"=>"dpi_1","pass"=>0,"is_acl_legal"=>"no","speed"=>50,"time"=>time())));
$collection->update(array("srv_name"=>"央视".$i."套"),array('$set'=>array("srv_name"=>"央视".$i."套","dpi_name"=>"dpi_1","pass"=>1,"is_acl_legal"=>"yes","speed"=>50,"time"=>time())));
$collection->update(array("srv_name"=>"央视".$i."套"),array('$set'=>array("srv_name"=>"央视".$i."套","dpi_name"=>"dpi_1","pass"=>1,"is_acl_legal"=>"no","speed"=>50,"time"=>time())));
//$collection->insert(array("srv_name"=>"央视".$i."套","dpi_name"=>"dpi_1","pass"=>0,"is_acl_legal"=>"yes","speed"=>50,"time"=>time()));
//$collection->insert(array("srv_name"=>"央视".$i."套","dpi_name"=>"dpi_1","pass"=>0,"is_acl_legal"=>"no","speed"=>50,"time"=>time()));
//$collection->insert(array("srv_name"=>"央视".$i."套","dpi_name"=>"dpi_1","pass"=>1,"is_acl_legal"=>"yes","speed"=>50,"time"=>time()));
//$collection->insert(array("srv_name"=>"央视".$i."套","dpi_name"=>"dpi_1","pass"=>1,"is_acl_legal"=>"no","speed"=>50,"time"=>time()));
}
echo "done!\n";
 */
//$arr = array(0,1,2,3,4,5,6,7,8,9);
$time = time();
$date = date("H:i:s",$time);
echo $date;
?>
