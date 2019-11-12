<?php
namespace app\admin\controller;
use think\Controller;
use model\WebApp;

class Webset extends Controller
{
	public function index()
    {
    	 $app = model('WebSet');
        $list = $app->find();
        $this->assign('data',$list);
        return $this->fetch('index');
       
       
    }


    public function add(){
        $app = model('WebSet');
        $data = $app->find();
        $this->assign('data',$data);
    	return $this->fetch('add');
    }
    public function addapp(){
        $app = model('WebSet');
        return $app->add();
    }
   
}