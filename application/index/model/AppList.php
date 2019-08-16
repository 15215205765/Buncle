<?php
namespace app\index\model;

use think\Model;

class AppList extends Model
{
	public function add(){
		$app = new AppList();
		$app->title = request()->post('title');
		$app->logo = request()->post('logo');
		$app->download = request()->post('download');
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

	public function search(){
		$app = new AppList();
		$list = $app->paginate(30);
		return $list;
	}
}
?>