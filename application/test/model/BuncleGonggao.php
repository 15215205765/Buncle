<?php
namespace app\test\model;

use think\Model;
use think\Session;

class BuncleGonggao extends Model
{
	public function index(){
		$db = new BuncleGonggao();
		$list = $db->order('createtime desc')->paginate(3);
		return $list;
	}

	public function search(){
		$db = new BuncleGonggao();
		$list = $db->order('createtime desc')->select();
		return $list;
	}
	public function detail(){
		$app = new BuncleGonggao();
		$list = $app->get(request()->get('id'));
		return $list;
	}
}