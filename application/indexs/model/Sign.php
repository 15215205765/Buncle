<?php
namespace app\index\model;

use think\Weixin;
use think\Model;
use think\Session;
class Sign extends Model
{
	public function sign(){
		$uid = Session::get('uid');
		$date = date('Ymd');
		$yestoday = date('Ymd', strtotime('-1 day'));
		$db = new Sign();
		$checkyes = $db->where(array('uid'=>$uid,'date'=>$yestoday))->find();
		$check = $db->where(array('uid'=>$uid,'date'=>$date))->find();
		if(!empty($check)){
			$json = array('code'=>1,'msg'=>'今日已签到');
		}else{
			$db->uid = $uid;
			$db->date = $date;
			$db->time = time();
			$db->buncle = 1;
			if($db->save()){
				$record = new BuncleRecord();
				$record->uid = $uid;
				$record->remark = '签到';
				$record->number = 1;
				$record->time = time();
				$record->save();
				$user = new User();
				$member = $user->find($uid);
				$member->buncle = $member->buncle+1;
				if(!empty($checkyes)){
					$member->sign_day = $member->sign_day+1;
				}else{
					$member->sign_day =1;
				}
				
				$member->save();
				$json = array('code'=>0,'msg'=>'签到成功');
			}else{
				$json = array('code'=>1,'msg'=>'签到失败，请稍后再试');
			}
		}
		return json($json);
	}

	public function display(){
		$uid = Session::get('uid');
		$user = new User();
		$member = $user->find($uid);
		$db = new Sign();
		$count = $db->where(array('uid'=>$uid))->count();
		$date = date('Ymd');
		$today = $db->where(array('uid'=>$uid,'date'=>$date))->count();
		return array('user'=>$member,'count'=>$count,'today'=>$today);
	}
}