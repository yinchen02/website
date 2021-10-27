<?php
namespace app\common\business;
use app\common\lib\Arr;
use \app\common\model\Consultation as ConsultationModel;
class Consultation {
    protected $model = null;
    public function __construct(){
        $this->model = new ConsultationModel();
    }
    public function getNormalList($num=10,$order=['id'=>'desc']){
        try {
            $result = $this->model->getNormalList($num,$order);
            $list = $result->toArray();
            $list['render'] = $result->render();
        }catch (\Exception $e){
            $list = Arr::getPaginateDefaultData($num);
        }
        return $list;
    }
    public function getNormalListById($id){
        $result = $this->model->getListById($id);
        if (!$result){
            return [];
        }
        return $result->toArray();

    }
    public function addData($data){
        $result = $this->model->add($data);
        return $result;
    }
    public function updateById($id,$data){
        $result = $this->model->updateById($id,$data);
        return $result;
    }

    public function updateAll($ids){
        $data = ['status'=>99];
        foreach ($ids as $key=>$value){
            $result = $this->model->updateById($value,$data);
        }
        return $result;
    }
}