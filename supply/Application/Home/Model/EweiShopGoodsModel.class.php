<?php
namespace Home\Model;
use Think\Model;
class EweiShopGoodsModel extends Model 
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
	
	
}

