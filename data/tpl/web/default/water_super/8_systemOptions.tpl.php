<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<div class="main">
    <ul class="nav nav-tabs">
        <li ><a href="<?php  echo $this->createWebUrl('addshop',array('shopid'=>$shop['id']));?>">商家信息</a></li>
        <li class="active"><a href="<?php  echo $this->createWebUrl('systemOptions');?>">系统选项</a></li>
        <li><a href="<?php  echo $this->createWebUrl('addMessage');?>">通知设置</a></li>
        <li><a href="<?php  echo $this->createWebUrl('setOrderState');?>">订单状态设置</a></li>
        <li><a href="<?php  echo $this->createWebUrl('fengge');?>">风格模板</a></li>
    </ul>
</div>       
<style>
.table td span{display:inline-block;margin-top:4px;}
.table td input{margin-bottom:0;}
</style>
<div class="clearfix">
<form class="form-horizontal form" action="" method="post" enctype="multipart/form-data">
    <div class="panel panel-default">
        <div class="panel-heading">根据业务场景选择对应的系统选项</div>
        <div class="panel-body">
                <input type="hidden" name="shopid" value="<?php  echo $shop['id'];?>">
                <div class="form-group">
                	<label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label"><span style='color:red'>*</span>是否审核</label>
                	<div class="col-sm-8 col-xs-12">
                    <label class="checkbox">
					  <input type="checkbox" name="needaudit" value="2" <?php  if($shop['needaudit'] == 2) { ?>checked="checked"<?php  } ?>>新增员工是否需要管理员后台审核
					</label>
					 </div>
                </div>
                <div class="form-group">
                	<label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label"><span style='color:red'>*</span>是否开启员工定价</label>
                	<div class="col-sm-8 col-xs-12">
                    <label class="checkbox">
					  <input type="checkbox" name="isygdj" value="1" <?php  if($shop['isygdj'] == 1) { ?>checked="checked"<?php  } ?>>员工上门清点之后确定价格然后再由客户付款
					</label>
					 </div>
                </div>                
                <div class="form-group">
                	<label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label"><span style='color:red'>*</span>支付方式</label>
                	<div class="col-sm-8 col-xs-12">
                    <label class="checkbox">
					  <input type="checkbox" name="paytype[0]" value="1" <?php  if($shop['dangmf'] == 1) { ?>checked="checked"<?php  } ?>>当面付:普通账号
					</label>
					 <label class="checkbox">
					  <input type="checkbox"  name="paytype[1]" value="2" <?php  if($shop['weixf'] == 2) { ?>checked="checked"<?php  } ?>>微信付:高级账号
					</label>
					 <label class="checkbox">
					  <input type="checkbox"  name="paytype[2]" value="3" <?php  if($shop['zhifb'] == 3) { ?>checked="checked"<?php  } ?>>支付宝:高级账号
					</label>
					 </div>
                </div> 
                <div class="form-group">
                	<label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label"><span style='color:red'>*</span>消息通知</label>
                	<div class="col-sm-8 col-xs-12">
                    <label class="checkbox">
					  <input type="checkbox" name="tztype[0]" value="1" <?php  if($shop['smsdx'] == 1) { ?>checked="checked"<?php  } ?>>SMS短信
					</label>
					 <label class="checkbox">
					  <input type="checkbox"  name="tztype[1]" value="2" <?php  if($shop['mbxx'] == 2) { ?>checked="checked"<?php  } ?>>模板消息
					</label>
					 </div>
                </div>                                                          

        </div>       
    </div>
    <div class="form-group">
        <div class="col-sm-12">
            <input name="submit" type="submit" value="提交" class="btn btn-primary col-lg-1">
            <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
        </div>
    </div>
</form>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>