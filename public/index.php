<?php
header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Credentials:true");
header('Access-Control-Allow-Methods:POST,GET,OPTIONS,DELETE,PUT');
header('Access-Control-Allow-Headers:Content-Type,x-requested-with');
use BBSMS\Exception\ContinueException;
use Phalcon\Di\FactoryDefault;

error_reporting(E_ALL & ~E_NOTICE &~E_WARNING);//只报错误

define('ROOT_PATH', dirname(__DIR__));
define('APP_PATH', ROOT_PATH . '/apps');
define('CONFIG_PATH',ROOT_PATH.'/config');
define('LIBRARY_PATH',ROOT_PATH.'/library');
define('VENDOR_PATH',ROOT_PATH.'/vendor');
try {

    /**
     * The FactoryDefault Dependency Injector automatically registers
     * the services that provide a full stack framework.
     */
    $di = new FactoryDefault();

    /**
     * Read services
     */
    include ROOT_PATH . '/config/services.php';
    
    /**
     * Handle routes
     */
    include ROOT_PATH . '/config/router.php';

    /**
     * Get config service for use in inline setup below
     */
    $config = $di->getConfig();

    /**
     * Include Autoloader
     */
    include ROOT_PATH . '/config/loader.php';

    /**
     * Handle the request
     */
    $application = new \Phalcon\Mvc\Application($di);

    // 注册模块
    $application->registerModules(
        [
            "home" => [
                "className" => "BBSMS\\Home\\Module",
                "path" => APP_PATH."/home/Module.php",
            ],
            "admin" => [
                "className" => "BBSMS\\Admin\\Module",
                "path" => APP_PATH."/admin/Module.php",
            ],
            "api" => [
                "className" => "BBSMS\\API\\Module",
                "path" => APP_PATH."/api/Module.php",
            ]
        ]
    );

    $eventsManager =$di->getShared('eventsManager');
    $application->setEventsManager($eventsManager);
    /**
     *监听器
     */
    include ROOT_PATH . '/config/listener.php';

    /** @var Logger $logger */
    $logger=$di->getShared('logger');
    $requestinfo=$_SERVER['REMOTE_ADDR'].'  '.$_SERVER['REQUEST_METHOD'].'  '
        .$_SERVER['REQUEST_URI'];

    $logger->info($_REQUEST);
    //记录访问日志
    /** @var \Phalcon\Mvc\Router $router */
    $router=$di->getRouter();
    $routerinfo='\\'.$router->getModuleName().'\\'.$router->getControllerName().'\\'.$router->getActionName();
    $logger->info($requestinfo.'    '.$routerinfo);
    try {
        // 处理请求
        /** @var \Phalcon\Http\Response $response */
        $response = $application->handle();
    } catch (ContinueException $e) {//手动抛的为了中断action的异常
        
    }
    $logger->info('回复内容:'.$application->response->getContent());
    if($response instanceof \Phalcon\Http\ResponseInterface){
        $response->send();
    }else{
        $application->response->send();
    }
    
} catch (\Exception $e) {
    $re=new \HJ100\BBSMS\SMSResult();
    $re->code=\HJ100\BBSMS\SMSError::E;
    $re->message='抛异常啦';
    echo json_encode($re);
    /** @var Logger $logger */
    $logger=$di->getShared('logger');
    $logger->error($e);
}
