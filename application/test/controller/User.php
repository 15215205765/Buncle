<?php
namespace app\test\controller;
use think\Controller;
use think\Weixin;
use think\Session;
class User extends Controller
{
	public function _initialize()
    {
        $app = model('User');
        $signPackage = $app->share();
        $this->assign('signPackage',$signPackage);
    }
	public function index(){
		$app = model('User');
		if(!Session::has('uid')){
			$res = $app->login();
		}
		$uid = Session::get('uid');
		$user = $app->get($uid);
		if(!$user){
			$res = $app->login();
		}
		$uid = Session::get('uid');
		$user = $app->get($uid);
		$this->assign('user',$user);
		$banner = model('Banner');
        $banners = $banner->search(2);
		$this->assign('banner',$banners);
		$m = model('Sign');
		$data = $m->display();
		$hour = date('H');
		$this->assign('hour',$hour);
		$this->assign('data',$data);
		return $this->fetch('index');
	}

	public function share(){
		$app = model('User');
		$signPackage = $app->share();
		$this->assign('signPackage',$signPackage);
		$uid = Session::get('uid');
		$user = $app->get($uid);
		if(!$user){
			$res = $app->login();
		}
		$parent = $app->parent();
		$this->assign('parent',$parent);
		$uid = Session::get('uid');
		$user = $app->get($uid);
		$record = model('BuncleRecord');
		$data = $record->count();
		$this->assign('member',$user);
		$this->assign('data',$data);
		return $this->fetch('share');
	}

		public function shares(){
		$app = model('User');
		$signPackage = $app->share();
		$parent = $app->parent();
		$this->assign('parent',$parent);
		$this->assign('signPackage',$signPackage);
		$uid = Session::get('uid');
		$user = $app->get($uid);
		if(!$user){
			$res = $app->login();
		}
		$uid = Session::get('uid');
		$user = $app->get($uid);
		$record = model('BuncleRecord');
		$data = $record->count();
		$this->assign('member',$user);
		$this->assign('data',$data);
		return $this->fetch('shares');
	}
	public function task(){
		$app = model('User');
		$uid = Session::get('uid');
		$user = $app->get($uid);
		if(!$user){
			$res = $app->login();
		}
		$uid = Session::get('uid');
		$user = $app->get($uid);
		$count = $app->getson();
		$this->assign('member',$user);
		$this->assign('count',$count);
		return $this->fetch('task');
	}

