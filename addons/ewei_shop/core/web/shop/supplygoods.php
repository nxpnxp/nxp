<?php
if (!defined('IN_IA')) {
    exit('Access Denied');
}
global $_W, $_GPC;
$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
$shopset  = m('common')->getSysset('shop');

if ($operation == 'post') {
	$id = intval($_GPC['id']);
    if (!empty($id)){
		 $goods = pdo_fetch("SELECT * FROM " . tablename('ewei_shop_supply_goods') . " WHERE id = :id", array(
            ':id' => $id
        ));
		$params = pdo_fetchall("SELECT * FROM " . tablename('ewei_shop_supply_goods_param') . " WHERE goods_id = :goodsid", array(
            ':goodsid' => $goods['id']
        ));
	}
	if(isset($_POST['act']) && $_POST['act']=='chk'){
	$data    = array(
	'ccate'=>intval($_GPC['ccate']),
	'id'=>intval($_GPC['id']),
	'status'=>intval($_GPC['status']),
	'reply'=>$_GPC['reply'],
	);
	if($data['status']==1){
		$paramTitle = $_POST['title1'];
		$paramValue = $_POST['value1'];
		foreach($paramTitle as $k=>$v){
			$arr = array();
			$arr['title']=$v;
			$arr['value']=$paramValue[$k];
			$arr['goodsid'] = intval($_GPC['id']);
			pdo_insert('ewei_shop_goods_param', $arr);
		}
		$gdata = array();
		$gdata['title'] = trim($_GPC['title']);
		$gdata['ccate'] = intval($_GPC['ccate']);
		$gdata['pcate'] = 6;
		$gdata['aid'] = $_GPC['aid'];
		$gdata['thumb'] = 'http://6s.weidianpu.net.cn/supply/Public/Uploads/'.$_GPC['thumb'];
		$gdata['content'] = $_GPC['content'];
		$gdata['goodssn'] = $_GPC['goodssn'];
		$gdata['marketprice'] = $_GPC['marketprice'];
		$gdata['productprice'] = $_GPC['productprice'];
		$gdata['status'] = 1;
		$gdata['uniacid'] = 8;
		$gdata['createtime'] = time();
		pdo_insert('ewei_shop_goods', $gdata);
	}
     pdo_update('ewei_shop_supply_goods', $data, array(
                'id' => $data['id']
            ));
	 message('商品审核成功！', $this->createWebUrl('shop/supplygoods', array(
            'op' => 'post',
            'id' => $data['id']
        )), 'success');
	}
}elseif ($operation == 'display'){
$sql = "select id,phone from ".tablename('ewei_shop_supply_apply').' WHERE `status` = :status'." ORDER BY id DESC";
$applies = pdo_fetchall($sql,array('status'=>2));

$pindex  = max(1, intval($_GPC['page']));
$psize   = 20;
$condition = ' WHERE 1 ';
if (!empty($_GPC['keyword'])) {
        $_GPC['keyword'] = trim($_GPC['keyword']);
        $condition .= ' AND `title` LIKE :title';
        $params[':title'] = '%' . trim($_GPC['keyword']) . '%';
    }
if (isset($_GPC['status']) && $_GPC['status']!=-1) {
        $condition .= ' AND `status` = :status';
        $params[':status'] = intval($_GPC['status']);
}

if (isset($_GPC['aid']) && $_GPC['aid']!=0) {
        $condition .= ' AND `aid` = :aid';
        $params[':aid'] = intval($_GPC['aid']);
}

$sql   = 'SELECT COUNT(*) FROM ' . tablename('ewei_shop_supply_goods') . $condition;
$total = pdo_fetchcolumn($sql, $params);

$sql      = 'SELECT * FROM ' . tablename('ewei_shop_supply_goods') . $condition . ' ORDER BY id DESC LIMIT ' . ($pindex - 1) * $psize . ',' . $psize;
$sgoods = pdo_fetchall($sql, $params);
$pager = pagination($total, $pindex, $psize);
	}



load()->func('tpl');
include $this->template('web/shop/supplygoods');