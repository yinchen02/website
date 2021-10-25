<?php
namespace app\admin\business;


class Roles {

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

    /**
     * 获取权限列表数据
     * @param $num
     * @param $order
     * @return array
     */
    public function getLists($num,$order){
        try {
            $list = $this->model->getLists($num,$order);
            $result = $list->toArray();
            $result['render'] = $list->render();
        }catch (\Exception $e){
            //返回分页默认返回的数据
            $result = \app\common\lib\Arr::getPaginateDefaultData($num);
        }
        return $result;
    }
    public function getMenuById($id){
        try {
            $result = $this->model->getListById($id);
        }catch (\Exception $e){
            return [];
        }
        return $result;
    }
    public function update($id,$data){
        $result = $this->model->updateById($id,$data);
        return $result;
    }
}