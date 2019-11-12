<?php
namespace app\index\model;

use think\Model;
use think\Session;
class BuncleRecord extends Model
{
	public function count(){
		$uid = Session::get('uid');
		$db = new BuncleRecord();
		$M1 = $db->where(array('uid'=>$uid,'remark'=>'M1'))->sum('number');
		$M2 = $db->where(array('uid'=>$uid,'remark'=>'M2'))->sum('number');
		$M3 = $db->where(array('uid'=>$uid,'remark'=>'M3'))->sum('number');
		$M4 = $db->where(array('uid'=>$uid,'remark'=>'M4'))->sum('number');
		$M5 = $db->where(array('uid'=>$uid,'remark'=>'M5'))->sum('number');
		$M6 = $db->where(array('uid'=>$uid,'remark'=>'M6'))->sum('number');
		return array('M1'=>$M1,'M2'=>$M2,'M3'=>$M3,'M4'=>$M4,'M5'=>$M5,'M6'=>$M6);
	}

	public function getlist(){
		$uid = Session::get('uid');
		$db = new BuncleRecord();
		$list = $db->where('uid',$uid)->order('time desc')->select();
		return $list;
	}
}