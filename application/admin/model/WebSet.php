<?php
namespace app\admin\model;

use think\Model;
use think\Db;

class WebSet extends Model
{
	public function add(){
		$app = new WebSet();
		if(!empty(request()->post('id'))){
			$apps = $app->get(request()->post('id'));
			$apps->thumb = request()->post('thumb');
			$apps->logo = request()->post('logo');
			
			if($apps->save()){
					return json(array('code'=>0));
				}else{
					return json(array('code'=>1));
				}
		}else{
			$app->thumb = request()->post('thumb');
			$app->logo = request()->post('logo');
			if($app->save()){
				return json(array('code'=>0));
			}else{
				return json(array('code'=>1));
			}
		}
		
	}
	public function find(){
	
		$app = new WebSet();
		$data = $app->get(1);
		return $data;
	}

	
	
}
?>