<?php
namespace app\index\controller;
use think\Controller;

class Index extends Controller
{
  
    public function index()
    {
    	$app = model('WebApp');
        $list = $app->search();
        $sets = model('WebSet');
        $set = $sets->search();
        $this->assign('set',$set);
        $this->assign('list',$list);
       return $this->fetch('index');
    }


    public function upload(){
    	return $this->fetch('upload');
    }
    public function notice(){ 
        $app = model('Gonggao');
        $list = $app->search();
        $this->assign('list',$list);
    	return $this->fetch('notice');
    }

    public function addinfomation(){
        $app = model('Information');
        return $app->add();
    }

    public function share_news(){
        $app =  model('Information');
        $data = $app->share();
        return $data;
    }

    public function detail(){
        $app = model('Gonggao');
        $list = $app->find();
        $this->assign('list',$list);
        return $this->fetch('detail');
    }

    public function add_notice(){
        return $this->fetch('add_notice');
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
