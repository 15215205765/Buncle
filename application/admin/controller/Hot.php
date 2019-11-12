<?php
namespace app\admin\controller;
use think\Controller;
use model\HotApp;

class Hot extends Controller
{
	public function index()
    {
    	 $app = model('HotApp');
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
        $app = model('HotApp');
        $data = $app->find();
        $this->assign('data',$data);
    	return $this->fetch('add');
    }
    public function addapp(){
        $app = model('HotApp');
        return $app->add();
    }
   public function del(){
    $app = model('HotApp');
    return $app->del();
   }
   public function tongguo(){
    $app = model('HotApp');
    return $app->tongguo();
   }
   public function yingcang(){
    $app = model('HotApp');
    return $app->yingcang();
   }
}