<?php
namespace app\test\model;

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
				$html .='<a href="/index.php/test/index/detail?id='.$v["id"].'"><li>
						    <div class="weimeiti_top"><img src="'.$v['logo'].'"><b>'.$v['author'].'</b><span>'.$v['time'].'</span></a></div>
						    <div class="weimeiti_neirong">
						      <a href="/index.php/test/index/detail?id='.$v['id'].'" style="color:#000;"><b>'.$v['title'].'</b>
						      <span>'.$v['title'].'</span>
						      </div>
						    </li></a>';
				
			}

			return json(array('code'=>0,'html'=>$html));
		}else{
			return json(array('code'=>1));
		}
		
	}
}