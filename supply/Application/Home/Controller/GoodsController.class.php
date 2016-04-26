<?php
namespace Home\Controller;
use Think\Controller;
class GoodsController extends Controller {
	private $model = null;
	public function __construct()
	{
		parent::__construct();
		$aname = session('aname');
		if(!$aname){
			$this->error("请先登录",U('index/index'));
		}
		$this->model = D('EweiShopSupplyGoods');
	}
    public function index(){
		$data = $this->model->search();
		foreach($data['data'] as $k=>$v){
			if($v['status']==0){
				$data['data'][$k]['status'] = '审核中...';
			}elseif($v['status']==0){
				$data['data'][$k]['status'] = '审核通过';
			}else{
				$data['data'][$k]['status'] = '未过审，查看原因';
			}
		}
		$this->assign('goods',$data);
        $this->display();
    }
	public function detail()
	{
		$id = I('get.id');
		$goods = $this->model->find($id);
		$params = M("EweiShopSupplyGoodsParam")->where(array('goods_id'=>$id))->select();
		$this->assign('param',$params);
		$this->assign('goods',$goods);
		$this->display();
	}
	public function add(){

       if(IS_POST){
		   if(!session('aid')){
			   $this->error("请先登录",U('index/index'));
		   }
		   if($this->model->create(I('post.'), 1))
			{
				// 插入到数据库中
				if($this->model->add())  // 在add()里又先调用了_before_insert方法
				{
					// 显示成功信息并等待1秒之后跳转
					$this->success("添加成功",U('Home/Goods/index'));
					exit;
				}
			}
			// 如果走到 这说明上面失败了在这里处理失败的请求
			// 从模型中取出失败的原因
			$error = $model->getError();
			// 由控制器显示错误信息,并在3秒跳回上一个页面
			$this->error($error);
	   }
       $this->display();
	}
	public function edit()
	{
		$id = I('get.id');
		$goods = $this->model->where(array('id'=>$id))->find();
		$this->assign('goods',$goods);
		$params = M("EweiShopSupplyGoodsParam")->where(array('goods_id'=>$id))->select();
		$this->assign('param',$params);
		if(IS_POST){
			if($this->model->create(I('post.'), 2))
			{
				if(FALSE !== $this->model->save())  // save()的返回值是，如果失败返回false,如果成功返回受影响的条数【如果修改后和修改前相同就会返回0】
				{
					$this->success('操作成功！', U('index'));
					exit;
				}
			}
			$error = $this->model->getError();
			$this->error($error);
		}
		$gpData = $gpModel = D("EweiShopSupplyGoodsImgs")->where(array('goods_id'=>$id))->select();
		$this->assign('gpData',$gpData);
		$this->display();
	}
	
	// 处理AJAX删除图片的请求
	public function ajaxDelPic()
	{
		$picId = I('get.picid');
		// 根据ID从硬盘上数据删除中删除图片
		$gpModel = D("EweiShopSupplyGoodsImgs");
		$pic = $gpModel->field('url')->find($picId);
		// 从硬盘删除图片
		 @unlink('./Public/Uploads/'.$pic['url']);
		// 从数据库中删除记录
		$gpModel->delete($picId);
	}
	
	public function delAll()
	{
       $ids = implode(',',I('post.ids'));
	   if($ids){
	   $gpModel = D("EweiShopSupplyGoodsImgs");
	   $gpData = $gpModel->where("goods_id in ($ids)")->select();
	   if($gpData){
		   foreach($gpData as $k=>$v){
			  @unlink('./Public/Uploads/'.$v['url']); 
		   }
		   $gpModel->where("goods_id in ($ids)")->delete();
	   }
	   $param = D("EweiShopSupplyGoodsParam");
	   $paramData = $param->where("goods_id in ($ids)")->select();
	   if($paramData){
		  $param->where("goods_id in ($ids)")->delete();
	   }
	   $data = $this->model->field("thumb")->where("id in ($ids)")->select(); 
	   foreach($data as $k=>$v){
		 @unlink('./Public/Uploads/'.$v['thumb']);

	   }
	   $this->model->where("id in ($ids)")->delete();
	   }
	   redirect(U('index'));
	}
	public function delete()
	{
		
		if(FALSE !== $this->model->delete(I('get.id'))){
			$this->success('删除成功！', U('index'));
			exit;
		}
		else 
			$this->error('删除失败！原因：'.$model->getError());
	}
}