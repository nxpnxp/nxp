<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<div class="main">
    <ul class="nav nav-tabs">
        <li><a href="<?php  echo $this->createWebUrl('goods');?>">商品管理</a></li>
        <li class="active"><a href="<?php  echo $this->createWebUrl('addgoods');?>">添加商品</a></li>
    </ul>
</div>       
<style>
.table td span{display:inline-block;margin-top:4px;}
.table td input{margin-bottom:0;}
.display {display:block;}
</style>
<script type="text/javascript">
$(document).ready(function(){
	if($('#isjj').is(':checked')){
		$(".display").css('display','block');  
	}else{
		$(".display").css('display','none');  
	}
	$("#isjj").click(function(){
		if($('#isjj').is(':checked')){
			$(".display").css('display','block');  
		}else{
			$(".display").css('display','none');  
			
		}
		
	});
	
});

</script>
<div class="clearfix">
<form class="form-horizontal form" action="" method="post" enctype="multipart/form-data">
    <div class="panel panel-default">
        <div class="panel-heading">商品信息编辑</div>
        <div class="panel-body">
                <input type="hidden" name="goodsid" value="<?php  echo $goods['id'];?>">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label"><span style='color:red'>*</span>商品名称</label>
                    <div class="col-sm-8 col-xs-12">
                        <input type="text" class="form-control" placeholder="" name="goodsname" value="<?php  echo $goods['goodsname'];?>">
                    	<span class="help-block">例如：9元区</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label"><span style='color:red'>*</span>商品价格</label>
                    <div class="col-sm-8 col-xs-12">
                        <input type="text" class="form-control" placeholder="" name="goodsprice" value="<?php  echo $goods['goodsprice'];?>">
                    	<span class="help-block">例如：9</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label"><span style='color:red'>*</span>商品单位</label>
                    <div class="col-sm-8 col-xs-12">
                        <input type="text" class="form-control" placeholder="" name="danwei" value="<?php  echo $goods['danwei'];?>">
                    	<span class="help-block">例如：件/斤/个</span>
                    </div>
                </div>                
                <div class="form-group">
                	<label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label"><span style='color:red'>*</span>是否计件</label>
                	<div class="col-sm-8 col-xs-12">
                    <label class="checkbox">
					  <input type="checkbox" id="isjj" name="isjj" value="1" <?php  if($goods['isjj'] == 1) { ?>checked="checked"<?php  } ?>>商品是否计件销售
					  <span class="help-block">微信端商品列表上方的是计件的，下方横排的是不计件的，若选中为计件</span>
					</label>
					 </div>
                </div>                
                <div class="form-group display">
                    <label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label">商品图片</label>
                    <div class="col-sm-8 col-xs-12">
                       <?php  echo tpl_form_field_image('goodsphoto',$goods['goodsphoto']);?>
                    </div>
                </div> 
                <div class="form-group display">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                    <div class="col-sm-9 col-xs-12">
                        <div class="help-block">商品图片图片，建议大小：50*50</div>
                    </div>
                </div>                                             
				<div class="form-group display">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>商品详情</label>
					<div class="col-sm-9 col-xs-12">
						<textarea style="height:200px; width:80%;" id='rule' class="form-control span7 richtext" name="goodsinfo" cols="70"><?php  echo $goods['goodsinfo'];?></textarea>
						<span class="help-block">介绍该商品的详细信息、分类等等，【注意字数、折行】</span>
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
<script type="text/javascript">
    var category = <?php  echo json_encode($children)?>;
    require(['jquery', 'util'], function($, u){
        $(function(){
            u.editor($('.richtext')[0]);
        });
        $('#credit1').click(function(){
            $('#credit-status1').show();
        });
        $('#credit0').click(function(){
            $('#credit-status1').hide();
        });
    });
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>