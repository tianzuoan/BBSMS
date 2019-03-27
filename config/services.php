<?php
use Phalcon\Mvc\View;
use Phalcon\Mvc\View\Engine\Php as PhpEngine;
use Phalcon\Mvc\Url as UrlResolver;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use Phalcon\Mvc\Model\Metadata\Memory as MetaDataAdapter;
use Phalcon\Session\Adapter\Files as SessionAdapter;
use Phalcon\Flash\Direct as Flash;
/**
 * Shared configuration service
 */
$di->setShared('config', function () {
    return include ROOT_PATH . "/config/config.php";
});

/**
 * The URL component is used to generate all kind of urls in the application
 */
$di->setShared('url', function () {
    $config = $this->getConfig();
    $url = new UrlResolver();
    $url->setBaseUri($config->application->baseUri);
    return $url;
});

/**
 * Setting up the view component
 */
$di->setShared('view', function () {
    $config = $this->getConfig();

    $view = new View();
    $view->setDI($this);
    $view->setViewsDir($config->application->viewsDir);

    $view->registerEngines([
        '.volt' => function ($view) {
            $config = $this->getConfig();

            $volt = new VoltEngine($view, $this);

            $volt->setOptions([
                'compiledPath' => $config->application->cacheDir,
                'compiledSeparator' => '_'
            ]);

            return $volt;
        },
        '.html' => PhpEngine::class

    ]);

    return $view;
});

/**
 * Database connection is created based in the parameters defined in the configuration file
 */
$di->setShared('db', function () {
    $config = $this->getConfig();

    $class = 'Phalcon\Db\Adapter\Pdo\\' . $config->database->adapter;
    $params = [
        'host'     => $config->database->host,
        'username' => $config->database->username,
        'password' => $config->database->password,
        'dbname'   => $config->database->dbname,
        'charset'  => $config->database->charset
    ];

    if ($config->database->adapter == 'Postgresql') {
        unset($params['charset']);
    }

    $connection = new $class($params);

    return $connection;
});


/**
 * If the configuration specify the use of metadata adapter use it or use memory otherwise
 */
$di->setShared('modelsMetadata', function () {
    return new MetaDataAdapter();
});

/**
 * Register the session flash service with the Twitter Bootstrap classes
 */
$di->set('flash', function () {
    return new Flash([
        'error'   => 'alert alert-danger',
        'success' => 'alert alert-success',
        'notice'  => 'alert alert-info',
        'warning' => 'alert alert-warning'
    ]);
});

/**
 * Start the session the first time some component request the session service
 */
$di->setShared('session', function () {
    $session = new SessionAdapter();
    $session->start();

    return $session;
});

/**
 * 注册logger，日志记录器
 */
$di->setShared('logger',function ($logger='root'){
    require_once ROOT_PATH.'/vendor/apache_log4php/Logger.php';
    Logger::configure(CONFIG_PATH.'/log4php.config.xml');
    return Logger::getLogger($logger);
});

/**
 * 注册短信发送器
 */
$di->setShared('smser',function(){
    
    //判断是选择哪个服务提供商
    /** @var \Phalcon\Di $this */
    /** @var \Phalcon\Http\Request $request */
    $request=$this->get('request');
    /** @var \Phalcon\Http\Response $response */
    $response=$this->get('response');
    $server=$request->getPost('Server','int',1);
    $config=$this->getConfig();//配置信息
    $signName=$request->getPost('SignName');
    switch ($server){
        case 1://阿里云短信
            /** @var \Phalcon\Config $aliyunConfig */
            $aliyunConfig=$config->sms->aliyun;
            /** @var \Phalcon\Config $value */
            foreach ($aliyunConfig as $key=> $value){
                if (in_array($signName,$value->signNames->toArray())){
                    $smser=new \BBSMS\ALiYunSMS($value->accessKeyId,
                        $value->accessKeySecret, $signName,$value->tempIds->toArray());
                    $smser->setLogger($this->getShared('logger'));
                    return $smser;
                }
            }
            $re=new \HJ100\BBSMS\SMSResult();
            $re->code=\HJ100\BBSMS\SMSError::NOTEXIST_SignName;
            $re->message='未支持的签名';
            $response->appendContent(json_encode($re));
            throw new \BBSMS\Exception\ContinueException();
            break;
        case 2:
            /** @var \Phalcon\Config $aliyunConfig */
            $qqconfig=$config->sms->qqsms;
            /** @var \Phalcon\Config $value */
            foreach ($qqconfig as $key=> $value){
                if (in_array($signName,$value->signNames->toArray())){
                    $smser=new \BBSMS\QQSMS($value->accessKeyId,
                        $value->accessKeySecret, $signName,$value->tempIds->toArray());
                    $smser->setLogger($this->getShared('logger'));
                    return $smser;
                }
            }
            $re=new \HJ100\BBSMS\SMSResult();
            $re->code=\HJ100\BBSMS\SMSError::NOTEXIST_SignName;
            $re->message='未支持的签名';
            $response->appendContent(json_encode($re));
            throw new \BBSMS\Exception\ContinueException();
            break;
        case 3:
            $re=new \HJ100\BBSMS\SMSResult();
            $re->code=\HJ100\BBSMS\SMSError::NOTEXIST_SignName;
            $re->message='尚未完成支持';
            $response->appendContent(json_encode($re));
            throw new \BBSMS\Exception\ContinueException();
            break;
        default:{
            $re=new \HJ100\BBSMS\SMSResult();
            $re->code=\HJ100\BBSMS\SMSError::NOTEXIST_SignName;
            $re->message='不支持的服务';
            $response->appendContent(json_encode($re));
            throw new \BBSMS\Exception\ContinueException();
            break;
        }
    }
});
