<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>

<div class="main">
	<ul class="nav nav-tabs">
		<li <?php  if($state == 2 ) { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('employee');?>">已审核员工</a></li>
		<li <?php  if($state != 2 ) { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('employee',array('state'=>1));?>">未审核员工</a></li>
	</ul>
	<div class="panel panel-info">
		<div class="panel-heading">员工数量： <?php  echo $total;?> 人</div>
		    <div class="panel-body">
    </div>
		
		
	</div>

	<div class="panel panel-default">
		<div class="panel-body table-responsive">
			<table class="table table-hover">
				<thead class="navbar-inner">
					<tr>
						<th style="width: 50px;">序号</th>
						<th style="width: 100px;">员工姓名</th>
						<th style="width: 160px;">电话</th>
						<th style="width: 100px;">已接单数量</th>
						<th style="width: 130px;">接单状态</th>
                        <!--<th style="width: 270px;">地址</th>-->
						<th style="width: 200px; text-align: right;">操作</th>
					</tr>
				</thead>
				<tbody>
					<?php  if(is_array($list)) { foreach($list as $item) { ?>
					<tr>
						<td><?php  echo $item['id'];?></td>
						<td><?php  echo $item['employeename'];?></td>
						<td><?php  echo $item['tel'];?></td>
						<td><?php  echo $item['sumorders'];?></td>
						<td>
						<?php  if($item['workstate'] ==0) { ?>空闲<?php  } else if($item['workstate'] ==1) { ?><a class="btn btn-success btn-sm"
							href="<?php  echo $this->createWebUrl('showemployee', array('employeeid' => $item['id']))?>"
							title="编辑"><i class="icon-edit"></i>取件途中</a> <?php  } else { ?><a class="btn btn-success btn-sm"
							href="<?php  echo $this->createWebUrl('showemployee', array('employeeid' => $item['id']))?>"
							title="编辑"><i class="icon-edit"></i>工作中</a> <?php  } ?>
						
						</td>
						<!--<td><?php  echo $item['customercity'];?><?php  echo $item['customerarea'];?><?php  echo $item['xiangxdz'];?></td>-->
						<td style="text-align: right;">
							<a class="btn btn-success btn-sm"
							href="<?php  echo $this->createWebUrl('showemployee', array('employeeid' => $item['id']))?>"
							title="编辑"><i class="icon-edit"></i>信息编辑</a> 
							<?php  if($item['employeestate'] !=2) { ?>
							<a class="btn btn-default btn-sm" href="#"
							onclick="drop_confirm('确定要通过审核吗?','<?php  echo $this->createWebUrl('showemployee',array('op'=>'update','employeeid'=>$item['id']))?>');"
							title="审核"><i class="icon-edit"></i>审核</a>
							<?php  } ?>
							<a class="btn btn-default btn-sm" href="#"
							onclick="drop_confirm('确定要删除吗?','<?php  echo $this->createWebUrl('showemployee',array('op'=>'delete','employeeid'=>$item['id']))?>');"
							title="删除"><i class="icon-remove"></i>删除</a>
							</td>
					</tr>
					<?php  } } ?>
				</tbody>
			</table>
		</div>
		<?php  echo $pager;?>
	</div>
</div>

<script type="text/javascript">
    function drop_confirm(msg, url){
        if(confirm(msg)){
            window.location = url;
        }
    }
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
