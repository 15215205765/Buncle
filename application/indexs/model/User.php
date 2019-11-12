<?php
namespace app\indexs\model;

use think\Weixin;
use think\Jssdk;
use think\Model;
use think\Session;
use think\Db;
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
			$user->buncle = 777;
			$user->createtime = time();
			if($user->save()){
				Session::set('uid',$user->id);
				$record = new BuncleRecord();
				$record->uid = $user->id;
				$record->remark = '关注';
				$record->number = 777;
				$record->time = time();
				$record->save();
				return '成功';
			}else{
				return '失败';
			}
		}
	}

	public function share (){
		$jssdk = new Jssdk('wx35974340dfd89358', 'ff6c1577bb2755b912058f3f5d2e09df');//这里填写自己的appid 和secret
        $signPackage = $jssdk->GetSignPackage();
        return $signPackage;
	}

	public function checkmobile(){
		$mobile =  request()->post('mobile');
		$db = new User();
		$check = $db->where('mobile',$mobile)->find();
		if(!empty($check)){
			$json = array('code'=>1,'msg'=>'该手机号已绑定');
		}else{
			$json = array('code'=>0);
		}
		return json($json);
	}

	public function addmobile(){
		$code = request()->post('code');
		session_start();
		if($code!=$_SESSION['code']){
			$json = array('code'=>2,'msg'=>'验证码错误');
			return json($json);
			exit;
		}
		$user = new User();
		$uid = Session::get('uid');
		$member = $user->find($uid);
		if(!empty($member->mobile)){
			$json = array('code'=>1,'msg'=>'已绑定手机号');
		}else{
			$member->mobile = request()->post('mobile');
			$member->buncle = $member->buncle+10;
			if($member->save()){
				$record = new BuncleRecord();
				$record->uid = $uid;
				$record->remark = '绑定手机';
				$record->number = 10;
				$record->time = time();
				$record->save();
				$json = array('code'=>0,'msg'=>'绑定成功');
			}else{
				$json = array('code'=>1,'msg'=>'绑定失败，请稍后再试');
			}
		}
		return json($json);
	}


	public function count(){
		$db = new User();
		$uid = Session::get('uid');
		$m1 = $db->where('parentid',$uid)->count();
		$m1_id = $db->where('parentid',$uid)->filed('id')->select();
		var_dump($m1_id);
		exit;
	}
	public function bid(){
		$db = new User();
		$user = $db->select();

		foreach ($user as $k => $v) {
			
			Db::name('user')

			    ->where('id', $v['id'])

			    ->data(['bid' => $this->createbid()])

			    ->update();

		}
	}
	public function createbid(){
		$str=rand(1,9);
		$str.=rand(1111111,9999999);
		while ($this->checkbid($str)) {
			$str=rand(1,9);
			$str.=rand(1111111,9999999);
		}
		
		return $str;
	}

	public function checkbid($bid){
		$db = new User();
		$res = $db->where('bid',$bid)->find();
		if($res){
			return true;
		}else{
			return false;
		}
	}
}