<?php
namespace app\index\model;

use think\Model;
use think\Session;

class WebApp extends Model
{
	public function search(){
		$db = new WebApp();
		$jiaoyisuo = $db->where('agent',1)->order('sock asc')->limit(6)->select();
		$qianbao = $db->where('agent',2)->order('sock asc')->limit(6)->select();
		$meiti = $db->where('agent',3)->order('sock asc')->limit(6)->select();
		$dapp = $db->where('agent',4)->order('sock asc')->limit(6)->select();
		return ['jiaoyisuo'=>$jiaoyisuo,'qianbao'=>$qianbao,'meiti'=>$meiti,'dapp'=>$dapp];
	}
}
?>