<?php
namespace app\index\model;

use think\Model;
use think\Session;

class WebSet extends Model
{
	public function search(){
		$db = new WebSet();
		$set = $db->get(1);
		return $set;
	}
}
?>