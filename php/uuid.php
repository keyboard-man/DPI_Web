<?php
function uuid()
{
mt_srand((double)microtime()*10000);
$charid = strtolower(md5(uniqid(rand(),true)));
$hyphen = chr(45);
$uuid = 
     substr($charid,0,8).$hyphen
	.substr($charid,8,4).$hyphen
	.substr($charid,12,4).$hyphen
	.substr($charid,16,4).$hyphen
	.substr($charid,20,12);
return $uuid;
}
//echo uuid();
?>
