<?php
namespace app\common\business;
use \app\common\model\ServiceCase as ServiceCaseModel;
class ServiceCase {
    protected $model = null;
    public function __construct(){
        $this->model = new ServiceCaseModel();
    }
    public function addData(){

    }
}