<?php
namespace app\admin\controller;
use app\admin\business\Roles;
use think\facade\View;

class Auth extends AdminBase{
    public function index(){
        $bis = (new Roles())->getAllNormalData();

        return View::fetch();
    }
}