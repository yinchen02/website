<?php
namespace app\admin\controller;
use think\facade\View;

class Auth extends AdminBase{
    public function index(){
        return View::fetch();
    }
}