<?php
namespace app\common\model;
use think\Model;

class BaseModel extends Model{
    /**
     * 添加一条数据
     * @param $data
     * @return bool
     */
    public function add($data){
        if (empty($data) || !is_array($data)){
            return false;
        }
        return  $this->save($data);
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
        return $this->where(['id'=>$id])->save($data);
    }

    /**
     * 软删除
     * @param $id
     * @return bool
     */
    public function status($id){
        if (empty($id)){
            return false;
        }
        $data = ['status'=>config('status.mysql.table_delete')];
        return $this->where(['id'=>$id])->save($data);
    }

    /**
     * 获取单条数据
     * @param $id
     * @return BaseModel|array|false|Model|null
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function getListById($id){
        if (empty($id)){
            return false;
        }
        return $this->where(['id'=>$id])->find();
    }

    /**
     * 获取所有分页数据
     * @param int $num
     * @param string[] $order
     * @return \think\Paginator
     * @throws \think\db\exception\DbException
     */
    public function getLists($num=10,$order=['id'=>'desc']){
        return $this->order($order)->where(['is_del'=>0])->paginate($num);
    }
}