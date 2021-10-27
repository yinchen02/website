<?php
namespace app\common\model;
class Industry extends BaseModel{

    public function getIndustryByName($name){
        return $this->where(['type'=>$name])->find();
    }


}