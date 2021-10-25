<?php
namespace app\admin\controller;
use app\BaseController;
use think\facade\View;
use think\facade\Db;
class User extends BaseController{
    public function index()
    {
        $params= input("get.");
        $where = [];
        $arr = ['account','role','status'];
        foreach ($arr as $key => $value) {
            if (isset($params[$value]) && $params[$value] != "") {
                $where[$value] = $params[$value];
            }
        }
        $where['is_del'] = 0;
        $data = DB::name("admin_user")->where($where)->order("create_time desc");
        if(isset($params['create_time'])&&$params['create_time']!=''){
            $time = explode(' - ',$params['create_time']);
            $data = $data->where('create_time','between',$time);
        }
        $data = $data->paginate(['list_rows'=> 5,'query' => request()->param()])->each(function($item, $key){
            $item['role_name'] = Db::name("roles")->where(['id'=>$item['role']])->value('role_name');
            return $item;
        });
        $role = DB::name("roles")->where(['is_del'=>0,'status'=>1])->select();
        $count = $data->total();
        view::assign("params",input("get."));
        view::assign("role",$role);
        view::assign("count",$count);
        view::assign("data",$data);

        return view::fetch();
    }
    /**
     * 添加角色页面
     */
    public function add_page(){
        $role = DB::name("roles")->where(['is_del'=>0,'status'=>1])->select();
        view::assign("role",$role);

        return view::fetch();
    }
    /**
     * 编辑角色界面
     */
    public function edit_page(){
        $role = DB::name("roles")->where(['is_del'=>0,'status'=>1])->select();
        $id = input("param.id");
        $data = DB::name("admin_user")->where(['id'=>$id])->find();
        view::assign("role",$role);
        view::assign("data",$data);

        return view::fetch();
    }
    /**
     * 添加方法
     */
    public function add(){
        $data = input("post.data");
        $result1 = Db::name("admin_user")->where(['account'=>$data['account'],'is_del'=>0])->find();
        if($result1 != null){
            return json(['code'=>'-1','msg'=>'该账号已存在']);
        }
        $result2 = Db::name("admin_user")->where(['phone'=>$data['phone'],'is_del'=>0])->find();
        if($result2 != null){
            return json(['code'=>'-1','msg'=>'该手机号已绑定其他账号']);
        }
        unset($data['file']);
        unset($data['re_pass']);
        $data['pass'] = md5($data['pass']);
        $data['create_time'] = date("Y-m-d H:i:s",time());
        //写入数据
        Db::name("admin_user")->insert($data);

        return json(['code'=>'0','msg'=>'添加账号成功']);
    }
    /**
     * 编辑方法
     */
    public function edit(){
        $data = input("post.data");
        $id = $data['id'];
        unset($data['id']);
        unset($data['re_pass']);
        unset($data['file']);
        if($data['pass'] == ""){
            unset($data['pass']);
        }else{
            $data['pass'] = md5($data['pass']);
        }
        //修改数据
        Db::name("admin_user")->where(['id'=>$id])->update($data);
        return json(['code'=>'0','msg'=>'修改成功']);
    }
    /**
     * 删除方法
     */
    public function delete(){
        $id = input("post.id");
        $result = Db::name("admin_user")->where(['id'=>$id,'is_del'=>0])->update(['is_del'=>1]);
        if($result){
            return json(['code'=>'0','msg'=>'删除成功']);
        }else{
            return json(['code'=>'0','msg'=>'要删除的内容不存在或已删除']);
        }
    }

    public function delete_all(){
        $id = input("post.id");
        foreach ($id as $key => $value) {
            $result = Db::name("admin_user")->where(['id'=>$value,'is_del'=>0])->update(['is_del'=>1]);
        }
        return json(['code'=>'0','msg'=>'删除成功']);

    }
    public function status(){
        $id = input("post.id");
        $status = input("post.status");
        $result = Db::name("admin_user")->where(['id'=>$id,'is_del'=>0])->update(['status'=>$status]);
        return json(['code'=>'0','msg'=>'修改状态成功']);
    }
}