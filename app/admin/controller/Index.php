<?php
namespace app\admin\controller;
use app\BaseController;
use think\facade\View;
use think\facade\Db;
class Index extends BaseController{
    public function index(){
        
        $topMenu = DB::name("menu")->where(['pid'=>0,'status'=>1,'is_del'=>0])->select()->toArray();//获取一级栏目
        return View::fetch();
    }
}