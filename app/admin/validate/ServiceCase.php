<?php
namespace app\admin\validate;
use think\Validate;

class ServiceCase extends Validate{
    protected $rule = [
        'type'=>'require',
        'title'=>'require',
        'summary'=>'require',
        'content'=>'require',
        'status'=>'require'
    ];
    protected $message = [
        'type'=>'请选择类型',
        'title'=>'标题必须',
        'summary'=>'简要描述必须',
        'content'=>'内容必须',
        'status'=>'状态必须'
    ];
}