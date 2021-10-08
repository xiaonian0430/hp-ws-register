<?php
/**
 * 启动文件
 * @author: Xiao Nian
 * @contact: xiaonian030@163.com
 * @datetime: 2021-09-14 10:00
 */
use Workerman\Worker;

defined('IN_PHAR') or define('IN_PHAR', boolval(\Phar::running(false)));
defined('SERVER_ROOT') or define('SERVER_ROOT', IN_PHAR ? \Phar::running() : realpath(getcwd()));
// 标记是全局启动
defined('GLOBAL_START') or define('GLOBAL_START', 1);
ini_set('display_errors', 'on');

// 检查扩展或环境
if(strpos(strtolower(PHP_OS), 'win') === 0) {
    exit("start.php not support windows.\n");
}
if(!extension_loaded('pcntl')) {
    exit("Please install pcntl extension.\n");
}
if(!extension_loaded('posix')) {
    exit("Please install posix extension.\n");
}

require_once SERVER_ROOT . '/core/autoload.php';

var_dump($argv);
$model='produce';
defined('GLOBAL_MODEL') or define('GLOBAL_MODEL', $model);

// 加载所有app/*/start.php，以便启动所有服务
foreach(glob(SERVER_ROOT.'/app/*/start*.php') as $start_file) {
    require_once $start_file;
}

// 运行所有服务
Worker::runAll();
