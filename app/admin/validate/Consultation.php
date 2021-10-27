<?php
namespace app\admin\validate;
use think\Validate;

class Consultation extends Validate{
    protected $rule = [
        'category_id'=>'require|number',
        'type'=>'require',
        'title'=>'require',
        'image'=>'require',
        'content'=>'require',
        'status'=>'require|number',
        'is_show'=>'require|number'
    ];
    protected $message = [
        'category_id.require'=>'栏目必须',
        'category_id.number'=>'数值错误',
        'type'=>'类型必须',
        'title'=>'标题必须',
        'image'=>'图片必须',
        'content'=>'内容必须',
        'status.require'=>'状态必须',
        'status.number'=>'数值错误',
        'is_show.require'=>'是否展示必须',
        'is_show.number'=>'数值错误'
    ];
}