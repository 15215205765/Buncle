<?php
namespace app\admin\model;

use think\Model;
use think\Db;

class Mbtc extends Model
{


	public function search(){
		$app = new Mbtc();
	
		$list = $app->order('createtime desc statu asc')->paginate(20);
		return $list;
	}

	public function tongguo(){
		$app = new Mbtc();
		$data = $app->get(request()->post('id'));
		$data->statu = 1;
		if($data->save()){
			return json(array('code'=>0));
		}else{
			return json(array('code'=>1));
		}
	}
	public function jujue(){
		$app = new Mbtc();
		$data = $app->get(request()->post('id'));
		$data->statu = 2;
		if($data->save()){
			$user = Db::name('User')->where('id',$data['uid'])->find();
			Db::name('User')->where('id',$data['uid'])->update(array('buncle'=>$user['buncle']+$data['number']));
			Db::name('BuncleRecord')->insert([
			    'uid'=>$data['uid'],
			    'remark'=>'拒绝兑换MBTC',
			    'number'=>$data['number'],
			    'time' => time()
			]);
			return json(array('code'=>0));
		}else{
			return json(array('code'=>1));
		}
	}
}
?>