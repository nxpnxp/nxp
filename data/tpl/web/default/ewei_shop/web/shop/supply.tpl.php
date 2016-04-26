<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_header', TEMPLATE_INCLUDEPATH)) : (include template('web/_header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/shop/tabs', TEMPLATE_INCLUDEPATH)) : (include template('web/shop/tabs', TEMPLATE_INCLUDEPATH));?>
<?php  if($operation == 'display') { ?>
     <form action="" method="post">
<div class="panel panel-default">
    <div class="panel-body table-responsive">
        <table class="table table-hover">
            <thead class="navbar-inner">
                <tr>
                    <th style="width:30px;">ID</th>
                    <th>公司名称</th>					
                    <th>联系人</th>
                    <th>手机</th>
                    <th>地址</th>
                    <th >供应产品</th>
                    <th >身份证</th>
                    <th >营业执照</th>
                    <th style="width:130px;">时间</th>
                    <th >状态</th>
                    <th >操作</th>
                </tr>
            </thead>
            <tbody>
                <?php  if(is_array($list)) { foreach($list as $row) { ?>
                <tr>
                    <td><?php  echo $row['id'];?></td>
                    <td><?php  echo $row['ca_name'];?></td>
                    <td><?php  echo $row['name'];?></td>
                    <td><?php  echo $row['phone'];?></td>
                    <td><?php  echo $row['addr'];?></td>
                    <td><?php  echo $row['product'];?></td>
                    <?php  $img1 = str_replace('&quot;','',$row['img1']); ?>
                    <?php  $img1 = substr($img1,2); ?>
                    <?php  $img2 = str_replace('&quot;','',$row['img2']); ?>
                    <?php  $img2 = substr($img2,2); ?>
                    <td><img src="<?php  echo $img1;?>" style="max-height: 100px;width: 100%;" /></td>
                    <td><img src="<?php  echo $img2;?>" style="max-height: 100px;width: 100%;" /></td>
                    <td>
                    	申请时间：<br/>
                    	<?php  echo date('Y-m-d H:i',$row['applytime']);?>
					</td>
                    
                    
                       <td>
                                    <?php  if($row['status']==1) { ?>
                                    <span class='label label-default'>申请中</span>
                                    <?php  } else if($row['status']==2) { ?>
                                    <span class='label label-success'>已通过</span>
                                    <?php  } else { ?>
                                    <span class='label label-danger'>已关闭</span>
                                    <?php  } ?>
                                </td>
                    <td style="text-align:left;">
                    	<?php  if($row['status']==1) { ?>
                        <a href="<?php  echo $this->createWebUrl('shop/supply', array('op' => 'shenhe1', 'id' => $row['id'],'status'=>2))?>" class="btn btn-default" 
                                                               >通过</a>
                        <a href="<?php  echo $this->createWebUrl('shop/supply', array('op' => 'shenhe2', 'id' => $row['id'],'status'=>0))?>" class="btn btn-default" 
                                                               >拒绝</a>
                        <?php  } ?>
                    </td>
                </tr>
                <?php  } } ?> 
                
            </tbody>
        </table>
        <?php  echo $pager;?>
    </div>
</div>
</form>
<script>
    require(['bootstrap'], function ($) {
        $('.btn').hover(function () {
            $(this).tooltip('show');
        }, function () {
            $(this).tooltip('hide');
        });
    });
</script>

<?php  } else if($operation == 'post') { ?>

<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_footer', TEMPLATE_INCLUDEPATH)) : (include template('web/_footer', TEMPLATE_INCLUDEPATH));?>