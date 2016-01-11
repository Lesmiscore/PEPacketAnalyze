<?php

/*
 *▪   ▄▄▄·       ▄▄· ▄ •▄ ▄▄▄ .▄▄▄▄▄
 *██ ▐█ ▄█▪     ▐█ ▌▪█▌▄▌▪▀▄.▀·•██
 *▐█· ██▀· ▄█▀▄ ██ ▄▄▐▀▀▄·▐▀▀▪▄ ▐█.▪
 *▐█▌▐█▪·•▐█▌.▐▌▐███▌▐█.█▌▐█▄▄▌ ▐█▌·
 *▀▀▀.▀    ▀█▄▀▪·▀▀▀ ·▀  ▀ ▀▀▀  ▀▀▀
 *
 *This program is free software:
 *and PocketEdision Packet Analyze.
 *
*/

namespace PEPacketAnalyze;

use PEPacketAnalyze\utils\Config;
use PEPacketAnalyze\utils\MainLogger;
use PEPacketAnalyze\utils\CommandReader;
use PEPacketAnalyze\utils\SocketReader;

class PEPacketAnalyze{
    protected $path, $logger;
    protected static $interface;

    public function getPath(){
        return $this->path;
    }

    public function getLogger(){
        return $this->logger;
    }

    public static function getInterface(){
        return self::$interface;
    }

    public function __construct($path){
        set_error_handler(function($severity, $message, $file, $line){
            echo $line . "\n";
            echo $message . "\n";
            $debug = debug_backtrace();
            echo $debug[1]["class"] . " : " . $debug[1]["function"] . "\n";
            echo $debug[2]["class"] . " : " . $debug[2]["function"] . "\n";
        });

        $this->path = $path;

        self::$interface = clone $this;

        $this->config = new Config($this->path.DIRECTORY_SEPARATOR . "config.json", [
            "host" => "0.0.0.0",
            "port" => "19132",
            "serverip" => "0.0.0.0",
            "serverport" => "19132",
            "debuglevel" => 0,
        ]);
        $this->config->save();

        $this->logger = new MainLogger($this->path, $this->config->get("debuglevel"));

        $this->logger->info("PEPacketAnalyze starting now...");

        $this->working = true;

        $this->commandreader = new CommandReader();
        $this->socketreader = new SocketReader($this->logger, $this->config->get("host"), $this->config->get("port"), $this->config->get("serverip"), $this->config->get("serverport"));

        $this->logger->info("PEPacketAnalyze start!");

        echo "\x1b]0;PEPacketAnalyze running!\x07";

        $this->tick();
    }

    public function tick(){
        while($this->working){
            $this->getCommandLine();
            for($i = 0; $i <= 100000; $i++){
                $this->socketreader->tick();
            }
        }
    }

    public function getCommandLine(){
        $line = $this->commandreader->getCommandLine();
        if($line !== null){
            $line = explode(" ", $line);
            switch($line[0]){
                case "stop":
                case "shutdown":
                    $this->shutdown();
                break;
                case "address":
                    if(isset($line[1]) and filter_var($line[1], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)){
                        $this->socketreader->setAddress($line[1]);
                        echo $line[1] . "をデフォルト受信アドレスに設定しました。\n";
                    }else{
                        echo "Usage: address [IPAddress]\n";
                    }
                break;
                case"help":
                    if(isset($line[1])){
                        switch($line[1]){
                            case "stop":
                            case "shutdown":
                                echo "解析を終了します\n";
                            break;

                            case "address":
                                echo "デフォルト受信アドレスを変更します。\n";
                            break;
                        }
                    }else{
                        echo "使用できるコマンド\n-stop\n-shutdown : 解析を終了します\n-address : デフォルト受信アドレスを変更します。\n";
                    }
                default:
                    echo "UnknownCommand: " . $line[0] . "\n";
                break;
            }
        }
    }

    public function shutdown(){
        $this->working = false;
        $this->config->save();
        $this->logger->info("Shutdown a system now.. . ");
    }
}