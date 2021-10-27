<?php
namespace app\admin\controller;
use app\BaseController;
use app\common\lib\Show;
use think\facade\Db;
use think\facade\View;

class Recruit extends BaseController{
    public function index(){
        $result = Db::name('recruit')->where('status','<>',99)->select();
        return View::fetch('',['result'=>$result]);
    }
    public function add_page(){
        return View::fetch();
    }
    public function edit_page(){
        $id = $this->request->param("id","","intval");
        if (empty($id)){
            return Show::error("缺少参数");
        }
        $result = Db::name("recruit")->where('id',$id)->find();
        return View::fetch('',['data'=>$result]);
    }
    public function edit(){
        $data = input("post.data");
        if (empty($data['position'])){
            return Show::error("请输入职位");
        }
        $data['requires'] = $this->request->param("requires","","trim");
        $data['cases'] = $this->request->param("cases","","trim");
        $data['create_time'] = time();
        $data['update_time'] = time();
        $result = Db::name("recruit")->where('id',$data['id'])->strict(false)->update($data);
        if ($result){
            return Show::success();
        }
        return Show::error("修改失败");
    }
    public function add(){
        $data = input("post.data");
        if (empty($data['position'])){
            return Show::error("请输入职位");
        }
        $data['requires'] = $this->request->param("requires","","trim");
        $data['cases'] = $this->request->param("cases","","trim");
        $data['create_time'] = time();
        $data['update_time'] = time();
        $result = Db::name("recruit")->strict(false)->save($data);
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
        $result = Db::name('recruit')->where('id', $id)->update(['status' => $status,'update_time'=>time()]);
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
            $result = Db::name('recruit')->where('id', $value)->update(['status' => 99,'update_time'=>time()]);
        }
        if ($result){
            return Show::success();
        }
        return Show::error("修改失败");
    }

}