<?php
namespace app\index\model;

use think\Model;
use think\Session;

class Banner extends Model
{
	public function search(){
		$db = new Banner();
		$agent = empty(request()->get('agent')) ? 1 : request()->get('agent');
		$list = $db->where(['is_show'=>1,'agent'=>$agent])->order('sock asc')->select();
		return $list;
	}
}