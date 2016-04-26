<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<div class="main">
    <ul class="nav nav-tabs">
        <li><a href="<?php  echo $this->createWebUrl('city');?>">城市管理</a></li>
        <li><a href="<?php  echo $this->createWebUrl('area', array('cityid' => $cityid));?>">区域管理</a></li>
        <li class="active"><a href="<?php  echo $this->createWebUrl('addarea', array('cityid' => $cityid));?>">添加区域</a></li>
    </ul>
</div>       
<style>
.table td span{display:inline-block;margin-top:4px;}
.table td input{margin-bottom:0;}
</style>
<div class="clearfix">
<form class="form-horizontal form" action="" method="post" enctype="multipart/form-data">
    <div class="panel panel-default">
        <div class="panel-heading">奖品信息编辑</div>
        <div class="panel-body">
                <input type="hidden" name="areaid" value="<?php  echo $area['id'];?>">
                <input type="hidden" name="cityid" value="<?php  echo $cityid;?>">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label"><span style='color:red'>*</span>所属城市</label>
                    <div class="col-sm-8 col-xs-12">
                    	<input type="text" class="form-control" disabled="disabled" placeholder="" name="groupid" value="<?php  echo $city['cityname'];?>">
                    </div>
                </div>                
				<div class="form-group">
                    <label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label">区域名称</label>
                    <div class="col-sm-8 col-xs-12">
                        <input type="text" class="form-control" placeholder="" name="areaname" value="<?php  echo $area['areaname'];?>">
                    	<span class="help-block">区域名称，尽量简短，例如城东、城西</span>
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