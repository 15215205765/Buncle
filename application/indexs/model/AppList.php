<?php
namespace app\index\model;

use think\Model;
use think\Session;

class AppList extends Model
{
	public function add(){
		$app = new AppList();
		$app->title = request()->post('title');
		$app->logo = request()->post('logo');
		$app->android = request()->post('android');
		$app->ios = request()->post('ios');
		$app->url = request()->post('url');
		$app->content = request()->post('content');
		$app->mobile = request()->post('mobile');
		$app->wetch = request()->post('wetch');

		$app->createtime = time();
		$app->is_hot = 0;
		$app->is_show = 0;
		$app->agent = request()->post('agent');
		if($app->save()){
			return json(array('code'=>0));
		}else{
			return json(array('code'=>1));
		}
	}

	public function getall(){
		$app = new AppList();
		$keyword = request()->get('keyword');
		$agent = request()->get('agent');
		$is_hot = request()->get('is_hot');
		$is_recommend = request()->get('is_recommend');
		if(!empty($keyword)){
			$ka = Session::get('keyword');
			if(empty($ka)){
				$ka = array();

			}
			if(!in_array($keyword, $ka)){
				array_push($ka, $keyword);
				Session::set('keyword',$ka);
			}
			
			$list = $app->where(['title'=>['like','%'.$keyword.'%'],'is_show'=>1])->order('sock', 'asc')->select();
		}elseif(!empty($is_hot)){
			$list = $app->where(['is_show'=>1,'is_hot'=>1])->order('sock', 'asc')->limit(30)->select();
		}elseif(!empty($is_recommend)){
			$list = $app->where(['is_show'=>1,'is_recommend'=>1])->order('createtime', 'asc')->limit(30)->select();
		}else{
			$list = $app->where(['is_show'=>1,'agent'=>$agent])->order('sock', 'asc')->select();
		}
		
		return $list;
	}
	public function search(){
		$app = new AppList();
		$agent = empty(request()->get('agent')) ? 100 : request()->get('agent');
		if($agent==100){
			$list1 = $app->where(['is_recommend'=>1,'is_show'=>1])->order('createtime', 'desc')->paginate(5);
			$list2 = $app->where(['is_hot'=>1,'is_show'=>1])->order('sock', 'desc')->paginate(5);
			$count1 = $app->where(['agent'=>1,'is_show'=>1])->count();
			$count2 = $app->where(['agent'=>2,'is_show'=>1])->count();
			$count3 = $app->where(['agent'=>3,'is_show'=>1])->count();
			$count4 = $app->where(['agent'=>4,'is_show'=>1])->count();
			return array('list1'=>$list1,'list2'=>$list2,'count1'=>$count1,'count2'=>$count2,'count3'=>$count3,'count4'=>$count4);
		}else{
			$list = $app->where(['agent'=>$agent,'is_show'=>1])->order('sock', 'asc')->paginate(32);
			return $list;
		}
		
	}
	public function findyi(){
		$app = new AppList();
		$id = request()->get('id');
		$list = $app->find($id);
		return $list;
	}
}
?>