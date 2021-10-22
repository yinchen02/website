<?php
namespace app\admin\business;
use app\common\business\BusBase;

class Roles extends BusBase {

    protected $model;
    public function __construct()
    {
        $this->model = new \app\common\model\Roles();
    }

    /**
     * 根据角色id来获取权限列表
     * @param $roleId
     * @return array|false|mixed
     */
    public function getAuthorityByRoleId($roleId){
        try {
            $result = $this->model->getAuthorityByRoleId($roleId);
        }catch (\Exception $e){
            return [];
        }
        return $result;
    }
}