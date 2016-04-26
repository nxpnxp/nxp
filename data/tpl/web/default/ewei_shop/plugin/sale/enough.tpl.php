<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_header', TEMPLATE_INCLUDEPATH)) : (include template('web/_header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('tabs', TEMPLATE_INCLUDEPATH)) : (include template('tabs', TEMPLATE_INCLUDEPATH));?>
<div class="main">
    <form id="dataform"    <?php if(cv('sale.deduct.save')) { ?>action="" method="post"<?php  } ?> class="form-horizontal form">
        <div class="panel panel-default">
            <div class="panel-heading">
                满额包邮设置
            </div>
            <div class="panel-body">
                    <div class="form-group">
                       <label class="col-xs-12 col-sm-3 col-md-2 control-label">满额包邮</label>
                       <div class="col-sm-9 col-xs-12">
                           <?php if(cv('sale.enough.save')) { ?>
                           <label class="radio-inline">
                               <input type="radio" name="data[enoughfree]" value='1' <?php  if($set['enoughfree']==1) { ?>checked<?php  } ?> /> 开启
                           </label>
                           <label class="radio-inline">
                               <input type="radio" name="data[enoughfree]" value='0' <?php  if(empty($set['enoughfree'])) { ?>checked<?php  } ?> /> 关闭
                            </label>
                           <span class='help-block'>开启满包邮, 订单总金额超过多少可以包邮</span>
                           <?php  } else { ?>
                           <div class='form-control-static'><?php  if($set['enoughfree']==1) { ?>开启<?php  } else { ?>关闭<?php  } ?></div>
                           <?php  } ?>
                       </div>
                   </div> 
                
                  <div class="form-group">
                       <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                       <div class="col-sm-4">
                           <?php if(cv('sale.enough.save')) { ?>
                          <div class='input-group'>
                                   <span class="input-group-addon">单笔订单满</span>
                                   <input type="text" name="data[enoughorder]"  value="<?php  echo $set['enoughorder'];?>" class="form-control" />
                                   <span class='input-group-addon'>元</span>
                           </div>
                           <span class='help-block'>如果开启满额包邮，设置0为全场包邮</span>
                           <?php  } else { ?>
                           <div class='form-control-static'><?php  if(empty($set['enoughmoney'])) { ?>全场包邮<?php  } else { ?>订单金额满<?php  echo $set['enoughmoney'];?>}元包邮<?php  } ?></div>
                           <?php  } ?>
                       </div>
                   </div> 
                
                
                  <div class="form-group">
                       <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                       <div class="col-sm-9 col-xs-12">
                           <?php if(cv('sale.enough.save')) { ?>
                           <div id="areas" class="form-control-static"><?php  echo $set['enoughareas'];?></div>
                           <a href="javascript:;" class="btn btn-default" onclick="selectAreas()">添加不参加满包邮的地区</a>
                           <input type="hidden" name="data[enoughareas]" value="<?php  echo $set['enoughareas'];?>" />
                           <?php  } else { ?>
                           <div class='form-control-static'><?php  echo $set['enoughareas'];?></div>
                           <?php  } ?>
                       </div>
                   </div> 
                     <div class="form-group">
                       <label class="col-xs-12 col-sm-3 col-md-2 control-label">满额减</label>
                       <div class="col-sm-4">
                           <?php if(cv('sale.enough.save')) { ?>
                          <div class='input-group'>
                                   <span class="input-group-addon">单笔订单满</span>
                                   <input type="text" name="data[enoughmoney]"  value="<?php  echo $set['enoughmoney'];?>" class="form-control" />
                                   <span class='input-group-addon'>元 立减</span>
                                   <input type="text" name="data[enoughdeduct]"  value="<?php  echo $set['enoughdeduct'];?>" class="form-control" />
                                   <span class='input-group-addon'>元</span>
                           </div>
                           <span class='help-block'>两个选项必须都填写，才能生效</span>
                           <?php  } else { ?>
                           <div class='form-control-static'><?php  if(empty($set['enoughmoney'])) { ?>全场包邮<?php  } else { ?>订单金额满<?php  echo $set['enoughmoney'];?>}元包邮<?php  } ?></div>
                           <?php  } ?>
                       </div>
                   </div> 
              
                   <?php if(cv('sale.deduct.save')) { ?>
                <div class="form-group"></div>
                   <div class="form-group">
                           <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                           <div class="col-sm-9 col-xs-12">
                                 <input type="submit" name="submit"  value="保存设置" class="btn btn-primary"/>
                                 <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                           </div>
                    </div>
                <?php  } ?>
            </div>
        </div>
    </form>
