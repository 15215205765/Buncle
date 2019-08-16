<?php
namespace app\admin\controller;
use think\Controller;
use model\AppList;

class App extends Controller
{
    public function index()
    {
    	 $app = model('AppList');
        $list = $app->search();
        $this->assign('list',$list);
        return $this->fetch('index');
       
       
    }


    public function add(){
        $app = model('AppList');
        $data = $app->find();
        $this->assign('data',$data);
    	return $this->fetch('add');
    }
    public function addapp(){
        $app = model('AppList');
        return $app->add();
    }
   public function del(){
    $app = model('AppList');
    return $app->del();
   }
}
