<?php
namespace app\common\model;
use think\Model;

class AdminUser extends Model{
    /**
     * 查询用户是否存在
     * @param $username
     * @return AdminUser|array|false|Model|null
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function getAdminUserByUsername($username){
        if (empty($username)){
            return false;
        }
        $where = ['account'=>$username];
        return $this->where($where)->find();
    }

    /**
     * 根据id来更新数据
     * @param $id
     * @param $data
     * @return bool
     */
    public function updateById($id,$data){
        if (empty($id) || empty($data) || !is_array($data)){
            return false;
        }
        $where = ['id'=>$id];
        return $this->where($where)->save($data);
    }
}