<?php
namespace app\test\model;

use think\Model;
use think\Session;

class Banner extends Model
{
	public function search($agent){
		$db = new Banner();
		$list = $db->where(['is_show'=>1,'agent'=>$agent])->order('sock asc')->select();
		return $list;
	}
}