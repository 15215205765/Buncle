<?php
namespace app\admin\model;

use think\Model;
use think\Db;

class HotKey extends Model
{
	public function add(){
		$app = new HotKey();
		if(!empty(request()->post('id'))){
			$apps = $app->get(request()->post('id'));
			$apps->key = request()->post('key');
			$apps->sort = request()->post('sort');
			if($apps->save()){
					return json(array('code'=>0));
				}else{
					return json(array('code'=>1));
				}
		}else{
			$app->key = request()->post('key');
			$app->sort = request()->post('sort');
			if($app->save()){
				return json(array('code'=>0));
			}else{
				return json(array('code'=>1));
			}
		}
		
	}
	public function find(){
		$id = request()->get('id');
		$app = new HotKey();
		$data = $app->get($id);
		return $data;
	}

	public function search(){
		$app = new HotKey();
		$list = $app->order('sort asc')->paginate(20);
		return $list;
	}

	public function del(){
		$app = new HotKey();
		if($app->where('id',request()->post('id'))->delete()){
			return json(array('code'=>0));
		}else{
			return json(array('code'=>1));
		}
	}
	public function yingcang(){
		$app = new HotKey();
		$data = $app->get(request()->post('id'));
		$data->is_show = 0;
		if($data->save()){
			return json(array('code'=>0));
		}else{
			return json(array('code'=>1));
		}
	}
	public function tongguo(){
		$app = new HotKey();
		$data = $app->get(request()->post('id'));
		$data->is_show = 1;
		if($data->save()){
			return json(array('code'=>0));
		}else{
			return json(array('code'=>1));
		}
	}
}
?>