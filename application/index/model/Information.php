<?php
namespace app\index\model;
use think\Model;
class Information extends Model
{
	public function search(){
		$app = new Information();
		$list = $app->group('title')->order('time desc')->paginate(30);
		return $list;
	}
}