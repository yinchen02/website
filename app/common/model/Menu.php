<?php
namespace app\common\model;

class Menu extends BaseModel {
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
        $where = ['status'=>config("status.mysql.table_normal"),'pid'=>0,'is_del'=>0];
        $res = $this->where($where)->whereIn('id',$authority)->select();
        return $res->toArray();
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
            'pid'=>$pid,
            'is_del'=>'0'
        ];
        $res = $this->where($where)->whereIn('id',$authority)->select();

        return $res->toArray();
    }

    /**
     * 获取顶级菜单
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function getTopMenus(){
        $where = ['pid'=>0,'status'=>config("status.mysql.table_normal"),'is_del'=>0];
        $result = $this->where($where)->select();
        return $result->toArray();
    }
    public function getChildrenMenus($id){
        if (empty($id)){
            return false;
        }
        $result = $this->where(['pid'=>$id])->select();
        return $result->toArray();
    }
}