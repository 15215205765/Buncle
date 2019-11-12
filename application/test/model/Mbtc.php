<?php
namespace app\test\model;

use think\Weixin;
use think\Jssdk;
use think\Model;
use think\Session;
class Mbtc extends Model
{
	public function add(){
		$number =  request()->post('number');
		$idcard = request()->post('idcard');
		$uid = Session::get('uid');
		$user = new User();
		$member = $user->find($uid);
		if($member['buncle']<$number*1000){
			$json = array('code'=>1,'msg'=>'UNLCE数量不足');
			return $json;
			exit;
		}
		$mbtc = new Mbtc();
		$mbtc->uid = $uid;
		$mbtc->number = $number*1000;
		$mbtc->idcard = $idcard;
		$mbtc->mbtc = $number*0.1;
		$mbtc->createtime = time();
		if($mbtc->save()){
			
			$member->buncle = $member['buncle']-$number*1000;
			$member->save();
			$mbtc = new Mbtc();
			$record = new BuncleRecord();
			$record->uid = $uid;
			$record->remark = '兑换MBTC';
			$record->number = $number*1000;
			$record->time = time();
			$record->save();
			$json = array('code'=>0,'msg'=>'提交成功');
		}else{
			$json = array('code'=>1,'msg'=>'提交失败');
		}
		return $json;
	}

	public function search(){
		$mbtc = new Mbtc();
		$uid = Session::get('uid');
		$list = $mbtc->where('uid',$uid)->order('createtime desc')->select();
		return $list;
	}

}