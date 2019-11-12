<?php
namespace app\admin\model;

use think\Model;
use think\Db;

class WebApp extends Model
{
	public function add(){
		$app = new WebApp();
		if(!empty(request()->post('id'))){
			$apps = $app->get(request()->post('id'));
			$apps->img = request()->post('img');
			$apps->agent = request()->post('agent');
			$apps->sock = request()->post('sock');
			$apps->url = request()->post('url');
			if($apps->save()){
					return json(array('code'=>0));
				}else{
					return json(array('code'=>1));
				}
		}else{
			$app->img = request()->post('img');
			$app->agent = request()->post('agent');
			$app->sock = request()->post('sock');
			$app->url = request()->post('url');
			if($app->save()){
				return json(array('code'=>0));
			}else{
				return json(array('code'=>1));
			}
		}
		
	}
	public function find(){
		$id = request()->get('id');
		$app = new WebApp();
		$data = $app->get($id);
		return $data;
	}

	public function search(){
		$app = new WebApp();
		$agent = request()->get('agent');
		$where = [];
		if(!empty($agent)){
			$where = ['agent'=>['like','%'.$keyword.'%'],'agent'=>$agent];
			
		}
		$list = $app->where($where)->paginate(20);
		return $list;
	}

	public function del(){
		$app = new WebApp();
		if($app->where('id',request()->post('id'))->delete()){
			return json(array('code'=>0));
		}else{
			return json(array('code'=>1));
		}
	}
	
}
?>