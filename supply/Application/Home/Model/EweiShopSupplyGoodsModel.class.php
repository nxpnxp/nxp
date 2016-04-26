<?php
namespace Home\Model;
use Think\Model;
class EweiShopSupplyGoodsModel extends Model 
{
	
  public function search($where=1) 
  {
		$pagecount  = 20;
		$totalCount = $this->where($where)->count();
		$page = new \Think\Page($totalCount,$pagecount);
		$page->parameter = I('get.'); //此处的row是数组，为了传递查询条件
		$page->setConfig('first','首页');
		$page->setConfig('prev','上一页');
		$page->setConfig('next','下一页');
		$page->setConfig('last','尾页');
		$page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% 第 '.I('p',1).' 页/共 %TOTAL_PAGE% 页 ( '.$pagecount.' 条/页 共 %TOTAL_ROW% 条)');
		return array(
		'data'=>$this->where($where)->limit($page->firstRow, $page->listRows)->order("id desc")->select(),
		'page'=>$page->show()
		); 
	}
	
	protected function _before_insert(&$data, $option)
	{
		if(!I('post.goodssn')){
		   $d = date('d:H:i:s');
		   $d = str_replace(':','',$d);
		   $data['goodssn'] = dechex(rand(1,15)).$d;
		}
		if($_FILES['thumb']['error'] == 0)
		{
			$ret = uploadOne('thumb', 'Goods', array(
				array(350, 350),
			));
            $data['thumb'] = $ret['images'][0];
            $data['date'] = time();
			$data['aid'] = session('aid');
		}
	}
	
	protected function _after_insert($data, $option)
	{
		
		/************ 处理商品属性的代码 **************/
		$aTitle = I('post.param_title');
		$aValue = I('post.param_value');
		if($aTitle){
			$param = D("EweiShopSupplyGoodsParam");
			$_data = array();
			foreach($aTitle as $k=>$v){
				$_data['goods_id'] = $data['id'];
				$_data['title'] = $v;
				$_data['value'] = $aValue[$k];
				$param->add($_data);
			}
		}
		
		/************ 处理相册图片 *****************/
		if(isset($_FILES['pic']))
		{
			$pics = array();
			foreach ($_FILES['pic']['name'] as $k => $v)
			{
				$pics[] = array(
					'name' => $v,
					'type' => $_FILES['pic']['type'][$k],
					'tmp_name' => $_FILES['pic']['tmp_name'][$k],
					'error' => $_FILES['pic']['error'][$k],
					'size' => $_FILES['pic']['size'][$k],
				);
			}
			$_FILES = $pics;  // 把处理好的数组赋给$_FILES，因为uploadOne函数是到$_FILES中找图片
			$gpModel = D("EweiShopSupplyGoodsImgs");
			// 循环每个上传
			foreach ($pics as $k => $v)
			{
				if($v['error'] == 0)
				{
					$ret = uploadOne($k, 'Goods', array(
						array(350, 350),
					));
					if($ret['ok'] == 1)
					{
						$gpModel->add(array(
							'url' => $ret['images'][0],
							'goods_id' => $data['id'],
						));
					}
				}
			}
		}
		
	}
	protected function _before_update(&$data, $option)
	{
		$id = $option['where']['id'];
		$aTitle = I('post.param_title');
		$aValue = I('post.param_value');
		if($aTitle){
			$param = D("EweiShopSupplyGoodsParam");
			$param->where(array('goods_id'=>$id))->delete();
			$_data = array();
			foreach($aTitle as $k=>$v){
				$_data['goods_id'] = $id;
				$_data['title'] = $v;
				$_data['value'] = $aValue[$k];
				$param->add($_data);
			}
		}
		if($_FILES['thumb']['error'] == 0)
		{
			$ret = uploadOne('thumb', 'Goods', array(
				array(350, 350),
			));
            $data['thumb'] = $ret['images'][0];
            $data['date'] = time();
			$images = $this->field('thumb')->find($option['where']['id']);
		    deleteImage($images);
		}
		
		/************ 处理相册图片 *****************/
		if(isset($_FILES['pic']))
		{
			$pics = array();
			foreach ($_FILES['pic']['name'] as $k => $v)
			{
				$pics[] = array(
					'name' => $v,
					'type' => $_FILES['pic']['type'][$k],
					'tmp_name' => $_FILES['pic']['tmp_name'][$k],
					'error' => $_FILES['pic']['error'][$k],
					'size' => $_FILES['pic']['size'][$k],
				);
			}
			$_FILES = $pics;  // 把处理好的数组赋给$_FILES，因为uploadOne函数是到$_FILES中找图片
			$gpModel = D("EweiShopSupplyGoodsImgs");
			// 循环每个上传
			foreach ($pics as $k => $v)
			{
				if($v['error'] == 0)
				{
					$ret = uploadOne($k, 'Goods', array(
						array(350, 350),
					));
					if($ret['ok'] == 1)
					{
						$gpModel->add(array(
							'url' => $ret['images'][0],
							'goods_id' => $id,
						));
					}
				}
			}
		}
		
		
	}
// 删除前
	protected function _before_delete($option)
	{
		if(is_array($option['where']['id']))
		{
			$this->error = '不支持批量删除';
			return FALSE;
		}
		$images = $this->field('thumb')->find($option['where']['id']);
		deleteImage($images);
		$gpModel = D("EweiShopSupplyGoodsImgs");
		$gpData = $gpModel->where(array('goods_id'=>$option['where']['id']))->select();
		if($gpData){
			foreach($gpData as $k=>$v){
				@unlink('./Public/Uploads/'.$v['url']);
			}
			$gpModel->where(array('goods_id'=>$option['where']['id']))->delete();
		}
		$param = D("EweiShopSupplyGoodsParam");
		$paramData = $param->where(array('goods_id'=>$option['where']['id']))->select();
		if($paramData){
			$param->where(array('goods_id'=>$option['where']['id']))->delete();
		}
	}	
	
}

