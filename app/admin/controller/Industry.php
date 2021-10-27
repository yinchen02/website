<?php
namespace app\admin\controller;
use app\BaseController;
use app\common\business\ServiceCase as ServiceCaseBis;
use app\common\lib\Show;
use think\facade\View;
use \app\common\business\Industry as IndustryBis;
class Industry extends BaseController{
    public function index(){
        $num = 10;
        $order = ['id'=>'desc'];
        $result = (new IndustryBis())->getNormalList($num,$order);
        return View::fetch('',['data'=>$result]);
    }
    public function add_page(){
        return View::fetch();
    }
    public function edit_page(){
        $id = $this->request->param("id",0,"intval");
        if (empty($id)){
            return Show::error("请选择一条数据");
        }
        $result = (new IndustryBis())->getNormalListById($id);
        return View::fetch('',['data'=>$result]);
    }
    public function add(){
        $type = $this->request->param("type","","trim");
        $status = $this->request->param("status",1,"intval");
        if (empty($type)){
            return Show::error("请输入行业名称");
        }
        $data = [
            'type'=>$type,
            'status'=>$status
        ];
        try {
            $result = (new IndustryBis())->addData($data);
        }catch (\Exception $e){
            return Show::error($e->getMessage());
        }
        if ($result){
            return Show::success("OK");
        }
        return Show::error("添加失败");
    }
    public function edit(){
        $id = $this->request->param("id",0,"intval");
        $type = $this->request->param("type","","trim");
        $status = $this->request->param("status",0,"trim");
        if (empty($id) || empty($type)){
            return Show::error("数值错误");
        }
        $data = [
            'id'=>$id,
            'type'=>$type,
            'status'=>$status
        ];
        $result = (new IndustryBis())->updateById($id,$data);
        if ($result){
            return Show::success();
        }
        return Show::error("修改失败");
    }
    public function status(){
        $id = $this->request->param("id",0,"intval");
        $status = $this->request->param("status",99,'intval');
        if (empty($id)){
            return Show::error("请选择一条数据");
        }
        $data = [
            'status'=>$status
        ];
        $result = (new IndustryBis())->updateById($id,$data);
        if ($result){
            return Show::success();
        }
        return Show::error();
    }
    public function delete_all(){
        $ids = $this->request->param("id","","trim");
        if (empty($ids) || !is_array($ids)){
            return Show::error("数值错误");
        }

        $result = (new IndustryBis())->updateAll($ids);
        if ($result){
            return Show::success("OK");
        }
        return Show::error("批量删除失败");
    }
}