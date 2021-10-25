<?php
namespace app\common\model;


class Roles extends BaseModel {
    /**
     * 根据角色id来获取权限列表
     * @param $roleId
     * @return false|mixed
     */
    public function getAuthorityByRoleId($roleId){
        $roleId = intval($roleId);
        if (empty($roleId)){
            return false;
        }
        $where = [
            'id'=>$roleId,
            'status'=>config("status.mysql.table_normal"),
            'is_del'=>0
        ];
        $res = $this->where($where)->value('authority');
        return $res;
    }
}