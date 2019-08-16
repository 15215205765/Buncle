<?php
namespace app\admin\model;

use think\Model;

class AppList extends Model
{
	public function add(){
		$app = new AppList();
		if(!empty(request()->post('id'))){
			$apps = $app->get(request()->post('id'));
			$app->title = request()->post('title');
			$apps->logo = request()->post('logo');
			$apps->ios = request()->post('ios');
			$apps->android = request()->post('android');
			$apps->url = request()->post('url');
			$apps->content = request()->post('content');
			$apps->sock = request()->post('sock');
			$apps->createtime = time();
			$apps->is_hot = 1;
			$apps->agent = request()->post('agent');
			if($apps->save()){
					return json(array('code'=>0));
				}else{
					return json(array('code'=>1));
				}
		}else{
			$app->title = request()->post('title');
			$app->logo = request()->post('logo');
			$app->ios = request()->post('ios');
			$app->android = request()->post('android');
			$app->url = request()->post('url');
			$app->content = request()->post('content');
			$app->sock = request()->post('sock');
			$app->createtime = time();
			$app->is_hot = 1;
			$app->agent = request()->post('agent');
			if($app->save()){
				return json(array('code'=>0));
			}else{
				return json(array('code'=>1));
			}
		}
		
	}
	public function find(){
		$id = request()->get('id');
		$app = new AppList();
		$data = $app->get($id);
		return $data;
	}

	public function search(){
		$app = new AppList();
		$list = $app->paginate(20);
		return $list;
	}

	public function del(){
		$app = new AppList();
		if($app->where('id',request()->post('id'))->delete()){
			return json(array('code'=>0));
		}else{
			return json(array('code'=>1));
		}
	}
}
?>