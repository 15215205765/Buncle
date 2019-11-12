<?php
namespace app\shop\model;

use think\Model;
use think\Db;

class ShopBanner extends Model
{
	public function add(){
		$app = new ShopBanner();
		if(!empty(request()->post('id'))){
			$apps = $app->get(request()->post('id'));
			$apps->img = request()->post('img');
			$apps->url = request()->post('url');
			$apps->sock = request()->post('sock');
			$apps->is_show = request()->post('is_show');
			$apps->createtime = time();
			if($apps->save()){
					return json(array('code'=>0));
				}else{
					return json(array('code'=>1));
				}
		}else{
			$app->img = request()->post('img');
			$app->url = request()->post('url');
			$app->sock = request()->post('sock');
			$app->is_show = request()->post('is_show');
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
		$app = new ShopBanner();
		$data = $app->get($id);
		return $data;
	}

	public function search(){
		$app = new ShopBanner();
		$list = $app->order('sock asc')->paginate(20);
		return $list;
	}

	public function del(){
		$app = new ShopBanner();
		if($app->where('id',request()->post('id'))->delete()){
			return json(array('code'=>0));
		}else{
			return json(array('code'=>1));
		}
	}
	public function yingcang(){
		$app = new ShopBanner();
		$data = $app->get(request()->post('id'));
		$data->is_show = 0;
		if($data->save()){
			return json(array('code'=>0));
		}else{
			return json(array('code'=>1));
		}
	}
	public function tongguo(){
		$app = new ShopBanner();
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