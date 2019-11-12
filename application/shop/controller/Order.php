<?php
namespace app\shop\controller;
use think\Controller;
use think\Session;
use app\test\model\User;

class Order extends Controller
{
  public function create(){
    $uid = Session::get('uid');
    $or = model('ShopOrder');
    $res = $or->add();
    if($res['code']==2){
        $order = $or->get($res['id']);
        $go =  model('ShopGoods');
        $goods = $go->get($order['gid']);
        $us = new User();
        $user = $us->get($uid);
         $params = [
            'body' =>$goods['title'],
            'out_trade_no' => $order['ordersn'],
            'total_fee' => $order['money']*100,
        ];
        $result = \wxpay\JsapiPay::getPayParams($params,$user['openid']);
         echo $result;
    }else{
        return json($res);
    }
  }
    public function create1(){
    $uid = Session::get('uid');
    $or = model('ShopVirtualOrder');
    $res = $or->add();
    if($res['code']==2){
        $order = $or->get($res['id']);
        $go =  model('ShopGoods');
        $goods = $go->get($order['gid']);
        $us = new User();
        $user = $us->get($uid);
         $params = [
            'body' =>$goods['title'],
            'out_trade_no' => $order['ordersn'],
            'total_fee' => $order['money']*100,
        ];
        $result = \wxpay\JsapiPay::getPayParams($params,$user['openid']);
         echo $result;
    }else{
        return json($res);
    }
  }

  public function all(){
        $shiwu = model('ShopOrder');
        $shiwuorder = $shiwu->search();
        $this->assign('shiwuorder',$shiwuorder);
        return $this->fetch('all');
  }
   public function daifahuo(){
        $shiwu = model('ShopOrder');
        $list = $shiwu->search1();
        $this->assign('list',$list);
        return $this->fetch('daifahuo');
  }
   public function xuni(){
        $shiwu = model('ShopVirtualOrder');
        $list = $shiwu->search();
        $this->assign('list',$list);
        return $this->fetch('xuni');
  }

  public function notify(){
    error_reporting(0);
    $input = file_get_contents('php://input');
    libxml_disable_entity_loader(true);
    $obj = simplexml_load_string($input, 'SimpleXMLElement', LIBXML_NOCDATA);
    $data = json_decode(json_encode($obj), true);
    if (empty($data)) 
    {
        exit('fail');
    }
    $str='';
    foreach ($data as $key => $value) {
        $str.= $key.'==>'.$value;
    }
    file_put_contents('test.php',$str);
    if($data['return_code']=='SUCCESS' && $data['result_code']=='SUCCESS'){
        $out_trade_no = $data['out_trade_no'];
 
        if(strpos($out_trade_no,'S')!==false){
            $order = model('ShopOrder');
            $res = $order->payresult($out_trade_no,$data['transaction_id']);
        }
        if(strpos($out_trade_no,'X')!==false){
            $order = model('ShopVirtualOrder');
            $res = $order->payresult($out_trade_no,$data['transaction_id']);
        }
        echo 'SUCCESSS';
        exit;

    }
    
   
  }
}
