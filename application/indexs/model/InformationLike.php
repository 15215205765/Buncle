<?php
namespace app\index\model;
use think\Model;
use think\Session;
class InformationLike extends Model
{
	public function dianzan(){
		$id = request()->post('id');
		$type = request()->post('type');
		$app = new InformationLike();
		if(!Session::has('uid')){
			$user = new User();
			$res = $user->login();
		}
		$uid = Session::get('uid');
		$check = $app->where(array('uid'=>$uid,'mid'=>$id))->find();
		if(!empty($check)){
			return json(array('code'=>1));
			exit;
		}
		$app->uid= $uid;
		$app->mid = $id;
		$app->type = intval($type);
		if($app->save()){
			return json(array('code'=>0));
		}else{
			return json(array('code'=>1));
		}
	}
}