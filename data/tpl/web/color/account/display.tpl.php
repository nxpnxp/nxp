<?php defined('IN_IA') or exit('Access Denied');?>﻿<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header-gw', TEMPLATE_INCLUDEPATH)) : (include template('common/header-gw', TEMPLATE_INCLUDEPATH));?>
	<div class="row" style="padding-top: 25px;">
			<div class="col-sm-4">
				<a class="btn btn-block btn-primary push-10" href="<?php  echo url('account/post-step');?>"><i class="fa fa-plus"></i> 添加公众号</a>
			</div>
			<div class="col-sm-8">
				<form action="./index.php" method="get" role="form">
					<input type="hidden" name="c" value="account">
					<input type="hidden" name="a" value="display">
					<input type="hidden" name="x" id="x" value="<?php  echo $we_xkey;?>">
					<div class="form-group">
						<div class="input-group">
							<input type="text" class="form-control <?php  if(empty($_GPC['keyword']) && !empty($_GPC['s_uniacid'])) { ?>hide<?php  } ?>" placeholder="请输入微信公众号名称" name="keyword" id="s_keyword" value="<?php  echo $_GPC['keyword'];?>">
							<input type="text" class="form-control <?php  if(empty($_GPC['s_uniacid'])) { ?>hide<?php  } ?>" placeholder="请输入微信公众号ID" name="s_uniacid" id="s_uniacid" value="<?php  echo $_GPC['s_uniacid'];?>">
							<div class="input-group-btn">
								<button class="btn btn-default"><i class="fa fa-search"></i> 搜索</button>
								<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
								<ul class="dropdown-menu dropdown-menu-right" role="menu">
									<li><a href="javascript:;" onclick="$('#s_uniacid').addClass('hide').val('');$('#s_keyword').removeClass('hide');">根据公众号名称搜索</a></li>
									<li><a href="javascript:;" onclick="$('#s_uniacid').removeClass('hide');$('#s_keyword').addClass('hide').val('');">根据公众号ID搜索</a></li>
								</ul>
							</div>
						</div>
					</div>
				</form>
			</div>
			
		</div>

	
	<div class="row">
	    <div class="col-sm-12">
	        <div class="alert alert-info alert-dismissable">
	            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	            <h5 class="font-w300 push-15">温馨提示</h5>
	            <p><i class="fa fa-info-circle"></i>
					Hi，<span class="text-strong"><?php  echo $_W['username'];?></span>，您所在的会员组 <span class="text-strong"><?php  echo $stat['group_name'];?></span>，
					账号有效期限：<span class="text-strong"><?php  echo date('Y-m-d', $_W['user']['starttime'])?> / <?php  if(empty($_W['user']['endtime'])) { ?>无限制<?php  } else { ?><?php  echo date('Y-m-d', $_W['user']['endtime'])?><?php  } ?></span>，
					可添加 <span class="text-strong"><?php  echo $stat['maxaccount'];?> </span>个主公号，已添加<span class="text-strong"> <?php  echo $stat['uniacid_num'];?> </span>个，还可添加 <span class="text-strong"><?php  echo $stat['uniacid_limit'];?> </span>个主公号。
					可添加 <span class="text-strong"><?php  echo $stat['maxsubaccount'];?> </span>个子公号，已添加<span class="text-strong"> <?php  echo $stat['acid_num'];?> </span>个，还可添加 <span class="text-strong"><?php  echo $stat['acid_limit'];?> </span>个子公号。</p>
	        </div>
	    </div>
	</div>
				


<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th class="text-center"><i class="si si-user"></i></th>
                <th class="text-center">所有人</th>
                <th class="text-center">服务有效期</th>
                <th class="text-center">公众号名称</th>
                <th class="text-center">接入状态</th>
                <th class="text-center">操作</th>
            </tr>
        </thead>
        <tbody>
        <?php  if(is_array($list)) { foreach($list as $uni) { ?>
            <?php  $subaccount = count($uni['details']);?>
            <?php  if(is_array($uni['details'])) { foreach($uni['details'] as $account) { ?>
            <tr>
                <td class="text-center">
                    <img <?php  if(file_exists(IA_ROOT . '/attachment/headimg_'.$account['acid'].'.jpg')) { ?> src="<?php  echo $_W['attachurl_local'];?>headimg_<?php  echo $account['acid'];?>.jpg?acid=<?php  echo $account['acid'];?>"<?php  } else { ?>src="resource/images/gw-wx.gif"<?php  } ?> class="img-avatar img-avatar48" onerror="this.src='resource/images/gw-wx.gif'" />
                </td>
                <td class="text-center"><?php  echo $uni['setmeal']['username'];?></td>
                <td class="text-center"><?php  echo $uni['setmeal']['timelimit'];?></td>
                <td class="text-center"><?php  echo $account['name'];?></td>
                <td class="text-center">
                    <?php  if($account['isconnect'] == 1) { ?><i class="si si-check text-success"></i><?php  } else { ?><i class="si si-close text-danger"></i><?php  } ?>
                </td>
                <td class="text-center">
                	<?php  if($uni['role'] == 'founder') { ?>
                    <a href="<?php  echo url('account/post-step', array('step' => '3', 'uniacid' => $uni['uniacid'], 'from' => 'list'))?>">设置权限</a>&nbsp;
                    <?php  } ?>
                    <?php  if($uni['role'] == 'founder' || $uni['role'] == 'manager') { ?>
                  <a href="<?php  echo url('account/permission', array('uniacid' => $uni['uniacid']))?>"> 操作员管理</a>&nbsp;
                    <?php  if($subaccount == 1) { ?><a href="<?php  echo url('account/post', array('uniacid' => $uni['uniacid']))?>"> 编辑</a><?php  } ?>&nbsp;
                <a href="<?php  echo url('account/delete', array('uniacid' => $uni['uniacid']))?>" onclick="return confirm('删除主公众号其所属的子公众号及其它数据会全部删除，确认吗？');return false;"> 删除</a>&nbsp;
                    <?php  } ?>
                    <a href="<?php  echo url('account/switch', array('uniacid' => $uni['uniacid']))?>" target="_blank" class="manage"> <font color="#FF0000">管理公众号</font></a>
                </td>
            </tr>
            <?php  } } ?>
        <?php  } } ?>
<tr style="background:#fff;"> 
   <td colspan="6"><div class="listpage pull-right"><?php  echo $pager;?></div></td>
</tr>                      
        </tbody>
    </table>
</div>
	


<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer-gw', TEMPLATE_INCLUDEPATH)) : (include template('common/footer-gw', TEMPLATE_INCLUDEPATH));?>