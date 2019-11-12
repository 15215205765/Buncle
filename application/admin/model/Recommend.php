<?php
namespace app\admin\model;

use think\Model;
use think\Db;

class Recommend extends Model
{
	public function add(){
		$app = new Recommend();
		if(!empty(request()->post('id'))){
			$apps = $app->get(request()->post('id'));
			$apps->aid = request()->post('aid');
			$apps->title = request()->post('title');
			$apps->img = request()->post('img');
			$apps->agent = request()->post('agent');
			$apps->is_show = request()->post('is_show');
			$apps->createtime = time();
			if($apps->save()){
					return json(array('code'=>0));
				}else{
					return json(array('code'=>1));
				}
		}else{
			$app->aid = request()->post('aid');
			$app->img = request()->post('img');
			$app->title = request()->post('title');
			$app->agent = request()->post('agent');
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
		$app = new Recommend();
		$data = $app->get($id);
		return $data;
	}

	public function search(){
		$app = new Recommend();
		$keyword = request()->get('keyword');
		$is_show = request()->get('is_show');
		$agent = request()->get('agent');
		$where = [];
		if(!empty($keyword)){
			$where = ['title'=>['like','%'.$keyword.'%']];
			
		}
		if(!empty($agent)){
			$where = ['agent'=>['like','%'.$keyword.'%'],'agent'=>$agent];
			
		}
		if($is_show!=''){
			$where = ['title'=>['like','%'.$keyword.'%'],'agent'=>$agent,'is_show'=>$is_show];
		}
		$list = $app->where($where)->paginate(20);
		return $list;
	}

	public function del(){
		$app = new Recommend();
		if($app->where('id',request()->post('id'))->delete()){
			return json(array('code'=>0));
		}else{
			return json(array('code'=>1));
		}
	}
	public function yingcang(){
		$app = new Recommend();
		$data = $app->get(request()->post('id'));
		$data->is_show = 0;
		if($data->save()){
			return json(array('code'=>0));
		}else{
			return json(array('code'=>1));
		}
	}
	public function tongguo(){
		$app = new Recommend();
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