<?php
namespace app\admin\controller;
use app\BaseController;
use app\common\lib\Show;
use think\facade\Db;
use think\facade\View;

class Position extends BaseController{
    public function index(){
        $result = Db::name("position")->where('status','<>',99)->select()->toArray();

        return View::fetch('',['data'=>$result]);
    }
    public function add_page(){
        return View::fetch();
    }
    public function edit_page(){
        $id = $this->request->param("id",0,"intval");
        if (empty($id)){
            return Show::error("参数错误");
        }
        $result = Db::name("position")->find($id);
        return View::fetch('',['data'=>$result]);
    }
    public function add(){
        $type = $this->request->param("type","","trim");
        $status = $this->request->param("status",0,"intval");
        if (empty($type)){
            return Show::error("请输入职位名称");
        }
        $result = Db::name("position")->where(['type'=>$type])->find();
        if ($result){
            return Show::error("此职业已存在");
        }
        $data = [
            'status'=>$status,
            'type'=>$type,
            'create_time'=>time(),
            'update_time'=>time()
        ];
        $result = Db::name("position")->save($data);
        if ($result){
            return Show::success();
        }
        return Show::error("添加失败");
    }
    public function edit(){
        $id = $this->request->param("id",0,"intval");
        $type = $this->request->param("type","","trim");
        $status = $this->request->param("status",0,"intval");
        if (empty($id)){
            return Show::error("请选择要修改的数据");
        }
        if (empty($type)){
            return Show::error("请输入职位名称");
        }

        $data = [

            'status'=>$status,
            'type'=>$type,
            'update_time'=>time()
        ];
        $result = Db::name("position")->where(['id'=>$id])->update($data);
        if ($result){
            return Show::success();
        }
        return Show::error("更新失败");
    }
    public function status(){
        $id = $this->request->param("id",0,"intval");
        $status = $this->request->param("status","","trim");
        if (empty($id)){
            return Show::error("参数错误");
        }
        $result = Db::name('position')->where('id', $id)->update(['status' => $status,'update_time'=>time()]);
        if ($result){
            return Show::success();
        }
        return Show::error("修改失败");
    }
    public function delete_all(){
        $id = $this->request->param("id","","trim");
        if (empty($id) || !is_array($id)){
            return Show::error("参数错误");
        }
        foreach ($id as $key=>$value){
            $result = Db::name('position')->where('id', $value)->update(['status' => 99,'update_time'=>time()]);
        }
        if ($result){
            return Show::success();
        }
        return Show::error("修改失败");
    }

}