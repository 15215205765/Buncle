<?php
namespace app\admin\controller;
use think\Controller;
use app\shop\model\ShopGoods;

class ShopGoodss extends Controller
{
	 public function index()
    {
    	 $app = new ShopGoods();
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
        $app = new ShopGoods();
        $data = $app->find();
        $this->assign('data',$data);
    	return $this->fetch('add');
    }
    public function addapp(){
        $app = new ShopGoods();
        return $app->add();
    }
   public function del(){
     $app = new ShopGoods();
    return $app->del();
   }
   public function tongguo(){
    $app = new ShopGoods();
    return $app->tongguo();
   }
   public function yingcang(){
    $app = new ShopGoods();
    return $app->yingcang();
   }
}