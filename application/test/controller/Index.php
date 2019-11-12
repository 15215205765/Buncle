<?php
namespace app\test\controller;
use think\Controller;

class Index extends Controller
{
     public function _initialize()
    {
        $app = model('User');
        $signPackage = $app->share();
        $this->assign('signPackage',$signPackage);
    }
    public function index()
    {
    	$app = model('Comment');
        $meiti = $app->search();
        $this->assign('meiti',$meiti);
        $app = model('Information');
        $kuaixun = $app->search();
        $this->assign('kuaixun',$kuaixun);
        $app = model('Gonggao');
        $gonggao = $app->search();
        $this->assign('gonggao',$gonggao);
       return $this->fetch('index');
    }


    public function news(){
        $app = model('Information');
        $list = $app->search();
        $this->assign('list',$list);
    	return $this->fetch('news');
    }
    public function notice(){ 
        $app = model('Gonggao');
        $list = $app->search();
        $this->assign('list',$list);
    	return $this->fetch('notice');
    }

    public function share_news(){
        $app =  model('Information');
        $data = $app->share();
        return $data;
    }

    public function detail(){
        $app = model('Gonggao');
        $list = $app->find();
        $this->assign('data',$list);
        return $this->fetch('detail');
    }
     public function kuaixunimg(){
         $id = request()->get('id');
        $this->assign('id',$id);
        return $this->fetch('kuaixunimg');
    }

    public function newsload(){
        $app =  model('Information');
        $data = $app->load();
        return $data;
    }
    public function commentload(){
        $app =  model('Comment');
        $data = $app->load();
        return $data;
    }
     public function gonggaoload(){
        $app =  model('Gonggao');
        $data = $app->load();
        return $data;
    }

    public function dianzan(){
         $app =  model('InformationLike');
        $data = $app->dianzan();
        return $data;
    }
}
