<?php
namespace app\shop\model;

use think\Model;
use think\Db;

class ShopExchange extends Model
{
	public function add(){
		$app = new ShopExchange();
		if(!empty(request()->post('id'))){
			$apps = $app->get(request()->post('id'));
			$apps->title = request()->post('title');
			$apps->count = request()->post('count');
			$apps->scale = request()->post('scale');
			
			$apps->banner =serialize(request()->post('banner/a'));
			$apps->thumb = request()->post('thumb');
			$apps->statu = request()->post('statu');
			$apps->endtime = strtotime(request()->post('endtime'));
			
			$apps->createtime = time();
			if($apps->save()){
					return json(array('code'=>0));
				}else{
					return json(array('code'=>1));
				}
		}else{
			$app->title = request()->post('title');
			$app->count = request()->post('count');
			$app->scale = request()->post('scale');
			$app->banner =serialize(request()->post('banner/a'));
			$app->thumb = request()->post('thumb');
			$app->statu = request()->post('statu');
			$app->endtime = strtotime(request()->post('endtime'));
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
		$app = new ShopExchange();
		$data = $app->where('statu',1)->find();

		return $data;
	}

	public function search(){
		$app = new ShopExchange();
		
		$list = $app->order('createtime asc')->paginate(20);
		
		
		return $list;
	}

	public function del(){
		$app = new ShopExchange();
		if($app->where('id',request()->post('id'))->delete()){
			return json(array('code'=>0));
		}else{
			return json(array('code'=>1));
		}
	}
	public function yingcang(){
		$app = new ShopExchange();
		$data = $app->get(request()->post('id'));
		$data->statu = 0;
		if($data->save()){
			return json(array('code'=>0));
		}else{
			return json(array('code'=>1));
		}
	}
	public function tongguo(){
		$app = new ShopExchange();
		$data = $app->get(request()->post('id'));
		$data->statu = 1;
		if($data->save()){
			return json(array('code'=>0));
		}else{
			return json(array('code'=>1));
		}
	}
}
?>