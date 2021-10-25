<?php
namespace app\admin\controller;
use app\BaseController;
use think\facade\View;

class ServiceCase extends BaseController{
    public function index(){

        return View::fetch('',['data'=>[]]);
    }
}