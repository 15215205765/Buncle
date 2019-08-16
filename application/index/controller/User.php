<?php
namespace app\index\controller;
use think\Controller;
use think\Weixin;
use think\Session;
class User extends Controller
{
	public function index(){
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
		return $this->fetch('index');
	}

	public function share(){
		return $this->fetch('share');
	}
	public function task(){
		return $this->fetch('task');
	}
}