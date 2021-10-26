<?php
namespace app\common\model;
class ServiceCase extends BaseModel{
    public function getTypeAttr($value){
        $type = ['case'=>'客户案例','service'=>'服务项目'];
        return $type[$value];
    }

}