<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_header', TEMPLATE_INCLUDEPATH)) : (include template('web/_header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('tabs', TEMPLATE_INCLUDEPATH)) : (include template('tabs', TEMPLATE_INCLUDEPATH));?>
<form id="setform"  action="" method="post" class="form-horizontal form">
    <div class='panel panel-default'>
       
        <div class='panel-heading'>
            基础设置
        </div>
        <div class='panel-body'>
            <div class="form-group">
                       <label class="col-xs-12 col-sm-3 col-md-2 control-label">在会员中心显示积分兑换按钮</label>
                       <div class="col-sm-9 col-xs-12">
                                  <?php if(cv('creditshop.set.save')) { ?>
                                  <label class='radio radio-inline'>
                                       <input type='radio' value='0' name='setdata[centeropen]' <?php  if($set['centeropen']==0) { ?>checked<?php  } ?> /> 关闭
                                  </label>
                                  <label class='radio radio-inline'>
                                       <input type='radio' value='1' name='setdata[centeropen]'  <?php  if($set['centeropen']==1) { ?>checked<?php  } ?> /> 显示
                                  </label>
                                  <?php  } else { ?>
                                    <div class='form-control-static'><?php  if($set['centeropen']==1) { ?>显示<?php  } else { ?>关闭<?php  } ?></div>
                                  <?php  } ?>
                       </div>
                   </div>
            
            <div class="form-group">
                       <label class="col-xs-12 col-sm-3 col-md-2 control-label">线下兑换关键词</label>
                       <div class="col-sm-9 col-xs-12">
                               <?php if(cv('creditshop.set.save')) { ?>
                           <input type="text" name="setdata[exchangekeyword]" class="form-control" value="<?php  echo $set['exchangekeyword'];?>" />
                           <span class='help-block'>店员线下兑换使用，如果不填写默认为“兑换"，使用方法: 回复关键词后系统会提示输入兑换码</span>
                           <?php  } else { ?>
                              <div class='form-control-static'><?php  if(empty($set['exchangekeyword'])) { ?>兑换<?php  } else { ?><?php  echo $set['exchangekeyword'];?><?php  } ?></div>
                           <?php  } ?>
                       </div>
                   </div>
     <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">关注引导页面</label>
                <div class="col-sm-9 col-xs-12">
                          <?php if(cv('creditshop.set.save')) { ?>
                    <input type="text" name="setdata[followurl]" class="form-control" value="<?php  echo $set['followurl'];?>"  />
                    <span class="help-block">不填写默认为商城引导页面</span>
                    <?php  } else { ?>
                    <div class='form-control-static'><?php  echo $set['followurl'];?></div>
                    <?php  } ?>
                </div>
            </div>
                 <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">积分说明页面</label>
                <div class="col-sm-9 col-xs-12">
                           <?php if(cv('creditshop.set.save')) { ?>
                    <input type="text" name="setdata[crediturl]" class="form-control" value="<?php  echo $set['crediturl'];?>"  />
                      <?php  } else { ?>
                    <div class='form-control-static'><?php  echo $set['crediturl'];?></div>
                    <?php  } ?>
                </div>
            </div>
            <div class="form-group">
    <label class="col-xs-12 col-sm-3 col-md-2 control-label">分享标题</label>
    <div class="col-sm-9 col-xs-12">
           <?php if(cv('creditshop.set.save')) { ?>
        <input type="text" name="setdata[share_title]" id="share_title" class="form-control" value="<?php  echo $set['share_title'];?>" />
        <?php  } else { ?>
        <div class='form-control-static'><?php  echo $set['share_title'];?></div>
        <?php  } ?>
    </div>
</div>
<div class="form-group">
    <label class="col-xs-12 col-sm-3 col-md-2 control-label">分享图标</label>
    <div class="col-sm-9 col-xs-12">
          <?php if(cv('creditshop.set.save')) { ?>
        <?php  echo tpl_form_field_image('setdata[share_icon]', $set['share_icon'])?>
             <?php  } else { ?>
                            <?php  if(!empty($set['share_icon'])) { ?>
                            <a href='<?php  echo tomedia($set['share_icon'])?>' target='_blank'>
                            <img src="<?php  echo tomedia($set['share_icon'])?>" style='width:100px;border:1px solid #ccc;padding:1px' />
                            </a>
                            <?php  } ?>
                        <?php  } ?>
    </div>
</div>
<div class="form-group">
    <label class="col-xs-12 col-sm-3 col-md-2 control-label">分享描述</label>
    <div class="col-sm-9 col-xs-12">
             <?php if(cv('creditshop.set.save')) { ?>
        <textarea name="setdata[share_desc]" class="form-control" ><?php  echo $set['share_desc'];?></textarea>
             <?php  } else { ?>
        <div class='form-control-static'><?php  echo $set['share_desc'];?></div>
        <?php  } ?>
    </div>
</div>
               <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">底部版权</label>
                <div class="col-sm-9 col-xs-12">
                       <?php if(cv('creditshop.set.save')) { ?>
        <textarea name="setdata[copyright]" class="form-control" ><?php  echo $set['copyright'];?></textarea>
             <?php  } else { ?>
        <div class='form-control-static'><?php  echo $set['copyright'];?></div>
        <?php  } ?>
                </div> 
            </div>
                  <div class="form-group">
        <label class="col-xs-12 col-sm-3 col-md-2 control-label">模板选择</label>
        <div class="col-sm-9 col-xs-12">
            <select class='form-control' name='setdata[style]'>
                <?php  if(is_array($styles)) { foreach($styles as $style) { ?>
                <option value='<?php  echo $style;?>' <?php  if($style==$set['style']) { ?>selected<?php  } ?>><?php  echo $style;?></option>
                <?php  } } ?>
            </select>
        </div>
    </div>
            
      
         <div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
            <div class="col-sm-9">
                <input type="submit" name="submit" value="提交" class="btn btn-primary col-lg-1" onclick='return formcheck()' />
                <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
            </div>
        </div>
        </div>
 
</form>
<script language='javascript'>
    function formcheck(){
        var become_child =$(":radio[name='setdata[become_child]']:checked").val();
        if( become_child=='1'  || become_child=='2' ){
            if( $(":radio[name='setdata[become]']:checked").val() =='0'){
              alert('成为下线条件选择了首次下单/首次付款，成为分销商条件不能选择无条件!')   ;
              return false;
            }
        }
        return true;
    }
    </script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>