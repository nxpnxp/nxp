<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php  load()->func('tpl');?>
<div class='container' style='padding:0 5px 10px;margin:0;width:100%'>
<div class="panel panel-success">
  <div class="panel-heading">参数设置</div>
  <div class="panel-body">
    <form class="form-horizontal" action="" method="post">
				<div class="form-group">
					<label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label">微信端顶部图片</label>
					<div class="col-sm-8">
						<?php  echo tpl_form_field_image('img', $settings['img'])?>
						<span class="help-block">顶部展示图片（../addons/wechat_renren/template/mobile/index5/banner2.png）</span>
					</div>
				</div>

 				<div class="form-group">
					<label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label">分享标题</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="writer" name="title" value="<?php  echo $settings['title'];?>">
						<span class="help-block">标题</span>
					</div>
				</div>
	
		<div class="form-group">
					<label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label">分享描述</label>
					<div class="col-sm-8">
						<textarea class="form-control" name="desc" rows="5"><?php  echo $settings['desc'];?></textarea>
						<span class="help-block">描述</span>
					</div>
				</div>
  
  				<div class="form-group">
					<label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label">手机跳转</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="writer" name="uuu" value="<?php  echo $settings['uuu'];?>">
						<span class="help-block">手机跳转(可跳转任意地址或者链接)</span>
					</div>
				</div>
  				<div class="form-group">
					<label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label">售前客服</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="writer" name="kefuq1" value="<?php  echo $settings['kefuq1'];?>">
						<span class="help-block">(仅需填写数字QQ号码)</span>
					</div>
				</div>
  				<div class="form-group">
					<label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label">售后客服</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="writer" name="kefuq2" value="<?php  echo $settings['kefuq2'];?>">
						<span class="help-block">(仅需填写数字QQ号码)</span>
					</div>
				</div>
  				<div class="form-group">
					<label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label">招商加盟</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="writer" name="kefuq3" value="<?php  echo $settings['kefuq3'];?>">
						<span class="help-block">(仅需填写数字QQ号码)</span>
					</div>
				</div>
  				<div class="form-group">
					<label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label">联系电话</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="writer" name="kefutel" value="<?php  echo $settings['kefutel'];?>">
						<span class="help-block">(仅需填写数字电话号码)</span>
					</div>
				</div>
				   <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
    <input name="token" type="hidden" value="<?php  echo $_W['token'];?>" />
  <button type="submit" class="btn btn-success col-sm-2" name="submit" value="提交"><i class="fa fa-check-circle"></i> 提交</button>
  </div>
  </div>
</form>
  </div>
</div>

</div>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
