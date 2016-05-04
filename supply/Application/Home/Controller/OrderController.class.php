<?php
namespace Home\Controller;
use Think\Controller;
class OrderController extends Controller {
	public function __construct()
	{
		parent::__construct();
		$this->order = D("EweiShopOrder");
	}
    public function index(){
		$aid = session('aid');
		$where = "aid = $aid";
		if(IS_POST){
			$fa = strtotime($_POST['fa']);
			$ta = strtotime($_POST['ta']);
            $where .= " and finishtime between $fa and $ta";
		}
		$order = $this->order->search($where);
		foreach($order['data'] as $k=>$v){
			if($v['status']==0){
				$order['data'][$k]['status']='待支付';
				}elseif($v['status']==1){
					$order['data'][$k]['status']='待发货';
					}elseif($v['status']==-1){
					$order['data'][$k]['status']='已关闭';
					}elseif($v['status']==2){
					$order['data'][$k]['status']='待收货';
					}elseif($v['status']==3){
					$order['data'][$k]['status']='已完成';
					}
			}
        $this->assign('order',$order['data']);
		$this->assign('page',$order['page']);
        $this->display();
    }
	
	//订单详情
	public function orderdetail()
	{
		$id = I("get.id");
		$order = $this->order->find($id);
		if($order['status']==0){
				$order['status']='待支付';
				}elseif($order['status']==1){
					$order['status']='待发货';
					}elseif($order['status']==-1){
					$order['status']='已关闭';
					}elseif($order['status']==2){
					$order['status']='待收货';
					}elseif($order['status']==3){
					$order['status']='已完成';
					}
		$addr = D('EweiShopMemberAddress');
		$address = $addr->where(array('id'=>$order['addressid']))->find();
		$og = D('EweiShopOrderGoods');
		$g = D('EweiShopGoods');
		$goods = $og->where(array('orderid'=>$order['id']))->select();
		foreach($goods as $k=>$v){
			$_goods = $g->field("title,thumb")->where(array('id'=>$v['goodsid']))->find();
			$goods[$k]['title'] = $_goods['title'];
			$goods[$k]['thumb'] = $_goods['thumb'];
			}
		if(IS_POST){
		   $data = array();
		   $id = I('post.id');
		   $data['express'] = I('post.express');
		   $data['expresscom'] = I('post.expresscom');
		   $data['expresssn'] = I('post.expresssn');
		   $data['sendtime'] = time();
		   $data['status'] = 2;
		   if(empty($data['express'])){
			   $this->error("请选择快递");
		   }
		   if(empty($data['expresssn'])){
			   $this->error("请输入快递单号");
		   }
		   if(FALSE !== $this->order->where(array('id'=>$id))->save($data)){
		       $this->success('发货成功！', U('orderdetail',array('id'=>$id)));
					exit;
		   }
		}
		$this->assign('goods',$goods);
		$this->assign('address',$address);
		$this->assign('order',$order);
		$this->display();
	}
	//取消发货
	public function cancel()
	{
		$id = I("get.id");
		$data['express'] = '';
		$data['expresscom'] = '';
		$data['expresssn'] = '';
		$data['sendtime'] = '';
		$data['status'] = 1;
		 if(FALSE !== $this->order->where(array('id'=>$id))->save($data)){
		       $this->success('取消发货成功！', U('orderdetail',array('id'=>$id)));
					exit;
		   }
	}
}