<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<div class="main">
    <ul class="nav nav-tabs">
        <li ><a href="<?php  echo $this->createWebUrl('addshop',array('shopid'=>$shop['id']));?>">商家信息</a></li>
        <li ><a href="<?php  echo $this->createWebUrl('systemOptions');?>">系统选项</a></li>
        <li ><a href="<?php  echo $this->createWebUrl('addMessage');?>">订单通知设置</a></li>
        <li class="active"><a href="<?php  echo $this->createWebUrl('setOrderState');?>">订单状态设置</a></li>
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
        <div class="panel-heading">根据业务场景设置订单状态展示内容</div>
        <div class="panel-body">
                <input type="hidden" name="shopid" value="<?php  echo $shop['id'];?>">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label"><span style='color:red'>*</span>【订单状态0】</label>
                    <div class="col-sm-8 col-xs-12">
                        <input type="text" class="form-control" placeholder="" name="ddzt0" value="<?php  echo $shop['ddzt0'];?>">
                    	<span class="help-block">订单第1个状态的描述内容，例如：下单成功，正在安排服务人员</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label"><span style='color:red'>*</span>【订单状态1】</label>
                    <div class="col-sm-8 col-xs-12">
                        <input type="text" class="form-control" placeholder="" name="ddzt1" value="<?php  echo $shop['ddzt1'];?>">
                    	<span class="help-block">订单第2个状态的描述内容，例如：工作人员上门服务途中</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label"><span style='color:red'>*</span>【订单状态2】</label>
                    <div class="col-sm-8 col-xs-12">
                        <input type="text" class="form-control" placeholder="" name="ddzt2" value="<?php  echo $shop['ddzt2'];?>">
                    	<span class="help-block">订单第3个状态的描述内容，例如：上门取件成功或者上门开始服务（家政服务）</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label"><span style='color:red'>*</span>【订单状态3】</label>
                    <div class="col-sm-8 col-xs-12">
                        <input type="text" class="form-control" placeholder="" name="ddzt3" value="<?php  echo $shop['ddzt3'];?>">
                    	<span class="help-block">订单第4个状态的描述内容，例如：正在清洗衣服（洗衣店）、正在打包发送（快递）</span>
                    </div>
                </div>    
                <div class="form-group">
                    <label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label"><span style='color:red'>*</span>【订单状态4】</label>
                    <div class="col-sm-8 col-xs-12">
                        <input type="text" class="form-control" placeholder="" name="ddzt4" value="<?php  echo $shop['ddzt4'];?>">
                    	<span class="help-block">订单第5个状态的描述内容，例如：洗衣完毕，上门归还衣物途中（洗衣）、快递已发出</span>
                    </div>
                </div>  
                 <div class="form-group">
                    <label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label"><span style='color:red'>*</span>【订单状态5】</label>
                    <div class="col-sm-8 col-xs-12">
                        <input type="text" class="form-control" placeholder="" name="ddzt5" value="<?php  echo $shop['ddzt5'];?>">
                    	<span class="help-block">订单第6个状态的描述内容，例如：确认接收衣物，服务结束（最后一个一般为结束状态）</span>
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