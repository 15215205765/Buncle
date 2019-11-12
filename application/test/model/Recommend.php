<?php
namespace app\test\model;

use think\Model;
use think\Session;

class Recommend extends Model
{
	public function search(){
		// $db = new Recommend();
		$agent = empty(request()->get('agent')) ? 1 : request()->get('agent');
		// $list = $db->where(['is_show'=>1,'agent'=>$agent])->order('sock asc')->select();
		$data = db('recommend')
    	->alias('r')
    	->join('app_list a','a.id=r.aid','left')
        ->where(['r.is_show'=>1,'r.agent'=>$agent])//条件:状态为1
    	->field(['r.*','a.title as apptitle','a.content','a.logo'])
    	->find();
		return $data;
	}
}