</div>
<style type='text/css'>
    .province { float:left; position:relative;width:150px; height:35px; line-height:35px;border:1px solid #fff;}
    .province:hover { border:1px solid #f7e4a5;border-bottom:1px solid #fffec6; background:#fffec6;}
    .province .cityall { margin-top:10px;}
    .province ul { list-style: outside none none;position:absolute;padding:0;background:#fffec6;border:1px solid #f7e4a5;display:none;
    width:auto; width:300px; z-index:999999;left:-1px;top:32px;}
    .province ul li  { float:left;min-width:60px;margin-left:20px; height:30px;line-height:30px; }
 </style>
 <div id="modal-areas"  class="modal fade" tabindex="-1">
    <div class="modal-dialog" style='width: 920px;'>
        <div class="modal-content">
            <div class="modal-header"><button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button><h3>选择区域</h3></div>
            <div class="modal-body" style='height:280px;;' > 
                
                <?php  if(is_array($areas['address']['province'])) { foreach($areas['address']['province'] as $value) { ?>
                <div class='province'>
                     <label class='checkbox-inline' style='margin-left:20px;'>
                         <input type='checkbox' class='cityall' /> <?php  echo $value['@attributes']['name']?>
                         <span class="citycount" style='color:#ff6600'></span>
                     </label>
                    <?php  if(count($value['city'])>0) { ?>
                    <ul>
                        <?php  if(is_array($value['city'])) { foreach($value['city'] as $c) { ?>
                        <li>
                             <label class='checkbox-inline'>
                                  <input type='checkbox' class='city' style='margin-top:8px;' city="<?php  echo $c['@attributes']['name']?>" /> <?php  echo $c['@attributes']['name']?>
                            </label>
                     </li>
                        <?php  } } ?>
                    </ul>
                    <?php  } ?>
                </div>
                <?php  } } ?>
            
            </div>
            <div class="modal-footer">
                <a href="javascript:;" id='btnSubmitArea' class="btn btn-success" data-dismiss="modal" aria-hidden="true">确定</a>
                <a href="javascript:;" class="btn btn-default" data-dismiss="modal" aria-hidden="true">关闭</a>
            </div>
        </div>
     </div>
</div> 
 <script language='javascript'>
    $(function(){
   
        $('.province').mouseover(function(){
              $(this).find('ul').show();
        }).mouseout(function(){
              $(this).find('ul').hide();
        });
        
        $('.cityall').click(function(){
            var checked = $(this).get(0).checked;
            var citys = $(this).parent().parent().find('.city');
            citys.each(function(){
                $(this).get(0).checked = checked;
            });
            var count = 0;
            if(checked){
                count =  $(this).parent().parent().find('.city:checked').length;
            }
            if(count>0){
               $(this).next().html("(" + count + ")")    ;
            }
            else{
                $(this).next().html("");
            }
        });
        $('.city').click(function(){
            var checked = $(this).get(0).checked;
            var cityall = $(this).parent().parent().parent().parent().find('.cityall');
          
            if(checked){
                cityall.get(0).checked = true;
            }
            var count = cityall.parent().parent().find('.city:checked').length;
            if(count>0){
               cityall.next().html("(" + count + ")")    ;
            }
            else{
                cityall.next().html("");
            }
        });    
      
    });
    
     function clearSelects(){
         $('.city').attr('checked',false).removeAttr('disabled');
         $('.cityall').attr('checked',false).removeAttr('disabled');
         $('.citycount').html('');
    }
    
    function selectAreas(){
        clearSelects();
        var old_citys = $('#areas').html().split(';');
      
                
        $('.city').each(function(){
            var parentcheck = false;
            for(var i in old_citys){
                if(old_citys[i]==$(this).attr('city')){
                    parentcheck = true;
                    $(this).get(0).checked = true;
                    break;
                }
            }
            if(parentcheck){
                $(this).parent().parent().parent().parent().find('.cityall').get(0).checked=  true;
            }
        });
        
        $("#modal-areas").modal();
        var citystrs = '';
        $('#btnSubmitArea').unbind('click').click(function(){
                   $('.city:checked').each(function(){              
                       citystrs+= $(this).attr('city') +";";
                   }); 
                   $('#areas').html(citystrs);
                   $(":input[name='data[enoughareas]']").val(citystrs);
        })
    
    }
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_footer', TEMPLATE_INCLUDEPATH)) : (include template('web/_footer', TEMPLATE_INCLUDEPATH));?>
