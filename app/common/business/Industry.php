<?php
namespace app\common\business;
use app\common\lib\Arr;
use \app\common\model\Industry as IndustryModel;
use think\Exception;

class Industry {
    protected $model = null;
    public function __construct(){
        $this->model = new IndustryModel();
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
    public function addData($data){
        $industry = $this->model->getIndustryByName($data['type']);
        if ($industry){
            throw new Exception("行业已存在");
        }
        $result = $this->model->add($data);
        return $result;
    }
    public function getNormalListById($id){
        $result = $this->model->getListById($id);
        return $result;
    }
    public function updateById($id,$data){
        $data['update_time'] = time();
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
    public function getLists(){
        $result = $this->model->getList();
        if (empty($result)){
            return [];
        }
        return $result->toArray();
    }
}