<?php

require_once 'Ice.php';
require_once 'IceStorm/IceStorm.php';
require_once 'subscriber.php';

class Publisher
{
	private $ICE;
	private $base;
	private $manager;
	private $topic;
	private $time;

	function __construct()
	{
		$this->ICE = Ice_initialize();
		try
		{
			//$this->base = $this->ICE->stringToProxy("DemoIceStorm/TopicManager:default -h 172.31.128.111 -p 20000");
			$this->base = $this->ICE->stringToProxy("DemoIceStorm/TopicManager:default -h 192.168.1.111 -p 20000");
			$this->manager = $this->base->ice_checkedCast("::IceStorm::TopicManager");
			$this->topic = $this->manager->retrieve("time");
			$this->time = Subs_McnnSubsPrxHelper::uncheckedCast($this->topic->getPublisher());
		}
		catch(Ice_LocalException $ex)
		{
			print_r($ex);
		}
	}

	function subsMcnnSrvInfoI($id,$type)
	{
		$this->time->subsMcnnSrvInfo($id,$type);
	}

	function subsDpiInfoI($dpi)
	{
		$this->time->subsDpiInfo($dpi);
	}

	function subsStatInfoI()
	{
		$this->time->subsStatInfo();
	}

}

//for test
/*
$publisher = new Publisher;
$id = "11111";
$type = array(555,55,22,5);
$publisher->subsMcnnSrvInfoI($id,$type);
echo "sbusMcnnSrvInfoI passed!\n";
$dpi = new Subs_PubSubDpi;
$dpi->id = "123d1fsafd123afds";
$dpi->ip = "192.168.1.111";
$dpi->port = "123";
$dpi->mantype = 1;
$publisher->subsDpiInfoI(array($dpi));
echo "subsDpiInfoI passed!\n";
$publisher->subsStatInfoI();
echo "subsStatInfoI passed!\n";
 */
?>
