<?php
namespace app\admin\controller;
use think\Controller;
use model\BuncleGonggao;

class Gonggao extends Controller
{
    public function index()
    {
    	 $app = model('BuncleGonggao');
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
        $app = model('BuncleGonggao');
        $data = $app->find();
        $this->assign('data',$data);
    	return $this->fetch('add');
    }
    public function addapp(){
        $app = model('BuncleGonggao');
        return $app->add();
    }
   public function del(){
    $app = model('BuncleGonggao');
    return $app->del();
   }
   public function tongguo(){
    $app = model('BuncleGonggao');
    return $app->tongguo();
   }
   public function yingcang(){
    $app = model('BuncleGonggao');
    return $app->yingcang();
   }
}
