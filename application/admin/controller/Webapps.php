<?php
namespace app\admin\controller;
use think\Controller;
use model\WebApp;

class Webapps extends Controller
{
	public function index()
    {
    	 $app = model('WebApp');
        $list = $app->search();
        $this->assign('list',$list);
        $keyword = request()->get('keyword');
        $is_show = request()->get('is_show');
        $agent = request()->get('agent');
        $this->assign('keyword',$keyword);
        $this->assign('is_show',$is_show);
        $this->assign('agent',$agent);
        return $this->fetch('index');
       
       
    }


    public function add(){
        $app = model('WebApp');
        $data = $app->find();
        $this->assign('data',$data);
    	return $this->fetch('add');
    }
    public function addapp(){
        $app = model('WebApp');
        return $app->add();
    }
   public function del(){
    $app = model('WebApp');
    return $app->del();
   }
   public function tongguo(){
    $app = model('WebApp');
    return $app->tongguo();
   }
   public function yingcang(){
    $app = model('WebApp');
    return $app->yingcang();
   }
}