<?php
namespace app\admin\controller;
use app\BaseController;
use app\common\lib\Show;
use think\facade\Db;
use think\facade\View;

class Team extends BaseController{
    public function index(){
        $result = Db::name('team')->where('status','<>','99')->select()->toArray();

        foreach ($result as $key=>$value){
            $position = Db::name("position")->where('id',$value['position_id'])->value('type');
            $result[$key]['position'] = $position;
        }


        return View::fetch('',['result'=>$result,'position'=>$position]);
    }
    public function add_page(){
        $position = Db::name('position')->where('status','<>','99')->select();

        return View::fetch('',['position'=>$position]);
    }
    public function edit_page(){
        $id = $this->request->param("id",0,"intval");
        if (empty($id)){
            return Show::error("缺少参数");
        }
        $result = Db::name('team')->where('id',$id)->find();
        $position = Db::name("position")->where('status','=',1)->select();
        return View::fetch('',['data'=>$result,'position'=>$position]);
    }
    public function add(){
        $data = input("post.data");
        $data['eduction'] = $this->request->param("eduction","","trim");
        $data['project'] = $this->request->param("project","","trim");
        if (empty($data['position_id'])){
            return Show::error("请选择职位");
        }
        $data['create_time'] = time();
        $data['update_time'] = time();
        $result = Db::name("team")->strict(false)->save($data);
        if ($result){
            return Show::success();
        }
        return Show::error("添加失败");
    }
    public function edit(){
        $data = input("post.data");
        $data['eduction'] = $this->request->param("eduction","","trim");
        $data['project'] = $this->request->param("project","","trim");
        if (empty($data['position_id'])){
            return Show::error("请选择职位");
        }
        $data['create_time'] = time();
        $data['update_time'] = time();
        $result = Db::name("team")->strict(false)->where('id',$data['id'])->update($data);
        if ($result){
            return Show::success();
        }
        return Show::error("添加失败");
    }
    public function status(){
        $id = $this->request->param("id",0,"intval");
        $status = $this->request->param("status","","trim");
        if (empty($id)){
            return Show::error("参数错误");
        }
        $result = Db::name('team')->where('id', $id)->update(['status' => $status,'update_time'=>time()]);
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
            $result = Db::name('team')->where('id', $value)->update(['status' => 99,'update_time'=>time()]);
        }
        if ($result){
            return Show::success();
        }
        return Show::error("修改失败");
    }
}