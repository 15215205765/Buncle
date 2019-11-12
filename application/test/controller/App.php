<?php
namespace app\test\controller;
use think\Controller;
use think\Session;

class App extends Controller
{
     public function _initialize()
    {
        $app = model('User');
        $signPackage = $app->share();
        $this->assign('signPackage',$signPackage);
    }
    public function index()
    {
    	 $app = model('AppList');
        $list = $app->search();
        $banner = model('Banner');
        $banners = $banner->search(100);
        $gonggao =  model('BuncleGonggao');
        $gonggaos = $gonggao->index();
        $app = model('User');
        if(!Session::has('uid')){
            $res = $app->login();
        }
        $uid = Session::get('uid');
        $user = $app->get($uid);
        if(!$user){
            $res = $app->login();
        }
        $uid = Session::get('uid');
        $user = $app->get($uid);
        $this->assign('user',$user);
        $this->assign('banner',$banners);
        $this->assign('gonggao',$gonggaos);
        $this->assign('list',$list);
       return $this->fetch('index');
    }


    public function search(){
        $key = model('HotKey');
        $keyword = $key->search();
        $this->assign('keyword',$keyword);
        $banner = model('Banner');
        $banners = $banner->search(1);
        $this->assign('banner',$banners);
    	return $this->fetch('search');
    }
    public function detail(){
        $app = model('AppList');
        $list = $app->findyi();
        $this->assign('data',$list);
    	return $this->fetch('detail');
    }

     public function hot(){
        $app = model('AppList');
        $list = $app->getall();
        $keyword = request()->get('keyword');
        $agent = request()->get('agent');
        $this->assign('agent',$agent);
        $is_recommend = request()->get('is_recommend');
        $this->assign('is_recommend',$is_recommend);
        $is_hot = request()->get('is_hot');
        $this->assign('is_hot',$is_hot);
        $this->assign('keyword',$keyword);

        $this->assign('list',$list);
        return $this->fetch('hot');
    }

    public function upload(){
        return $this->fetch('upload');
    }

    public function addapp(){
         $app = model('AppList');
         return $app->add();
    }


    public function delkey(){
        $key = request()->post('key');
        $keyword = Session::get('keyword');
        $keyword = array_diff($keyword, [$key]);
        Session::set('keyword',$keyword);
        return json(array('code'=>0));
    }
}
