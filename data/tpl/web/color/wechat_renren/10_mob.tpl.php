<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php  load()->func('tpl');?>
<div class='container' style='padding:0 5px 10px;margin:0;width:100%'>
<div class="panel panel-success">
  <div class="panel-heading">参数设置</div>
  <div class="panel-body">
    <form class="form-horizontal" action="" method="post">
预留
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
