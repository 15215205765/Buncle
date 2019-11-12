<?php
namespace app\admin\controller;
use think\Controller;
use app\shop\model\ShopBanner;

class Shopbanners extends Controller
{
	 public function index()
    {
    	 $app = new ShopBanner();
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
        $app = new ShopBanner();
        $data = $app->find();
        $this->assign('data',$data);
    	return $this->fetch('add');
    }
    public function addapp(){
        $app = new ShopBanner();
        return $app->add();
    }
   public function del(){
     $app = new ShopBanner();
    return $app->del();
   }
   public function tongguo(){
    $app = new ShopBanner();
    return $app->tongguo();
   }
   public function yingcang(){
    $app = new ShopBanner();
    return $app->yingcang();
   }
}