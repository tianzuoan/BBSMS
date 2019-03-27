<?php
/**
 * Created by PhpStorm.
 * User: tianzuoan
 * Date: 2017/8/30
 * Time: 15:39
 */

namespace BBSMS\Home\Controller;


class ErrorController extends BaseController
{
    public function indexAction(){

    }

    public function http404Action(){
        echo '<div align="center"><h1>404</h1></div>';
    }
}