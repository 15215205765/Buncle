<?php
namespace app\index\controller;
use think\Controller;

class App extends Controller
{
    public function index()
    {
    	 $app = model('AppList');
        $list = $app->search();
        $this->assign('list',$list);
       return $this->fetch('index');
    }


    public function news(){
    	return $this->fetch('news');
    }
    public function notice(){
    	return $this->fetch('notice');
    }
}
