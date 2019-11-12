<?php
namespace app\shop\controller;
use think\Controller;
use think\Session;
use app\test\model\User;

class Exchange extends Controller
{
  
   public function detail(){
    $ex = model('ShopExchange');
    $exchange = $ex->find();
    $this->assign('exchange',$exchange);
    $app = new User();
    $uid = Session::get('uid');
    $user = $app->get($uid);
    if(!$user){
        $res = $app->login();
    }
    $uid = Session::get('uid');
    $user = $app->get($uid);
    $this->assign('user',$user);
    return $this->fetch('detail');
   }
}
