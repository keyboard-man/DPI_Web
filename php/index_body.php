<?php
include "common.php";

function index_body()
{
	$result = '
		</div>
		</div>
		<div class="jumbotron masthead">
		<div class="container">
			<h1>DPI-Net</h1>
			<p>中国广科院-中国科学技术大学深度包解析项目主页</p>
		</div>
		</div>
		<div class="container">
		<div class="marketing-legacy">
			<h1 class="marketing">DPI深度包解析</h1>
			<p class="marketing-byline marketing">在高速、大数据量的核心网络环境中，进行网络业务的管控。为广播视频网络提供高效、安全的控制解决方案</p>
			<div class="row-fluid">
				<div class="span4">
				<h2>高效</h2>
				<p>运转高效，高速、大数据量，运行平稳</p>
				</div>

				<div class="span4">
				<h2>安全</h2>
				<p>安全等级高，防中间人攻击</p>
				</div>

				<div class="span4">
				<h2>全面</h2>
				<p>管控的非常全面，在WEB上就能操作整个系统</p>
				</div>
			</div>

		';

	return $result;
}

//for test
//index_body();
?>
