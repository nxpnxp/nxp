<?php
global $_W, $_GPC;
$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
//print_r('bbs:///');print_r($operation);exit;
//$normal_order_list = pdo_fetchall('SELECT * FROM ' . tablename('ewei_shop_printer') . ' WHERE uniacid = :uniacid and printertype=0 order by isdefault desc', array(':uniacid' => $_W['uniacid']));
//$express_order_list = pdo_fetchall('SELECT * FROM ' . tablename('ewei_shop_printer') . ' WHERE uniacid = :uniacid and printertype=1 order by isdefault desc', array(':uniacid' => $_W['uniacid']));
//print_r('<pre>');print_r($normal_order_list);print_r('<pre>');print_r($express_order_list);exit;
if ($operation == 'display') {

    $sql = "select id,phone,ca_name from ".tablename('ewei_shop_supply_apply').' WHERE `status` = :status'." ORDER BY id DESC";
    $applies = pdo_fetchall($sql,array('status'=>2)); 
	 
	 $pindex  = max(1, intval($_GPC['page']));
     $psize   = 20;
     $condition = ' WHERE o.deleted=0 and o.status=3 and aid<>0';
	 
	 if (empty($starttime) || empty($endtime)) {
        $starttime = strtotime('-1 month');
        $endtime   = time();
    }
    
    if (!empty($_GPC['time'])) {
        $starttime = strtotime($_GPC['time']['start']);
        $endtime   = strtotime($_GPC['time']['end']);
        if ($_GPC['searchtime'] == '1') {
            $condition .= " AND o.finishtime >= :starttime AND o.finishtime <= :endtime ";
            $paras[':starttime'] = $starttime;
            $paras[':endtime']   = $endtime;
        }
    }
	
	if (isset($_GPC['aid']) && $_GPC['aid']!=0) {
        $condition .= ' AND `aid` = :aid';
        $params[':aid'] = intval($_GPC['aid']);
    }
	
    $sql   = 'SELECT COUNT(*) FROM ' .  tablename('ewei_shop_order'). " o left join" . tablename('ewei_shop_order_goods'). " og on o.id = og.orderid left join "  . tablename('ewei_shop_goods') . " g on og.goodsid = g.id " . $condition;
    $total = pdo_fetchcolumn($sql, $params);
	
	$sql = "select o.* ,g.aid,g.aname from " . tablename('ewei_shop_order'). " o left join" . tablename('ewei_shop_order_goods'). " og on o.id = og.orderid left join "  . tablename('ewei_shop_goods') . " g on og.goodsid = g.id " . $condition . "  ORDER BY o.finishtime DESC LIMIT ";
	$sql .= ($pindex - 1) * $psize . ',' . $psize;
	//echo $sql;
	 $list  = pdo_fetchall($sql,$paras);
	 $pager = pagination($total, $pindex, $psize);
	//print_r($list);
    load()->func('tpl');
    include $this->template('web/order/supplyorder');
    exit;
} 