<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>

<div class="main">
    <ul class="nav nav-tabs">
        <li class="active"><a href="<?php  echo $this->createWebUrl('city');?>">城市管理</a></li>
        <li><a href="<?php  echo $this->createWebUrl('addcity');?>">添加城市</a></li>
    </ul> 
  <div class="panel panel-default">
        <div class="panel-body table-responsive">
            <table class="table table-hover">
                <thead class="navbar-inner">
                    <tr>
                        <th style="width:80px;">序号</th>
                        <th style="width:120px;">城市名称</th>
                        <th style="width:100px;">区域数量</th>
                         <th style="width:110px;">未处理订单</th>
                          <th style="width:110px;">已处理订单</th>
                        <th style="width:120px;">已完成订单</th>
                        <th style="width:280px; text-align:right;">操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php  if(is_array($list)) { foreach($list as $item) { ?>
                  <tr> 
                    <td><?php  echo $item['id'];?></td>
                    <td><?php  echo $item['cityname'];?></td>
                    <td><?php  echo $this->getAreasCount($item['id']);?></td>
                    <td><a href="<?php  echo $this->createWebUrl('order', array('op'=>'undeal','cityid' => $item['id']))?>" class="btn btn-danger">
					<?php  echo $this->getOrdersCountByCS($item['cityname'],0);?></a></td>
                   	<td><a href="<?php  echo $this->createWebUrl('order', array('op'=>'hasdeal','cityid' => $item['id']))?>" class="btn btn-primary">
                   	<?php  echo $this->getWordingOrdersCountByCity($item['cityname']);?></a></td>
                    <td><a href="<?php  echo $this->createWebUrl('order',array('op'=>'over','cityid' =>$item['id']))?>" class="btn btn-success">
                    <?php  echo $this->getOrdersCountByCS($item['cityname'],5);?></a></td>
	                <td style="text-align:right;">
	                  <a class="btn btn-success btn-sm" href="<?php  echo $this->createWebUrl('area', array('cityid' =>$item['id']))?>" title="区域管理"><i class="icon-edit"></i>区域管理</a>
	                  <a class="btn btn-success btn-sm" href="<?php  echo $this->createWebUrl('addcity', array('cityid' =>$item['id']))?>" title="编辑"><i class="icon-edit"></i>编辑</a>
	                  <a class="btn btn-default btn-sm" href="#" onclick="drop_confirm('您确定要删除吗?', '<?php  echo $this->createWebUrl('addcity',array('op'=>'delete', 'cityid' =>$item['id']))?>');" title="删除"><i class="icon-remove"></i>删除</a>
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