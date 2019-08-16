<?php
namespace app\index\controller;
use think\Controller;

class Index extends Controller
{
    public function index()
    {
    	$this->assign('name','sunhui');
       return $this->fetch('index');
    }


    public function news(){
        $app = model('Information');
        $list = $app->search();
        $this->assign('list',$list);
    	return $this->fetch('news');
    }
    public function notice(){
    	return $this->fetch('notice');
    }
}
