<?php
namespace app\shop\model;
use think\Session;
use think\Model;
use think\Db;
use app\test\model\User;
use app\test\model\BuncleRecord;

class ShopOrder extends Model
{
	public function add(){
		$app = new ShopOrder();
		$gd = new ShopGoods();
		$goods = $gd->get(request()->post('gid'));
		$app->uid = Session::get('uid');
		$app->gid = request()->post('gid');
		$app->aid = request()->post('aid');
		$app->ordersn = 'S'.date('YmdHis').rand(1111,9999);
		$app->number = request()->post('number');
		$app->money = request()->post('number')*$goods['price'];
		$app->uncle = request()->post('number')*$goods['uncle'];
		
		$app->createtime = time();
		if($app->save()){
			if($app->uncle>0){
				$user = new User();
				$member = $user->get($app->uid);
				$data = array(
						'buncle' => $member['buncle']-$app->uncle,
						'id' => $app->uid 
					);
				$user->save($data);
				$record = new BuncleRecord();
				$record->uid = $app->uid;
				$record->remark = '购买产品';
				$record->number = $app->uncle;
				$record->time = time();
				$record->save();
				return array('code'=>0);
			}
			if($app->money>0){
				return array('code'=>2,'id'=>$app->id);
			}
			
		}else{
			return array('code'=>1);
		}
		
	}
	public function find(){
		$uid = Session::get('uid');
		$id = request()->get('aid');
		$app = new ShopOrder();
		if($id){
			$data = $app->get($id);
		}else{
			$data = $app->where(array('uid'=>$uid,'checked'=>1))->find();
		}
		
		return $data;
	}

	public function search(){
		$app = new ShopOrder();
		$uid = Session::get('uid');
		$list = $app->where('uid',$uid)->order('createtime desc')->paginate(20);
		$go = new ShopGoods();
		foreach ($list as $k => $v) {
			$list[$k]['goods'] = $go->get($v['gid']);
		}
		return $list;
	}
	public function search1(){
		$app = new ShopOrder();
		$uid = Session::get('uid');
		$list = $app->where(array('uid'=>$uid,'statu'=>1))->order('createtime desc')->paginate(20);
		$go = new ShopGoods();
		foreach ($list as $k => $v) {
			$list[$k]['goods'] = $go->get($v['gid']);
		}
		return $list;
	}

	public function del(){
		$app = new ShopOrder();
		if($app->where('id',request()->post('id'))->delete()){
			return json(array('code'=>0));
		}else{
			return json(array('code'=>1));
		}
	}
	

	public function payresult($ordersn,$transaction_id){
		$app = new ShopOrder();
		$app->save(array('statu'=>1,'paytime'=>time(),'transaction_id'=>$transaction_id),array('ordersn'=>$ordersn));
	}	
	
}
?>