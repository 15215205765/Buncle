<?php
namespace app\index\model;

use think\Model;

class Gonggao extends Model
{
	public function search(){
		$app = new Gonggao();
		$list = $app->group('title')->order('time desc')->paginate(10);
		return $list;
	}

	public function find(){
		$app = new Gonggao();
		$list = $app->get(request()->get('id'));
		return $list;
	}



		public function load(){
		$page = request()->post('page');
		$app = new Gonggao();
		$list = $app->group('title')->order('time desc')->limit($page*10,10)->select();
		
		if(count($list)>0){
			$html = '';
			foreach ($list as $k => $v) {
				$html .= '<div class="list" onclick="goto(this)" data-id='.$v["id"].'>
							<div class="list-left">
								<img src="'.$v['logo'].'">
							</div>
							<div class="list-right">
								<div class="right-bottom">
									<div class="bottom-title">
										'.$v['author'].'
									</div>
									<div class="bottom-time">
											'.$v['time'].'
										</div>
								
									</div>
									<div class="right-title">
										'.$v['title'].'
									</div>
								
							</div>
						</div>';
			}

			return json(array('code'=>0,'html'=>$html));
		}else{
			return json(array('code'=>1));
		}
		
	}
}