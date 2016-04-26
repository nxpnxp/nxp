<?php
if (!defined('IN_IA')) {
    exit('Access Denied');
}
global $_W, $_GPC;
$openid = m('user')->getOpenid();
$member = m('member')->getInfo($openid);


if ($_W['isajax']) {
		
	$apply = pdo_fetch('select * from ' . tablename('ewei_shop_supply_apply') . " where mid=:mid limit 1", array(
            ':mid' => $_GPC['mid']
        ));
	$ret           = array();
	if (!empty($apply)) {
		$ret['return1'] = 1;
		if($apply['status'] == 1){
			$ret['status'] = 2;
		}elseif($apply['status'] == 2){
			$ret['status'] = 1;
		}
	}else{
		$ret['return1'] = 0;
		if ($_W['ispost']) {
			$data          = array(
	           	   'mid'=> $_GPC['mid'],
                   'ca_name'=> $_GPC['ca_name'],
                   'name'=> $_GPC['name'],
                   'phone'=>  $_GPC['phone'],
                   'addr'=>  $_GPC['addr'],
                   'product'=>  $_GPC['product'],
                   'img1'=>  $_GPC['img1'],
                   'img2'=>  $_GPC['img2'],
                   'status'=>  1,
                   'applytime'=> time()
	        );
	        pdo_insert('ewei_shop_supply_apply', $data);
			$id = pdo_insertid();
			$ret['status'] = 2;
//			if(!empty($id)){
//				$openid = m('user')->getOpenid();
//				$message = '折随时随';
//              $msg     = array(
//                  'keyword1' => array(
//                      'value' => '申请供应商通知',
//                      "color" => "#73a68d"
//                  ),
//                  'keyword2' => array(
//                      'value' => $message,
//                      "color" => "#73a68d"
//                  )
//              );
//              
//              m('message')->sendCustomNotice($openid, $msg);
//			}
		}
	}
	  
    show_json(1, $ret);
}
include $this->template('member/supply');