	public function answer(){
		$data = array('0'=>array('url'=>'http://mp.weixin.qq.com/s?__biz=Mzg2ODE5NTA2NQ==&mid=100000341&idx=1&sn=c53d5228c3e1ddce5134a0016d501703&chksm=4eb14dc379c6c4d5dbfa8cc5b4cc8f353f5c54e8a5707f5f88b4b93685fe7357ecff211f02d9#rd','title'=>'第1集  从物物交换到比特币'),'1'=>array('url'=>'https://mp.weixin.qq.com/s/qFQkUmHvewhF1VraLiQvaw','title'=>'第2集  什么是比特币？'),'2'=>array('url'=>'https://mp.weixin.qq.com/s/dy7H0YjZ0xlDfX70pyyznw','title'=>'第3集  比特币白皮书的诞生'),'3'=>array('url'=>'https://mp.weixin.qq.com/s/Sr8PkItsn00oMcb_D_PuNQ','title'=>'第4集  第一个比特币诞生'),'4'=>array('url'=>'https://mp.weixin.qq.com/s/b0N4ak05d_x97McOOBW3Bg','title'=>'第5集  谁是中本聪'),'5'=>array('url'=>'https://mp.weixin.qq.com/s/ycsm_lyVkgc2XBBhPEt_rA','title'=>'第6集  密码朋克是什么？'),'6'=>array('url'=>'http://mp.weixin.qq.com/s?__biz=Mzg2ODE5NTA2NQ==&mid=100000048&idx=1&sn=49fb938b17cc78f21a819edadc982d53&chksm=4eb14ea679c6c7b0fc43ed9b8a5e2e8a116c55b73e61d970bce380dfc184c4b0435a61058aff#rd','title'=>'第7集  比特币是怎么发行的？'),'7'=>array('url'=>'http://mp.weixin.qq.com/s?__biz=Mzg2ODE5NTA2NQ==&mid=100000092&idx=1&sn=8c2b78fcb86322878639f2aa4db54079&chksm=4eb14eca79c6c7dcecf67f354eba99dc40ee509ccb77973e62948b9e346448b95c303eb71eea#rd','title'=>'第8集  什么披萨居然卖到3亿元？'),'8'=>array('url'=>'http://mp.weixin.qq.com/s?__biz=Mzg2ODE5NTA2NQ==&mid=100000095&idx=1&sn=439aee1099afd5b053d6b8eb958b221e&chksm=4eb14ec979c6c7df12599ea55bcc95108fe56cc26d0351696efd5ac3d5194b66640cbaf81766#rd','title'=>'第9集  中本聪的继任者——加文·安德烈森'),'9'=>array('url'=>'http://mp.weixin.qq.com/s?__biz=Mzg2ODE5NTA2NQ==&mid=100000098&idx=1&sn=8a73f9718588dea489f549ffa0931636&chksm=4eb14ef479c6c7e2df6b62fd0546f7f4293eba0843c4eee90b06eba961b2d9de39b49474e2b3#rd','title'=>'第10集  比特币水龙头'),'10'=>array('url'=>'http://mp.weixin.qq.com/s?__biz=Mzg2ODE5NTA2NQ==&mid=100000101&idx=1&sn=1331a99f3c40c1231ada8505ed8ea136&chksm=4eb14ef379c6c7e586ef2135c68b5c2e7ab83ac6a56fe42fa26fdcca86788503f8d28eff7cd0#rd','title'=>'第11集  比特币为什么还没挖完？'),'11'=>array('url'=>'http://mp.weixin.qq.com/s?__biz=Mzg2ODE5NTA2NQ==&mid=100000104&idx=1&sn=599cbd7d1dab53b695aa12f03b6cfa7f&chksm=4eb14efe79c6c7e86b377efb48b2d4da5ee427774f8377545b15782e7c4edecd3038d6ceb61a#rd','title'=>'第12集  比特币如何实现总量恒定？'),'12'=>array('url'=>'http://mp.weixin.qq.com/s?__biz=Mzg2ODE5NTA2NQ==&mid=100000107&idx=1&sn=7462164cc3e56b89930acb51d98ac837&chksm=4eb14efd79c6c7eb5bfcce143be398a5b3ab080a5362e3233c1b875a2908c072d5ae0220c15a#rd','title'=>'第13集  比特币和Q币有哪些不同？'),'13'=>array('url'=>'http://mp.weixin.qq.com/s?__biz=Mzg2ODE5NTA2NQ==&mid=100000110&idx=1&sn=b955364b92a2c2ec72d45401b0288413&chksm=4eb14ef879c6c7ee54f7792dc669d8bc56e5bdff68bcb31c85ff82722b14645637c458946f64#rd','title'=>'第14集  各国对区块链资产的态度如何？'),'14'=>array('url'=>'http://mp.weixin.qq.com/s?__biz=Mzg2ODE5NTA2NQ==&mid=100000113&idx=1&sn=d4c6b8b19ffff8aef1bbb6cab01bd985&chksm=4eb14ee779c6c7f1781b20a6a1d490352495720d5e6ceadc784aabcab3a4d35f16e8c6fc3cf8#rd','title'=>'第15集  比特币怎么转账? '),'15'=>array('url'=>'http://mp.weixin.qq.com/s?__biz=Mzg2ODE5NTA2NQ==&mid=100000116&idx=1&sn=aedd7aafd166e6e008d115e3dc2a8612&chksm=4eb14ee279c6c7f4fcbc28243c4625c91ccbc7d87c05a4e9d7f0248e622dadd30c3893ed719e#rd','title'=>'第16集  比特币转账需要多少手续费？'),'16'=>array('url'=>'http://mp.weixin.qq.com/s?__biz=Mzg2ODE5NTA2NQ==&mid=100000119&idx=1&sn=93ec8b7ee819f3555507a41f9205dff3&chksm=4eb14ee179c6c7f7a24a09360aee29067b9b55adac3de586814cf12ee2e28d40734ff6cbddaf#rd','title'=>'第17集  区块链转账居然按字节收费？'),'17'=>array('url'=>'http://mp.weixin.qq.com/s?__biz=Mzg2ODE5NTA2NQ==&mid=100000122&idx=1&sn=e440a47dc68260c8938ce2cb229eb23f&chksm=4eb14eec79c6c7fab7b5493d8f114992b6c560cd536dc4b6ab7305bbea0920eb0d9ca2bd277f#rd','title'=>'第18集  比特币地址是什么？'),'18'=>array('url'=>'http://mp.weixin.qq.com/s?__biz=Mzg2ODE5NTA2NQ==&mid=100000125&idx=1&sn=3108ab8e067bfeb8006c5393e1e9fd19&chksm=4eb14eeb79c6c7fd4e241e07c9c60f42bfd402956c9fd9dcfcb33863f0f5f9e87fa4a9cfa58e#rd','title'=>'第19集  比特币节点是什么？'),'19'=>array('url'=>'http://mp.weixin.qq.com/s?__biz=Mzg2ODE5NTA2NQ==&mid=100000128&idx=1&sn=46ea92f4a74803a3de6bedaac73122aa&chksm=4eb14e1679c6c700dd5e7dece126ad422762e950ca6c512e8e644870cd33c2058a5b44124c11#rd','title'=>'第20集  从发出交易到矿工打包需要几步？'),'20'=>array('url'=>'http://mp.weixin.qq.com/s?__biz=Mzg2ODE5NTA2NQ==&mid=100000131&idx=1&sn=20ab30e1ffaec2ecf773982cc019c3e2&chksm=4eb14e1579c6c703a7bf974bb3aaaa69b9b1b734b174a9e3e9a00c84bc6207616cbcb20b9ad8#rd','title'=>'第21集  比特币的数字签名'),'21'=>array('url'=>'http://mp.weixin.qq.com/s?__biz=Mzg2ODE5NTA2NQ==&mid=100000134&idx=1&sn=cce7fdab32a8856247554b36ec5eeb81&chksm=4eb14e1079c6c70662ff1ce239bad174c0a7cf452b9f6605f7f98d324c67b5972c6d7acc0ff2#rd','title'=>'第22集  比特币交易和找零机制'),'22'=>array('url'=>'http://mp.weixin.qq.com/s?__biz=Mzg2ODE5NTA2NQ==&mid=100000137&idx=1&sn=fe78013fe1d67d372124a2dc8adfabf8&chksm=4eb14e1f79c6c709ace245c0c33bcee974329b108c582baf219470b1b16c62f762119969bf29#rd','title'=>'第23集  挖矿是什么？'),'23'=>array('url'=>'http://mp.weixin.qq.com/s?__biz=Mzg2ODE5NTA2NQ==&mid=100000140&idx=1&sn=8a283c520c1403e6db03be2e10148d62&chksm=4eb14e1a79c6c70cba8b94693db3d996b7ad55f89280bde05b02db97cf8e62e104cdcc2ee781#rd','title'=>'第24集  比特币怎么挖矿？'),'24'=>array('url'=>'http://mp.weixin.qq.com/s?__biz=Mzg2ODE5NTA2NQ==&mid=100000143&idx=1&sn=54fc92695251b06211531481a4388a37&chksm=4eb14e1979c6c70fee597ad12c2d753a7fc6edb5afe962c0c869824bf4e6e57437627c7ff507#rd','title'=>'第25集  矿工是怎么挖矿的？'),'25'=>array('url'=>'http://mp.weixin.qq.com/s?__biz=Mzg2ODE5NTA2NQ==&mid=100000146&idx=1&sn=b8cbbd89d34f389944fdf0d5808ed983&chksm=4eb14e0479c6c712be4a7437f346268f58fe7b8fad678fb1e368ee73bf1a5c8aedc2c74bf14e#rd','title'=>'第26集  矿机是什么？'),'26'=>array('url'=>'http://mp.weixin.qq.com/s?__biz=Mzg2ODE5NTA2NQ==&mid=100000149&idx=1&sn=04cd1f24c0a27225c609d0a032b1fea5&chksm=4eb14e0379c6c715a6453ce0903a534c4f2153afbd8e0de85b88ea66304833a2c58935ab8633#rd','title'=>'第27集  比特币挖矿机的进化史'),'27'=>array('url'=>'http://mp.weixin.qq.com/s?__biz=Mzg2ODE5NTA2NQ==&mid=100000152&idx=1&sn=718b0904690c29938d3f97c97cb32b1f&chksm=4eb14e0e79c6c7185063d5af0db443737319435aa46c1a175229ef5f262dd99d8f15dbdf7362#rd','title'=>'第28集  矿场长什么样？'),'28'=>array('url'=>'http://mp.weixin.qq.com/s?__biz=Mzg2ODE5NTA2NQ==&mid=100000155&idx=1&sn=8b11ed15ac49edefa9120c13304ca58a&chksm=4eb14e0d79c6c71b066ed617d3aa9e481d86e1ddd3f25faabe820c4bf09f24823b4009f6404d#rd','title'=>'第29集  矿池怎么挖矿？'),'29'=>array('url'=>'http://mp.weixin.qq.com/s?__biz=Mzg2ODE5NTA2NQ==&mid=100000158&idx=1&sn=dd6006e75c87ea14ef6b4f1e764cb70a&chksm=4eb14e0879c6c71e3755b6c783b9d3eaf0f5e6d4e2f6ea5d8436e8f531bbdeb6fd57f1121449#rd','title'=>'第30集  算力是什么？'),'30'=>array('url'=>'http://mp.weixin.qq.com/s?__biz=Mzg2ODE5NTA2NQ==&mid=100000161&idx=1&sn=2ebbe6cf006094087f84d02db1462447&chksm=4eb14e3779c6c721a897dcff8b96df7ac759e642230045f221c56ee608e3938dc9b9f875fdb3#rd','title'=>'第31集  竞争记账是什么？'),'31'=>array('url'=>'http://mp.weixin.qq.com/s?__biz=Mzg2ODE5NTA2NQ==&mid=100000164&idx=1&sn=ab29118b14577188aba12b85773d365b&chksm=4eb14e3279c6c724facf0e8f2918161d9e9aec3a8aa9b2adbee93eaea512a0022abacb9be7e4#rd','title'=>'第32集  如何投资区块链资产？'),'32'=>array('url'=>'http://mp.weixin.qq.com/s?__biz=Mzg2ODE5NTA2NQ==&mid=100000167&idx=1&sn=41990a3dd769b59fd8d47a15ee84d7bd&chksm=4eb14e3179c6c727870ba75c174cb4ff4b688299c8f5fba0591a0feec19973d546a1bd32199c#rd','title'=>'第33集  如何在交易平台投资区块链资产？'),'33'=>array('url'=>'http://mp.weixin.qq.com/s?__biz=Mzg2ODE5NTA2NQ==&mid=100000170&idx=1&sn=c4e4c78ec29b068c50c078493941af84&chksm=4eb14e3c79c6c72a0db5faeffe84f8e73f505670cf8d70a6f307110f04df4d4914a75814ef09#rd','title'=>'第34集  量化交易是什么？'),'34'=>array('url'=>'http://mp.weixin.qq.com/s?__biz=Mzg2ODE5NTA2NQ==&mid=100000173&idx=1&sn=ce774f5776603dc3b02c3b0a53e6ce91&chksm=4eb14e3b79c6c72d1a4f8bd9b68fd9b96a66e566eaa1a78d4936ae46db6ec29ece229e23272b#rd','title'=>'第35集  区块链资产如何在场外交易？'),'35'=>array('url'=>'http://mp.weixin.qq.com/s?__biz=Mzg2ODE5NTA2NQ==&mid=100000176&idx=1&sn=070a73327c88935b09b177d4623f1d61&chksm=4eb14e2679c6c73011bf38fcb66ca4ae6c9b9062d8f798770d3004c42ed29cabab0bf6488666#rd','title'=>'第36集  去中心化交易平台是什么？'),'36'=>array('url'=>'http://mp.weixin.qq.com/s?__biz=Mzg2ODE5NTA2NQ==&mid=100000179&idx=1&sn=87a70dd6ee9b605fd989ea67d0664cf7&chksm=4eb14e2579c6c7335963948f15f0a13a37e0197426eab2e229206c52f4176b771b26ec46e4b2#rd','title'=>'第37集  币币交易是什么? '),'37'=>array('url'=>'http://mp.weixin.qq.com/s?__biz=Mzg2ODE5NTA2NQ==&mid=100000182&idx=1&sn=49c74497e88f0a04d5eb59d23499b8b8&chksm=4eb14e2079c6c7368c9dcac9f65fc2076943a4b1979bbcf9ab001f3dc7a698486df6f185c652#rd','title'=>'第38集  比特币钱包是干嘛的？'),'38'=>array('url'=>'http://mp.weixin.qq.com/s?__biz=Mzg2ODE5NTA2NQ==&mid=100000185&idx=1&sn=88590d9f0236f5043590c5a2fef7c4a3&chksm=4eb14e2f79c6c739f8859d5413bedd993ce8db5a5aa1c4e88cb060c37dd071cf6d80f165fc01#rd','title'=>'第39集  冷钱包热钱包'),'39'=>array('url'=>'http://mp.weixin.qq.com/s?__biz=Mzg2ODE5NTA2NQ==&mid=100000188&idx=1&sn=818c95b898d965f34deab7c44d84f8d4&chksm=4eb14e2a79c6c73ce42db3726243dd73d335ad768f613350e694d4a9b6498eb90c8cb1f6f663#rd','title'=>'第40集  全节点钱包和轻钱包'),'40'=>array('url'=>'http://mp.weixin.qq.com/s?__biz=Mzg2ODE5NTA2NQ==&mid=100000191&idx=1&sn=48864e0d1a7f07a39f907a5758a88fe9&chksm=4eb14e2979c6c73f0820417e6ecaeeefe62fb80139fb20de0d81ed1d6e58460f376f696ed87f#rd','title'=>'第41集  比特币可以用于支付吗'),'41'=>array('url'=>'http://mp.weixin.qq.com/s?__biz=Mzg2ODE5NTA2NQ==&mid=100000194&idx=1&sn=f8b118df6a7bd8ea53bffe2acdea4051&chksm=4eb14e5479c6c742b32beb7f34e2f69fcc189b5d692a5ccae9d360bf071cd40c433d08038ddb#rd','title'=>'第42集  区块链和比特币是什么关系'),'42'=>array('url'=>'http://mp.weixin.qq.com/s?__biz=Mzg2ODE5NTA2NQ==&mid=100000197&idx=1&sn=ab7bf7bcc1b5349296b73ace070c518a&chksm=4eb14e5379c6c7458db4667fe23ae6eab02f114742c0686455781bc81701cb145401e53a4536#rd','title'=>'第43集  区块链技术的发展历史'),'43'=>array('url'=>'http://mp.weixin.qq.com/s?__biz=Mzg2ODE5NTA2NQ==&mid=100000200&idx=1&sn=1df9adca12af1a64344dd553418573f2&chksm=4eb14e5e79c6c748efc65189e1a5bf5fcb4a4eb2475950da440e6b2c064923b10788416fa13b#rd','title'=>'第44集  区块链，制造信用的机器'),'44'=>array('url'=>'http://mp.weixin.qq.com/s?__biz=Mzg2ODE5NTA2NQ==&mid=100000203&idx=1&sn=18d6fc40076145f1ce5854d71b92caea&chksm=4eb14e5d79c6c74b1f6684b08a65f97347534b5db30027707ca81c8d3b7f7904f68ba66e27f0#rd','title'=>'第45集  区块如何连接成区块链'),'45'=>array('url'=>'http://mp.weixin.qq.com/s?__biz=Mzg2ODE5NTA2NQ==&mid=100000206&idx=1&sn=706dc4817d8b29c95064b2acb64ad7ee&chksm=4eb14e5879c6c74e968ddc932173d67cf81009ab9b6c920bdd9a63009b582e5fface74d95a17#rd','title'=>'第46集  区块链记录哪些信息？'),'46'=>array('url'=>'http://mp.weixin.qq.com/s?__biz=Mzg2ODE5NTA2NQ==&mid=100000209&idx=1&sn=e06a02c58fe0dd1cf12cc319bb83e2e0&chksm=4eb14e4779c6c751884d9737d79e553fe74f745d054854e69d046c569845c6ce039532cfff10#rd','title'=>'第47集  时间戳是什么？'),'47'=>array('url'=>'http://mp.weixin.qq.com/s?__biz=Mzg2ODE5NTA2NQ==&mid=100000212&idx=1&sn=0f850316f00d1ab1222b255705d635e0&chksm=4eb14e4279c6c75420a625b2fe5c8cd65f12593602efd0f8fae14c14709ea024d8b86e392245#rd','title'=>'第48集  最长区块链才是正确的区块链？'),'48'=>array('url'=>'http://mp.weixin.qq.com/s?__biz=Mzg2ODE5NTA2NQ==&mid=100000215&idx=1&sn=e060ffff8b23e0d354a958481566851b&chksm=4eb14e4179c6c757ed65f13110e328b4e4d4c5ff1298806c9c34c158435c0f7167b2f99cdad2#rd','title'=>'第49集  区块链如何分类？'),'49'=>array('url'=>'http://mp.weixin.qq.com/s?__biz=Mzg2ODE5NTA2NQ==&mid=100000218&idx=1&sn=09ebc8b221035451b1b3b33b12bdc9c7&chksm=4eb14e4c79c6c75afef232a60a10ce509ada5fba675eb3addb135021058b232e00529256bc11#rd','title'=>'第50集  区块链资产的特点——全球流通'),'50'=>array('url'=>'http://mp.weixin.qq.com/s?__biz=Mzg2ODE5NTA2NQ==&mid=100000221&idx=1&sn=826f247f3021b3e99329bcbae81741bb&chksm=4eb14e4b79c6c75d0aca090fce8d6a2ba9da0efd05e49eca76eca2e4a982cd1351c4b651aecb#rd','title'=>'第51集  区块链资产的特点——匿名性'),'51'=>array('url'=>'http://mp.weixin.qq.com/s?__biz=Mzg2ODE5NTA2NQ==&mid=100000224&idx=1&sn=3702744b70dcd9034a07f0a3ec389e2f&chksm=4eb14e7679c6c76036de617f8cd1f9993531c31873706625016c38f82787ead3697642f1dbff#rd','title'=>'第52集  区块链资产的特点——去中心化记账'),'52'=>array('url'=>'http://mp.weixin.qq.com/s?__biz=Mzg2ODE5NTA2NQ==&mid=100000227&idx=1&sn=8f44f11c388a3028f20526ea44bf9851&chksm=4eb14e7579c6c763cc79c3af9abf73a15c8c5166f673ae7b99b341839bf1fd33f378a166ea2e#rd','title'=>'第53集  区块链资产的特点——不可复制'),'53'=>array('url'=>'http://mp.weixin.qq.com/s?__biz=Mzg2ODE5NTA2NQ==&mid=100000230&idx=1&sn=3257701cb60b57de5bf79817ccf32103&chksm=4eb14e7079c6c7668f756d0d5e18b8f4ca0b6ae011251244a4f29b17e9a0f0a6f53cb24d3607#rd','title'=>'第54集  区块链的共识机制是什么？'),'54'=>array('url'=>'http://mp.weixin.qq.com/s?__biz=Mzg2ODE5NTA2NQ==&mid=100000233&idx=1&sn=12f2a0ce17e0dbeeae7600acb6976def&chksm=4eb14e7f79c6c7691ed81e19eae6571dfe10b4445aa9e0aadb857513a5768db7f2ba78c9ffd2#rd','title'=>'第55集  工作量证明机制POW是什么？'),'55'=>array('url'=>'http://mp.weixin.qq.com/s?__biz=Mzg2ODE5NTA2NQ==&mid=100000236&idx=1&sn=86fe5a05984e484ca21c4b4f43c844aa&chksm=4eb14e7a79c6c76cc917e64cec7ca90a3087374259ccd2bbb048c008f05323fad0ad3d65eb90#rd','title'=>'第56集  权益证明机制PoS是什么？'),'56'=>array('url'=>'http://mp.weixin.qq.com/s?__biz=Mzg2ODE5NTA2NQ==&mid=100000239&idx=1&sn=49ebcea369d9f6f6672efe8fa894646c&chksm=4eb14e7979c6c76fe58dd1a250efaf91b1eac16b2a173be8d2b23d121feef85cc0f7513933a9#rd','title'=>'第57集  股份授权证明机制 DPoS 是什么？'),'57'=>array('url'=>'http://mp.weixin.qq.com/s?__biz=Mzg2ODE5NTA2NQ==&mid=100000242&idx=1&sn=b90d6fb4d5f0daf832a95a2517113216&chksm=4eb14e6479c6c772ba34358f9069a98b3121cd59dca0720c278f5f3d3981ba52fbacc99800e1#rd','title'=>'第58集  零知识证明是什么？'),'58'=>array('url'=>'http://mp.weixin.qq.com/s?__biz=Mzg2ODE5NTA2NQ==&mid=100000245&idx=1&sn=796d022da1fe28344ed823b97095af2f&chksm=4eb14e6379c6c7755d3c01b357848b380fcfbfc661ab04566bbc9b8839623dbedab560a5c036#rd','title'=>'第59集  哈希算法是什么？'),'59'=>array('url'=>'http://mp.weixin.qq.com/s?__biz=Mzg2ODE5NTA2NQ==&mid=100000248&idx=1&sn=c357f0aa8f0c9e181f4463867a1d4da3&chksm=4eb14e6e79c6c778053ea592eaca775ad2a8bcd9cf1ea789b4b58032863531a3c1a3b3ae984d#rd','title'=>'第60集  非对称加密算法是什么？'),'60'=>array('url'=>'http://mp.weixin.qq.com/s?__biz=Mzg2ODE5NTA2NQ==&mid=100000251&idx=1&sn=08e115e756818959b2de59a8f87bbc82&chksm=4eb14e6d79c6c77befc28264222d4f5468b0651c2bf8ab314a02f959de759e34953d0fbdfd54#rd','title'=>'区块链扩容是什么？ 区块链100问第61集'),'61'=>array('url'=>'http://mp.weixin.qq.com/s?__biz=Mzg2ODE5NTA2NQ==&mid=100000254&idx=1&sn=aa70f90170a5b0f267d04938754321d1&chksm=4eb14e6879c6c77e0119eb1e165c2f2baaf58a8458a69012d9b13cc13a932a5d4eb5ccaecf3f#rd','title'=>'第62集  比特币为什么要扩容？'),'62'=>array('url'=>'http://mp.weixin.qq.com/s?__biz=Mzg2ODE5NTA2NQ==&mid=100000257&idx=1&sn=066c287ced0d7f2bbda39a911c218b4d&chksm=4eb14d9779c6c4811ea7ed149088dd85cccf383bbd1556db5b5bce735f64156e6b5454687102#rd','title'=>'第63集  隔离见证是什么？'),'63'=>array('url'=>'http://mp.weixin.qq.com/s?__biz=Mzg2ODE5NTA2NQ==&mid=100000260&idx=1&sn=4d552e4a077ab48e37092aee9b1a493e&chksm=4eb14d9279c6c4848105628693a11d050d176c7e740fa24f945806c71f97e5071a86f3cd1123#rd','title'=>'第64集  区块链分叉是什么？'),'64'=>array('url'=>'http://mp.weixin.qq.com/s?__biz=Mzg2ODE5NTA2NQ==&mid=100000263&idx=1&sn=8b15ba4f5b2da069e8ba638f2cffd5f3&chksm=4eb14d9179c6c4871b53368c710a0f3ccabb584ff7054221641a3aedbb1c9da98b2a06f35c63#rd','title'=>'第65集  比特币生儿子了'),'65'=>array('url'=>'http://mp.weixin.qq.com/s?__biz=Mzg2ODE5NTA2NQ==&mid=100000266&idx=1&sn=e0a5885a188a586823820abfbba61f8f&chksm=4eb14d9c79c6c48a55cd59f31c9bf41b099869a4df1dd56a818f99711e9af909386b27a231a7#rd','title'=>'第66集  软分叉和硬分叉是什么？'),'66'=>array('url'=>'http://mp.weixin.qq.com/s?__biz=Mzg2ODE5NTA2NQ==&mid=100000269&idx=1&sn=a29b5c1d0be6f90fa45fcfc4a399746a&chksm=4eb14d9b79c6c48d4431952b97211b66884724c4bb0ba44f7b7d886283643430fe58b3ebed75#rd','title'=>'第67集  重放攻击是什么？'),'67'=>array('url'=>'http://mp.weixin.qq.com/s?__biz=Mzg2ODE5NTA2NQ==&mid=100000272&idx=1&sn=a5a0d49f11f1f31fddb2b664c3a3974f&chksm=4eb14d8679c6c4902586f8dac651aaef7dca01770d56a7e0df337b73afdb4d2636d396edd406#rd','title'=>'第68集  硬分叉的故事-以太经典ETC'),'68'=>array('url'=>'http://mp.weixin.qq.com/s?__biz=Mzg2ODE5NTA2NQ==&mid=100000275&idx=1&sn=e14577ec21d796024c81e0067a7c0f7f&chksm=4eb14d8579c6c49343626feb06517454a58bfb68b766f374d282f3ba54502e6886e8479c4ffe#rd','title'=>'第69集  区块链项目的分类和应用'),'69'=>array('url'=>'http://mp.weixin.qq.com/s?__biz=Mzg2ODE5NTA2NQ==&mid=100000278&idx=1&sn=430f2aacc31a2bf5f1fce71d4990c020&chksm=4eb14d8079c6c4967403b2a12d62b6295a5970ad0d5783561a928efbacdbc28dbcc5e1fbac97#rd','title'=>'第70集  区块链项目—币类'),'70'=>array('url'=>'http://mp.weixin.qq.com/s?__biz=Mzg2ODE5NTA2NQ==&mid=100000281&idx=1&sn=1c3fadb3b4731893a271173a011cbf5d&chksm=4eb14d8f79c6c4994e8ccf32517744aa0995487d51df9e25396442a36a9d72ee03e5f0d8518c#rd','title'=>'第71集  莱特币是什么？'),'71'=>array('url'=>'http://mp.weixin.qq.com/s?__biz=Mzg2ODE5NTA2NQ==&mid=100000284&idx=1&sn=838d58089a587ab5c56ce4dd906cb78f&chksm=4eb14d8a79c6c49c1086431200ccc0f0bb9eb44e9a06ac25c24c597b6d6ae912763166ed60e0#rd','title'=>'第72集  币类资产新经币'),'72'=>array('url'=>'http://mp.weixin.qq.com/s?__biz=Mzg2ODE5NTA2NQ==&mid=100000287&idx=1&sn=3a78bb3e07fb3b66818967d080f7ebcf&chksm=4eb14d8979c6c49f2375826a2dfcb03c250e38ba957bd735ff80f322e92b9ad28955b169dbc2#rd','title'=>'第73集  达世币Dash是什么？'),'73'=>array('url'=>'http://mp.weixin.qq.com/s?__biz=Mzg2ODE5NTA2NQ==&mid=100000290&idx=1&sn=d48a6f320be44914e8738d10aba1b810&chksm=4eb14db479c6c4a2f7cb32f61f059c57b54e9ee973f5c3a71edebdca4ead31b28a1fe6038bfd#rd','title'=>'第74集  匿名币类资产——门罗币Monero'),'74'=>array('url'=>'http://mp.weixin.qq.com/s?__biz=Mzg2ODE5NTA2NQ==&mid=100000293&idx=1&sn=c4afba5f9e2e9e26ba905430133d13b9&chksm=4eb14db379c6c4a54bb019e1cf2b322c2b3e23edb13bd591017dca61f54d30b1407a17a28851#rd','title'=>'第75集  匿名币类资产大零币Zcash'),'75'=>array('url'=>'http://mp.weixin.qq.com/s?__biz=Mzg2ODE5NTA2NQ==&mid=100000296&idx=1&sn=a165cf00948e65a4b5be8223951e1206&chksm=4eb14dbe79c6c4a88f108d67529c3f0cc9a99e029c9a31582eab028a0f17b7b6ce569b2584bb#rd','title'=>'第76集  区块链项目-平台类'),'76'=>array('url'=>'http://mp.weixin.qq.com/s?__biz=Mzg2ODE5NTA2NQ==&mid=100000299&idx=1&sn=b7867e6185ce5c58c07b77427de16500&chksm=4eb14dbd79c6c4ab01562d99886c22ac957c41450c65361f7df3828a7ec3eccb38b4828392b5#rd','title'=>'第77集  以太坊是什么？'),'77'=>array('url'=>'http://mp.weixin.qq.com/s?__biz=Mzg2ODE5NTA2NQ==&mid=100000302&idx=1&sn=2274bee4a04a60e3c156a8de81550a06&chksm=4eb14db879c6c4ae464d53df656a5e973cb21159e6a3dbe396bfc1d907bc91d64069675c3198#rd','title'=>'第78集  EOS是什么？'),'78'=>array('url'=>'http://mp.weixin.qq.com/s?__biz=Mzg2ODE5NTA2NQ==&mid=100000305&idx=1&sn=cc1cd3e3093f24ba2514dbf4fd2a6707&chksm=4eb14da779c6c4b187be8f60989e3c2d1e36cf4db5610720b1b7579ee152506ac7e180acc84d#rd','title'=>'第79集  平台类项目之以太坊'),'79'=>array('url'=>'http://mp.weixin.qq.com/s?__biz=Mzg2ODE5NTA2NQ==&mid=100000308&idx=1&sn=612aec5cc08839670658f1e21e430938&chksm=4eb14da279c6c4b4d9bfa2de2708e2d2512aadecd38180b9a6e61a5092fe8497d6c30bb732ed#rd','title'=>'第80集  区块链项目——应用类'),'80'=>array('url'=>'http://mp.weixin.qq.com/s?__biz=Mzg2ODE5NTA2NQ==&mid=100000311&idx=1&sn=52c7b7c6251f973e0ebd674fae3c32f6&chksm=4eb14da179c6c4b7821e9c5be97f20d3929dc9e0d0be97acb6350be978b195b72b080d38fcd8#rd','title'=>'第81集  应用类项目—Augur'),'81'=>array('url'=>'http://mp.weixin.qq.com/s?__biz=Mzg2ODE5NTA2NQ==&mid=100000314&idx=1&sn=1f2e00ad6965da08bd664e80b2594b47&chksm=4eb14dac79c6c4ba57590e30ee101a013e49c478ba75589b2edaf35b5e099f584f63ad2afe6e#rd','title'=>'第82集  应用类项目—Golem'),'82'=>array('url'=>'http://mp.weixin.qq.com/s?__biz=Mzg2ODE5NTA2NQ==&mid=100000317&idx=1&sn=b54c43d961ef75a0bb00a36c7f7b83b4&chksm=4eb14dab79c6c4bde77f2c999161a2bb9f83b7a5c7ab2882a80c5f2e9c367b2ed07b359696d0#rd','title'=>'第83集  区块链项目——资产代币化'),'83'=>array('url'=>'http://mp.weixin.qq.com/s?__biz=Mzg2ODE5NTA2NQ==&mid=100000320&idx=1&sn=d0b0cb10dcd4cea1a484c7c3efeff713&chksm=4eb14dd679c6c4c0cd885f96728644a9121a8e3756806273a81a51b2e00317f235e8d7d53ede#rd','title'=>'第84集  资产代币化——对标黄金的Digix'),'84'=>array('url'=>'http://mp.weixin.qq.com/s?__biz=Mzg2ODE5NTA2NQ==&mid=100000323&idx=1&sn=a06cb8acecb0ebbd3b3f11b6f0da8c11&chksm=4eb14dd579c6c4c31cf0800c613fd2f2be7b7450b64966ddb4c5c1e471e5a7ce60d00bdb5051#rd','title'=>'第85集  资产代币化——对标美元的USDT'),'85'=>array('url'=>'http://mp.weixin.qq.com/s?__biz=Mzg2ODE5NTA2NQ==&mid=100000326&idx=1&sn=82fa0d6b399885013e7077693c3ed644&chksm=4eb14dd079c6c4c65ca9879695f635b533fe1c10168456dd442a38559bbf5efb3d92818fb66d#rd','title'=>'第86集  山寨币和竞争币是什么？'),'86'=>array('url'=>'http://mp.weixin.qq.com/s?__biz=Mzg2ODE5NTA2NQ==&mid=100000329&idx=1&sn=1599d6f0bc4ee58455534d23043eecc7&chksm=4eb14ddf79c6c4c915fa3cc89e517cee4f3507fd12a237030f2180ee7fcb02e4dbc39f3d8f8d#rd','title'=>'第87集  区块链能像互联网一样改变世界'),'87'=>array('url'=>'http://mp.weixin.qq.com/s?__biz=Mzg2ODE5NTA2NQ==&mid=100000332&idx=1&sn=3ed4be50cd2484aa47aa457f45c27e1f&chksm=4eb14dda79c6c4cc6de80c8956f37fe4d893b709cdc944543c362eff9af78c4ca9db204c0713#rd','title'=>'第88集  区块链有哪些缺点？'),'88'=>array('url'=>'http://mp.weixin.qq.com/s?__biz=Mzg2ODE5NTA2NQ==&mid=100000335&idx=1&sn=2ecd55a13e2dcc55d93843fd907710aa&chksm=4eb14dd979c6c4cf1e06aa531b1cfc95a43d796e8ac5ae8e1a21ab6c01d56a52c3c5fd6bd37c#rd','title'=>'第89集  区块链适合应用于哪些领域？'),'89'=>array('url'=>'http://mp.weixin.qq.com/s?__biz=Mzg2ODE5NTA2NQ==&mid=100000338&idx=1&sn=e9c54dc6a514d35bbd0479c448656b14&chksm=4eb14dc479c6c4d2c7af3890165c03d25d2f89106259cbddf37633161584173651d9e7528275#rd','title'=>'第90集  目前的区块链联盟盘点'));


		$app = model('User');
		$signPackage = $app->share();
		$this->assign('signPackage',$signPackage);
		$this->assign('data',$data);
		return $this->fetch('answer');
	}
	public function sign(){
		$app = model('User');
		$uid = Session::get('uid');
		$user = $app->get($uid);
		if(!$user){
			$res = $app->login();
		}
		$m = model('Sign');
		$data = $m->display();
		$data['count'] = sprintf("%03d", $data['count']);

		$data['count'] = str_split($data['count']);
		// var_dump($arr);exit;
		// $data['count'] = array_count_values($arr);

		$this->assign('data',$data);
		return $this->fetch('sign');
	}
	public function signorder(){
		$app = model('User');
		$uid = Session::get('uid');
		$user = $app->get($uid);
		if(!$user){
			$res = $app->login();
		}
		$m = model('Sign');
		$data = $m->paixu();
		$this->assign('data',$data);
		return $this->fetch('signorder');
	}
	public function mobile(){
		$app = model('User');
		$uid = Session::get('uid');
		$user = $app->get($uid);
		if(!$user){
			$res = $app->login();
		}
		return $this->fetch('mobile');
	}

