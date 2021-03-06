<?php defined('IN_IA') or exit('Access Denied');?><?php  $newUI = true;?>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
	<li<?php  if($do == 'set') { ?> class="active"<?php  } ?>><a href="<?php  echo url('mc/tplnotice')?>"><i class="icon-group"></i> 设置通知模板</a></li>
</ul>
<div class="alert alert-info">
	<i class="fa fa-info-circle"></i> 只有认证的公众号才可以使用微信通知。如果您的公众号是“认证服务号”,您可以选择一下通知方式中的一种。如果您的公众号是“认证订阅号”，只能使用客服消息通知<br>
	<i class="fa fa-info-circle"></i> 使用客服消息发送通知，要求：粉丝过去的“48小时内”必须有过交互，否则将不能发送通知<br>
</div>
<div class="clearfix">
	<form action="<?php  echo url('mc/tplnotice');?>" method="post" class="form-horizontal form">
		<div class="panel panel-default">
			<div class="panel-heading">
				设置通知模板
			</div>
			<div class="panel-body">
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">通知方式</label>
					<div class="col-sm-9 col-xs-12">
						<label class="radio-inline">
							<input type="radio" name="type" value="tpl" <?php  if($tpl['type'] == 'tpl' || empty($tpl['type'])) { ?> checked="checked"<?php  } ?>/>
							模板消息
						</label>
						<label class="radio-inline">
							<input type="radio" name="type" value="custom" <?php  if($tpl['type'] == 'custom') { ?> checked="checked"<?php  } ?>/>
							客服消息
						</label>
						<span class="help-block">只有认证的公众号才可以使用微信通知。如果您的公众号是“认证服务号”,您可以使用以上两种方式中的一种。如果您的公众号是“认证订阅号”，只能使用客服消息通知</span>
						<span class="help-block"><strong class="text-danger">如果选择模板消息通知，需要设置模板编号</strong></span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">会员余额充值模板编号</label>
					<div class="col-sm-9 col-xs-12">
						<input type="text" class="form-control" name="recharge" value="<?php  echo $tpl['recharge'];?>"/>
						<span class="help-block">会员充值成功后，系统将通过微信发送充值成功消息</span>
						<span class="help-block">请在“微信公众平台”选择行业为：“IT科技 - 互联网|电子商务”，添加标题为：”会员充值通知“，编号为：“TM00009”的模板。</span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">会员余额变更模板编号</label>
					<div class="col-sm-9 col-xs-12">
						<input type="text" class="form-control" name="credit2" value="<?php  echo $tpl['credit2'];?>"/>
						<span class="help-block">请在“微信公众平台”选择行业为：“IT科技 - 互联网|电子商务”，添加标题为：”余额变更通知“，编号为：“OPENTM207266084”的模板。</span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">会员积分变更模板编号</label>
					<div class="col-sm-9 col-xs-12">
						<input type="text" class="form-control" name="credit1" value="<?php  echo $tpl['credit1'];?>"/>
						<span class="help-block">会员充值成功后，系统将通过微信发送充值成功消息</span>
						<span class="help-block">请在“微信公众平台”选择行业为：“IT科技 - 互联网|电子商务”，添加标题为：”积分提醒“，编号为：“TM00335”的模板。</span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">会员等级变更模板编号</label>
					<div class="col-sm-9 col-xs-12">
						<input type="text" class="form-control" name="group" value="<?php  echo $tpl['group'];?>"/>
						<span class="help-block">请在“微信公众平台”选择行业为：“IT科技 - 互联网|电子商务”，添加标题为：”会员级别变更提醒“，编号为：“TM00891”的模板。</span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">会员卡计次充值模板编号</label>
					<div class="col-sm-9 col-xs-12">
						<input type="text" class="form-control" name="nums_plus" value="<?php  echo $tpl['nums_plus'];?>"/>
						<span class="help-block">请在“微信公众平台”选择行业为：“IT科技 - 互联网|电子商务”，添加标题为：”计次充值通知“，编号为：“OPENTM207207134”的模板。</span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">会员卡计次消费模板编号</label>
					<div class="col-sm-9 col-xs-12">
						<input type="text" class="form-control" name="nums_times" value="<?php  echo $tpl['nums_times'];?>"/>
						<span class="help-block">请在“微信公众平台”选择行业为：“IT科技 - 互联网|电子商务”，添加标题为：”计次消费通知“，编号为：“OPENTM202322532”的模板。</span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">会员卡计时续费模板编号</label>
					<div class="col-sm-9 col-xs-12">
						<input type="text" class="form-control" name="times_plus" value="<?php  echo $tpl['times_plus'];?>"/>
						<span class="help-block">请在“微信公众平台”选择行业为：“IT科技 - 互联网|电子商务”，添加标题为：”自动续费成功通知“，编号为：“TM00956”的模板。</span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">会员卡计时即将到期模板编号</label>
					<div class="col-sm-9 col-xs-12">
						<input type="text" class="form-control" name="times_times" value="<?php  echo $tpl['times_times'];?>"/>
						<span class="help-block">请在“微信公众平台”选择行业为：“IT科技 - 互联网|电子商务”，添加标题为：”到期提醒通知“，编号为：“TM00003”的模板。</span>
					</div>
				</div>


			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-9 col-xs-12">
				<input type="hidden" name="token" value="<?php  echo $_W['token'];?>"/>
				<input type="submit" name="submit" value="提交" class="btn btn-primary col-lg-1"/>
			</div>
		</div>
	</form>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
