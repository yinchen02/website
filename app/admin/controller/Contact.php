<?php
namespace app\admin\controller;
use app\BaseController;
use app\common\lib\Show;
use think\facade\View;

class Contact extends BaseController{
    public function index(){
        $result = config("contact");

        return View::fetch('',['data'=>$result]);
    }
    public function add(){
        $companyName = $this->request->param("company_name","","trim");
        $address = $this->request->param("address","","trim");
        $telephone = $this->request->param("telephone","","trim");
        $email = $this->request->param("email","","trim");
        $image = $this->request->param("image","","trim");

        $data = [
            'company_name'=>$companyName,
            'address'=>$address,
            'telephone'=>$telephone,
            'email'=>$email,
            'image'=>$image
        ];

        $path = app_path('config').'contact.php';
        $fso = fopen($path,'wb');
        $res = fwrite($fso,"<?php\nreturn ".var_export($data,true).";\n".'?>');
        fclose($fso);
        if ($res){
            return Show::success();
        }
        return Show::error("修改失败");
    }
}