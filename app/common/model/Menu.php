<?php
namespace app\common\model;
use think\Model;

class Menu extends Model{
    /**
     * 根据权限列表获取顶级菜单
     * @param $authority
     * @return Menu[]|array|false|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function getTopMenusByAuthority($authority){
        if (empty($authority)){
            return false;
        }
        $where = ['status'=>config("status.mysql.table_normal"),'pid'=>0];
        $res = $this->where($where)->whereIn('id',$authority)->select();
        return $res;
    }

    /**
     * 根据父类id获取子集菜单
     * @param $pid
     * @param $authority
     * @return array|false
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function getMenuChildrenByPid($pid,$authority){
        if (empty($pid) || empty($authority)){
            return false;
        }
        $where = [
            'status'=>config("status.mysql.table_normal"),
            'pid'=>$pid
        ];
        $res = $this->where($where)->whereIn('id',$authority)->select();

        return $res->toArray();
    }
}