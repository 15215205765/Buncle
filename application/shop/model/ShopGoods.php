<?php
namespace app\shop\model;

use think\Model;
use think\Db;

class ShopGoods extends Model
{
	public function add(){
		$app = new ShopGoods();
		if(!empty(request()->post('id'))){
			$apps = $app->get(request()->post('id'));
			$apps->title = request()->post('title');
			$apps->price = request()->post('price');
			$apps->oldprice = request()->post('oldprice');
			$apps->uncle = request()->post('uncle');
			$apps->type = request()->post('type');
			$apps->banner =serialize(request()->post('banner/a'));
			$apps->thumb = request()->post('thumb');
			$apps->content = request()->post('content');
			$apps->statu = request()->post('statu');
			$apps->stock = request()->post('stock');
			$apps->type = request()->post('type');
			$apps->is_hot = request()->post('is_hot');
			$apps->sock = request()->post('sock');
			$apps->sold = request()->post('sold');
			
			$apps->createtime = time();
			if($apps->save()){
					return json(array('code'=>0));
				}else{
					return json(array('code'=>1));
				}
		}else{
			$app->title = request()->post('title');
			$app->price = request()->post('price');
			$app->oldprice = request()->post('oldprice');
			$app->uncle = request()->post('uncle');
			$app->type = request()->post('type');
			$app->banner =serialize(request()->post('banner/a'));
			$app->thumb = request()->post('thumb');
			$app->content = request()->post('content');
			$app->statu = request()->post('statu');
			$app->stock = request()->post('stock');
			$app->sock = request()->post('sock');
			$app->type = request()->post('type');
			$app->is_hot = request()->post('is_hot');
			$app->sold = request()->post('sold');
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
		$app = new ShopGoods();
		$data = $app->get($id);

		return $data;
	}

	public function search($type=2){
		$app = new ShopGoods();
		if($type==2){
			$list = $app->order('sock asc')->paginate(20);
		}else{
			$list = $app->where(array('type'=>$type,'statu'=>1))->order('sock asc')->paginate(20);
		}
		
		return $list;
	}

	public function del(){
		$app = new ShopGoods();
		if($app->where('id',request()->post('id'))->delete()){
			return json(array('code'=>0));
		}else{
			return json(array('code'=>1));
		}
	}
	public function yingcang(){
		$app = new ShopGoods();
		$data = $app->get(request()->post('id'));
		$data->statu = 0;
		if($data->save()){
			return json(array('code'=>0));
		}else{
			return json(array('code'=>1));
		}
	}
	public function tongguo(){
		$app = new ShopGoods();
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