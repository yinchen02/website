<?php
namespace app\admin\controller;
use app\BaseController;
use think\facade\View;

class User extends BaseController{
    public function index(){

        return View::fetch();
    }
}