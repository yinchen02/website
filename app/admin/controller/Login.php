<?php
namespace app\admin\controller;
use app\admin\business\AdminUser;
use app\BaseController;
use app\common\lib\Show;
use think\App;
use think\facade\View;

class Login extends AdminBase {

    public function initialize()
    {
        //登录了则访问不了登录页
       if ($this->isLogin()){
            return $this->redirect(url('/admin/index'));
       }
    }
    public function index(){
        return View::fetch();
    }
    public function check(){
        if (!$this->request->isPost()){
            return Show::error("请求类型错误");
        }
        $username = $this->request->param("username","","trim");
        $password = $this->request->param("password","","trim");
        $data = [
            'username'=>$username,
            'password'=>$password,
        ];
        //tp6验证机制
        try {
            validate(\app\admin\validate\AdminUser::class)->check($data);
        }catch (\Exception $e){
            return Show::error($e->getMessage());
        }
        try {
            $result = (new AdminUser())->login($data);
        }catch (\Exception $e){
            return Show::error($e->getMessage());
        }
        if ($result){
            return Show::success("登录成功");
        }
        return Show::success("登录失败");
    }
}