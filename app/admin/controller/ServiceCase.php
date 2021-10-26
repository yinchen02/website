<?php
namespace app\admin\controller;
use app\BaseController;
use app\common\lib\Show;
use think\facade\View;
use app\common\business\ServiceCase as ServiceCaseBis;
class ServiceCase extends BaseController{
    public function index(){
        $num = 2;
        $order = ['id'=>'desc'];
        $result = (new ServiceCaseBis())->getNormalList($num,$order);

        return View::fetch('',['result'=>$result]);
    }
    public function add_page(){
        return View::fetch();
    }
    public function edit_page(){
        $id = $this->request->param("id",0,"intval");
        if (empty($id)){
            return Show::error("请选择一条数据");
        }
        $result = (new ServiceCaseBis())->getNormalListById($id);
        return View::fetch('',['data'=>$result]);
    }
    public function add(){
        if (!$this->request->isPost()){
            return Show::error("请求类型错误");
        }
        $type = $this->request->param("type","case","trim");
        $title = $this->request->param("title","","trim");
        $summary = $this->request->param("summary","","trim");
        $content = $this->request->param("content","","trim");
        $status = $this->request->param("status","1","intval");
        $data = [
            'type'=>$type,
            'title'=>$title,
            'summary'=>$summary,
            'content'=>$content,
            'status'=>$status
        ];
        $validate = new \app\admin\validate\ServiceCase();
        if (!$validate->check($data)){
            return Show::error($validate->getError());
        }

        $result = (new ServiceCaseBis())->addData($data);
        if ($result){
            return Show::success("OK");
        }
        return Show::error("添加失败");
    }
    public function edit(){
        if (!$this->request->isPost()){
            return Show::error("请求类型错误");
        }
        $id = $this->request->param("id","","intval");
        $type = $this->request->param("type","case","trim");
        $title = $this->request->param("title","","trim");
        $summary = $this->request->param("summary","","trim");
        $content = $this->request->param("content","","trim");
        $status = $this->request->param("status","1","intval");
        if (empty($id)){
            return Show::error("请选择要修改的数据");
        }
        $data = [
            'type'=>$type,
            'title'=>$title,
            'summary'=>$summary,
            'content'=>$content,
            'status'=>$status
        ];
        $result = (new ServiceCaseBis())->updateById($id,$data);
        if ($result){
            return Show::success("OK");
        }
        return Show::error("修改失败");
    }
    public function status(){
        $id = $this->request->param("id","","intval");
        $status = $this->request->param("status","0","intval");
        if (empty($id)){
            return Show::error("请选择要修改的数据");
        }
        $data = [
            'status'=>$status
        ];

        $result = (new ServiceCaseBis())->updateById($id,$data);
        if ($result){
            return Show::success("OK");
        }
        return Show::error("ERROR");
    }
    public function delete_all(){
        $ids = $this->request->param("id","","trim");
        if (empty($ids) || !is_array($ids)){
            return Show::error("数值错误");
        }

        $result = (new ServiceCaseBis())->updateAll($ids);
        if ($result){
            return Show::success("OK");
        }
        return Show::error("批量删除失败");
    }
}