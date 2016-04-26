<?php
if (!defined('IN_IA')) {
    exit('Access Denied');
}
global $_W, $_GPC;

$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
if ($operation == 'display') {
    
    $list = pdo_fetchall("SELECT * FROM " . tablename('ewei_shop_supply_apply') );

} elseif ($operation == 'shenhe1') {
	//审核通过
	$pwd = make_password(10);
    pdo_update('ewei_shop_supply_apply', array(
                'status' => $_GPC['status'],
                'pwd' => $pwd
            ), array(
                'id' => $_GPC['id']
            ));
	
	$mid = pdo_fetch('select mid,phone,pwd from '. tablename('ewei_shop_supply_apply').' where id='.$_GPC['id']);
	$info = pdo_fetch('select openid from '. tablename('ewei_shop_member').' where id='.$mid['mid']);
	$openid = $info['openid'];
	$message = '您的供应商申请已通过，请前往供应商平台登陆并上传商品。您的账号为：'.$mid['phone'].',密码为：'.$mid['pwd'].'。';
    $msg     = array(
        'keyword1' => array(
            'value' => '申请供应商通知',
            "color" => "#73a68d"
        ),
        'keyword2' => array(
            'value' => $message,
            "color" => "#73a68d"
        )
    );
    m('message')->sendCustomNotice($openid, $msg);		
	
	message('供应商审核通过！', $this->createWebUrl('shop/supply', array(
            'op' => 'display'
        )), 'success');
} elseif ($operation == 'shenhe2') {
	//审核不通过
    pdo_update('ewei_shop_supply_apply', array(
                'status' => $_GPC['status']
            ), array(
                'id' => $_GPC['id']
            ));
	$mid = pdo_fetch('select mid from '. tablename('ewei_shop_supply_apply').' where id='.$_GPC['id']);
	$info = pdo_fetch('select openid from '. tablename('ewei_shop_member').' where id='.$mid['mid']);
	$openid = $info['openid'];
	$message = '您的供应商申请未通过。';
    $msg     = array(
        'keyword1' => array(
            'value' => '申请供应商通知',
            "color" => "#73a68d"
        ),
        'keyword2' => array(
            'value' => $message,
            "color" => "#73a68d"
        )
    );
    m('message')->sendCustomNotice($openid, $msg);	
	message('供应商审核不通过！', $this->createWebUrl('shop/supply', array(
            'op' => 'display'
        )), 'success');
}
load()->func('tpl');
include $this->template('web/shop/supply');