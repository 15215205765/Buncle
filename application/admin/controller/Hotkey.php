<?php
namespace app\admin\controller;
use think\Controller;
use model\HotApp;

class Hotkey extends Controller
{
	public function index(){
		$app = model('HotKey');
        $list = $app->search();
		$this->assign('list',$list);
        return $this->fetch('index');
	}
	public function add(){
        $app = model('HotKey');
        $data = $app->find();
        $this->assign('data',$data);
    	return $this->fetch('add');
    }
    public function addapp(){
        $app = model('HotKey');
        return $app->add();
    }
   public function del(){
    $app = model('HotKey');
    return $app->del();
   }
}