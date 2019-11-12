<?php
namespace app\test\model;
use think\Model;
class Information extends Model
{
	public function search(){
		$app = new Information();
		$list = $app->field('*,UNIX_TIMESTAMP(CONCAT("2019/",`time`))  as t')->group('title')->order('t desc')->paginate(10);
		return $list;
	}

	public function load(){
		$page = request()->post('page');
		$app = new Information();
		$list = $app->field('*,UNIX_TIMESTAMP(CONCAT("2019/",`time`))  as t')->group('title')->order('t desc')->limit($page*10,10)->select();
		
		if(count($list)>0){
			$html = '';
			foreach ($list as $k => $v) {
				$html .= ' <li>
						    <div class="h24_riqichuchu">●<b>'.$v["time"].'</b></div>
						    <div class="weimeiti_neirong">
						    <b>'.$v["title"].'</b>
						    <span>'.$v["content"].'</span>
						    </div>
						    <div class="h24_toolimg"><ul><li onclick="share('.$v["id"].')"><a><img src="/public/static/images/2/fmax.png"></a><span>分享</span></li>
						    </ul></div>
						    </li>';
			}
			return json(array('code'=>0,'html'=>$html));
		}else{
			return json(array('code'=>1));
		}
		
	}

	public function share(){
		$app = new Information();
		$id = request()->post('id');
		$information = $app->get($id);



	$text1 = trim($information['content']);
    $text = "";
   
    $im_width        = 960;
    $font_path = 'public/songti2.TTF';
    $title = $this->str_n($im_width,45,100,$information['title'],$font_path);
    $text = $this->str_n($im_width,35,100,$text1,$font_path);
    $time = date('m月d日 H:i',strtotime($information['time']));
    $time = $this->str_n($im_width,35,100,$time,$font_path);
    $rows      = substr_count($text, "\n") + 1;
   	$row_title = substr_count($title, "\n") + 1;
   	$row_time = substr_count($time, "\n") + 1;
   $padding = 100;
   $row_plus_heigh  = 20;
    $im_height       = (4 + (35 * 4) / 3) * $rows + 20 * 2+(6 + (45 * 4) / 3) * $row_title + 20  * 2+(4 + (35 * 4) / 3) * $row_time + 20  * 2+40+80;
    $im_height = $im_height<1200 ? 1200 : $im_height;
    $im              = @imagecreatetruecolor($im_width, $im_height);

    $ims = @imagecreatetruecolor(1130, $im_height);
    if (!$im)
        throw new Exception("初始化图片失败，请检查 GD 配置");
    imagefilledrectangle($im, 0, 0, $im_width, $im_height, imagecolorallocate($im, 255,255,255));
    imagefilledrectangle($ims, 0, 0, 1130, $im_height, imagecolorallocate($im, 1,102,254));
   
    imagettftext($im, 45, 0,  $padding, 45*4/3+20, imagecolorallocate($im, 0, 0, 0), $font_path, $title);
     imagettftext($im, 35, 0,  $padding, (35 * 4)/3+(6 + (45 * 4) / 3) * $row_title +20+20+20, imagecolorallocate($im, 22, 22, 22), $font_path, $time);
    // imagettftext($im, 24, 0,  $padding+1, ((24 * 4) / 3+20 +  $padding)+(20 + (24 * 4) / 3) * $row_time, imagecolorallocate($ims, 0, 0, 0), $font_path, $title);
    imagettftext($im, 35, 0,  $padding, ((35 * 4) / 3 +4+  20)+(6 + (45 * 4) / 3) * $row_title + 20+20+((35 * 4) / 3)+20+20, imagecolorallocate($im, 0, 0, 0), $font_path, $text);
   
   	imagecopyresized($ims, $im, 86, 0, 0, 0,960,$im_height,960,$im_height);
    // @mkdir($base_path, 0777, true);
    // $filename = $short_filename;
    // $res = imagepng($im,$base_filename);
    // var_dump($res);exit;
    // if (!$res) {
    //     throw new Exception("创建图片时出错。");
    // }

    // @imagedestroy($im);
    
    $thumb = imagecreatetruecolor(1130, $im_height+459+519);

    $poster1 = 'http://www.buncle.co/public/newposter_1.png';
    $poster3 = 'http://www.buncle.co/public/newposter_2.png';
    $source1 = imagecreatefrompng($poster1);
    $source3 = imagecreatefrompng($poster3);
    $source2 = $ims; 
    imagecopyresized($thumb, $source3, 0, $im_height+459, 0, 0,1130,519,1130,519);
    imagecopyresized($thumb, $source1, 0, 0, 0, 0,1130,459,1130,459);
    imagecopyresized($thumb, $ims, 0, 459, 0, 0,1130,$im_height,1130,$im_height);
     $res = imagejpeg($thumb,"kuaixun".$id.".jpg");
   // $this->show('<img src="/wap/ROOT/bds/kuaixun.jpg" style="width:100%;">');
   $json = array('code'=>0,'img'=>"kuaixun".$id.".jpg");
		return json($json);
	}



	function str_n($width,$size,$padding,$str,$font_path){
		for ($i=0;$i<mb_strlen($str);$i++) {
		  $array[] = mb_substr($str, $i, 1,"UTF8");
	   	}
	   $string='';
	   foreach ($array as $l) {
	       $teststr = $string." ".$l;
	       $fontBox = imagettfbbox($size, 0, $font_path, $teststr);
	       if (($fontBox[2] > $width-$padding*2) && ($l !== "")) {

	           $string .= "\n";

	       }

	       $string .= $l;

	   }
	   return $string;

	}


}