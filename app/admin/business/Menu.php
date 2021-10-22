<?php
namespace app\admin\business;
use \app\common\model\Menu as MenuModel;
class Menu {
    protected $model;
    public function __construct(){
        $this->model = new MenuModel();
    }
    /**
     * 根据权限列表来获取菜单栏
     * @param $authority
     * @return array
     */
    public function getTopMenusByAuthority($authority){
        $menus = [];
        try {
            //获取顶级菜单
            $topMenu = $this->model->getTopMenusByAuthority($authority);
            //获取所对应的子集菜单
            foreach ($topMenu as $key=>$value){
                $value['children'] = $this->model->getMenuChildrenByPid($value['id'],$authority);
                $menus[] = $value;
            }
        }catch (\Exception $e){
            return [];
        }
        return $menus;
    }
}