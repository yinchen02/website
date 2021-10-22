<?php
namespace app\admin\controller;
use app\BaseController;
use app\common\lib\Show;

class Logout extends AdminBase {
    public function index(){
        session(config('admin.session_admin'),null);
        return redirect(url('/admin/login'));
    }
}