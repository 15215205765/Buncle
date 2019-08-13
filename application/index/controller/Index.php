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
    	return $this->fetch('news');
    }
    public function notice(){
    	return $this->fetch('notice');
    }
}
