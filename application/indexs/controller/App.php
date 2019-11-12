<?php
namespace app\index\controller;
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
        $agent = empty(request()->get('agent')) ? 100 : request()->get('agent');
        $banner = model('Banner');
        $banners = $banner->search();
        $hot = model('HotApp');
        $hots = $hot->search();
        $reco = model('Recommend');
        $recommend = $reco->search();
        // $app = model('User');
        // $signPackage = $app->share();
        // $this->assign('signPackage',$signPackage);
        $this->assign('recommend',$recommend);
        $this->assign('agent',$agent);
        $this->assign('hot',$hots);
        $this->assign('banner',$banners);
        $this->assign('list',$list);
       return $this->fetch('index');
    }


    public function search(){
        $keyword = Session::get('keyword');
         $this->assign('keyword',$keyword);
    	return $this->fetch('search');
    }
    public function detail(){
        $app = model('AppList');
        $list = $app->findyi();
        $this->assign('data',$list);
        $agent = empty(request()->get('agent')) ? 1 : request()->get('agent');
        $this->assign('agent',$agent);
    	return $this->fetch('detail');
    }

     public function hot(){
        $app = model('AppList');
        $list = $app->getall();
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
