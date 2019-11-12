<?php
namespace app\admin\model;

use think\Model;
use think\Db;

class AppList extends Model
{
	public function add(){
		$app = new AppList();
		$condition['title'] = request()->post('title');
		$condition['android'] = request()->post('android');
		$condition['ios'] = request()->post('ios');
		$condition['agent'] = request()->post('agent');
		
		if(!empty(request()->post('id'))){
			$apps = $app->get(request()->post('id'));
			$apps->title = request()->post('title');
			$apps->short_title = request()->post('short_title');
			$apps->logo = request()->post('logo');
			$apps->ios = request()->post('ios');
			$apps->android = request()->post('android');
			$apps->url = request()->post('url');
			$apps->content = request()->post('content');
			$apps->sock = request()->post('sock');
			$apps->createtime = time();
			$apps->is_hot = request()->post('is_hot');
			$apps->is_recommend = request()->post('is_recommend');
			$apps->is_show = request()->post('is_show');
			$apps->agent = request()->post('agent');
			if($apps->save()){
					return json(array('code'=>0));
				}else{
					return json(array('code'=>1));
				}
		}else{
			$check =Db::name('AppList')->where($condition)->select();
			if(!empty($check)){
				$json = array('code'=>2,'msg'=>'请勿上传重复信息');
				return $json;
				exit;
			}
			$app->title = request()->post('title');
			$app->short_title = request()->post('short_title');
			$app->logo = request()->post('logo');
			$app->ios = request()->post('ios');
			$app->android = request()->post('android');
			$app->url = request()->post('url');
			$app->content = request()->post('content');
			$app->sock = request()->post('sock');
			$app->createtime = time();
			$app->is_hot = request()->post('is_hot');
			$app->is_recommend = request()->post('is_recommend');
			$app->is_show = request()->post('is_show');
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
		$list = $app->where($where)->order('sock','asc')->paginate(20,false,['query'=>request()->get()]);
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
	public function yingcang(){
		$app = new AppList();
		$data = $app->get(request()->post('id'));
		$data->is_show = 0;
		if($data->save()){
			return json(array('code'=>0));
		}else{
			return json(array('code'=>1));
		}
	}
	public function tongguo(){
		$app = new AppList();
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