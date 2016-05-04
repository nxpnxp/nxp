<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>供货商管理后台</title>
<link href="/6spl/nxp/supply/Public/css/bootstrap.min.css" rel="stylesheet">
<link href="/6spl/nxp/supply/Public/css/my.css" rel="stylesheet">
<!--[if lte IE 9]>
<script src="/6spl/nxp/supply/Public/js/respond.js"></script>
<![endif]-->
<style>
body{font-family:"微软雅黑", "宋体";}
.red{ color:#F00;}
select{ width:200px;}
</style>
<script src="/6spl/nxp/supply/Public/js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="/6spl/nxp/supply/Public/js/layer.js"></script>
</head>

<body>
<?php echo W('Template/top');?>
<div class="container">
<div class="row">
<div class="col-md-2">
<?php echo W('Template/left');?>
</div>
<div class="col-md-10">
<form method="post" action="/6spl/nxp/supply/index.php/Home/order/index">
<table class="table table-border">
<tr>
<td width="65%" align="right">完成时间：从 <input type="text" id="fa" name="fa" class="form-control" style="width:40%; display:inline" value="<?php echo I('get.fa'); ?>" size="20" />
			到 <input type="text" id="ta" name="ta" class="form-control" style="width:40%; display:inline" value="<?php echo I('get.ta'); ?>" size="20" /></td>
<td align="left"><input type="submit" class="btn btn-default" value="搜索"/> <a href="/6spl/nxp/supply/index.php/Home/Order/index" class="btn btn-default">全部订单</a></td>
</tr>
</table>
</form>
<table class="table">
  <tr><th>订单号</th><th>状态</th><th>操作</th></tr>
  <?php if(is_array($order)): $i = 0; $__LIST__ = $order;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr>
  <td><a href="/6spl/nxp/supply/index.php/Home/Order/orderdetail/id/<?php echo ($v["id"]); ?>"><?php echo ($v["ordersn"]); ?></a></td><td><?php echo ($v["status"]); ?></td><td><a href="/6spl/nxp/supply/index.php/Home/Order/orderdetail/id/<?php echo ($v["id"]); ?>">查看</a></td>
  </tr><?php endforeach; endif; else: echo "" ;endif; ?>
  </table>
<div class="pagelist"><?php echo ($page); ?></div>
</div>
</div>
</div>
<!-- 引入时间插件 -->
<link href="/6spl/nxp/supply/Public/datetimepicker/jquery-ui-1.9.2.custom.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" charset="utf-8" src="/6spl/nxp/supply/Public/datetimepicker/jquery-ui-1.9.2.custom.min.js"></script>
<script type="text/javascript" charset="utf-8" src="/6spl/nxp/supply/Public/datetimepicker/datepicker-zh_cn.js"></script>
<link rel="stylesheet" media="all" type="text/css" href="/6spl/nxp/supply/Public/datetimepicker/time/jquery-ui-timepicker-addon.min.css" />
<script type="text/javascript" src="/6spl/nxp/supply/Public/datetimepicker/time/jquery-ui-timepicker-addon.min.js"></script>
<script type="text/javascript" src="/6spl/nxp/supply/Public/datetimepicker/time/i18n/jquery-ui-timepicker-addon-i18n.min.js"></script>
<script>
// 添加时间插件
$.timepicker.setDefaults($.timepicker.regional['zh-CN']);  // 设置使用中文 

$("#fa").datetimepicker();
$("#ta").datetimepicker();
</script>
</body>
</html>