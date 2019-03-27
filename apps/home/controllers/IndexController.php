<?php

namespace BBSMS\Home\Controller;

use BBSMS\Home\Controller\BaseController;

class IndexController extends BaseController
{

    public function indexAction()
    {
        echo php_sapi_name();
        echo 'index';
    }

    public function showAction()
    {
        echo 'show';
    }

}

