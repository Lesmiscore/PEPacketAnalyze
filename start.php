<?php

/*
 *▪   ▄▄▄·       ▄▄· ▄ •▄ ▄▄▄ .▄▄▄▄▄
 *██ ▐█ ▄█▪     ▐█ ▌▪█▌▄▌▪▀▄.▀·•██
 *▐█· ██▀· ▄█▀▄ ██ ▄▄▐▀▀▄·▐▀▀▪▄ ▐█.▪
 *▐█▌▐█▪·•▐█▌.▐▌▐███▌▐█.█▌▐█▄▄▌ ▐█▌·
 *▀▀▀.▀    ▀█▄▀▪·▀▀▀ ·▀  ▀ ▀▀▀  ▀▀▀
 *
 *This program is free software:
 *and PocketEdition Packet Analyze.
 *
*/

namespace PEPacketAnalyze{

    use PEPacketAnalyze\PEPacketAnalyze;
    use PEPacketAnalyze\utils\ClassLoader;

    require_once(__DIR__ . "/src/PEPacketAnalyze/utils/ClassLoader.php");

    $loader = new ClassLoader();
    $loader->addPath(__DIR__ . "/src");
    $loader->register();

    if(php_sapi_name() === "cli"){
        $class = new PEPacketAnalyze(__DIR__);
        $class->getLogger()->info("Thank you for using PEPacketAnalyze by iPocket!");
    }else{
        echo "It cannot start from web.<br> Please start from a command-line<br>";
    }
}
