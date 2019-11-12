<?php
namespace app\shop\controller;
use think\Controller;
use think\Session;
use app\test\model\User;

class Goods extends Controller
{
  
    public function xuni()
    {
        
      
        $goods = model('ShopGoods');
       $data = $goods->find();
        $this->assign('data',$data);
       return $this->fetch('xuni');
    }

     public function shiwu()
    {
        
        
        $goods = model('ShopGoods');
        $data = $goods->find();
        $data['banner'] = unserialize($data['banner']);
        $add = model('ShopAddress');
        $address = $add->find();
        $this->assign('address',$address);
        $this->assign('data',$data);
       return $this->fetch('shiwu');
    }
}
