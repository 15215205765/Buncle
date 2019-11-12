<?php
namespace app\admin\controller;
use think\Controller;

class Mbtc extends Controller
{
	 public function index()
    {
    	 $app = model('Mbtc');
        $list = $app->search();
        $this->assign('list',$list);
        return $this->fetch('index');
       
       
    }
   public function tongguo(){
    $app = model('Mbtc');
    return $app->tongguo();
   }
   public function jujue(){
    $app = model('Mbtc');
    return $app->jujue();
   }
}