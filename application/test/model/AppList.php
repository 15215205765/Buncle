<?php
namespace app\test\model;

use think\Model;
use think\Session;
use think\Db;

class AppList extends Model
{
	public function add(){
		$app = new AppList();
		$condition['title'] = request()->post('title');
		$check =Db::name('AppList')->where($condition)->select();
			if(!empty($check)){
				$json = array('code'=>2,'msg'=>'请勿上传重复信息');
				return $json;
				exit;
			}
		$app->title = request()->post('title');
		$app->short_title = request()->post('short_title');
		$app->logo = request()->post('logo');
		$app->android = request()->post('android');
		$app->ios = request()->post('ios');
		$app->url = request()->post('url');
		$app->content = request()->post('content');
		$app->thumb = request()->post('thumb');
		$app->zanzhu = request()->post('zanzhu');
		$app->zanzhu_con = request()->post('zanzhu_con');
		$app->zanzhu_num = request()->post('zanzhu_num');
		$app->wetch = request()->post('wetch');

		$app->createtime = time();
		$app->is_hot = 0;
		$app->is_show = 0;
		$app->agent = request()->post('agent');
		if($app->save()){
			return json(array('code'=>0,'msg'=>'提交成功'));
		}else{
			return json(array('code'=>1,'msg'=>'提交失败，请稍后再试'));
		}
	}

	public function getall(){
		$app = new AppList();
		$keyword = trim(request()->get('keyword'));
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
			$list = $app->where(['is_show'=>1,'is_recommend'=>1])->order('createtime', 'desc')->limit(30)->select();
		}else{
			$list = $app->where(['is_show'=>1,'agent'=>$agent])->order('sock', 'asc')->select();
		}
		
		return $list;
	}
	public function search(){
		$app = new AppList();
		$zuixin = $app->where(['is_recommend'=>1,'is_show'=>1])->order('createtime', 'desc')->paginate(5);
		$remen = $app->where(['is_hot'=>1,'is_show'=>1])->order('sock', 'asc')->paginate(6);
		$jiaoyisuo = $app->where(['agent'=>1,'is_show'=>1])->order('sock', 'asc')->paginate(5);
		$meiti = $app->where(['agent'=>2,'is_show'=>1])->order('sock', 'asc')->paginate(5);
		$qianbao = $app->where(['agent'=>3,'is_show'=>1])->order('sock', 'asc')->paginate(5);
		$qita = $app->where(['agent'=>4,'is_show'=>1])->order('sock', 'asc')->paginate(5);
		return array('zuixin'=>$zuixin,'remen'=>$remen,'jiaoyisuo'=>$jiaoyisuo,'meiti'=>$meiti,'qianbao'=>$qianbao,'qita'=>$qita);
		
	}
	public function findyi(){
		$app = new AppList();
		$id = request()->get('id');
		$list = $app->find($id);
		$other = $app->where(['agent'=>$list->agent,'is_show'=>1])->orderRaw('rand()')->limit('5')->select();
		$list['other'] = $other;
		return $list;
	}
}
?>