<?php
namespace app\admin\business;
use think\Exception;

class AdminUser {
    protected $model;
    public function __construct()
    {
        $this->model = new \app\common\model\AdminUser();
    }

    /**
     * 后台登录
     * @param $data
     * @return bool
     * @throws Exception
     */
    public function login($data){
        $adminUser = $this->getAdminUserByUsername($data['account']);
        if (empty($adminUser)){
            throw new Exception("不存在该用户");
        }
        if ($adminUser['pass'] != md5($data['pass'])){
            throw new Exception("密码错误");
        }

        $updateData = [
            'last_login_time'=>date("Y-m-d H:i:s",time()),
            'last_login_ip'=>request()->ip(),
        ];
       
        try {
            $res = $this->model->updateById($adminUser['id'],$updateData);
        }catch (\Exception $e){
            throw new Exception("内部异常,登录失败");
        }
        if (empty($res)){
            throw new Exception("登录失败");
        }
        //记录session
        session(config('admin.session_admin'),$adminUser);
        return true;
    }

    /**
     * 根据用户名获取后台用户数据
     * @param $username
     * @return array|false
     */
    public function getAdminUserByUsername($username){

        $adminUser = $this->model->getAdminUserByUsername($username);

        if (empty($adminUser) || $adminUser['status'] != config("status.mysql.table_normal")){
            return false;
        }

        $adminUser = $adminUser->toArray();
        return $adminUser;
    }
}