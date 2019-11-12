<?php
namespace app\test\model;

use think\Model;

class Comment extends Model
{
	public function search(){
		$app = new Comment();
		$list = $app->group('title')->order('fabu_time desc')->paginate(10);
		return $list;
	}

	public function load(){
		$page = request()->post('page');
		$app = new Comment();
		$list = $app->group('title')->order('fabu_time desc')->limit($page*10,10)->select();
		
		if(count($list)>0){
			$html = '';
			foreach ($list as $k => $v) {
				$url = $v['ls_url'];
				$html .=' <li onclick="goto(this)" data-url='.$url.'>
						    <div class="weimeiti_top"><img src="'.$v['gzh_touxiang'].'"><b>'.$v['gzh'].'</b><span>'.date('Y-m-d H:i',$v['fabu_time']).'</span></div>
						    <div class="weimeiti_neirong">
						    <b>'.$v['title'].'</b>
						    <span>'.$v['title'].'</span>
						    </div>
						    </li>';
			
			}
			return json(array('code'=>0,'html'=>$html));
		}else{
			return json(array('code'=>1));
		}
		
	}
}