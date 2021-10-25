<?php
namespace app\admin\controller;
use app\admin\business\Menu;
use app\admin\business\Roles;
use app\common\lib\Show;
use think\facade\Db;
use think\facade\View;

class Auth extends AdminBase{
    public function index(){
        $num = 10;
        $order = ['id'=>'desc'];
        $result = (new Roles())->getLists($num,$order);
        $count = count($result['data']);
        view::assign("count",$count);
        View::assign("data",$result);
        return View::fetch();
    }
    public function add_page(){
        $menus = (new Menu())->getNormalMenus();
        View::assign("menu",$menus);
        return View::fetch();
    }
    public function edit_page(){
        $id = $this->request->param("id","","intval");
        $result = (new Roles())->getMenuById($id);
        $auth = json_decode($result->authority,true);

        $menus = (new Menu())->getNormalMenus($auth);
        foreach($menus as $key=>&$value){
            if (in_array($value['id'],$auth)){
                $value['checked'] = 1;
            }else{
                $value['checked'] = 0;
            }
            foreach ($value['children'] as $k=>&$v){
                if (in_array($value['id'],$auth)){
                    $v['checked'] = 1;
                }else{
                    $v['checked'] = 0;
                }
            }
        }
        return View::fetch('',['data'=>$result,'menu'=>$menus]);
    }
    public function status(){
        $id = $this->request->param("id","","trim");
        $status = $this->request->param("status",0,"intval");
        if (empty($id)){
            return Show::error("请选择一条数据");
        }
        $data = [
            'status'=>$status
        ];
        $result = (new Roles())->update($id,$data);
        if ($result){
            return Show::success("OK");
        }
        return Show::error("修改失败");
    }

    public function delete(){
        $id = $this->request->param("id","","intval");
        $data = [
            'is_del'=>1
        ];
        $result = (new Roles())->update($id,$data);

        if ($result){
            return Show::success();
        }
        return Show::error("删除失败");
    }

    //复制粘贴
    public function delete_all(){
        $id = input("post.id");
        foreach ($id as $key => $value) {
            $result = Db::name("roles")->where(['id'=>$value,'is_del'=>0])->update(['is_del'=>1]);
        }
        return Show::success();
    }
    public function add(){
        $data = input("post.data");
        if(!isset($data['role_name']) || !isset($data['note'])){
            return json(['code'=>'-1','msg'=>'添加角色失败,请检查参数']);
        }
        //切割权限字符串成数组
        if($data['auth'] != ""){
            $authArray = explode(",",$data['auth']);
            array_pop($authArray);//去掉数组最后一位的空字符
        }else{
            $authArray = [];
        }
        $newData = [
            'role_name'=>$data['role_name'],
            'note' => $data['note'],
            'authority' => json_encode($authArray),
            'create_time'=> date("Y-m-d H:i:s",time()),
        ];
        //写入数据
        Db::name("roles")->insert($newData);

        return json(['code'=>'0','msg'=>'添加角色成功']);
    }
    /**
     * 编辑方法
     */
    public function edit(){
        $data = input("post.data");
        //切割权限字符串成数组
        if($data['auth'] != ""){
            $authArray = explode(",",$data['auth']);
            array_pop($authArray);//去掉数组最后一位的空字符
        }else{
            $authArray = [];
        }
        $newData = [
            'role_name'=>$data['role_name'],
            'note' => $data['note'],
            'authority' => json_encode($authArray),
        ];
        //修改数据
        Db::name("roles")->where(['id'=>$data['id']])->update($newData);

        return json(['code'=>'0','msg'=>'修改成功']);


    }
}