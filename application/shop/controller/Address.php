<?php
namespace app\shop\controller;
use think\Controller;
use think\Session;

class Address extends Controller
{
  
    public function index()
    {
       
        $ba = model('ShopAddress');
        $data = $ba->search();
        $gid = request()->get('gid');
        $this->assign('gid',$gid);
        $this->assign('data',$data);
       return $this->fetch('index');
    }
    public function add(){
        return $this->fetch('add');
    }
    public function addact(){
        $ba = model('ShopAddress');
        return $ba->add();
    }
}
