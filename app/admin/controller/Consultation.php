<?php
namespace app\admin\controller;
use app\BaseController;
use app\common\business\ServiceCase as ServiceCaseBis;
use app\common\lib\Show;
use think\facade\View;
use \app\common\business\Consultation as ConsultationBis;
class Consultation extends BaseController{
    public function index(){
        $num = 10;
        $order = ['id'=>'desc'];
        $result  = (new ConsultationBis())->getNormalList($num,$order);
        return View::fetch('',['result'=>$result]);
    }
    public function add_page(){
        $industryBis = new \app\common\business\Industry();
        $industry = $industryBis->getLists();
        return View::fetch('',['industry'=>$industry]);
    }
    public function edit_page(){
        $id = $this->request->param("id",0,"intval");
        if (empty($id)){
            return Show::error("请选择一条数据");
        }
        $industryBis = new \app\common\business\Industry();
        $industry = $industryBis->getLists();
        $result = (new ConsultationBis())->getNormalListById($id);
        return View::fetch('',['data'=>$result,'industry'=>$industry]);
    }

    public function add(){
        $category_id = $this->request->param("cate",0,"intval");
        $type = $this->request->param("type","","trim");
        $title = $this->request->param("title","","trim");
        $image = $this->request->param("image","","trim");
        $content = $this->request->param("content","","trim");
        $status = $this->request->param("status",0,"intval");
        $isShow = $this->request->param("is_show",0,"intval");
        if (empty($category_id)){
            return Show::error("请选择所属栏目");
        }
        $data = [
            'category_id'=>$category_id,
            'type'=>$type,
            'title'=>$title,
            'image'=>$image,
            'content'=>$content,
            'status'=>$status,
            'is_show'=>$isShow
        ];
        $validate = new \app\admin\validate\Consultation();
        if (!$validate->check($data)){
            return Show::error($validate->getError());
        }

        $result = (new ConsultationBis())->addData($data);
        if ($result){
            return Show::success();
        }
        return Show::error("添加失败");

    }
    public function edit(){
        $id = $this->request->param("id","","intval");
        $category_id = $this->request->param("cate",0,"intval");
        $type = $this->request->param("type","","trim");
        $title = $this->request->param("title","","trim");
        $image = $this->request->param("image","","trim");
        $content = $this->request->param("content","","trim");
        $status = $this->request->param("status",0,"intval");
        $isShow = $this->request->param("is_show",0,"intval");
        if (empty($category_id)){
            return Show::error("请选择所属栏目");
        }
        $data = [
            'category_id'=>$category_id,
            'type'=>$type,
            'title'=>$title,
            'image'=>$image,
            'content'=>$content,
            'status'=>$status,
            'is_show'=>$isShow
        ];
        $validate = new \app\admin\validate\Consultation();
        if (!$validate->check($data)){
            return Show::error($validate->getError());
        }

        $result = (new ConsultationBis())->updateById($id,$data);

        if ($result){
            return Show::success();
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
        $result = (new ConsultationBis())->updateById($id,$data);
        if ($result){
            return Show::success("OK");
        }
        return Show::error("ERROR");
    }
    public function isShow(){
        $id = $this->request->param("id","","intval");
        $status = $this->request->param("status","0","intval");
        if (empty($id)){
            return Show::error("请选择要修改的数据");
        }
        $data = [
            'is_show'=>$status
        ];
        $result = (new ConsultationBis())->updateById($id,$data);
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
        $result = (new ConsultationBis())->updateAll($ids);
        if ($result){
            return Show::success("OK");
        }
        return Show::error("批量删除失败");
    }
}