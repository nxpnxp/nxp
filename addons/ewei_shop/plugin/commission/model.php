<?php
if (!defined('IN_IA')) {
    exit('Access Denied');
}
define('TM_COMMISSION_AGENT_NEW', 'commission_agent_new');
define('TM_COMMISSION_ORDER_PAY', 'commission_order_pay');
define('TM_COMMISSION_ORDER_FINISH', 'commission_order_finish');
define('TM_COMMISSION_APPLY', 'commission_apply');
define('TM_COMMISSION_CHECK', 'commission_check');
define('TM_COMMISSION_PAY', 'commission_pay');
define('TM_COMMISSION_UPGRADE', 'commission_upgrade');
define('TM_COMMISSION_BECOME', 'commission_become');
if (!class_exists('CommissionModel')) {
    class CommissionModel extends PluginModel
    {
        public function getSet()
        {
            $set          = parent::getSet();
            $set['texts'] = array(
                'agent' => empty($set['texts']['agent']) ? '分销商' : $set['texts']['agent'],
                'shop' => empty($set['texts']['shop']) ? '小店' : $set['texts']['shop'],
                'myshop' => empty($set['texts']['myshop']) ? '我的小店' : $set['texts']['myshop'],
                'center' => empty($set['texts']['center']) ? '分销中心' : $set['texts']['center'],
                'become' => empty($set['texts']['become']) ? '成为分销商' : $set['texts']['become'],
                'withdraw' => empty($set['texts']['withdraw']) ? '提现' : $set['texts']['withdraw'],
                'commission' => empty($set['texts']['commission']) ? '佣金' : $set['texts']['commission'],
                'commission1' => empty($set['texts']['commission1']) ? '分销佣金' : $set['texts']['commission1'],
                'commission_total' => empty($set['texts']['commission_total']) ? '累计佣金' : $set['texts']['commission_total'],
                'commission_ok' => empty($set['texts']['commission_ok']) ? '可提现佣金' : $set['texts']['commission_ok'],
                'commission_apply' => empty($set['texts']['commission_apply']) ? '已申请佣金' : $set['texts']['commission_apply'],
                'commission_check' => empty($set['texts']['commission_check']) ? '待打款佣金' : $set['texts']['commission_check'],
                'commission_lock' => empty($set['texts']['commission_lock']) ? '未结算佣金' : $set['texts']['commission_lock'],
                'commission_detail' => empty($set['texts']['commission_detail']) ? '佣金明细' : $set['texts']['commission_detail'],
                'commission_pay' => empty($set['texts']['commission_pay']) ? '成功提现佣金' : $set['texts']['commission_pay'],
                'order' => empty($set['texts']['order']) ? '分销订单' : $set['texts']['order'],
                'myteam' => empty($set['texts']['myteam']) ? '我的团队' : $set['texts']['myteam'],
                'c1' => empty($set['texts']['c1']) ? '一级' : $set['texts']['c1'],
                'c2' => empty($set['texts']['c2']) ? '二级' : $set['texts']['c2'],
                'c3' => empty($set['texts']['c3']) ? '三级' : $set['texts']['c3'],
                'mycustomer' => empty($set['texts']['mycustomer']) ? '我的下线' : $set['texts']['mycustomer']
            );
            return $set;
        }
        public function calculate($orderid = 0, $update = true)
        {
            global $_W;
            $set    = $this->getSet();
            $levels = $this->getLevels();
            $goods  = pdo_fetchall("select og.id,og.cateid,og.realprice,og.total,g.fx1,g.fx2,g.fx3,g.fx6 from " . tablename('ewei_shop_order_goods') . '  og ' . ' left join ' . tablename('ewei_shop_goods') . ' g on g.id = og.goodsid' . ' where og.orderid=:orderid and og.uniacid=:uniacid', array(
                ':orderid' => $orderid,
                ':uniacid' => $_W['uniacid']
            ));
            
            foreach ($goods as &$cinfo) {
                
				$arr = array(1,2,5);
				if(in_array($cinfo['cateid'], $arr)){
					$xi = pdo_fetch('select * from '.tablename('ewei_shop_category_commission'). ' where cateid='.$cinfo['cateid']);
				
					$price = $cinfo['realprice'];
	                   
                    $cinfo['commission1'] = array(
                        'default' =>  round($xi['commission1'] * $cinfo['total'], 2) 
                    );
                    $cinfo['commission2'] = array(
                        'default' =>  round($xi['commission2'] * $cinfo['total'], 2) 
                    );
                    $cinfo['commission3'] = array(
                        'default' =>  round($xi['commission3'] * $cinfo['total'], 2) 
                    );
					$cinfo['commission4'] = array(
                        'default' =>  round($xi['commission4'] * $cinfo['total'], 2) 
                    );
					$cinfo['commission5'] = array(
                        'default' =>  round($xi['commission5'] * $cinfo['total'], 2) 
                    );
					$cinfo['commission6'] = array(
                        'default' =>  round($xi['commission6'] * $cinfo['total'], 2) 
                    );
	                   
					
				}else {
					
					if( empty($cinfo['fx1']) && empty($cinfo['fx2']) && empty($cinfo['fx3']) && empty($cinfo['fx6']) ){
							
						$xi = pdo_fetch('select * from '.tablename('ewei_shop_category_commission'). ' where cateid=5');
						$cinfo['commission1'] = array(
	                        'default' =>  round($xi['commission1'] * $cinfo['total'], 2) 
	                    );
	                    $cinfo['commission2'] = array(
	                        'default' =>  round($xi['commission2'] * $cinfo['total'], 2) 
	                    );
	                    $cinfo['commission3'] = array(
	                        'default' =>  round($xi['commission3'] * $cinfo['total'], 2) 
	                    );
						$cinfo['commission4'] = array(
	                        'default' =>  round($xi['commission4'] * $cinfo['total'], 2) 
	                    );
						$cinfo['commission5'] = array(
	                        'default' =>  round($xi['commission5'] * $cinfo['total'], 2) 
	                    );
						$cinfo['commission6'] = array(
	                        'default' =>  round($xi['commission6'] * $cinfo['total'], 2) 
	                    );
						
					}else{
						
						$cinfo['commission1'] = array(
	                        'default' =>  round($cinfo['fx1'] * $cinfo['total'], 2) 
	                    );
	                    $cinfo['commission2'] = array(
	                        'default' =>  round($cinfo['fx2'] * $cinfo['total'], 2) 
	                    );
	                    $cinfo['commission3'] = array(
	                        'default' =>  round($cinfo['fx3'] * $cinfo['total'], 2) 
	                    );
						$cinfo['commission4'] = array(
	                        'default' =>  round(0, 2) 
	                    );
						$cinfo['commission5'] = array(
	                        'default' =>  round(0, 2) 
	                    );
						$cinfo['commission6'] = array(
	                        'default' =>  round($cinfo['fx6'] * $cinfo['total'], 2) 
	                    );
						
					}
					
//                  $cinfo['commission1'] = array(
//                      'default' => 0
//                  );
//                  $cinfo['commission2'] = array(
//                      'default' => 0
//                  );
//                  $cinfo['commission3'] = array(
//                      'default' => 0
//                  );
//					$cinfo['commission4'] = array(
//                      'default' => 0
//                  );
//					$cinfo['commission5'] = array(
//                      'default' => 0
//                  );
//					$cinfo['commission6'] = array(
//                      'default' => 0
//                  );
//                  foreach ($levels as $level) {
//                      $cinfo['commission1']['level' . $level['id']] = 0;
//                      $cinfo['commission2']['level' . $level['id']] = 0;
//                      $cinfo['commission3']['level' . $level['id']] = 0;
//                      $cinfo['commission4']['level' . $level['id']] = 0;
//                      $cinfo['commission5']['level' . $level['id']] = 0;
//                      $cinfo['commission6']['level' . $level['id']] = 0;
//                  }
                }
                if ($update) {
                    pdo_update('ewei_shop_order_goods', array(
                        'commission1' => iserializer($cinfo['commission1']),
                        'commission2' => iserializer($cinfo['commission2']),
                        'commission3' => iserializer($cinfo['commission3']),
                        'commission4' => iserializer($cinfo['commission4']),
                        'commission5' => iserializer($cinfo['commission5']),
                        'commission6' => iserializer($cinfo['commission6']),
                        'nocommission' => $cinfo['nocommission']
                    ), array(
                        'id' => $cinfo['id']
                    ));
                }
            }
            unset($cinfo);
            
            return $goods;
        }
        public function getInfo($openid, $options = null)
        {
            if (empty($options) || !is_array($options)) {
                $options = array();
            }
            global $_W;
            $set              = $this->getSet();
            $level            = intval($set['level']);
            $member           = m('member')->getInfo($openid);
			
			
			$f2c_pu = pdo_fetchcolumn('select COUNT(og.realprice) from '.tablename('ewei_shop_order').' o left join '.tablename('ewei_shop_order_goods').' og on o.id=og.orderid where o.uniacid=:uniacid and o.openid=:openid and o.status=:status and og.cateid not in (1,2,8) ', array(
				':uniacid' => $_W['uniacid'],
				':openid' => $openid,
				':status' => 3
			)); 
			
			$f2c_gold = pdo_fetchcolumn('select COUNT(og.realprice) from '.tablename('ewei_shop_order').' o left join '.tablename('ewei_shop_order_goods').' og on o.id=og.orderid where o.uniacid=:uniacid and o.openid=:openid and o.status=:status and og.cateid=8 ', array(
				':uniacid' => $_W['uniacid'],
				':openid' => $openid,
				':status' => 3
			));
			
			
            $agentLevel       = $this->getLevel($openid);
            $time             = time();
            $day_times        = intval($set['settledays']) * 3600 * 24;
            $agentcount       = 0;
            $ordercount0      = 0;
            $ordermoney0      = 0;
            $ordercount       = 0;
            $ordermoney       = 0;
            $ordercount3      = 0;
            $ordermoney3      = 0;
            $commission_total = 0;
            $commission_ok    = 0;
            $commission_apply = 0;
            $commission_check = 0;
            $commission_lock  = 0;
            $commission_pay   = 0;
            $level1           = 0;
            $level2           = 0;
            $level3           = 0;
			$level4           = 0;
            $level5           = 0;
            $level6           = 0;
            $order10          = 0;
            $order20          = 0;
            $order30          = 0;
            $order1           = 0;
            $order2           = 0;
            $order3           = 0;
            $order13          = 0;
            $order23          = 0;
            $order33          = 0;
            if ($level >= 1) {
                if (in_array('ordercount0', $options)) {
                    $level1_ordercount = pdo_fetch('select sum(og.realprice) as ordermoney,count(distinct o.id) as ordercount from ' . tablename('ewei_shop_order') . ' o ' . ' left join  ' . tablename('ewei_shop_order_goods') . ' og on og.orderid=o.id ' . ' where o.agentid=:agentid and o.status>=0 and og.status1>=0 and og.nocommission=0 and o.uniacid=:uniacid  limit 1', array(
                        ':uniacid' => $_W['uniacid'],
                        ':agentid' => $member['id']
                    ));
                    $order10 += $level1_ordercount['ordercount'];
                    $ordercount0 += $level1_ordercount['ordercount'];
                    $ordermoney0 += $level1_ordercount['ordermoney'];
                }
                if (in_array('ordercount', $options)) {
                    $level1_ordercount = pdo_fetch('select sum(og.realprice) as ordermoney,count(distinct o.id) as ordercount from ' . tablename('ewei_shop_order') . ' o ' . ' left join  ' . tablename('ewei_shop_order_goods') . ' og on og.orderid=o.id ' . ' where o.agentid=:agentid and o.status>=1 and og.status1>=0 and og.nocommission=0 and o.uniacid=:uniacid  limit 1', array(
                        ':uniacid' => $_W['uniacid'],
                        ':agentid' => $member['id']
                    ));
                    $order1 += $level1_ordercount['ordercount'];
                    $ordercount += $level1_ordercount['ordercount'];
                    $ordermoney += $level1_ordercount['ordermoney'];
                }
                if (in_array('ordercount3', $options)) {
                    $level1_ordercount3 = pdo_fetch('select sum(og.realprice) as ordermoney,count(distinct o.id) as ordercount from ' . tablename('ewei_shop_order') . ' o ' . ' left join  ' . tablename('ewei_shop_order_goods') . ' og on og.orderid=o.id ' . ' where o.agentid=:agentid and o.status>=3 and og.status1>=0 and og.nocommission=0 and o.uniacid=:uniacid  limit 1', array(
                        ':uniacid' => $_W['uniacid'],
                        ':agentid' => $member['id']
                    ));
                    $order13 += $level1_ordercount3['ordercount'];
                    $ordercount3 += $level1_ordercount3['ordercount'];
                    $ordermoney3 += $level1_ordercount3['ordermoney'];
                }
                if (in_array('total', $options)) {
                    $level1_commissions = pdo_fetchall('select og.commission1  from ' . tablename('ewei_shop_order_goods') . ' og ' . ' left join  ' . tablename('ewei_shop_order') . ' o on o.id = og.orderid' . " where o.agentid=:agentid and o.status>=1 and og.nocommission=0 and o.uniacid=:uniacid", array(
                        ':uniacid' => $_W['uniacid'],
                        ':agentid' => $member['id']
                    ));
                    foreach ($level1_commissions as $c) {
                        $commission = iunserializer($c['commission1']);
                        $commission_total += $commission['default'];
                    }
                }
                if (in_array('ok', $options)) {
                    $level1_commissions = pdo_fetchall('select og.commission1  from ' . tablename('ewei_shop_order_goods') . ' og ' . ' left join  ' . tablename('ewei_shop_order') . ' o on o.id = og.orderid' . " where o.agentid=:agentid and o.status>=3 and og.nocommission=0 and ({$time} - o.createtime > {$day_times}) and og.status1=0  and o.uniacid=:uniacid", array(
                        ':uniacid' => $_W['uniacid'],
                        ':agentid' => $member['id']
                    ));
                    foreach ($level1_commissions as $c) {
                        $commission = iunserializer($c['commission1']);
                        $commission_ok += $commission['default'];
                    }
                }
                if (in_array('lock', $options)) {
                    $level1_commissions1 = pdo_fetchall('select og.commission1  from ' . tablename('ewei_shop_order_goods') . ' og ' . ' left join  ' . tablename('ewei_shop_order') . ' o on o.id = og.orderid' . " where o.agentid=:agentid and o.status>=3 and og.nocommission=0 and ({$time} - o.createtime <= {$day_times})  and og.status1=0  and o.uniacid=:uniacid", array(
                        ':uniacid' => $_W['uniacid'],
                        ':agentid' => $member['id']
                    ));
                    foreach ($level1_commissions1 as $c) {
                        $commission = iunserializer($c['commission1']);
                        $commission_lock += isset($commission['level' . $agentLevel['id']]) ? $commission['level' . $agentLevel['id']] : $commission['default'];
                    }
                }
                if (in_array('apply', $options)) {
                    $level1_commissions2 = pdo_fetchall('select og.commission1  from ' . tablename('ewei_shop_order_goods') . ' og ' . ' left join  ' . tablename('ewei_shop_order') . ' o on o.id = og.orderid' . " where o.agentid=:agentid and o.status>=3 and og.status1=1 and og.nocommission=0 and o.uniacid=:uniacid", array(
                        ':uniacid' => $_W['uniacid'],
                        ':agentid' => $member['id']
                    ));
                    foreach ($level1_commissions2 as $c) {
                        $commission = iunserializer($c['commission1']);
                        $commission_apply += isset($commission['level' . $agentLevel['id']]) ? $commission['level' . $agentLevel['id']] : $commission['default'];
                    }
                }
                if (in_array('check', $options)) {
                    $level1_commissions2 = pdo_fetchall('select og.commission1  from ' . tablename('ewei_shop_order_goods') . ' og ' . ' left join  ' . tablename('ewei_shop_order') . ' o on o.id = og.orderid' . " where o.agentid=:agentid and o.status>=3 and og.status1=2 and og.nocommission=0 and o.uniacid=:uniacid ", array(
                        ':uniacid' => $_W['uniacid'],
                        ':agentid' => $member['id']
                    ));
                    foreach ($level1_commissions2 as $c) {
                        $commission = iunserializer($c['commission1']);
                        $commission_check += isset($commission['level' . $agentLevel['id']]) ? $commission['level' . $agentLevel['id']] : $commission['default'];
                    }
                }
                if (in_array('pay', $options)) {
                    $level1_commissions2 = pdo_fetchall('select og.commission1  from ' . tablename('ewei_shop_order_goods') . ' og ' . ' left join  ' . tablename('ewei_shop_order') . ' o on o.id = og.orderid' . " where o.agentid=:agentid and o.status>=1 and og.status1=3 and og.nocommission=0 and o.uniacid=:uniacid ", array(
                        ':uniacid' => $_W['uniacid'],
                        ':agentid' => $member['id']
                    ));
                    foreach ($level1_commissions2 as $c) {
                        $commission = iunserializer($c['commission1']);
                        $commission_pay += $commission['default'];
                    }
                }
                $level1_agentids = pdo_fetchall('select id from ' . tablename('ewei_shop_member') . ' where agentid=:agentid and isagent=1 and status=1 and uniacid=:uniacid ', array(
                    ':uniacid' => $_W['uniacid'],
                    ':agentid' => $member['id']
                ), 'id');
                $level1          = count($level1_agentids);
                $agentcount += $level1;
            }
            if ($level >= 2) {
                if ($level1 > 0) {
                    if (in_array('ordercount0', $options)) {
                        $level2_ordercount = pdo_fetch('select sum(og.realprice) as ordermoney,count(distinct o.id) as ordercount from ' . tablename('ewei_shop_order') . ' o ' . ' left join  ' . tablename('ewei_shop_order_goods') . ' og on og.orderid=o.id ' . ' where o.agentid in( ' . implode(',', array_keys($level1_agentids)) . ')  and o.status>=0 and og.status2>=0 and og.nocommission=0 and o.uniacid=:uniacid limit 1', array(
                            ':uniacid' => $_W['uniacid']
                        ));
                        $order20 += $level2_ordercount['ordercount'];
                        $ordercount0 += $level2_ordercount['ordercount'];
                        $ordermoney0 += $level1_ordercount['ordermoney'];
                    }
                    if (in_array('ordercount', $options)) {
                        $level2_ordercount = pdo_fetch('select sum(og.realprice) as ordermoney,count(distinct o.id) as ordercount from ' . tablename('ewei_shop_order') . ' o ' . ' left join  ' . tablename('ewei_shop_order_goods') . ' og on og.orderid=o.id ' . ' where o.agentid in( ' . implode(',', array_keys($level1_agentids)) . ')  and o.status>=1 and og.status2>=0 and og.nocommission=0 and o.uniacid=:uniacid limit 1', array(
                            ':uniacid' => $_W['uniacid']
                        ));
                        $order2 += $level2_ordercount['ordercount'];
                        $ordercount += $level2_ordercount['ordercount'];
                        $ordermoney += $level1_ordercount['ordermoney'];
                    }
                    if (in_array('ordercount3', $options)) {
                        $level2_ordercount3 = pdo_fetch('select sum(og.realprice) as ordermoney,count(distinct o.id) as ordercount from ' . tablename('ewei_shop_order') . ' o ' . ' left join  ' . tablename('ewei_shop_order_goods') . ' og on og.orderid=o.id ' . ' where o.agentid in( ' . implode(',', array_keys($level1_agentids)) . ')  and o.status>=3 and og.status2>=0 and og.nocommission=0 and o.uniacid=:uniacid limit 1', array(
                            ':uniacid' => $_W['uniacid']
                        ));
                        $order23 += $level2_ordercount3['ordercount'];
                        $ordercount3 += $level2_ordercount3['ordercount'];
                        $ordermoney3 += $level1_ordercount3['ordermoney'];
                    }
                    if (in_array('total', $options)) {
                        $level2_commissions = pdo_fetchall('select commission2  from ' . tablename('ewei_shop_order_goods') . ' og ' . ' left join  ' . tablename('ewei_shop_order') . ' o on o.id = og.orderid ' . ' where o.agentid in( ' . implode(',', array_keys($level1_agentids)) . ")  and o.status>=1 and og.nocommission=0 and o.uniacid=:uniacid", array(
                            ':uniacid' => $_W['uniacid']
                        ));
                        foreach ($level2_commissions as $c) {
                            $commission = iunserializer($c['commission2']);
                            $commission_total += $commission['default'];
                        }
                    }
                    if (in_array('ok', $options)) {
                        $level2_commissions = pdo_fetchall('select commission2  from ' . tablename('ewei_shop_order_goods') . ' og ' . ' left join  ' . tablename('ewei_shop_order') . ' o on o.id = og.orderid ' . ' where o.agentid in( ' . implode(',', array_keys($level1_agentids)) . ")  and ({$time} - o.createtime > {$day_times}) and o.status>=3 and og.status2=0 and og.nocommission=0  and o.uniacid=:uniacid", array(
                            ':uniacid' => $_W['uniacid']
                        ));
                        foreach ($level2_commissions as $c) {
                            $commission = iunserializer($c['commission2']);
                            $commission_ok += $commission['default'];
                        }
                    }
                    if (in_array('lock', $options)) {
                        $level2_commissions1 = pdo_fetchall('select commission2  from ' . tablename('ewei_shop_order_goods') . ' og ' . ' left join  ' . tablename('ewei_shop_order') . ' o on o.id = og.orderid ' . ' where o.agentid in( ' . implode(',', array_keys($level1_agentids)) . ")  and ({$time} - o.createtime <= {$day_times}) and og.status2=0 and o.status>=3 and og.nocommission=0 and o.uniacid=:uniacid", array(
                            ':uniacid' => $_W['uniacid']
                        ));
                        foreach ($level2_commissions1 as $c) {
                            $commission = iunserializer($c['commission2']);
                            $commission_lock += isset($commission['level' . $agentLevel['id']]) ? $commission['level' . $agentLevel['id']] : $commission['default'];
                        }
                    }
                    if (in_array('apply', $options)) {
                        $level2_commissions2 = pdo_fetchall('select commission2  from ' . tablename('ewei_shop_order_goods') . ' og ' . ' left join  ' . tablename('ewei_shop_order') . ' o on o.id = og.orderid ' . ' where o.agentid in( ' . implode(',', array_keys($level1_agentids)) . ")  and o.status>=3 and og.status2=1 and og.nocommission=0 and o.uniacid=:uniacid", array(
                            ':uniacid' => $_W['uniacid']
                        ));
                        foreach ($level2_commissions2 as $c) {
                            $commission = iunserializer($c['commission2']);
                            $commission_apply += isset($commission['level' . $agentLevel['id']]) ? $commission['level' . $agentLevel['id']] : $commission['default'];
                        }
                    }
                    if (in_array('check', $options)) {
                        $level2_commissions3 = pdo_fetchall('select commission2  from ' . tablename('ewei_shop_order_goods') . ' og ' . ' left join  ' . tablename('ewei_shop_order') . ' o on o.id = og.orderid ' . ' where o.agentid in( ' . implode(',', array_keys($level1_agentids)) . ")  and o.status>=3 and og.status2=2 and og.nocommission=0 and o.uniacid=:uniacid", array(
                            ':uniacid' => $_W['uniacid']
                        ));
                        foreach ($level2_commissions3 as $c) {
                            $commission = iunserializer($c['commission2']);
                            $commission_check += isset($commission['level' . $agentLevel['id']]) ? $commission['level' . $agentLevel['id']] : $commission['default'];
                        }
                    }
                    if (in_array('pay', $options)) {
                        $level2_commissions3 = pdo_fetchall('select commission2  from ' . tablename('ewei_shop_order_goods') . ' og ' . ' left join  ' . tablename('ewei_shop_order') . ' o on o.id = og.orderid ' . ' where o.agentid in( ' . implode(',', array_keys($level1_agentids)) . ")  and o.status>=1 and og.status2=3 and og.nocommission=0 and o.uniacid=:uniacid", array(
                            ':uniacid' => $_W['uniacid']
                        ));
                        foreach ($level2_commissions3 as $c) {
                            $commission = iunserializer($c['commission2']);
                            $commission_pay += $commission['default'];
                        }
                    }
                    $level2_agentids = pdo_fetchall('select id from ' . tablename('ewei_shop_member') . ' where agentid in( ' . implode(',', array_keys($level1_agentids)) . ') and isagent=1 and status=1 and uniacid=:uniacid', array(
                        ':uniacid' => $_W['uniacid']
                    ), 'id');
                    $level2          = count($level2_agentids);
                    $agentcount += $level2;
                }
            }
            if ($level >= 3) {
                if ($level2 > 0) {
                    if (in_array('ordercount0', $options)) {
                        $level3_ordercount = pdo_fetch('select sum(og.realprice) as ordermoney,count(distinct og.orderid) as ordercount from ' . tablename('ewei_shop_order') . ' o ' . ' left join  ' . tablename('ewei_shop_order_goods') . ' og on og.orderid=o.id ' . ' where o.agentid in( ' . implode(',', array_keys($level2_agentids)) . ')  and o.status>=0 and og.status3>=0 and og.nocommission=0 and o.uniacid=:uniacid limit 1', array(
                            ':uniacid' => $_W['uniacid']
                        ));
                        $order30 += $level3_ordercount['ordercount'];
                        $ordercount0 += $level3_ordercount['ordercount'];
                        $ordermoney0 += $level3_ordercount['ordermoney'];
                    }
                    if (in_array('ordercount', $options)) {
                        $level3_ordercount = pdo_fetch('select sum(og.realprice) as ordermoney,count(distinct og.orderid) as ordercount from ' . tablename('ewei_shop_order') . ' o ' . ' left join  ' . tablename('ewei_shop_order_goods') . ' og on og.orderid=o.id ' . ' where o.agentid in( ' . implode(',', array_keys($level2_agentids)) . ')  and o.status>=1 and og.status3>=0 and og.nocommission=0 and o.uniacid=:uniacid limit 1', array(
                            ':uniacid' => $_W['uniacid']
                        ));
                        $order3 += $level3_ordercount['ordercount'];
                        $ordercount += $level3_ordercount['ordercount'];
                        $ordermoney += $level3_ordercount['ordermoney'];
                    }
                    if (in_array('ordercount3', $options)) {
                        $level3_ordercount3 = pdo_fetch('select sum(og.realprice) as ordermoney,count(distinct og.orderid) as ordercount from ' . tablename('ewei_shop_order') . ' o ' . ' left join  ' . tablename('ewei_shop_order_goods') . ' og on og.orderid=o.id ' . ' where o.agentid in( ' . implode(',', array_keys($level2_agentids)) . ')  and o.status>=3 and og.status3>=0 and og.nocommission=0 and o.uniacid=:uniacid limit 1', array(
                            ':uniacid' => $_W['uniacid']
                        ));
                        $order33 += $level3_ordercount3['ordercount'];
                        $ordercount3 += $level3_ordercount3['ordercount'];
                        $ordermoney3 += $level3_ordercount3['ordermoney'];
                    }
                    if (in_array('total', $options)) {
                        $level3_commissions = pdo_fetchall('select commission3  from ' . tablename('ewei_shop_order_goods') . ' og ' . ' left join  ' . tablename('ewei_shop_order') . ' o on o.id = og.orderid' . ' where o.agentid in( ' . implode(',', array_keys($level2_agentids)) . ")  and o.status>=1 and og.nocommission=0 and o.uniacid=:uniacid", array(
                            ':uniacid' => $_W['uniacid']
                        ));
                        foreach ($level3_commissions as $c) {
                            $commission = iunserializer($c['commission3']);
                            $commission_total += $commission['default'];
                        }
                    }
                    if (in_array('ok', $options)) {
                        $level3_commissions = pdo_fetchall('select commission3  from ' . tablename('ewei_shop_order_goods') . ' og ' . ' left join  ' . tablename('ewei_shop_order') . ' o on o.id = og.orderid' . ' where o.agentid in( ' . implode(',', array_keys($level2_agentids)) . ")  and ({$time} - o.createtime > {$day_times}) and o.status>=3 and og.status3=0  and og.nocommission=0 and o.uniacid=:uniacid", array(
                            ':uniacid' => $_W['uniacid']
                        ));
                        foreach ($level3_commissions as $c) {
                            $commission = iunserializer($c['commission3']);
                            $commission_ok += $commission['default'];
                        }
                    }
                    if (in_array('lock', $options)) {
                        $level3_commissions1 = pdo_fetchall('select commission3  from ' . tablename('ewei_shop_order_goods') . ' og ' . ' left join  ' . tablename('ewei_shop_order') . ' o on o.id = og.orderid' . ' where o.agentid in( ' . implode(',', array_keys($level2_agentids)) . ")  and o.status>=3 and ({$time} - o.createtime > {$day_times}) and og.status3=0  and og.nocommission=0 and o.uniacid=:uniacid", array(
                            ':uniacid' => $_W['uniacid']
                        ));
                        foreach ($level3_commissions1 as $c) {
                            $commission = iunserializer($c['commission3']);
                            $commission_lock += isset($commission['level' . $agentLevel['id']]) ? $commission['level' . $agentLevel['id']] : $commission['default'];
                        }
                    }
                    if (in_array('apply', $options)) {
                        $level3_commissions2 = pdo_fetchall('select commission3  from ' . tablename('ewei_shop_order_goods') . ' og ' . ' left join  ' . tablename('ewei_shop_order') . ' o on o.id = og.orderid' . ' where o.agentid in( ' . implode(',', array_keys($level2_agentids)) . ")  and o.status>=3 and og.status3=1 and og.nocommission=0 and o.uniacid=:uniacid", array(
                            ':uniacid' => $_W['uniacid']
                        ));
                        foreach ($level3_commissions2 as $c) {
                            $commission = iunserializer($c['commission3']);
                            $commission_lock += isset($commission['level' . $agentLevel['id']]) ? $commission['level' . $agentLevel['id']] : $commission['default'];
                        }
                    }
                    if (in_array('check', $options)) {
                        $level3_commissions3 = pdo_fetchall('select commission3  from ' . tablename('ewei_shop_order_goods') . ' og ' . ' left join  ' . tablename('ewei_shop_order') . ' o on o.id = og.orderid' . ' where o.agentid in( ' . implode(',', array_keys($level2_agentids)) . ")  and o.status>=3 and og.status3=2 and og.nocommission=0 and o.uniacid=:uniacid", array(
                            ':uniacid' => $_W['uniacid']
                        ));
                        foreach ($level3_commissions3 as $c) {
                            $commission = iunserializer($c['commission3']);
                            $commission_check += isset($commission['level' . $agentLevel['id']]) ? $commission['level' . $agentLevel['id']] : $commission['default'];
                        }
                    }
                    if (in_array('pay', $options)) {
                        $level3_commissions3 = pdo_fetchall('select commission3  from ' . tablename('ewei_shop_order_goods') . ' og ' . ' left join  ' . tablename('ewei_shop_order') . ' o on o.id = og.orderid' . ' where o.agentid in( ' . implode(',', array_keys($level2_agentids)) . ")  and o.status>=1 and og.status3=3 and og.nocommission=0 and o.uniacid=:uniacid", array(
                            ':uniacid' => $_W['uniacid']
                        ));
                        foreach ($level3_commissions3 as $c) {
                            $commission = iunserializer($c['commission3']);
                            $commission_pay += $commission['default'];
                        }
                    }
                    $level3_agentids = pdo_fetchall('select id from ' . tablename('ewei_shop_member') . ' where uniacid=:uniacid and agentid in( ' . implode(',', array_keys($level2_agentids)) . ') and isagent=1 and status=1', array(
                        ':uniacid' => $_W['uniacid']
                    ), 'id');
                    $level3          = count($level3_agentids);
                    $agentcount += $level3;
                }
            }
			
			if ($level3 > 0) {
				$level4_agentids = pdo_fetchall('select id from ' . tablename('ewei_shop_member') . ' where uniacid=:uniacid and agentid in( ' . implode(',', array_keys($level3_agentids)) . ') and isagent=1 and status=1', array(
	                ':uniacid' => $_W['uniacid']
	            ), 'id');
	            $level4          = count($level4_agentids);
	            $agentcount += $level4;
				
				if (in_array('total', $options)) {
	                $level4_commissions = pdo_fetchall('select commission4  from ' . tablename('ewei_shop_order_goods') . ' og ' . ' left join  ' . tablename('ewei_shop_order') . ' o on o.id = og.orderid ' . ' where o.agentid in( ' . implode(',', array_keys($level3_agentids)) . ")  and o.status>=1 and og.nocommission=0 and o.uniacid=:uniacid and m.two=1", array(
	                    ':uniacid' => $_W['uniacid']
	                ));
	                foreach ($level4_commissions as $c) {
	                    $commission = iunserializer($c['commission4']);
	                    $commission_total += $commission['default'];
	                }
				}
				
				if (in_array('pay', $options)) {
					$level4_commissions3 = pdo_fetchall('select commission4  from ' . tablename('ewei_shop_order_goods') . ' og ' . ' left join  ' . tablename('ewei_shop_order') . ' o on o.id = og.orderid' . ' where o.agentid in( ' . implode(',', array_keys($level3_agentids)) . ")  and o.status>=1 and og.status4=3 and og.nocommission=0 and o.uniacid=:uniacid and m.two=1", array(
	                    ':uniacid' => $_W['uniacid']
	                ));
	                foreach ($level4_commissions3 as $c) {
	                    $commission = iunserializer($c['commission4']);
	                    $commission_pay +=  $commission['default'];
	                }
                }
				
				if (in_array('ok', $options)) {
					$level4_commissions = pdo_fetchall('select commission4  from ' . tablename('ewei_shop_order_goods') . ' og ' . ' left join  ' . tablename('ewei_shop_order') . ' o on o.id = og.orderid' . ' where o.agentid in( ' . implode(',', array_keys($level3_agentids)) . ")  and ({$time} - o.createtime > {$day_times}) and o.status>=3 and og.status4=0  and og.nocommission=0 and o.uniacid=:uniacid and m.two=1", array(
	                    ':uniacid' => $_W['uniacid']
	                ));
	                foreach ($level4_commissions as $c) {
	                    $commission = iunserializer($c['commission4']);
	                    $commission_ok += $commission['default'];
	                }
				}
                   
            }
			
			if ($level4 > 0) {
				$level5_agentids = pdo_fetchall('select id from ' . tablename('ewei_shop_member') . ' where uniacid=:uniacid and agentid in( ' . implode(',', array_keys($level4_agentids)) . ') and isagent=1 and status=1', array(
	                ':uniacid' => $_W['uniacid']
	            ), 'id');
	            $level5          = count($level5_agentids);
	            $agentcount += $level5;
				
				if (in_array('total', $options)) {
					$level5_commissions = pdo_fetchall('select commission5  from ' . tablename('ewei_shop_order_goods') . ' og ' . ' left join  ' . tablename('ewei_shop_order') . ' o on o.id = og.orderid ' . ' where o.agentid in( ' . implode(',', array_keys($level4_agentids)) . ")  and o.status>=1 and og.nocommission=0 and o.uniacid=:uniacid and m.two=1", array(
	                    ':uniacid' => $_W['uniacid']
	                ));
	                foreach ($level5_commissions as $c) {
	                    $commission = iunserializer($c['commission5']);
	                    $commission_total += $commission['default'];
	                }
                }
				
				if (in_array('pay', $options)) {
					$level5_commissions3 = pdo_fetchall('select commission5  from ' . tablename('ewei_shop_order_goods') . ' og ' . ' left join  ' . tablename('ewei_shop_order') . ' o on o.id = og.orderid' . ' where o.agentid in( ' . implode(',', array_keys($level4_agentids)) . ")  and o.status>=1 and og.status5=3 and og.nocommission=0 and o.uniacid=:uniacid and m.two=1", array(
	                    ':uniacid' => $_W['uniacid']
	                ));
	                foreach ($level5_commissions3 as $c) {
	                    $commission = iunserializer($c['commission5']);
	                    $commission_pay +=  $commission['default'];
	                }
				}
				
				if (in_array('ok', $options)) {
					$level5_commissions = pdo_fetchall('select commission5  from ' . tablename('ewei_shop_order_goods') . ' og ' . ' left join  ' . tablename('ewei_shop_order') . ' o on o.id = og.orderid' . ' where o.agentid in( ' . implode(',', array_keys($level4_agentids)) . ")  and ({$time} - o.createtime > {$day_times}) and o.status>=3 and og.status5=0  and og.nocommission=0 and o.uniacid=:uniacid and m.two=1", array(
	                    ':uniacid' => $_W['uniacid']
	                ));
	                foreach ($level5_commissions as $c) {
	                    $commission = iunserializer($c['commission5']);
	                    $commission_ok += $commission['default'];
	                }
				}
				
            }
			
			if ($level5 > 0) {
				$level6_agentids = pdo_fetchall('select id from ' . tablename('ewei_shop_member') . ' where uniacid=:uniacid and agentid in( ' . implode(',', array_keys($level5_agentids)) . ') and isagent=1 and status=1', array(
	                ':uniacid' => $_W['uniacid']
	            ), 'id');
	            $level6          = count($level6_agentids);
	            $agentcount += $level6;
				
				$temp_gold = round($f2c_pu * 0.3 , 2);
				if( empty($f2c_gold) && !empty($f2c_pu) && $f2c_pu >= 2000 ){
					if (in_array('total', $options)) {
						$level6_commissions = pdo_fetchall('select commission6  from ' . tablename('ewei_shop_order_goods') . ' og ' . ' left join  ' . tablename('ewei_shop_order') . ' o on o.id = og.orderid ' . ' left join  ' . tablename('ewei_shop_member') . ' m on m.openid = o.openid' . ' where o.agentid in( ' . implode(',', array_keys($level5_agentids)) . ")  and o.status>=1 and og.nocommission=0 and o.uniacid=:uniacid  and m.two=1", array(
		                    ':uniacid' => $_W['uniacid']
		                ));
		                foreach ($level6_commissions as $c) {
		                    $commission = iunserializer($c['commission6']);
		                    $commission_total += $commission['default'];
		                }
					}
					
					if (in_array('pay', $options)) {
						$level6_commissions3 = pdo_fetchall('select commission6  from ' . tablename('ewei_shop_order_goods') . ' og ' . ' left join  ' . tablename('ewei_shop_order') . ' o on o.id = og.orderid' . ' left join  ' . tablename('ewei_shop_member') . ' m on m.openid = o.openid' . ' where o.agentid in( ' . implode(',', array_keys($level5_agentids)) . ")  and o.status>=1 and og.status6=3 and og.nocommission=0 and o.uniacid=:uniacid  and m.two=1", array(
		                    ':uniacid' => $_W['uniacid']
		                ));
		                foreach ($level6_commissions3 as $c) {
		                    $commission = iunserializer($c['commission6']);
		                    $commission_pay +=  $commission['default'];
		                }
					}
					
					if (in_array('ok', $options)) {
						$level6_commissions = pdo_fetchall('select commission6  from ' . tablename('ewei_shop_order_goods') . ' og ' . ' left join  ' . tablename('ewei_shop_order') . ' o on o.id = og.orderid' . ' left join  ' . tablename('ewei_shop_member') . ' m on m.openid = o.openid' . ' where o.agentid in( ' . implode(',', array_keys($level5_agentids)) . ")  and ({$time} - o.createtime > {$day_times}) and o.status>=3 and og.status6=0  and og.nocommission=0 and o.uniacid=:uniacid and m.two=1", array(
		                    ':uniacid' => $_W['uniacid']
		                ));
		                foreach ($level6_commissions as $c) {
		                    $commission = iunserializer($c['commission6']);
		                    $commission_ok += $commission['default'];
		                }
					}
				}elseif( empty($f2c_pu) && !empty($f2c_gold) && $f2c_gold >= 8000 ){
					if (in_array('total', $options)) {
						$level6_commissions = pdo_fetchall('select commission6  from ' . tablename('ewei_shop_order_goods') . ' og ' . ' left join  ' . tablename('ewei_shop_order') . ' o on o.id = og.orderid ' . ' left join  ' . tablename('ewei_shop_member') . ' m on m.openid = o.openid' . ' where o.agentid in( ' . implode(',', array_keys($level5_agentids)) . ")  and o.status>=1 and og.nocommission=0 and o.uniacid=:uniacid  and m.two=1", array(
		                    ':uniacid' => $_W['uniacid']
		                ));
		                foreach ($level6_commissions as $c) {
		                    $commission = iunserializer($c['commission6']);
		                    $commission_total += $commission['default'];
		                }
					}
					
					if (in_array('pay', $options)) {
						$level6_commissions3 = pdo_fetchall('select commission6  from ' . tablename('ewei_shop_order_goods') . ' og ' . ' left join  ' . tablename('ewei_shop_order') . ' o on o.id = og.orderid' . ' left join  ' . tablename('ewei_shop_member') . ' m on m.openid = o.openid' . ' where o.agentid in( ' . implode(',', array_keys($level5_agentids)) . ")  and o.status>=1 and og.status6=3 and og.nocommission=0 and o.uniacid=:uniacid  and m.two=1", array(
		                    ':uniacid' => $_W['uniacid']
		                ));
		                foreach ($level6_commissions3 as $c) {
		                    $commission = iunserializer($c['commission6']);
		                    $commission_pay +=  $commission['default'];
		                }
					}
					
					if (in_array('ok', $options)) {
						$level6_commissions = pdo_fetchall('select commission6  from ' . tablename('ewei_shop_order_goods') . ' og ' . ' left join  ' . tablename('ewei_shop_order') . ' o on o.id = og.orderid' . ' left join  ' . tablename('ewei_shop_member') . ' m on m.openid = o.openid' . ' where o.agentid in( ' . implode(',', array_keys($level5_agentids)) . ")  and ({$time} - o.createtime > {$day_times}) and o.status>=3 and og.status6=0  and og.nocommission=0 and o.uniacid=:uniacid and m.two=1", array(
		                    ':uniacid' => $_W['uniacid']
		                ));
		                foreach ($level6_commissions as $c) {
		                    $commission = iunserializer($c['commission6']);
		                    $commission_ok += $commission['default'];
		                }
					}
				}elseif(!empty($f2c_pu) && !empty($f2c_gold) && ($f2c_gold >= $temp_gold) ){
					if (in_array('total', $options)) {
						$level6_commissions = pdo_fetchall('select commission6  from ' . tablename('ewei_shop_order_goods') . ' og ' . ' left join  ' . tablename('ewei_shop_order') . ' o on o.id = og.orderid ' . ' left join  ' . tablename('ewei_shop_member') . ' m on m.openid = o.openid' . ' where o.agentid in( ' . implode(',', array_keys($level5_agentids)) . ")  and o.status>=1 and og.nocommission=0 and o.uniacid=:uniacid  and m.two=1", array(
		                    ':uniacid' => $_W['uniacid']
		                ));
		                foreach ($level6_commissions as $c) {
		                    $commission = iunserializer($c['commission6']);
		                    $commission_total += $commission['default'];
		                }
					}
					
					if (in_array('pay', $options)) {
						$level6_commissions3 = pdo_fetchall('select commission6  from ' . tablename('ewei_shop_order_goods') . ' og ' . ' left join  ' . tablename('ewei_shop_order') . ' o on o.id = og.orderid' . ' left join  ' . tablename('ewei_shop_member') . ' m on m.openid = o.openid' . ' where o.agentid in( ' . implode(',', array_keys($level5_agentids)) . ")  and o.status>=1 and og.status6=3 and og.nocommission=0 and o.uniacid=:uniacid  and m.two=1", array(
		                    ':uniacid' => $_W['uniacid']
		                ));
		                foreach ($level6_commissions3 as $c) {
		                    $commission = iunserializer($c['commission6']);
		                    $commission_pay +=  $commission['default'];
		                }
					}
					
					if (in_array('ok', $options)) {
						$level6_commissions = pdo_fetchall('select commission6  from ' . tablename('ewei_shop_order_goods') . ' og ' . ' left join  ' . tablename('ewei_shop_order') . ' o on o.id = og.orderid' . ' left join  ' . tablename('ewei_shop_member') . ' m on m.openid = o.openid' . ' where o.agentid in( ' . implode(',', array_keys($level5_agentids)) . ")  and ({$time} - o.createtime > {$day_times}) and o.status>=3 and og.status6=0  and og.nocommission=0 and o.uniacid=:uniacid and m.two=1", array(
		                    ':uniacid' => $_W['uniacid']
		                ));
		                foreach ($level6_commissions as $c) {
		                    $commission = iunserializer($c['commission6']);
		                    $commission_ok += $commission['default'];
		                }
					}
				}else{
					
				}
				
				
				
            }

            $member['agentcount']       = $agentcount;
            $member['ordercount']       = $ordercount;
            $member['ordermoney']       = $ordermoney;
            $member['order1']           = $order1;
            $member['order2']           = $order2;
            $member['order3']           = $order3;
            $member['ordercount3']      = $ordercount3;
            $member['ordermoney3']      = $ordermoney3;
            $member['order13']          = $order13;
            $member['order23']          = $order23;
            $member['order33']          = $order33;
            $member['ordercount0']      = $ordercount0;
            $member['ordermoney0']      = $ordermoney0;
            $member['order10']          = $order10;
            $member['order20']          = $order20;
            $member['order30']          = $order30;
            $member['commission_total'] = round($commission_total, 2);
            $member['commission_ok']    = round($commission_ok, 2);
            $member['commission_lock']  = round($commission_lock, 2);
            $member['commission_apply'] = round($commission_apply, 2);
            $member['commission_check'] = round($commission_check, 2);
            $member['commission_pay']   = round($commission_pay, 2);
            $member['level1']           = $level1;
            $member['level1_agentids']  = $level1_agentids;
            $member['level2']           = $level2;
            $member['level2_agentids']  = $level2_agentids;
            $member['level3']           = $level3;
            $member['level3_agentids']  = $level3_agentids;
			$member['level4']           = $level4;
			$member['level5']           = $level5;
			$member['level6']           = $level6;			
            $member['agenttime']        = date('Y-m-d H:i', $member['agenttime']);
            return $member;
        }
        public function getAgents($orderid = 0)
        {
            global $_W, $_GPC;
            $agents = array();
            $order  = pdo_fetch('select id,agentid,openid from ' . tablename('ewei_shop_order') . ' where id=:id and uniacid=:uniacid limit 1', array(
                ':id' => $orderid,
                ':uniacid' => $_W['uniacid']
            ));
            if (empty($order)) {
                return $agents;
            }
            $m1 = m('member')->getInfo($order['agentid']);
            if (!empty($m1) && $m1['isagent'] == 1 && $m1['status'] == 1) {
                $agents[] = $m1;
                if (!empty($m1['agentid'])) {
                    $m2 = m('member')->getInfo($m1['agentid']);
                    if (!empty($m2) && $m2['isagent'] == 1 && $m2['status'] == 1) {
                        $agents[] = $m2;
                        if (!empty($m2['agentid'])) {
                            $m3 = m('member')->getInfo($m2['agentid']);
                            if (!empty($m3) && $m3['isagent'] == 1 && $m3['status'] == 1) {
                                $agents[] = $m3;
                            }
                        }
                    }
                }
            }
            return $agents;
        }
        public function isAgent($openid)
        {
            if (empty($openid)) {
                return false;
            }
            if (is_array($openid)) {
                return $openid['isagent'] == 1 && $openid['status'] == 1;
            }
            $member = m('member')->getMember($openid);
            return $member['isagent'] == 1 && $member['status'] == 1;
        }
        public function getCommission($goods)
        {
            global $_W;
            $set        = $this->getSet();
            $commission = 0;
            if ($goods['hascommission'] == 1) {
                $commission = $set['level'] >= 1 ? ($goods['commission1_rate'] > 0 ? ($goods['commission1_rate'] * $goods['marketprice'] / 100) : $goods['commission1_pay']) : 0;
            } else {
                $openid = m('user')->getOpenid();
                $level  = $this->getLevel($openid);
                if (!empty($level)) {
                    $commission = $set['level'] >= 1 ? round($level['commission1'] * $goods['marketprice'] / 100, 2) : 0;
                } else {
                    $commission = $set['level'] >= 1 ? round($set['commission1'] * $goods['marketprice'] / 100, 2) : 0;
                }
            }
            return $commission;
        }
        public function createMyShopQrcode($mid = 0, $posterid = 0)
        {
            global $_W;
            $path = IA_ROOT . "/addons/ewei_shop/data/qrcode/" . $_W['uniacid'];
            if (!is_dir($path)) {
                load()->func('file');
                mkdirs($path);
            }
            $url = $_W['siteroot'] . 'app/index.php?i=' . $_W['uniacid'] . '&c=entry&m=ewei_shop&do=plugin&p=commission&method=myshop&mid=' . $mid;
            if (!empty($posterid)) {
                $url .= '&posterid=' . $posterid;
            }
            $file    = 'myshop_' . $posterid . '_' . $mid . '.png';
            $qr_file = $path . '/' . $file;
            if (!is_file($qr_file)) {
                require IA_ROOT . '/framework/library/qrcode/phpqrcode.php';
                QRcode::png($url, $qr_file, QR_ECLEVEL_H, 4);
            }
            return $_W['siteroot'] . 'addons/ewei_shop/data/qrcode/' . $_W['uniacid'] . '/' . $file;
        }
        private function createImage($url)
        {
            load()->func('communication');
            $resp = ihttp_request($url);
            return imagecreatefromstring($resp['content']);
        }
        public function createGoodsImage($goods, $shop_set)
        {
            global $_W, $_GPC;
            $goods  = set_medias($goods, 'thumb');
            $openid = m('user')->getOpenid();
            $me     = m('member')->getInfo($openid);
            if ($me['isagent'] == 1 && $me['status'] == 1) {
                $userinfo = $me;
            } else {
                $mid = intval($_GPC['mid']);
                if (!empty($mid)) {
                    $userinfo = m('member')->getInfo($mid);
                }
            }
            $path = IA_ROOT . "/addons/ewei_shop/data/poster/" . $_W['uniacid'] . '/';
            if (!is_dir($path)) {
                load()->func('file');
                mkdirs($path);
            }
            $img  = empty($goods['commission_thumb']) ? $goods['thumb'] : tomedia($goods['commission_thumb']);
            $md5  = md5(json_encode(array(
                'id' => $goods['id'],
                'marketprice' => $goods['marketprice'],
                'productprice' => $goods['productprice'],
                'img' => $img,
                'openid' => $openid,
                'version' => 4
            )));
            $file = $md5 . '.jpg';
            if (!is_file($path . $file)) {
                set_time_limit(0);
                $font   = IA_ROOT . "/addons/ewei_shop/static/fonts/msyh.ttf";
                $target = imagecreatetruecolor(640, 1225);
                $bg     = imagecreatefromjpeg(IA_ROOT . '/addons/ewei_shop/plugin/commission/images/poster.jpg');
                imagecopy($target, $bg, 0, 0, 0, 0, 640, 1225);
                imagedestroy($bg);
                $avatar = preg_replace('/\/0$/i', '/96', $userinfo['avatar']);
                $head   = $this->createImage($avatar);
                $w      = imagesx($head);
                $h      = imagesy($head);
                imagecopyresized($target, $head, 24, 32, 0, 0, 88, 88, $w, $h);
                imagedestroy($head);
                $thumb = $this->createImage($img);
                $w     = imagesx($thumb);
                $h     = imagesy($thumb);
                imagecopyresized($target, $thumb, 0, 160, 0, 0, 640, 640, $w, $h);
                imagedestroy($thumb);
                $black = imagecreatetruecolor(640, 127);
                imagealphablending($black, false);
                imagesavealpha($black, true);
                $blackcolor = imagecolorallocatealpha($black, 0, 0, 0, 25);
                imagefill($black, 0, 0, $blackcolor);
                imagecopy($target, $black, 0, 678, 0, 0, 640, 127);
                imagedestroy($black);
                $goods_qrcode_file = tomedia(m('qrcode')->createGoodsQrcode($userinfo['id'], $goods['id']));
                $qrcode            = $this->createImage($goods_qrcode_file);
                $w                 = imagesx($qrcode);
                $h                 = imagesy($qrcode);
                imagecopyresized($target, $qrcode, 50, 835, 0, 0, 250, 250, $w, $h);
                imagedestroy($qrcode);
                $bc   = imagecolorallocate($target, 0, 3, 51);
                $cc   = imagecolorallocate($target, 240, 102, 0);
                $wc   = imagecolorallocate($target, 255, 255, 255);
                $yc   = imagecolorallocate($target, 255, 255, 0);
                $str1 = '我是';
                imagettftext($target, 20, 0, 150, 70, $bc, $font, $str1);
                imagettftext($target, 20, 0, 210, 70, $cc, $font, $userinfo['nickname']);
                $str2 = '我要为';
                imagettftext($target, 20, 0, 150, 105, $bc, $font, $str2);
                $str3 = $shop_set['name'];
                imagettftext($target, 20, 0, 240, 105, $cc, $font, $str3);
                $box   = imagettfbbox(20, 0, $font, $str3);
                $width = $box[4] - $box[6];
                $str4  = '代言';
                imagettftext($target, 20, 0, 240 + $width + 10, 105, $bc, $font, $str4);
                $str5 = mb_substr($goods['title'], 0, 50, 'utf-8');
                imagettftext($target, 20, 0, 30, 730, $wc, $font, $str5);
                $str6 = "￥" . number_format($goods['marketprice'], 2);
                imagettftext($target, 25, 0, 25, 780, $yc, $font, $str6);
                $box   = imagettfbbox(26, 0, $font, $str6);
                $width = $box[4] - $box[6];
                if ($goods['productprice'] > 0) {
                    $str7 = "￥" . number_format($goods['productprice'], 2);
                    imagettftext($target, 22, 0, 25 + $width + 10, 780, $wc, $font, $str7);
                    $end   = 25 + $width + 10;
                    $box   = imagettfbbox(22, 0, $font, $str7);
                    $width = $box[4] - $box[6];
                    imageline($target, $end, 770, $end + $width + 20, 770, $wc);
                    imageline($target, $end, 771.5, $end + $width + 20, 771, $wc);
                }
                imagejpeg($target, $path . $file);
                imagedestroy($target);
            }
            return $_W['siteroot'] . "addons/ewei_shop/data/poster/" . $_W['uniacid'] . "/" . $file;
        }
        public function createShopImage($shop_set)
        {
            global $_W, $_GPC;
            $shop_set = set_medias($shop_set, 'signimg');
            $path     = IA_ROOT . "/addons/ewei_shop/data/poster/" . $_W['uniacid'] . '/';
            if (!is_dir($path)) {
                load()->func('file');
                mkdirs($path);
            }
            $mid    = intval($_GPC['mid']);
            $openid = m('user')->getOpenid();
            $me     = m('member')->getInfo($openid);
            if ($me['isagent'] == 1 && $me['status'] == 1) {
                $userinfo = $me;
            } else {
                $mid = intval($_GPC['mid']);
                if (!empty($mid)) {
                    $userinfo = m('member')->getInfo($mid);
                }
            }
            $md5  = md5(json_encode(array(
                'openid' => $openid,
                'signimg' => $shop_set['signimg'],
                'version' => 4
            )));
            $file = $md5 . '.jpg';
            if (!is_file($path . $file)) {
                set_time_limit(0);
                @ini_set('memory_limit', '256M');
                $font   = IA_ROOT . "/addons/ewei_shop/static/fonts/msyh.ttf";
                $target = imagecreatetruecolor(640, 1225);
                $bc     = imagecolorallocate($target, 0, 3, 51);
                $cc     = imagecolorallocate($target, 240, 102, 0);
                $wc     = imagecolorallocate($target, 255, 255, 255);
                $yc     = imagecolorallocate($target, 255, 255, 0);
                $bg     = imagecreatefromjpeg(IA_ROOT . '/addons/ewei_shop/plugin/commission/images/poster.jpg');
                imagecopy($target, $bg, 0, 0, 0, 0, 640, 1225);
                imagedestroy($bg);
                $avatar = preg_replace('/\/0$/i', '/96', $userinfo['avatar']);
                $head   = $this->createImage($avatar);
                $w      = imagesx($head);
                $h      = imagesy($head);
                imagecopyresized($target, $head, 24, 32, 0, 0, 88, 88, $w, $h);
                imagedestroy($head);
                $thumb = $this->createImage($shop_set['signimg']);
                $w     = imagesx($thumb);
                $h     = imagesy($thumb);
                imagecopyresized($target, $thumb, 0, 160, 0, 0, 640, 640, $w, $h);
                imagedestroy($thumb);
                $qrcode_file = tomedia($this->createMyShopQrcode($userinfo['id']));
                $qrcode      = $this->createImage($qrcode_file);
                $w           = imagesx($qrcode);
                $h           = imagesy($qrcode);
                imagecopyresized($target, $qrcode, 50, 835, 0, 0, 250, 250, $w, $h);
                imagedestroy($qrcode);
                $str1 = '我是';
                imagettftext($target, 20, 0, 150, 70, $bc, $font, $str1);
                imagettftext($target, 20, 0, 210, 70, $cc, $font, $userinfo['nickname']);
                $str2 = '我要为';
                imagettftext($target, 20, 0, 150, 105, $bc, $font, $str2);
                $str3 = $shop_set['name'];
                imagettftext($target, 20, 0, 240, 105, $cc, $font, $str3);
                $box   = imagettfbbox(20, 0, $font, $str3);
                $width = $box[4] - $box[6];
                $str4  = '代言';
                imagettftext($target, 20, 0, 240 + $width + 10, 105, $bc, $font, $str4);
                imagejpeg($target, $path . $file);
                imagedestroy($target);
            }
            return $_W['siteroot'] . "addons/ewei_shop/data/poster/" . $_W['uniacid'] . "/" . $file;
        }
        public function checkAgent()
        {
            global $_W, $_GPC;
            $set = $this->getSet();
            if (empty($set['level'])) {
                return;
            }
            $openid = m('user')->getOpenid();
            if (empty($openid)) {
                return;
            }
            $member = m('member')->getMember($openid);
            if (empty($member)) {
                return;
            }
            $parent = false;
            $mid    = intval($_GPC['mid']);
            if (!empty($mid)) {
                $parent = m('member')->getMember($mid);
            }
            $parent_is_agent = !empty($parent) && $parent['isagent'] == 1 && $parent['status'] == 1;
            if ($parent_is_agent) {
                if ($parent['openid'] != $openid) {
                    $clickcount = pdo_fetchcolumn('select count(*) from ' . tablename('ewei_shop_commission_clickcount') . ' where uniacid=:uniacid and openid=:openid and from_openid=:from_openid limit 1', array(
                        ':uniacid' => $_W['uniacid'],
                        ':openid' => $openid,
                        ':from_openid' => $parent['openid']
                    ));
                    if ($clickcount <= 0) {
                        $click = array(
                            'uniacid' => $_W['uniacid'],
                            'openid' => $openid,
                            'from_openid' => $parent['openid'],
                            'clicktime' => time()
                        );
                        pdo_insert('ewei_shop_commission_clickcount', $click);
                        pdo_update('ewei_shop_member', array(
                            'clickcount' => $parent['clickcount'] + 1
                        ), array(
                            'uniacid' => $_W['uniacid'],
                            'id' => $parent['id']
                        ));
                    }
                }
            }
            if ($member['isagent'] == 1) {
                return;
            }
            if ($type == 0) {
                $first = pdo_fetchcolumn('select count(*) from ' . tablename('ewei_shop_member') . ' where id<:id and uniacid=:uniacid limit 1', array(
                    ':uniacid' => $_W['uniacid'],
                    ':id' => $member['id']
                ));
                if ($first <= 0) {
                    pdo_update('ewei_shop_member', array(
                        'isagent' => 1,
                        'status' => 1,
                        'agenttime' => time(),
                        'agentblack' => 0
                    ), array(
                        'uniacid' => $_W['uniacid'],
                        'id' => $member['id']
                    ));
                    return;
                }
            }
            $time         = time();
            $become_child = intval($set['become_child']);
            if ($parent_is_agent && empty($member['agentid'])) {
                if ($member['id'] != $parent['id']) {
                    if (empty($become_child)) {
                        pdo_update('ewei_shop_member', array(
                            'agentid' => $parent['id'],
                            'childtime' => $time
                        ), array(
                            'uniacid' => $_W['uniacid'],
                            'id' => $member['id']
                        ));
                        $this->sendMessage($parent['openid'], array(
                            'nickname' => $member['nickname'],
                            'childtime' => $time
                        ), TM_COMMISSION_AGENT_NEW);
                    } else {
                        pdo_update('ewei_shop_member', array(
                            'inviter' => $parent['id']
                        ), array(
                            'uniacid' => $_W['uniacid'],
                            'id' => $member['id']
                        ));
                    }
                }
            }
            $become_check = intval($set['become_check']);
            if (empty($set['become'])) {
                if (empty($member['agentblack'])) {
                    pdo_update('ewei_shop_member', array(
                        'isagent' => 1,
                        'status' => $become_check,
                        'agenttime' => $become_check == 1 ? $time : 0
                    ), array(
                        'uniacid' => $_W['uniacid'],
                        'id' => $member['id']
                    ));
                    if ($become_check == 1) {
                        $this->sendMessage($openid, array(
                            'nickname' => $member['nickname'],
                            'agenttime' => $time
                        ), TM_COMMISSION_BECOME);
                    }
                }
            }
        }
        public function checkOrderConfirm($orderid = '0')
        {
            global $_W, $_GPC;
            if (empty($orderid)) {
                return;
            }
            $set = $this->getSet();
            if (empty($set['level'])) {
                return;
            }
            $order = pdo_fetch('select id,openid,ordersn,goodsprice,agentid,paytime from ' . tablename('ewei_shop_order') . ' where id=:id and status>=0 and uniacid=:uniacid limit 1', array(
                ':id' => $orderid,
                ':uniacid' => $_W['uniacid']
            ));
            if (empty($order)) {
                return;
            }
            $openid = $order['openid'];
            $member = m('member')->getMember($openid);
            if (empty($member)) {
                return;
            }
            $become_child = intval($set['become_child']);
            $parent       = false;
            if (empty($become_child)) {
                $parent = m('member')->getMember($member['agentid']);
            } else {
                $parent = m('member')->getMember($member['inviter']);
            }
            $parent_is_agent = !empty($parent) && $parent['isagent'] == 1 && $parent['status'] == 1;
            $time            = time();
            $become_child    = intval($set['become_child']);
            if ($parent_is_agent) {
                if ($become_child == 1) {
                    if (empty($member['agentid']) && $member['id'] != $parent['id']) {
                        $member['agentid'] = $parent['id'];
                        pdo_update('ewei_shop_member', array(
                            'agentid' => $parent['id'],
                            'childtime' => $time
                        ), array(
                            'uniacid' => $_W['uniacid'],
                            'id' => $member['id']
                        ));
                        $this->sendMessage($parent['openid'], array(
                            'nickname' => $member['nickname'],
                            'childtime' => $time
                        ), TM_COMMISSION_AGENT_NEW);
                    }
                }
            }
            $isagentself = false;
            if ($member['isagent'] == 1 && $member['status'] == 1) {
                if (!empty($set['selfbuy'])) {
                    $isagentself = true;
                }
            }
            if ($isagentself) {
                pdo_update('ewei_shop_order', array(
                    'agentid' => $member['id']
                ), array(
                    'id' => $orderid
                ));
            } else {
                pdo_update('ewei_shop_order', array(
                    'agentid' => $member['agentid']
                ), array(
                    'id' => $orderid
                ));
            }
            if (!empty($member['agentid'])) {
            }
        }
        public function checkOrderPay($orderid = '0')
        {
            global $_W, $_GPC;
            if (empty($orderid)) {
                return;
            }
            $set = $this->getSet();
            if (empty($set['level'])) {
                return;
            }
            $order = pdo_fetch('select id,openid,ordersn,goodsprice,agentid,paytime from ' . tablename('ewei_shop_order') . ' where id=:id and status>=1 and uniacid=:uniacid limit 1', array(
                ':id' => $orderid,
                ':uniacid' => $_W['uniacid']
            ));
            if (empty($order)) {
                return;
            }
            $openid = $order['openid'];
            $member = m('member')->getMember($openid);
            if (empty($member)) {
                return;
            }
			
			
			//购买完成为分销商
			if(empty($member['isagent'])){
				$data          = array(
	                'isagent' => 1,
	                'status' => 1,
	//              'realname' => $_GPC['realname'],
	//              'mobile' => $_GPC['mobile'],
	//              'weixin' => $_GPC['weixin'],
	                'agenttime' =>  time() 
	            );
	            pdo_update('ewei_shop_member', $data, array(
	                'id' => $member['id']
	            ));
                $this->sendMessage($member['openid'], array(
                    'agenttime' => $data['agenttime']
                ), TM_COMMISSION_BECOME);
			}

			//特殊分类 立即打款
			//if(!empty($member['topcommissionlevel'])){
				$order_goods = pdo_fetchall('select * from ' . tablename('ewei_shop_order_goods') . ' where orderid=:orderid and uniacid=:uniacid ', array(
	                ':orderid' => $orderid,
	                ':uniacid' => $_W['uniacid']
	            ));
				if(!empty($order_goods)){
					foreach ($order_goods as $k => $v) {
						$arr = array(1,2);
						if(in_array($v['cateid'], $arr)){
							if(!empty($member['agentid'])){
								$member_ll = pdo_fetch('select id,agentid,openid,topcommissionlevel,two from ' . tablename('ewei_shop_member') . ' where id=:id and uniacid=:uniacid limit 1', array(
						                ':id' => $member['agentid'],
						                ':uniacid' => $_W['uniacid']
						            ));
								if(!empty($member_ll)){
									$commission_temp = iunserializer($v['commission1']);
			                    	$commission[1]['money'] = !empty($member_ll['topcommissionlevel']) ? $commission_temp['default'] : 0;
									$commission[1]['openid'] = $member_ll['openid'];
									$commission[1]['agentid'] = $member_ll['agentid'];
									
									$member_ll = pdo_fetch('select id,agentid,openid,topcommissionlevel,two from ' . tablename('ewei_shop_member') . ' where id=:id and uniacid=:uniacid limit 1', array(
							                ':id' => $commission[1]['agentid'],
							                ':uniacid' => $_W['uniacid']
							            ));
									if(!empty($member_ll)){
										$commission_temp = iunserializer($v['commission2']);
				                    	$commission[2]['money'] = !empty($member_ll['topcommissionlevel']) ? $commission_temp['default'] : 0;
										$commission[2]['openid'] = $member_ll['openid'];
										$commission[2]['agentid'] = $member_ll['agentid'];
										
										$member_ll = pdo_fetch('select id,agentid,openid,topcommissionlevel,two from ' . tablename('ewei_shop_member') . ' where id=:id and uniacid=:uniacid limit 1', array(
								                ':id' => $commission[2]['agentid'],
								                ':uniacid' => $_W['uniacid']
								            ));
										if(!empty($member_ll)){
											$commission_temp = iunserializer($v['commission3']);
					                    	$commission[3]['money'] = !empty($member_ll['topcommissionlevel']) ? $commission_temp['default'] : 0;
											$commission[3]['openid'] = $member_ll['openid'];
											$commission[3]['agentid'] = $member_ll['agentid'];
											
											$member_ll = pdo_fetch('select id,agentid,openid,topcommissionlevel,two from ' . tablename('ewei_shop_member') . ' where id=:id and uniacid=:uniacid limit 1', array(
									                ':id' => $commission[3]['agentid'],
									                ':uniacid' => $_W['uniacid']
									            ));
											if(!empty($member_ll)){
												$commission_temp = iunserializer($v['commission4']);
						                    	$commission[4]['money'] = !empty($member_ll['topcommissionlevel']) ? $commission_temp['default'] : 0;
												$commission[4]['money'] = !empty($member_ll['two']) ? $commission[4]['money'] : 0;
												$commission[4]['openid'] = $member_ll['openid'];
												$commission[4]['agentid'] = $member_ll['agentid'];
												
												$member_ll = pdo_fetch('select id,agentid,openid,topcommissionlevel,two from ' . tablename('ewei_shop_member') . ' where id=:id and uniacid=:uniacid limit 1', array(
										                ':id' => $commission[4]['agentid'],
										                ':uniacid' => $_W['uniacid']
										            ));
												if(!empty($member_ll)){
													$commission_temp = iunserializer($v['commission5']);
							                    	$commission[5]['money'] = !empty($member_ll['topcommissionlevel']) ? $commission_temp['default'] : 0;
													$commission[5]['money'] = !empty($member_ll['two']) ? $commission[5]['money'] : 0;
													$commission[5]['openid'] = $member_ll['openid'];
													$commission[5]['agentid'] = $member_ll['agentid'];
													
													$member_ll = pdo_fetch('select id,agentid,openid,topcommissionlevel,two from ' . tablename('ewei_shop_member') . ' where id=:id and uniacid=:uniacid limit 1', array(
											                ':id' => $commission[5]['agentid'],
											                ':uniacid' => $_W['uniacid']
											            ));
													if(!empty($member_ll)){
														$commission_temp = iunserializer($v['commission6']);
								                    	$commission[6]['money'] = !empty($member_ll['topcommissionlevel']) ? $commission_temp['default'] : 0;
														$commission[6]['money'] = !empty($member_ll['two']) ? $commission[6]['money'] : 0;
														$commission[6]['openid'] = $member_ll['openid'];
													}
												}
											}
										}
									}
								}
																								
								if(!empty($commission)){
									foreach ($commission as $k1 => $v1) {
										if(empty($v1['money'])){
											continue;
										}
										$openid = $v1['openid'];
										$type = 1;
										$pay = $v1['money'] * 100;
										$no = '';
										m('finance')->pay($openid,$type,$pay,$no);
										$message = '您获得佣金：'.$v1['money'].'元';
										$msg     = array(
						                    'keyword1' => array(
						                        'value' => '佣金获取通知',
						                        "color" => "#73a68d"
						                    ),
						                    'keyword2' => array(
						                        'value' => $message,
						                        "color" => "#73a68d"
						                    )
						                );
										m('message')->sendCustomNotice($openid,$msg);
									}
		
									$data = array(
										'status1' => 3,
										'status2' => 3,
										'status3' => 3,
										'status4' => 3,
										'status5' => 3,
										'status6' => 3
									);
									pdo_update('ewei_shop_order_goods', $data, array(
						                'id' => $v['id']
						            ));
								}
								
							}
							
						}
					}
				}
			//}
			
			//改变会员topcommissionlevel状态
        	m('member')->updateonetwo($orderid);
			
			
			
//			$order_goods = pdo_fetch('select * from ' . tablename('ewei_shop_order_goods') . ' where orderid=:orderid limit 1', array(
//              ':orderid' => $orderid
//          ));
//			if (!empty($order_goods)) {
//				$rel = array();
//				if($order_goods['cateid'] == 1 ){
//					$rel = array('one'=>1);
//				}elseif($order_goods['cateid'] == 2 ){
//					$rel = array('one'=>1,'two'=>1);					
//				}
//				pdo_update('ewei_shop_member', $rel, array(
//                  'id' => $member['id']
//              ));
//			}
			
			
            $become_child = intval($set['become_child']);
            $parent       = false;
            if (empty($become_child)) {
                $parent = m('member')->getMember($member['agentid']);
            } else {
                $parent = m('member')->getMember($member['inviter']);
            }
            $parent_is_agent = !empty($parent) && $parent['isagent'] == 1 && $parent['status'] == 1;
            $time            = time();
            $become_child    = intval($set['become_child']);
            if ($parent_is_agent) {
                if ($become_child == 2) {
                    if (empty($member['agentid']) && $member['id'] != $parent['id']) {
                        $member['agentid'] = $parent['id'];
                        pdo_update('ewei_shop_member', array(
                            'agentid' => $parent['id'],
                            'childtime' => $time
                        ), array(
                            'uniacid' => $_W['uniacid'],
                            'id' => $member['id']
                        ));
                        $this->sendMessage($parent['openid'], array(
                            'nickname' => $member['nickname'],
                            'childtime' => $time
                        ), TM_COMMISSION_AGENT_NEW);
                        if (empty($order['agentid'])) {
                            $order['agentid'] = $parent['id'];
                            pdo_update('ewei_shop_order', array(
                                'agentid' => $parent['id']
                            ), array(
                                'id' => $orderid
                            ));
                        }
                    }
                }
            }
            $isagent = $member['isagent'] == 1 && $member['status'] == 1;
            if (!$isagent && empty($set['become_order'])) {
                $time = time();
                if ($set['become'] == 2 || $set['become'] == 3) {
                    if (!empty($member['agentid'])) {
                        $parent = m('member')->getMember($member['agentid']);
                        if (empty($parent) || $parent['isagent'] != 1 || $parent['status'] != 1) {
                            return;
                        }
                    }
                    $can = false;
                    if ($set['become'] == '2') {
                        $ordercount = pdo_fetchcolumn('select count(*) from ' . tablename('ewei_shop_order') . ' where openid=:openid and status>=1 and uniacid=:uniacid limit 1', array(
                            ':uniacid' => $_W['uniacid'],
                            ':openid' => $openid
                        ));
                        $can        = $ordercount >= intval($set['become_ordercount']);
                    } else if ($set['become'] == '3') {
                        $moneycount = pdo_fetchcolumn('select sum(og.realprice) from ' . tablename('ewei_shop_order_goods') . ' og left join ' . tablename('ewei_shop_order') . ' o on og.orderid=o.id  where o.openid=:openid and o.status>=1 and o.uniacid=:uniacid limit 1', array(
                            ':uniacid' => $_W['uniacid'],
                            ':openid' => $openid
                        ));
                        $can        = $moneycount >= floatval($set['become_moneycount']);
                    }
                    if ($can) {
                        if (empty($member['agentblack'])) {
                            $become_check = intval($set['become_check']);
                            pdo_update('ewei_shop_member', array(
                                'status' => $become_check,
                                'isagent' => 1,
                                'agenttime' => $time
                            ), array(
                                'uniacid' => $_W['uniacid'],
                                'id' => $member['id']
                            ));
                            if ($become_check == 1) {
                                $this->sendMessage($openid, array(
                                    'nickname' => $member['nickname'],
                                    'agenttime' => $time
                                ), TM_COMMISSION_BECOME);
                            }
                        }
                    }
                }
            }
            if (!empty($member['agentid'])) {
                $parent = m('member')->getMember($member['agentid']);
                if (empty($parent) || $parent['isagent'] != 1 || $parent['status'] != 1) {
                    return;
                }
                if ($order['agentid'] != $parent['id']) {
                    return;
                }
                $this->sendMessage($parent['openid'], array(
                    'nickname' => $member['nickname'],
                    'ordersn' => $order['ordersn'],
                    'price' => $order['goodsprice'],
                    'paytime' => $order['paytime']
                ), TM_COMMISSION_ORDER_PAY);
            }
        }
        public function checkOrderFinish($orderid = '')
        {
            global $_W, $_GPC;
            if (empty($orderid)) {
                return;
            }
            $order = pdo_fetch('select id,openid, ordersn,goodsprice,agentid,finishtime from ' . tablename('ewei_shop_order') . ' where id=:id and status>=3 and uniacid=:uniacid limit 1', array(
                ':id' => $orderid,
                ':uniacid' => $_W['uniacid']
            ));
            if (empty($order)) {
                return;
            }
            $set = $this->getSet();
            if (empty($set['level'])) {
                return;
            }
            $openid = $order['openid'];
            $member = m('member')->getMember($openid);
            if (empty($member)) {
                return;
            }
            $time    = time();
            $isagent = $member['isagent'] == 1 && $member['status'] == 1;
            if (!$isagent && $set['become_order'] == 1) {
                if ($set['become'] == 2 || $set['become'] == 3) {
                    if (!empty($member['agentid'])) {
                        $parent = m('member')->getMember($member['agentid']);
                        if (empty($parent) || $parent['isagent'] != 1 || $parent['status'] != 1) {
                            return;
                        }
                    }
                    $can = false;
                    if ($set['become'] == '2') {
                        $ordercount = pdo_fetchcolumn('select count(*) from ' . tablename('ewei_shop_order') . ' where openid=:openid and status>=3 and uniacid=:uniacid limit 1', array(
                            ':uniacid' => $_W['uniacid'],
                            ':openid' => $openid
                        ));
                        $can        = $ordercount >= intval($set['become_ordercount']);
                    } else if ($set['become'] == '3') {
                        $moneycount = pdo_fetchcolumn('select sum(goodsprice) from ' . tablename('ewei_shop_order') . ' where openid=:openid and status>=3 and uniacid=:uniacid limit 1', array(
                            ':uniacid' => $_W['uniacid'],
                            ':openid' => $openid
                        ));
                        $can        = $moneycount >= floatval($set['become_moneycount']);
                    }
                    if ($can) {
                        if (empty($member['agentblack'])) {
                            $become_check = intval($set['become_check']);
                            pdo_update('ewei_shop_member', array(
                                'status' => $become_check,
                                'isagent' => 1,
                                'agenttime' => $time
                            ), array(
                                'uniacid' => $_W['uniacid'],
                                'id' => $member['id']
                            ));
                            if ($become_check == 1) {
                                $this->sendMessage($member['openid'], array(
                                    'nickname' => $member['nickname'],
                                    'agenttime' => $time
                                ), TM_COMMISSION_BECOME);
                            }
                        }
                    }
                }
            }
            if ($isagent) {
                $this->upgradeLevel($openid);
            }
            if (!empty($member['agentid'])) {
                $parent = m('member')->getMember($member['agentid']);
                if (empty($parent) || $parent['isagent'] != 1 || $parent['status'] != 1) {
                    return;
                }
                if ($order['agentid'] != $parent['id']) {
                    return;
                }
                $this->sendMessage($parent['openid'], array(
                    'nickname' => $member['nickname'],
                    'ordersn' => $order['ordersn'],
                    'price' => $order['goodsprice'],
                    'finishtime' => $order['finishtime']
                ), TM_COMMISSION_ORDER_FINISH);
            }
        }
        function getShop($m)
        {
            global $_W;
            $member = m('member')->getMember($m);
            $shop   = pdo_fetch('select * from ' . tablename('ewei_shop_commission_shop') . ' where uniacid=:uniacid and mid=:mid limit 1', array(
                ':uniacid' => $_W['uniacid'],
                ':mid' => $member['id']
            ));
            $sysset = m('common')->getSysset(array(
                'shop',
                'share'
            ));
            $set    = $sysset['shop'];
            $share  = $sysset['share'];
            $desc   = $share['desc'];
            if (empty($desc)) {
                $desc = $set['description'];
            }
            if (empty($desc)) {
                $desc = $set['name'];
            }
            if (empty($shop)) {
                $shop = array(
                    'name' => $member['nickname'] . '的小店',
                    'logo' => $member['avatar'],
                    'desc' => $desc,
                    'img' => tomedia($set['img'])
                );
            } else {
                if (empty($shop['name'])) {
                    $shop['name'] = $member['nickname'] . '的小店';
                }
                if (empty($shop['logo'])) {
                    $shop['logo'] = tomedia($member['avatar']);
                }
                if (empty($shop['img'])) {
                    $shop['img'] = tomedia($set['img']);
                }
                if (empty($shop['desc'])) {
                    $shop['desc'] = $desc;
                }
            }
            return $shop;
        }
        function getLevels($all = true)
        {
            global $_W;
            if ($all) {
                return pdo_fetchall('select * from ' . tablename('ewei_shop_commission_level') . ' where uniacid=:uniacid order by commission1 asc', array(
                    ':uniacid' => $_W['uniacid']
                ));
            } else {
                return pdo_fetchall('select * from ' . tablename('ewei_shop_commission_level') . ' where uniacid=:uniacid and (ordermoney>0 or commissionmoney>0) order by commission1 asc', array(
                    ':uniacid' => $_W['uniacid']
                ));
            }
        }
        function getLevel($openid)
        {
            global $_W;
            if (empty($openid)) {
                return false;
            }
            $member = m('member')->getMember($openid);
            if (empty($member['agentlevel'])) {
                return false;
            }
            $level = pdo_fetch('select * from ' . tablename('ewei_shop_commission_level') . ' where uniacid=:uniacid and id=:id limit 1', array(
                ':uniacid' => $_W['uniacid'],
                ':id' => $member['agentlevel']
            ));
            return $level;
        }
        function upgradeLevel($openid)
        {
            global $_W;
            if (empty($openid)) {
                return;
            }
            $set = $this->getSet();
            if (empty($set['level'])) {
                return;
            }
            $m      = m('member')->getMember($openid);
            $agents = array();
            if (!empty($set['selfbuy'])) {
                $agents[] = $m;
            }
            if (!empty($m)) {
                if (!empty($m['agentid'])) {
                    $m1 = m('member')->getMember($m['agentid']);
                    if (!empty($m1)) {
                        $agents[] = $m1;
                        if (!empty($m1['agentid']) && $m1['isagent'] == 1 && $m1['status'] == 1) {
                            $m2 = m('member')->getMember($m1['agentid']);
                            if (!empty($m2) && $m2['isagent'] == 1 && $m2['status'] == 1) {
                                $agents[] = $m2;
                                if (!empty($set['selfbuy'])) {
                                    if (!empty($m2['agentid']) && $m2['isagent'] == 1 && $m2['status'] == 1) {
                                        $m3 = m('member')->getMember($m1['agentid']);
                                        if (!empty($m3) && $m3['isagent'] == 1 && $m3['status'] == 1) {
                                            $agents[] = $m3;
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
            foreach ($agents as $agent) {
                $info = $this->getInfo($agent['id'], array(
                    'ordercount3',
                    'pay'
                ));
                if (!empty($info['agentnotupgrade'])) {
                    continue;
                }
                $ordermoney      = $info['ordermoney3'];
                $commissionmoney = $info['commission_pay'];
                $newlevel        = pdo_fetch('select * from ' . tablename('ewei_shop_commission_level') . " where uniacid=:uniacid " . " and {$ordermoney} >= ordermoney and ordermoney>0  order by ordermoney desc limit 1", array(
                    ':uniacid' => $_W['uniacid']
                ));
                if (empty($newlevel)) {
                    $newlevel = pdo_fetch('select * from ' . tablename('ewei_shop_commission_level') . " where uniacid=:uniacid " . " and {$commissionmoney} >= commissionmoney and commissionmoney>0  order by commissionmoney desc limit 1", array(
                        ':uniacid' => $_W['uniacid']
                    ));
                }
                if (!empty($newlevel) && $newlevel['id'] != $agent['agentlevel']) {
                    $oldlevel = $this->getLevel($agent['openid']);
                    if (empty($oldlevel['id'])) {
                        $oldlevel = array(
                            'levelname' => empty($set['levelname']) ? '普通等级' : $set['levelname'],
                            'commission1' => $set['commission1'],
                            'commission2' => $set['commission2'],
                            'commission3' => $set['commission3']
                        );
                    }
                    pdo_update('ewei_shop_member', array(
                        'agentlevel' => $newlevel['id']
                    ), array(
                        'id' => $agent['id']
                    ));
                    $this->sendMessage($agent['openid'], array(
                        'nickname' => $agent['nickname'],
                        'oldlevel' => $oldlevel,
                        'newlevel' => $newlevel
                    ), TM_COMMISSION_UPGRADE);
                }
            }
        }
        function sendMessage($openid = '', $data = array(), $message_type = '')
        {
            global $_W, $_GPC;
            $set        = $this->getSet();
            $tm         = $set['tm'];
            $templateid = $tm['templateid'];
            $member     = m('member')->getMember($openid);
            $usernotice = unserialize($member['noticeset']);
            if (!is_array($usernotice)) {
                $usernotice = array();
            }
            if ($message_type == TM_COMMISSION_AGENT_NEW && !empty($tm['commission_agent_new']) && empty($usernotice['commission_agent_new'])) {
                $message = $tm['commission_agent_new'];
                $message = str_replace('[昵称]', $data['nickname'], $message);
                $message = str_replace('[时间]', date('Y-m-d H:i:s', $data['childtime']), $message);
                $msg     = array(
                    'keyword1' => array(
                        'value' => !empty($tm['commission_agent_newtitle']) ? $tm['commission_agent_newtitle'] : '新增下线通知',
                        "color" => "#73a68d"
                    ),
                    'keyword2' => array(
                        'value' => $message,
                        "color" => "#73a68d"
                    )
                );
                if (!empty($templateid)) {
                    m('message')->sendTplNotice($openid, $templateid, $msg);
                } else {
                    m('message')->sendCustomNotice($openid, $msg);
                }
            } else if ($message_type == TM_COMMISSION_ORDER_PAY && !empty($tm['commission_order_pay']) && empty($usernotice['commission_order_pay'])) {
                $message = $tm['commission_order_pay'];
                $message = str_replace('[昵称]', $data['nickname'], $message);
                $message = str_replace('[时间]', date('Y-m-d H:i:s', $data['paytime']), $message);
                $message = str_replace('[订单编号]', $data['ordersn'], $message);
                $message = str_replace('[订单金额]', $data['price'], $message);
                $msg     = array(
                    'keyword1' => array(
                        'value' => !empty($tm['commission_order_paytitle']) ? $tm['commission_order_paytitle'] : '下线付款通知'
                    ),
                    'keyword2' => array(
                        'value' => $message
                    )
                );
                if (!empty($templateid)) {
                    m('message')->sendTplNotice($openid, $templateid, $msg);
                } else {
                    m('message')->sendCustomNotice($openid, $msg);
                }
            } else if ($message_type == TM_COMMISSION_ORDER_FINISH && !empty($tm['commission_order_finish']) && empty($usernotice['commission_order_finish'])) {
                $message = $tm['commission_order_finish'];
                $message = str_replace('[昵称]', $data['nickname'], $message);
                $message = str_replace('[时间]', date('Y-m-d H:i:s', $data['finishtime']), $message);
                $message = str_replace('[订单编号]', $data['ordersn'], $message);
                $message = str_replace('[订单金额]', $data['price'], $message);
                $msg     = array(
                    'keyword1' => array(
                        'value' => !empty($tm['commission_order_finishtitle']) ? $tm['commission_order_finishtitle'] : '下线确认收货通知',
                        "color" => "#73a68d"
                    ),
                    'keyword2' => array(
                        'value' => $message,
                        "color" => "#73a68d"
                    )
                );
                if (!empty($templateid)) {
                    m('message')->sendTplNotice($openid, $templateid, $msg);
                } else {
                    m('message')->sendCustomNotice($openid, $msg);
                }
            } else if ($message_type == TM_COMMISSION_APPLY && !empty($tm['commission_apply']) && empty($usernotice['commission_apply'])) {
                $message = $tm['commission_apply'];
                $message = str_replace('[昵称]', $member['nickname'], $message);
                $message = str_replace('[时间]', date('Y-m-d H:i:s', time()), $message);
                $message = str_replace('[金额]', $data['commission'], $message);
                $message = str_replace('[提现方式]', $data['type'], $message);
                $msg     = array(
                    'keyword1' => array(
                        'value' => !empty($tm['commission_applytitle']) ? $tm['commission_applytitle'] : '提现申请提交成功',
                        "color" => "#73a68d"
                    ),
                    'keyword2' => array(
                        'value' => $message,
                        "color" => "#73a68d"
                    )
                );
                if (!empty($templateid)) {
                    m('message')->sendTplNotice($openid, $templateid, $msg);
                } else {
                    m('message')->sendCustomNotice($openid, $msg);
                }
            } else if ($message_type == TM_COMMISSION_CHECK && !empty($tm['commission_check']) && empty($usernotice['commission_check'])) {
                $message = $tm['commission_check'];
                $message = str_replace('[昵称]', $member['nickname'], $message);
                $message = str_replace('[时间]', date('Y-m-d H:i:s', time()), $message);
                $message = str_replace('[金额]', $data['commission'], $message);
                $message = str_replace('[提现方式]', $data['type'], $message);
                $msg     = array(
                    'keyword1' => array(
                        'value' => !empty($tm['commission_checktitle']) ? $tm['commission_checktitle'] : '提现申请审核处理完成',
                        "color" => "#73a68d"
                    ),
                    'keyword2' => array(
                        'value' => $message,
                        "color" => "#73a68d"
                    )
                );
                if (!empty($templateid)) {
                    m('message')->sendTplNotice($openid, $templateid, $msg);
                } else {
                    m('message')->sendCustomNotice($openid, $msg);
                }
            } else if ($message_type == TM_COMMISSION_PAY && !empty($tm['commission_pay']) && empty($usernotice['commission_pay'])) {
                $message = $tm['commission_pay'];
                $message = str_replace('[昵称]', $member['nickname'], $message);
                $message = str_replace('[时间]', date('Y-m-d H:i:s', time()), $message);
                $message = str_replace('[金额]', $data['commission'], $message);
                $message = str_replace('[提现方式]', $data['type'], $message);
                $msg     = array(
                    'keyword1' => array(
                        'value' => !empty($tm['commission_paytitle']) ? $tm['commission_paytitle'] : '佣金打款通知',
                        "color" => "#73a68d"
                    ),
                    'keyword2' => array(
                        'value' => $message,
                        "color" => "#73a68d"
                    )
                );
                if (!empty($templateid)) {
                    m('message')->sendTplNotice($openid, $templateid, $msg);
                } else {
                    m('message')->sendCustomNotice($openid, $msg);
                }
            } else if ($message_type == TM_COMMISSION_UPGRADE && !empty($tm['commission_upgrade']) && empty($usernotice['commission_upgrade'])) {
                $message = $tm['commission_upgrade'];
                $message = str_replace('[昵称]', $member['nickname'], $message);
                $message = str_replace('[时间]', date('Y-m-d H:i:s', time()), $message);
                $message = str_replace('[旧等级]', $data['oldlevel']['levelname'], $message);
                $message = str_replace('[旧一级分销比例]', $data['oldlevel']['commission1'] . '%', $message);
                $message = str_replace('[旧二级分销比例]', $data['oldlevel']['commission2'] . '%', $message);
                $message = str_replace('[旧三级分销比例]', $data['oldlevel']['commission3'] . '%', $message);
                $message = str_replace('[新等级]', $data['newlevel']['levelname'], $message);
                $message = str_replace('[新一级分销比例]', $data['newlevel']['commission1'] . '%', $message);
                $message = str_replace('[新二级分销比例]', $data['newlevel']['commission2'] . '%', $message);
                $message = str_replace('[新三级分销比例]', $data['newlevel']['commission3'] . '%', $message);
                $msg     = array(
                    'keyword1' => array(
                        'value' => !empty($tm['commission_upgradetitle']) ? $tm['commission_upgradetitle'] : '分销等级升级通知',
                        "color" => "#73a68d"
                    ),
                    'keyword2' => array(
                        'value' => $message,
                        "color" => "#73a68d"
                    )
                );
                if (!empty($templateid)) {
                    m('message')->sendTplNotice($openid, $templateid, $msg);
                } else {
                    m('message')->sendCustomNotice($openid, $msg);
                }
            } else if ($message_type == TM_COMMISSION_BECOME && !empty($tm['commission_become']) && empty($usernotice['commission_become'])) {
                $message = $tm['commission_become'];
                $message = str_replace('[昵称]', $data['nickname'], $message);
                $message = str_replace('[时间]', date('Y-m-d H:i:s', $data['agenttime']), $message);
                $msg     = array(
                    'keyword1' => array(
                        'value' => !empty($tm['commission_becometitle']) ? $tm['commission_becometitle'] : '成为分销商通知',
                        "color" => "#73a68d"
                    ),
                    'keyword2' => array(
                        'value' => $message,
                        "color" => "#73a68d"
                    )
                );
                if (!empty($templateid)) {
                    m('message')->sendTplNotice($openid, $templateid, $msg);
                } else {
                    m('message')->sendCustomNotice($openid, $msg);
                }
            }
        }
        function perms()
        {
            return array(
                'commission' => array(
                    'text' => $this->getName(),
                    'isplugin' => true,
                    'child' => array(
                        'cover' => array(
                            'text' => '入口设置'
                        ),
                        'agent' => array(
                            'text' => '分销商',
                            'view' => '浏览',
                            'check' => '审核-log',
                            'edit' => '修改-log',
                            'agentblack' => '黑名单操作-log',
                            'delete' => '删除-log',
                            'user' => '查看下线',
                            'order' => '查看推广订单(还需有订单权限)'
                        ),
                        'level' => array(
                            'text' => '分销商等级',
                            'view' => '浏览',
                            'add' => '添加-log',
                            'edit' => '修改-log',
                            'delete' => '删除-log'
                        ),
                        'apply' => array(
                            'text' => '佣金审核',
                            'view1' => '浏览待审核',
                            'view2' => '浏览已审核',
                            'view3' => '浏览已打款',
                            'view_1' => '浏览无效',
                            'check' => '审核-log',
                            'pay' => '打款-log',
                            'cancel' => '重新审核-log'
                        ),
                        'notice' => array(
                            'text' => '通知设置-log'
                        ),
                        'set' => array(
                            'text' => '基础设置-log'
                        )
                    )
                )
            );
        }
    }
}