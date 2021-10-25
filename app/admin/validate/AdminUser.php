<?php
namespace app\admin\validate;
use think\Validate;

class AdminUser extends Validate{
    protected $rule = [
        'account'=>'require',
        'pass'=>'require'
    ];
    protected $message = [
        'account'=>'用户名必须',
        'pass'=>'密码必须'
    ];

}