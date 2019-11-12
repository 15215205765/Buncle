<?php
namespace app\test\controller;
use think\Controller;
use think\Session;

class Gonggao extends Controller
{
	 public function _initialize()
    {
        $app = model('User');
        $signPackage = $app->share();
        $this->assign('signPackage',$signPackage);
    }
	public function index(){
		$app =  model('BuncleGonggao');
        $list = $app->search();
        $this->assign('list',$list);
       return $this->fetch('index');
	}
	public function detail(){
		$app =  model('BuncleGonggao');
        $list = $app->detail();
        $this->assign('data',$list);
       return $this->fetch('detail');
	}
}