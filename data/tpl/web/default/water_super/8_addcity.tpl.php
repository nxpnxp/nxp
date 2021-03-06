<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<div class="main">
    <ul class="nav nav-tabs">
        <li><a href="<?php  echo $this->createWebUrl('city');?>">城市管理</a></li>
        <li class="active"><a href="<?php  echo $this->createWebUrl('addcity');?>">添加城市</a></li>
    </ul>
</div>       
<style>
.table td span{display:inline-block;margin-top:4px;}
.table td input{margin-bottom:0;}
</style>
<div class="clearfix">
<form class="form-horizontal form" action="" method="post" enctype="multipart/form-data">
    <div class="panel panel-default">
        <div class="panel-heading">服务城市信息编辑</div>
        <div class="panel-body">
                <input type="hidden" name="cityid" value="<?php  echo $city['id'];?>">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label"><span style='color:red'>*</span>城市名称</label>
                    <div class="col-sm-8 col-xs-12">
                        <input type="text" class="form-control" placeholder="" name="cityname" value="<?php  echo $city['cityname'];?>">
                    	<span class="help-block">例如：北京市</span>
                    </div>
                </div>              
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>服务详情</label>
					<div class="col-sm-9 col-xs-12">
						<textarea style="height:200px; width:80%;" id='rule' class="form-control span7 richtext" name="cityinfo" cols="70"><?php  echo $city['cityinfo'];?></textarea>
						<span class="help-block">介绍该城市的服务情况，例如范围、服务时间</span>
					</div>
				</div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label">城市服务范围图片</label>
                    <div class="col-sm-8 col-xs-12">
                       <?php  echo tpl_form_field_image('cityphoto',$city['cityphoto']);?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                    <div class="col-sm-9 col-xs-12">
                        <div class="help-block">城市服务范围图片</div>
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