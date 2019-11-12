<?php
namespace app\shop\controller;
use think\Controller;
use think\Session;
use app\test\model\User;

class Index extends Controller
{
  
    public function index()
    {
        $app = new User();
        $uid = Session::get('uid');
        $user = $app->get($uid);
        if(!$user){
            $res = $app->login();
        }
        $uid = Session::get('uid');
        $ba = model('ShopBanner');
        $banner = $ba->search();
        $this->assign('banner',$banner);
        $goods = model('ShopGoods');
        $xuni = $goods->search(0);
        $shiwu = $goods->search(1);
        $this->assign('xuni',$xuni);
        $this->assign('shiwu',$shiwu);
        $duihuan = model('ShopExchange');
        $exchange = $duihuan->find();
        
        $this->assign('exchange',$exchange);
       return $this->fetch('index');
    }
}
