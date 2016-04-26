<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<div class="main">
	<ul class="nav nav-tabs">
		<li<?php  if($_GPC['do'] == 'manage' || $_GPC['do'] == '' ) { ?> class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('manage');?>"> 管理幸运大转盘</a></li>
		<li<?php  if($_GPC['do'] == 'post') { ?> class="active"<?php  } ?>><a href="<?php  echo url('platform/reply/post',array('m'=>'stonefish_bigwheel'));?>"><i class="fa fa-plus"></i> 添加幸运大转盘</a></li>
		<li<?php  if($_GPC['do'] == 'template') { ?> class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('template');?>">管理活动模板</a></li>
        <li<?php  if($_GPC['do'] == 'templatepost') { ?> class="active"<?php  } ?>><a href="<?php  echo url('site/entry/templatepost',array('m'=>'stonefish_bigwheel'));?>"><i class="fa fa-plus"></i> 添加活动模板</a></li>
		<li<?php  if($_GPC['do'] == 'tmplmsg') { ?> class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('tmplmsg');?>"> 管理消息模板</a></li>
        <li<?php  if($_GPC['do'] == 'tmplmsgpost') { ?> class="active"<?php  } ?>><a href="<?php  echo url('site/entry/tmplmsgpost',array('m'=>'stonefish_bigwheel'));?>"><i class="fa fa-plus"></i> 添加消息模板</a></li>
	</ul>     
    <div class="panel panel-info">
	<div class="panel-heading">筛选</div>
	<div class="panel-body">
		<form action="./index.php" method="get" class="form-horizontal" role="form">
			<input type="hidden" name="c" value="site" />
			<input type="hidden" name="a" value="entry" />
        	<input type="hidden" name="m" value="stonefish_bigwheel" />
        	<input type="hidden" name="do" value="manage" />
			<div class="form-group">
				<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">关键字</label>
				<div class="col-xs-12 col-sm-8 col-lg-9">
					<input class="form-control" name="keyword" id="" type="text" value="<?php  echo $_GPC['keyword'];?>">
				</div>
                <div class=" col-xs-12 col-sm-2 col-lg-2">
					<button class="btn btn-default"><i class="fa fa-search"></i> 搜索</button>
				</div>
			</div>
 			<div class="form-group">
			</div>
		</form>
	</div> 
    </div>    
	<div class="panel panel-default">
		<div class="panel-body table-responsive">
		<table class="table table-hover">
			<thead class="navbar-inner">
				<tr>
					<th class='with-checkbox' style="width:30px;">删？</th>
					<th style="width:140px;">活动名称</th>
					<th style="width:80px;">参与/浏览</th>
					<th style="width:140px;">开始/结束时间</th>
					<th style="width:70px;">状态</th>
					<th style="width:580px;">操作</th>
				</tr>
			</thead>
			<tbody>
				<?php  if(is_array($list)) { foreach($list as $row) { ?>
				<tr>
					<td class="with-checkbox"><input type="checkbox" name="check" value="<?php  echo $row['rid'];?>"></td>
					<td><a href="<?php  echo url('platform/reply/post',array('m'=>'stonefish_bigwheel','rid'=>$row['rid']));?>" title="<?php  echo $row['title'];?>"><?php  echo $row['title'];?></a></td>
					<td><a href="<?php  echo url('site/entry/trend',array('m'=>'stonefish_bigwheel','rid'=>$row['rid']));?>" title="活动分析表"><?php  echo $row['fansnum'];?>/<?php  echo $row['viewnum'];?></a></td>
					<td><?php  echo $row['start_time'];?><br><?php  echo $row['end_time'];?></td>
					<td><?php  echo $row['status'];?></td>
					<td>
						<a href="<?php  echo $this->createWebUrl('fansdata',array('rid'=>$row['rid']))?>" class="btn  btn-default" data-toggle="tooltip" data-placement="top" title="参与粉丝"><i class="fa fa-users"></i> 粉丝</a>
						<a href="<?php  echo $this->createWebUrl('sharedata',array('rid'=>$row['rid']))?>" class="btn  btn-default" data-toggle="tooltip" data-placement="top" title="粉丝分享数据"><i class="fa fa-share-alt"></i> 分享</a>
						<a href="<?php  echo $this->createWebUrl('prizedata',array('rid'=>$row['rid']))?>" class="btn  btn-default" data-toggle="tooltip" data-placement="top" title="中奖记录名单"><i class="fa fa-gift"></i> 中奖</a>
						<a href="<?php  echo $this->createWebUrl('rankdata',array('rid'=>$row['rid']))?>" class="btn  btn-default" data-toggle="tooltip" data-placement="top" title="粉丝排行榜"><i class="fa fa-list-ol"></i> 排行</a>
						<a href="<?php  echo $this->createWebUrl('posttmplmsg',array('rid'=>$row['rid']))?>" class="btn  btn-default" data-toggle="tooltip" data-placement="top" title="消息通知记录"><i class="fa fa-volume-up"></i> 消息</a>
						<?php  if($stonefish_branch) { ?><a href="<?php  echo $this->createWebUrl('branch',array('rid'=>$row['rid']))?>" class="btn  btn-default" data-toggle="tooltip" data-placement="top" title="商家赠送项"><i class="fa fa-plus-square"></i> 商家</a><?php  } ?>
                        <a class="btn btn-default" data-toggle="tooltip" data-placement="top" href="<?php  echo url('platform/reply/post',array('m'=>'stonefish_bigwheel','rid'=>$row['rid']));?>" title="编辑"><i class="fa fa-edit"></i></a>
                        <?php  if($row['isshow']==0) { ?>
                        <a class="btn btn-default" title="开始活动" data-placement="top" href="#" onclick="drop_confirm('您确定要开始吗,设置中途可以随时修改!', '<?php  echo $this->createWebUrl('setshow',array('rid'=>$row['rid'],'isshow'=>1))?>');"><i class="fa fa-play"></i></a>
                        <?php  } else if($row['isshow']==1) { ?>
                        <a class="btn btn-default" title="结束活动" data-placement="top" href="#" onclick="drop_confirm('您确定要暂停吗,设置中途可以随时修改!', '<?php  echo $this->createWebUrl('setshow',array('rid'=>$row['rid'],'isshow'=>0))?>');"><i class="fa fa-stop"></i></a>
                        <?php  } ?>
                        <a class="btn btn-default" data-toggle="tooltip" data-placement="top" href="#" onclick="drop_confirm('您确定要删除吗?', '<?php  echo $this->createWebUrl('delete',array('rid'=>$row['rid']))?>');" title="删除活动"><i class="fa fa-times"></i></a>
                  	</td>
				</tr>
				<?php  } } ?>
				<tr>
					<td><input type="checkbox" name="" onclick="var ck = this.checked;$(':checkbox').each(function(){this.checked = ck});"></td>
					<td colspan="5"><input type="button" class="btn btn-danger" name="deleteall" value="删除选择的活动" /></td>
				</tr>
			</tbody>
		</table>
	</div>
	</div>
	<?php  echo $pager;?>
</div>
<script>
function drop_confirm(msg, url){
    if(confirm(msg)){
        window.location = url;
    }
}
require(['bootstrap'],function($){
	$('.btn').hover(function(){
		$(this).tooltip('show');
	},function(){
		$(this).tooltip('hide');
	});
});
require(['jquery', 'util'], function($, u){
	$("input[name=deleteall]").click(function(){
		var check = $("input:checked");
		if(check.length<1){
			u.message('请选择要删除的活动', '', 'error');
			return false;
		}
       // if( confirm("确认要删除选择的记录?")){
		var id = new Array();
		check.each(function(i){
			id[i] = $(this).val();
		});
		$.post('<?php  echo $this->createWebUrl('deleteAll')?>', {idArr:id},function(data){
			if (data.errno ==0){
				u.message(data.error, '<?php  echo url('site/entry/manage',array('m' => 'stonefish_bigwheel'))?>', 'warning');
			}else{
				u.message(data.error, '', 'error');
			}
			return false;
		},'json');
		//}
	});
});
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>