<?php
namespace app\test\model;

use think\Model;
use think\Db;

class HotKey extends Model
{
	
	

	public function search(){
		$app = new HotKey();
		$list = $app->order('sort asc')->paginate(5);
		return $list;
	}

}
?>