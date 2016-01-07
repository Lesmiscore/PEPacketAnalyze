<?php

namespace PEPacketAnalyze{
	use PEPacketAnalyze\PEPacketAnalyze;
	use PEPacketAnalyze\utils\ClassLoader;

	require_once(__DIR__."/src/PEPacketAnalyze/utils/ClassLoader.php");

	$autoloader = new ClassLoader();
	$autoloader->addPath(__DIR__."/src");
	$autoloader->register();

	if(php_sapi_name() === "cli"){
		$pepacketanalyze = new PEPacketAnalyze(__DIR__);
		$pepacketanalyze->getLogger()->info("Thank you for using PEPacketAnalyze!");
	}else{
		echo "It cannot start from web.<br> Please start from a command-line<br>";
	}
}
