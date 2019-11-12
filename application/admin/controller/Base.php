<?php
namespace app\admin\controller;
use think\Controller;
class Base extends Controller
{
	public function uploadimg(){
         $file = request()->file('file');
         $info = $file->validate(['ext'=>'jpg,png,gif,jpeg'])->move(ROOT_PATH . 'public' . DS . 'uploads');
        if($info){
            // 成功上传后 获取上传信息
            // 输出 jpg
            //echo $info->getExtension();
            // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
            //echo $info->getSaveName();
            // 输出 42a79759f284b767dfcb2a0197904287.jpg
            //echo $info->getFilename(); 
            $json = array('code'=>0,'url'=>$info->getSaveName());
        }else{
            // 上传失败获取错误信息
            $json = array('code'=>1,'msg'=> $file->getError());
        }
        return json($json);
    }
}