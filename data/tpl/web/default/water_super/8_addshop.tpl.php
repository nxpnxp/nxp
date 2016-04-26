<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<div class="main">
    <ul class="nav nav-tabs">
        <li class="active"><a href="<?php  echo $this->createWebUrl('addshop',array('shopid'=>$shop['id']));?>">商家信息</a></li>
        <li><a href="<?php  echo $this->createWebUrl('systemOptions');?>">系统选项</a></li>
        <li><a href="<?php  echo $this->createWebUrl('addMessage');?>">订单通知设置</a></li>
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
        <div class="panel-heading">系统店面信息编辑</div>
        <div class="panel-body">
                <input type="hidden" name="shopid" value="<?php  echo $shop['id'];?>">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label"><span style='color:red'>*</span>商家名称</label>
                    <div class="col-sm-8 col-xs-12">
                        <input type="text" class="form-control" placeholder="" name="shopname" value="<?php  echo $shop['shopname'];?>">
                    	<span class="help-block">例如：天天洗衣</span>
                    </div>
                </div> 
<!--                 <div class="form-group">
                    <label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label"><span style='color:red'>*</span>商家标语</label>
                    <div class="col-sm-8 col-xs-12">
                        <input type="text" class="form-control" placeholder="" name="indexad" value="<?php  echo $shop['indexad'];?>">
                    	<span class="help-block">例如：天天洗衣，天天好心情</span>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label"><span style='color:red'>*</span>首页标语1</label>
                    <div class="col-sm-8 col-xs-12">
                        <input type="text" class="form-control" placeholder="呼叫下单" name="xc1" value="<?php  echo $shop['xc1'];?>">
                    	<span class="help-block">例如：呼叫下单</span>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label"><span style='color:red'>*</span>首页标语2</label>
                    <div class="col-sm-8 col-xs-12">
                        <input type="text" class="form-control" placeholder="专业清洗" name="xc2" value="<?php  echo $shop['xc2'];?>">
                    	<span class="help-block">例如：专业清洗</span>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label"><span style='color:red'>*</span>首页标语3</label>
                    <div class="col-sm-8 col-xs-12">
                        <input type="text" class="form-control" placeholder="挂件送回" name="xc3" value="<?php  echo $shop['xc3'];?>">
                    	<span class="help-block">例如：挂件送回</span>
                    </div>
                </div> -->
                <div class="form-group">
                    <label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label"><span style='color:red'>*</span>选择商品页标语</label>
                    <div class="col-sm-8 col-xs-12">
                        <input type="text" class="form-control" placeholder="我要洗衣" name="sltxc" value="<?php  echo $shop['sltxc'];?>">
                    	<span class="help-block">例如：我要洗衣</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label"><span style='color:red'>*</span>选择商品小贴士</label>
                    <div class="col-sm-8 col-xs-12">
                        <textarea class="form-control"  name="sltts" ><?php  echo $shop['sltts'];?></textarea>
                    	<span class="help-block">例如：如果您不确定要清洗的衣服归类，您可以先选择第一类衣物(200字以内)</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label"><span style='color:red'>*</span>提供服务名称</label>
                    <div class="col-sm-8 col-xs-12">
                        <input type="text" class="form-control" placeholder="洗衣服务" name="fuwuname" value="<?php  echo $shop['fuwuname'];?>">
                    	<span class="help-block">例如：洗衣服务、快递服务（展示在订单的页面上）</span>
                    </div>
                </div>                                 
                <div class="form-group">
                    <label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label"><span style='color:red'>*</span>客服电话</label>
                    <div class="col-sm-8 col-xs-12">
                        <input type="text" class="form-control" placeholder="" name="kefutel" value="<?php  echo $shop['kefutel'];?>">
                    	<span class="help-block">联系电话</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label"><span style='color:red'>*</span>客服微信</label>
                    <div class="col-sm-8 col-xs-12">
                        <input type="text" class="form-control" placeholder="" name="kefuwx" value="<?php  echo $shop['kefuwx'];?>">
                    	<span class="help-block">店主的微信账号</span>
                    </div>
                </div>                                                
                <div class="form-group">
                    <label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label">会员卡图片</label>
                    <div class="col-sm-8 col-xs-12">
                       <?php  echo tpl_form_field_image('cardlogo',$shop['cardlogo']);?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label"><span style='color:red'>*</span>员工新增密码</label>
                    <div class="col-sm-8 col-xs-12">
                        <input type="text" class="form-control" placeholder="" name="addemployeepwd" value="<?php  echo $shop['addemployeepwd'];?>">
                    	<span class="help-block">在公众号内输入  密码#员工姓名#员工电话  ，即可完成添加员工操作</span>
                    </div>
                </div>
<!--                 <div class="form-group">
                    <label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label"><span style='color:red'>*</span>价目描述URL</label>
                    <div class="col-sm-8 col-xs-12">
                        <input type="text" class="form-control" placeholder="" name="goodsinfourl" value="<?php  echo $shop['goodsinfourl'];?>">
                    	<span class="help-block">首页右上角有个价目按钮，可链接到设定的一片文章内容，描述商品分类价格信息等</span>
                    </div>
                </div>   -->
               <div class="form-group">
                    <label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label"><span style='color:red'>*</span>意见反馈URL</label>
                    <div class="col-sm-8 col-xs-12">
                        <input type="text" class="form-control" placeholder="" name="yjfkurl" value="<?php  echo $shop['yjfkurl'];?>">
                    	<span class="help-block">个人中心意见反馈：百度【麦客表单】www.mikecrm.com</span>
                    </div>
                </div>                                   
                <div class="form-group">
                    <label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label"><span style='color:red'>*</span>充值送值</label>
                    <div class="col-sm-8 col-xs-12">
                        <input type="text" class="form-control" placeholder="" name="recharge" value="<?php  echo $shop['recharge'];?>">
                    	<span class="help-block">例如：充100送10，300送40，500送70的写法如下：100-10#300-40#500-70</span>
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