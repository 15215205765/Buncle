<?php
namespace app\index\model;

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
				$html .= '<div class="list" onclick="goto(this)" data-url='.$url.'>
							<div class="list-left">
								<img src="'.$v['gzh_touxiang'].'">
							</div>
							<div class="list-right">
								<div class="right-title">
									'.$v['title'].'
								</div>
								<div class="right-bottom">
									<div class="bottom-title">
										'.$v['gzh'].'
									</div>
									<div class="bottom-time">
										'.date('Y-m-d H:i',$v['fabu_time']).'
									</div>
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