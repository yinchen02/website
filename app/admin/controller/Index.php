<?php
namespace app\admin\controller;
use app\admin\business\Menu;
use app\admin\business\Roles;
use app\BaseController;
use think\App;
use think\facade\View;
use think\facade\Db;
class Index extends AdminBase {
    public function index(){
        $adminUser = session(config('admin.session_admin'));

        $role = $adminUser['role'];
        //获取权限列表
        $admin_auth = (new Roles())->getAuthorityByRoleId($role);
        $admin_auth = json_decode($admin_auth,true);
        //获取菜单
        $topMenu = (new Menu())->getTopMenusByAuthority($admin_auth);
        view::assign("username",$adminUser['account']);
        view::assign("menu",$topMenu);
        return View::fetch();
    }
}