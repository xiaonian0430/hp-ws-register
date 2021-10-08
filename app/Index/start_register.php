<?php
/**
 * 服务注册中心
 * @author: Xiao Nian
 * @contact: xiaonian030@163.com
 * @datetime: 2021-09-14 10:00
 */
use \Workerman\Worker;
use \GatewayWorker\Register;

$conf = require_once SERVER_ROOT . '/config/'.GLOBAL_MODE.'.php';
$address=$conf['REGISTER']['PROTOCOL'].'://'.$conf['REGISTER']['LISTEN_ADDRESS'].':'.$conf['REGISTER']['PORT'];

// register 服务必须是text协议
$register = new Register($address);

// 如果不是在根目录启动，则运行runAll方法
if(!defined('GLOBAL_START')) {
    Worker::runAll();
}

