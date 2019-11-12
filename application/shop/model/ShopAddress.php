<?php
namespace app\shop\model;
use think\Session;
use think\Model;
use think\Db;

class ShopAddress extends Model
{
	public function add(){
		$app = new ShopAddress();
	
		$app->uid = Session::get('uid');
		$app->realname = request()->post('realname');
		$app->mobile = request()->post('mobile');
		$app->province = request()->post('province');
		$app->city = request()->post('city');
		$app->area = request()->post('area');
		$app->detail = request()->post('detail');
		$app->checked = request()->post('checked');
		$app->createtime = time();
		if($app->save()){
			return json(array('code'=>0));
		}else{
			return json(array('code'=>1));
		}
		
	}
	public function find(){
		$uid = Session::get('uid');
		$id = request()->get('aid');
		$app = new ShopAddress();
		if($id){
			$data = $app->get($id);
		}else{
			$data = $app->where(array('uid'=>$uid,'checked'=>1))->find();
		}
		
		return $data;
	}

	public function search(){
		$app = new ShopAddress();
		$list = $app->order('createtime desc')->paginate(20);
		return $list;
	}

	public function del(){
		$app = new ShopAddress();
		if($app->where('id',request()->post('id'))->delete()){
			return json(array('code'=>0));
		}else{
			return json(array('code'=>1));
		}
	}
	public function yingcang(){
		$app = new ShopAddress();
		$data = $app->get(request()->post('id'));
		$data->is_show = 0;
		if($data->save()){
			return json(array('code'=>0));
		}else{
			return json(array('code'=>1));
		}
	}
	public function tongguo(){
		$app = new ShopAddress();
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