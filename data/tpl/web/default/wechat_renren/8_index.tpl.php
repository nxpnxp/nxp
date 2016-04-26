<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>

<div class='container' style='padding:0 5px 10px;margin:0;width:100%'>

<ul class="nav nav-tabs">
  <li <?php  if($op == 'post') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('renrenshop', array('op' => 'post'));?>">添加商品</a></li>
  <li <?php  if($op == 'display') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('renrenshop',array('op'=>'display'));?>">管理商品</a></li>
 
</ul>
<?php  if($op =='display') { ?>
<div class="panel panel-success">
  <div class="panel-heading">商品中心 > 商品管理</div>
  

</div>
<div class="panel panel-info">
		<div class="panel-heading">筛选</div>
		<div class="panel-body">
			<form action="./index.php" method="get" class="form-horizontal" role="form">
                <input type="hidden" name="c" value="site" />
                <input type="hidden" name="a" value="entry" />
			<input type="hidden" value="wechat_renren" name="m">
			<input type="hidden" value="renrenshop" name="do">
			<input type="hidden" value="display" name="op">
			<div class="form-group">
				<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">关键字</label>
				<div class="col-sm-8">
						<input type="text" placeholder="搜索商品名称或简介" value="<?php  echo $_GPC['keyword'];?>" id="" name="keyword" class="form-control">
				</div>				
			</div>
			<div class="form-group">
				<div class="pull-right col-xs-12 col-sm-2 col-lg-1">
					<button class="btn btn-block"><i class="fa fa-search"></i> 搜索</button>
				</div>
			</div>
			</form>
		</div>
	</div>
<div style="padding:15px;">
<form id="form2" class="form-horizontal" method="post">

		<table class="table table-hover">
			<thead class="navbar-inner">
				<tr>
				<th style="width:50px;">全选</th>
					<th style="width:50px;">序号</th>
					<th style="width:100px;">图标</th>
					<th style="width:100px;">名称</th>
					<th style="width:50px;">价格</th>
					<th style="min-width:60px;width:100px;">审核 | 修改 |  删除</th>
				</tr>
			</thead>
			<tbody>
				<?php  if(is_array($list)) { foreach($list as $item) { ?>
				<tr>
				<td><input type="checkbox" value="<?php  echo $item['id'];?>" name="delete[]"></td>
					<td><?php  echo $item['id'];?></td>
					<td><img src="<?php  echo toimage($item['logo']);?>" width="50" height="50" /></td>
					<td><a title="<?php  echo $item['jianjie'];?>" target="_blank"  href="<?php  echo $item['url'];?>"><?php  echo $item['title'];?></a></td>
					<td><?php  echo $item['money'];?></a></td>
					<td>
					
<a id="id<?php  echo $item['id'];?>" href="javascript:shen('<?php  echo $this->createWebUrl('renrenshop', array('op' => 'shenhe', 'id' =>$item['id'],'isok'=>$item['isok']))?>',<?php  echo $item['id'];?>);" title="<?php  if($item['isok']==0) { ?>未审核<?php  } else { ?>已审核<?php  } ?>" class="shen btn btn-mini <?php  if($item['isok']==0) { ?>btn-danger<?php  } else { ?>btn-success<?php  } ?>"><i class="fa fa-check"></i></a>
					<a href="<?php  echo $this->createWebUrl('renrenshop', array('op' => 'post', 'id' => $item['id']))?>" title="编辑" class="btn btn-mini btn-primary"><i class="fa fa-edit"></i></a>
					<a onclick="return confirm('此操作不可恢复，确认吗？'); return false;" href="<?php  echo $this->createWebUrl('renrenshop', array('id' => $item['id'],'op'=>'del'))?>" title="删除" class="btn btn-mini btn-danger"><i class="fa fa-times"></i></a>
					</td>				
				</tr>
				
				<?php  } } ?>
				<tr >
				<td><input type="checkbox"  onclick="var ck = this.checked;$(':checkbox').each(function(){this.checked = ck});" name=''>    <input class="btn btn-primary" type="submit" value="删除" name="submit" ></td><td></td><td></td><td></td>
				</tr>
			</tbody>
		</table>
		<input type="hidden" value="renrenshop" name="do">
		<input type="hidden" value="del" name="op">
		<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
		
		
		</form>
		<?php  echo $pager;?>
			<script>

function shen(url,id){
						$.getJSON(url,function(data){
						if(data.a==0){
						$("#id"+id).removeClass('btn-success');
						$("#id"+id).addClass('btn-danger');
						}else if(data.a==1){
						$("#id"+id).removeClass('btn-danger');
						$("#id"+id).addClass('btn-success');
						}
						location.reload();
						})
						
}
	</script>
	<script>

		
					$('#form2').submit(function(){
if($(":checkbox[name='delete[]']:checked").size() > 0){
return confirm('删除后不可恢复，您确定删除吗？');
}
return false;
}); 


		</script>	
	</div>
<?php  } else if($op == 'post') { ?>
<div class="panel panel-success">
  <div class="panel-heading">商品中心 > 商品管理</div>
  

</div>
<div class="main">
	<form action="" method="post" class="form-horizontal form">
	<div class="panel panel-default">
		<div class="panel-heading">
		添加商品
		</div>
		
		<div class="panel-body">

			<div class="form-group">
				<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">商品名称</label>
				<div class="col-sm-8">
					<input type="text" name="title" class="form-control" value="<?php  echo $item['title'];?>" /> 
					<span class="help-block">填写商品名称</span>
				</div>
			</div>
			<div class="form-group">
				<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">商品地址</label>
				<div class="col-sm-8">
					<input type="text" name="url" class="form-control" value="<?php  echo $item['url'];?>" /> 
					<span class="help-block">填写商品地址</span>
				</div>
			</div>
			<div class="form-group">
				<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">商品价格</label>
				<div class="col-sm-8">
					<input type="text" name="money" class="form-control" value="<?php  echo $item['money'];?>" /> 
					<span class="help-block">填写商品价格</span>
				</div>
			</div>
		<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">商品图片</label>
		<div class="col-sm-8">
			<?php echo tpl_form_field_image('logo', $item['logo'] =='' ? $setting['thumb'] : $item['logo']);?>
			<span class="help-block">商品图片</span>
		</div>
	</div>		
				<div class="form-group">
					<label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label">商品说明</label>
					<div class="col-sm-8">
						<textarea class="form-control" name="jianjie" rows="5"><?php  echo $item['jianjie'];?></textarea>
						<span class="help-block">帮助（填写商品说明）</span>
					</div>
				</div>						
			<div class="form-group">
				<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label"></label>
				<div class="col-sm-4">
				<input type="hidden" name="id" value="<?php  echo $item['id'];?>">
				<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
					<input name="submit" type="submit" value="提交" class="btn btn-primary span3" />
					
				</div>
			</div>
			
			</div>
			</div>
	</form>
</div>


<?php  } ?>	
</div>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
