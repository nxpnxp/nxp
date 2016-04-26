<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
		if(IS_POST){
			$user = I('post.user');
			$pwd = I('post.password');
			$model = M("EweiShopSupplyApply");
			$info = $model->where(array('phone'=>$user))->find();
			if($info){
				if($info['pwd']==$pwd){
					session('aname',$info['phone']);
					session('aid',$info['id']);
					redirect(U("Home/Goods/index"));
				}else{
					$this->error("密码错误");
				}
			}else{
				$this->error("用户不存在");
			}
		}
        $this->display();
    }
	public function getPwd(){
		$str = '';
		for($i=0;$i<4;$i++){
			$str .= dechex(rand(1,15));
		}
        echo $str;
	}
	public function loginout()
	{
		session('aname',null);
		$this->success("退出成功",U('index/index'));
	}
}