	public function signact(){
		$m = model('Sign');
		return $m->sign();
	}

	public function checkmobile(){
		$m = model('User');
		return $m->checkmobile();
	}
	public function addmobile(){
		$m = model('User');
		return $m->addmobile();
	}

	public function record(){
		$m = model('BuncleRecord');
		$list = $m->getlist();
		$this->assign('list',$list);
		$app = model('User');
		$uid = Session::get('uid');
		$user = $app->get($uid);
		if(!$user){
			$res = $app->login();
		}
		$uid = Session::get('uid');
		$user = $app->get($uid);;
		$this->assign('member',$user);
		return $this->fetch('record');
	}

	public function mbtc(){
		$app = model('User');
		$uid = Session::get('uid');
		$user = $app->get($uid);
		if(!$user){
			$res = $app->login();
		}
		$uid = Session::get('uid');
		$user = $app->get($uid);
		if($user['buncle']>=1000){
			$number =($user['buncle']-$user['buncle']%1000)/1000;
		}else{
			$number = 0;
		}
		$m = model('Mbtc');
		$list = $m->search();
		$this->assign('list',$list);
		$this->assign('user',$user);
		$this->assign('number',$number);
		return $this->fetch('mbtc');
	}
	public function activity(){
		return $this->fetch('activity');
	}
	public function mbtcadd(){
		$app = model('Mbtc');
		return $app->add();
	}
}