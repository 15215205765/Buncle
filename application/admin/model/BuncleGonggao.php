<?php
namespace app\admin\model;

use think\Model;
use think\Db;

class BuncleGonggao extends Model
{
	public function add(){
		$app = new BuncleGonggao();
		
		
		if(!empty(request()->post('id'))){
			$apps = $app->get(request()->post('id'));
			$apps->title = request()->post('title');
			$apps->content = request()->post('content');
			$apps->author = request()->post('author');
			$apps->logo = request()->post('logo');
			
			if($apps->save()){
					return json(array('code'=>0));
				}else{
					return json(array('code'=>1));
				}
		}else{
			
			$app->title = request()->post('title');
			$app->content = request()->post('content');
			$app->author = request()->post('author');
			$app->logo = request()->post('logo');
			$app->createtime = time();
			
			if($app->save()){
				return json(array('code'=>0));
			}else{
				return json(array('code'=>1));
			}
		}
		
	}
	public function find(){
		$id = request()->get('id');
		$app = new BuncleGonggao();
		$data = $app->get($id);
		return $data;
	}

	public function search(){
		$app = new BuncleGonggao();
		$keyword = request()->get('keyword');
		$is_show = request()->get('is_show');
		$agent = request()->get('agent');
		$where = [];
		
		$list = $app->where($where)->paginate(20);
		return $list;
	}

	public function del(){
		$app = new BuncleGonggao();
		if($app->where('id',request()->post('id'))->delete()){
			return json(array('code'=>0));
		}else{
			return json(array('code'=>1));
		}
	}
	
}
?>