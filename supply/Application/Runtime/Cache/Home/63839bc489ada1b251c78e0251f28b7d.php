<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>供货商管理后台</title>
<link href="/supply/Public/css/bootstrap.min.css" rel="stylesheet">
<link href="/supply/Public/css/my.css" rel="stylesheet">
<!--[if lte IE 9]>
<script src="/supply/Public/js/respond.js"></script>
<![endif]-->
<style>
body{font-family:"微软雅黑", "宋体";}
.red{ color:#F00;}
</style>
<script src="/supply/Public/js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="/supply/Public/js/layer.js"></script>
</head>

<body>
<?php echo W('Template/top');?>
<div class="container">
<div class="row">
<div class="col-md-2">
<?php echo W('Template/left');?>
</div>
<div class="col-md-10">
<form method="post" action="/supply/index.php/Home/Goods/delAll">
<table class="table .table-striped">
<tr><th></th><th>图片</th><th>名称</th><th>货号</th><th>状态</th><th>操作</th></tr>
<?php if(is_array($goods['data'])): $i = 0; $__LIST__ = $goods['data'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
<td><input class="one" type="checkbox" name="ids[]" value="<?php echo ($vo["id"]); ?>"/></td>
<td><img src="<?php echo IMG_PATH; echo ($vo["thumb"]); ?>" width="50"></td>
<td><a href="/supply/index.php/Home/Goods/detail/id/<?php echo ($vo["id"]); ?>"><?php echo ($vo["title"]); ?></a></td>
<td><?php echo ($vo["goodssn"]); ?></td>
<td><?php if($vo["status"] == '未过审，查看原因'): ?><a href="#" class="red" title="<?php echo ($vo["reply"]); ?>"><?php echo ($vo["status"]); ?></a><?php else: echo ($vo["status"]); endif; ?></td>
<td>
<a href="/supply/index.php/Home/Goods/edit/id/<?php echo ($vo["id"]); ?>">编辑</a> <a href="/supply/index.php/Home/Goods/delete/id/<?php echo ($vo["id"]); ?>" onclick="return confirm('确定要删除吗？');" title="移除">删除</a>
</td>
</tr><?php endforeach; endif; else: echo "" ;endif; ?>
<tr><td colspan="6"><input type="checkbox" id="all" >全选 <input type="submit" value="批量删除"/></td></tr>
</table>
</form>
<div class="pagelist"><?php echo ($goods['page']); ?></div>
</div>
</div>
</div>
<script>
$("#all").click(function(){
	var _check = $(this).is(':checked');
	//alert(_check);
	$(".one").prop("checked",_check);
})
    $(".red").click(function(){
		layer.open({
		type: 1, //page层
		area: ['300px', '300px'],
		title: '审核未通过原因',
		shade: 0.6, //遮罩透明度
		moveType: 1, //拖拽风格，0是默认，1是传统拖动
		shift: 1, //0-6的动画形式，-1不开启
		content: '<div style="padding:50px;">'+$(this).prop("title")+'</div>'
		});          
	})
</script>
</body>
</html>