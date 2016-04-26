<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_header', TEMPLATE_INCLUDEPATH)) : (include template('web/_header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('tabs', TEMPLATE_INCLUDEPATH)) : (include template('tabs', TEMPLATE_INCLUDEPATH));?>
<form id="setform"  action="" method="post" class="form-horizontal form">
    <div class='panel panel-default'>
       
        <div class='panel-heading'>
            基础设置
        </div>
        <div class='panel-body'>
          <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">发货提醒</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if(cv('virtual.set.save')) { ?>
                        <input type="text" name="tm[send]" class="form-control" value="<?php  echo $set['tm']['send'];?>" />
                        <div class="help-block">公众平台模板消息编号: OPENTM203331384</div>
                         <?php  if(p('creditshop')) { ?>
                         <div class="help-block">与“积分商城”插件发货提醒模板消息一致，如果公众平台已经添加，无需重复添加，直接复制即可</div>
                         <?php  } ?>
                        <?php  } else { ?>
                        <input type="hidden" name="tm[send]" value="<?php  echo $set['tm']['send'];?>" />
                        <div class="form-control-static"><?php  echo $set['tm']['send'];?></div>
                        <?php  } ?>
                    </div>
        </div>
      <?php if(cv('virtual.set.save')) { ?>
         <div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
            <div class="col-sm-9">
                <input type="submit" name="submit" value="提交" class="btn btn-primary col-lg-1"/>
                <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
            </div>
        </div>
        </div>
      <?php  } ?>
 
</form>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>