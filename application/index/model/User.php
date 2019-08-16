<?php
namespace app\index\model;

use think\Weixin;
use think\Model;
use think\Session;
class User extends Model
{
	public function login(){

		$weixin= new Weixin('wx35974340dfd89358','ff6c1577bb2755b912058f3f5d2e09df','gh_7d6ef8f4c99a');
		$res = $weixin->authorization('userinfo');
		$user = new User();
		$memeber = $user->where('openid', $res['openid']) ->find();
		if(!empty($memeber)){
			if(empty($memeber->nickname)){
				$memeber->nickname = $res['nickname'];
				$memeber->avatar = $res['headimgurl'];
				$memeber->openid = $res['openid'];
				$memeber->save();
			}
			Session::set('uid',$memeber->id);
		}else{
			$user->nickname = $res['nickname'];
			$user->avatar = $res['headimgurl'];
			$user->openid = $res['openid'];
			$user->createtime = time();
			if($user->save()){
				Session::set('uid',$user->id);
				return '成功';
			}else{
				return '失败';
			}
		}
	}
}