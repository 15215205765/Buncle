<?php
namespace app\admin\controller;
use think\Controller;
use app\shop\model\ShopExchange;

class Shopduihuan extends Controller
{
	 public function index()
    {
    	 $app = new ShopExchange();
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
        $app = new ShopExchange();
        $data = $app->find();
        $this->assign('data',$data);
    	return $this->fetch('add');
    }
    public function addapp(){
        $app = new ShopExchange();
        return $app->add();
    }
   public function del(){
     $app = new ShopExchange();
    return $app->del();
   }
   public function tongguo(){
    $app = new ShopExchange();
    return $app->tongguo();
   }
   public function yingcang(){
    $app = new ShopExchange();
    return $app->yingcang();
   }
}