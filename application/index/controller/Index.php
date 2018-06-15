<?php
namespace app\index\controller;
use app\index\controller\Base;
class Index extends Base
{
    public function index()
    {
        $this -> isLogin();
        $this->view -> assign('title' , '杭州霸悦投资管理');
        return $this->fetch();
    }
}
