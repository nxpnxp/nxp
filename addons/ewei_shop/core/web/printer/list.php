<?php
		global $_W, $_GPC;
		load()->func('file');
		load()->func('tpl');
		//print_r('<pre>');print_r($_W);exit;
		if (!$_W['ispost']) {
			//$this->doWebAuth();
			checklogin();
		}
        $op = !empty($_GPC['op']) ? $_GPC['op'] : 'express';
		if ($op == 'preview_express') {
			$id = intval($_GPC['id']);
			$entry = pdo_fetch('SELECT * FROM ' . tablename('ewei_shop_printer') . ' WHERE uniacid = :uniacid and printertype=1 and id=:id', array(':uniacid' => $_W['uniacid'], ':id' => $id));
			$previewtmp = $entry['printerconfig'];
			for ($i = 1; $i < 3; $i++) {
				$previewtmp = str_replace('购货人', '张三同志', $previewtmp);
				$previewtmp = str_replace('收货姓名', '张三', $previewtmp);
				$previewtmp = str_replace('收货电话', '021-88885555', $previewtmp);
				$previewtmp = str_replace('收货地址', '上海市青浦区xxxxx', $previewtmp);
				$previewtmp = str_replace('支付方式', '在线支付', $previewtmp);
				$previewtmp = str_replace('配送方式', '申通快递', $previewtmp);
				$previewtmp = str_replace('发货单号', '115345585233', $previewtmp);
				$previewtmp = str_replace('订单编号', '8774675533', $previewtmp);
				$previewtmp = str_replace('下单时间', date('Y-m-d H:i:s', time() - 1000), $previewtmp);
				$previewtmp = str_replace('订单金额', '920.0', $previewtmp);
				$previewtmp = str_replace('配送费用', '10.0', $previewtmp);
				$previewtmp = str_replace('商品金额', '910.0', $previewtmp);
				$previewtmp = str_replace('打印时间', date('Y-m-d H:i:s', time()), $previewtmp);
				$previewtmp = str_replace('寄件公司', '寄件公司X', $previewtmp);
				$previewtmp = str_replace('寄件人', '寄件人A', $previewtmp);
				$previewtmp = str_replace('寄件地址', '上海xxxxxx', $previewtmp);
				$previewtmp = str_replace('寄件电话', '13333333333', $previewtmp);
				$previewtmp = str_replace('年', date('Y', time()), $previewtmp);
				$previewtmp = str_replace('月', date('m', time()), $previewtmp);
				$previewtmp = str_replace('日', date('d', time()), $previewtmp);
			}
			include $this->template('web/printer/printer_express_print');
			die;
		}

		if ($op == 'express') {
			$list = pdo_fetchall('SELECT * FROM ' . tablename('ewei_shop_printer') . ' WHERE uniacid = :uniacid and printertype=1', array(':uniacid' => $_W['uniacid']));
			include $this->template('web/printer/printer_express');
			die;
		}

		if ($op == 'set_express') {
			$id = intval($_GPC['id']);
			if (empty($id)) {
				message('请选择一条记录');
			}
			pdo_update('ewei_shop_printer', array('isdefault' => 0), array('uniacid' => $_W['uniacid'], 'printertype' => 1));
			pdo_update('ewei_shop_printer', array('isdefault' => 1), array('uniacid' => $_W['uniacid'], 'id' => $id, 'printertype' => 1));
			message('设置成功!', referer(), 'success');
		}

		if ($op == 'priview_express') {
			$id = intval($_GPC['id']);
			$entry = pdo_fetch('SELECT * FROM ' . tablename('ewei_shop_printer') . ' WHERE uniacid = :uniacid and id=:id', array(':uniacid' => $_W['uniacid'], ':id' => $id));
			include $this->template('web/printer/printer_express_print');
		}

		if ($op == 'create_express') {
			if (checksubmit('delpic')) {
				$entry = array();
				$entry['expresscode'] = $_GPC['expresscode'];
				$entry['name'] = $_GPC['print_name'];
				$entry['printerconfig'] = $_GPC['printerconfig'];
				include $this->template('web/printer/printer_express_detail');
				die;
			}
			if (checksubmit('picupload')) {
				$entry = array();
				if (!empty($_FILES['expresspic']['tmp_name'])) {
					file_delete($_GPC['old_expresspic']);
					$expresspic = file_upload($_FILES['expresspic']);
					$entry['expresspic'] = $expresspic['path'];
				}
				$entry['print_from_compy'] = $_GPC['print_from_compy'];
				$entry['print_from_uname'] = $_GPC['print_from_uname'];
				$entry['print_from_addr'] = $_GPC['print_from_addr'];
				$entry['print_from_tel'] = $_GPC['print_from_tel'];
				$entry['expresscode'] = $_GPC['expresscode'];
				$entry['name'] = $_GPC['print_name'];
				$entry['printerconfig'] = $_GPC['printerconfig'];
				include $this->template('web/printer/printer_express_detail');
				die;
			}
			if (checksubmit('submit')) {
				$expressconfig = array();
				$expressconfig['print_from_compy'] = $_GPC['print_from_compy'];
				$expressconfig['print_from_uname'] = $_GPC['print_from_uname'];
				$expressconfig['print_from_addr'] = $_GPC['print_from_addr'];
				$expressconfig['print_from_tel'] = $_GPC['print_from_tel'];
				pdo_insert('ewei_shop_printer', array('expresspic' => $_GPC['old_expresspic'], 'expressconfig' => iserializer($expressconfig), 'printerconfig' => $_GPC['printerconfig'], 'expresscode' => $_GPC['expresscode'], 'expressdaxiao' => $_GPC['expressdaxiao'], 'expressziti' => $_GPC['expressziti'], 'isdefault' => 0, 'createtime' => time(), 'printertype' => 1, 'uniacid' => $_W['uniacid'], 'name' => $_GPC['print_name']));
				message('保存成功!', $this->createWebUrl('printer', array('op' => 'express')), 'success');
			}
			include $this->template('web/printer/printer_express_detail');
			die;
		}

		if ($op == 'edit_express') {
			$id = intval($_GPC['id']);
			if (empty($id)) {
				message('请选择一条记录');
			}
			if (checksubmit('picupload')) {
				$data = array('expresscode' => $_GPC['expresscode'], 'expressdaxiao' => $_GPC['expressdaxiao'], 'expressziti' => $_GPC['expressziti'], 'printerconfig' => $_GPC['printerconfig'], 'createtime' => time(), 'printertype' => 1, 'name' => $_GPC['print_name']);
				$expressconfig = array();
				$expressconfig['print_from_compy'] = $_GPC['print_from_compy'];
				$expressconfig['print_from_uname'] = $_GPC['print_from_uname'];
				$expressconfig['print_from_addr'] = $_GPC['print_from_addr'];
				$expressconfig['print_from_tel'] = $_GPC['print_from_tel'];
				$data['expressconfig'] = iserializer($expressconfig);
				if (!empty($_FILES['expresspic']['tmp_name'])) {
					file_delete($_GPC['old_expresspic']);
					$expresspic = file_upload($_FILES['expresspic']);
					$data['expresspic'] = $expresspic['path'];
				}
				pdo_update('ewei_shop_printer', $data, array('id' => $id, 'uniacid' => $_W['uniacid']));
				header('Location:' . $this->createWebUrl('printer', array('op' => 'edit_express', 'id' => $id)));
				die;
			}
			if (checksubmit('submit')) {
				$expressconfig = array();
				$expressconfig['print_from_compy'] = $_GPC['print_from_compy'];
				$expressconfig['print_from_uname'] = $_GPC['print_from_uname'];
				$expressconfig['print_from_addr'] = $_GPC['print_from_addr'];
				$expressconfig['print_from_tel'] = $_GPC['print_from_tel'];
				pdo_update('ewei_shop_printer', array('expresscode' => $_GPC['expresscode'], 'expressdaxiao' => $_GPC['expressdaxiao'], 'expressziti' => $_GPC['expressziti'], 'printerconfig' => $_GPC['printerconfig'], 'createtime' => time(), 'expressconfig' => iserializer($expressconfig), 'printertype' => 1, 'name' => $_GPC['print_name']), array('id' => $id, 'uniacid' => $_W['uniacid']));
				message('保存成功!', referer(), 'success');
			}
			$entry = pdo_fetch('SELECT * FROM ' . tablename('ewei_shop_printer') . ' WHERE uniacid = :uniacid and id=:id', array(':uniacid' => $_W['uniacid'], ':id' => $id));
			if (!empty($entry['expressconfig'])) {
				$t_expressconfig = iunserializer($entry['expressconfig']);
				$entry['print_from_compy'] = $t_expressconfig['print_from_compy'];
				$entry['print_from_uname'] = $t_expressconfig['print_from_uname'];
				$entry['print_from_addr'] = $t_expressconfig['print_from_addr'];
				$entry['print_from_tel'] = $t_expressconfig['print_from_tel'];
			}
			if (checksubmit('delpic')) {
				file_delete($_GPC['old_expresspic']);
				$data = array();
				$data['expresspic'] = '';
				pdo_update('ewei_shop_printer', $data, array('id' => $id, 'uniacid' => $_W['uniacid']));
			}

			include $this->template('web/printer/printer_express_detail');
			die;
		}

		if ($op == 'del_express') {
			$id = intval($_GPC['id']);
			if (empty($id)) {
				message('请选择一条记录');
			}
			pdo_delete('ewei_shop_printer', array('uniacid' => $_W['uniacid'], 'id' => $id, 'printertype' => 1));
			message('删除成功!', $this->createWebUrl('printer', array('op' => 'express')), 'success');
			die;
		}

		if ($op == 'set_normal') {
			$id = intval($_GPC['id']);
			if (empty($id)) {
				message('请选择一条记录');
			}
			pdo_update('ewei_shop_printer', array('isdefault' => 0), array('uniacid' => $_W['uniacid'], 'printertype' => 0));
			pdo_update('ewei_shop_printer', array('isdefault' => 1), array('uniacid' => $_W['uniacid'], 'id' => $id, 'printertype' => 0));
			message('设置成功!', referer(), 'success');
		}

		if ($op == 'create_normal' || $op == 'printview_normal' || $op == 'edit_normal') {
			if (checksubmit('printview') || $op == 'printview_normal') {
				echo '
				<html xmlns="http://www.w3.org/1999/xhtml">
				<head>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
				</head>
				<body>';
				$previewtmp = $_GPC['previewtmp'];
				if ($op == 'printview_normal') {
					$entry = pdo_fetch('SELECT * FROM ' . tablename('ewei_shop_printer') . ' WHERE  id=:id', array(':id' => $_GPC['id']));
					$previewtmp = $entry['printerconfig'];
				}
				for ($i = 1; $i < 3; $i++) {
					$previewtmp = str_replace('{buyer}', '张三同志', $previewtmp);
					$previewtmp = str_replace('{consignee}', '张三', $previewtmp);
					$previewtmp = str_replace('{tel}', '021-88885555', $previewtmp);
					$previewtmp = str_replace('{address}', '上海市青浦区xxxxx', $previewtmp);
					$previewtmp = str_replace('{pay_type}', '在线支付', $previewtmp);
					$previewtmp = str_replace('{dispatch_type}', '申通快递', $previewtmp);
					$previewtmp = str_replace('{dispatch_sn}', '115345585233', $previewtmp);
					$previewtmp = str_replace('{order_sn}', '8774675533', $previewtmp);
					$previewtmp = str_replace('{time}', date('Y-m-d H:i:s', time() - 1000), $previewtmp);
					$previewtmp = str_replace('{order_price}', '920.0', $previewtmp);
					$previewtmp = str_replace('{dispatch_price}', '10.0', $previewtmp);
					$previewtmp = str_replace('{good_price}', '910.0', $previewtmp);
					$previewtmp = str_replace('{print_time}', date('Y-m-d H:i:s', time()), $previewtmp);
					$good_line = '<table width="100%" border="1" style="border-collapse:collapse;border-color:#000;">
					<tr align="center">
						<td bgcolor="#cccccc">商品名称 </td>
						<td bgcolor="#cccccc">价格 </td>
						<td bgcolor="#cccccc">数量</td>
						<td bgcolor="#cccccc">小计</td>
					</tr>
					<tr>
						<td>&nbsp;商务翻领休闲直筒修身男装夹克</td>
						<td align="right">￥300.00元&nbsp;</td>
						<td align="right">2&nbsp;</td>
						<td align="right">￥600.00元&nbsp;</td>
					</tr>
					<tr>
						<td>&nbsp;淑女粉色九分袖獭兔毛外套</td>
						<td align="right">￥310.00元&nbsp;</td>
						<td align="right">1&nbsp;</td>
						<td align="right">￥310.00元&nbsp;</td>
					</tr>
					<tr>
						<td colspan="4" align="right">商品总金额：￥910.00元</td>
					</tr>
					</table>';
					$previewtmp = str_replace('{good_line}', $good_line, $previewtmp);
				}
				echo htmlspecialchars_decode($previewtmp);
				echo '</body>';
				die;
			}
		}
		if ($op == 'create_normal') {
			if (checksubmit('submit')) {
				pdo_insert('ewei_shop_printer', array('printerconfig' => $_GPC['gmsptz'], 'isdefault' => 0, 'createtime' => time(), 'printertype' => 0, 'uniacid' => $_W['uniacid'], 'name' => $_GPC['print_name']));
				message('保存成功!', $this->createWebUrl('printer', array('op' => 'normal')), 'success');
			}
			if (checksubmit('预设模板')) {
				$entry['printerconfig'] = '';
				$entry['printerconfig'] = $this->curl_printerconfig(1);///50.发货单预设模版：参数可调多种模版。
			}
			include $this->template('web/printer/printer_normal_detail');
			die;
		}
		if ($op == 'edit_normal') {
			$id = intval($_GPC['id']);
			if (empty($id)) {
				message('请选择一条记录');
			}
			$entry = pdo_fetch('SELECT * FROM ' . tablename('ewei_shop_printer') . ' WHERE uniacid = :uniacid and id=:id', array(':uniacid' => $_W['uniacid'], ':id' => $id));
			if (checksubmit('submit')) {
				pdo_update('ewei_shop_printer', array('printerconfig' => $_GPC['gmsptz'], 'createtime' => time(), 'printertype' => 0, 'name' => $_GPC['print_name']), array('id' => $id, 'uniacid' => $_W['uniacid']));
				message('保存成功!', referer(), 'success');
			}
			if (checksubmit('预设模板')) {
				$entry['printerconfig'] = '';
				$entry['printerconfig'] = $this->curl_printerconfig(1);///50.发货单预设模版：参数可调多种模版。
			}
			include $this->template('web/printer/printer_normal_detail');
			die;
		}
		if ($op == 'del_normal') {
			$id = intval($_GPC['id']);
			if (empty($id)) {
				message('请选择一条记录');
			}
			pdo_delete('ewei_shop_printer', array('uniacid' => $_W['uniacid'], 'id' => $id, 'printertype' => 0));
			message('删除成功!', $this->createWebUrl('printer', array('op' => 'normal')), 'success');
			die;
		}
		if ($op == 'normal') {
			$list = pdo_fetchall('SELECT * FROM ' . tablename('ewei_shop_printer') . ' WHERE uniacid = :uniacid and printertype=0', array(':uniacid' => $_W['uniacid']));
			include $this->template('web/printer/printer_normal');
			die;
		}
		include $this->template('printer');