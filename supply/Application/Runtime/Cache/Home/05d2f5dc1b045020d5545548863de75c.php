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
#thumb,.input-group-addon{ font-size:13px;}
#ul_pic_list li{margin-top:10px;list-style-type:none;}
</style>
<script src="/6spl/nxp/supply/Public/js/jquery-1.10.2.min.js"></script>
<script src="/6spl/nxp/supply/Public/js/bootstrap.min.js"></script>
<script type="text/javascript" charset="utf-8" src="/6spl/nxp/supply/Public/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/6spl/nxp/supply/Public/ueditor/ueditor.all.min.js"> </script>
<script type="text/javascript" charset="utf-8" src="/6spl/nxp/supply/Public/ueditor/lang/zh-cn/zh-cn.js"></script>
</head>

<body>
<?php echo W('Template/top');?>

<div class="container">
<div class="row">
<div class="col-md-2">
<?php echo W('Template/left');?>
</div>
<div class="col-md-10">


<div class="panel panel-default">
  <div class="panel-heading">添加商品</div>
  <div class="panel-body">
    <form class="form-horizontal" action="/6spl/nxp/supply/index.php/Home/goods/add" method="post" enctype="multipart/form-data" onSubmit="return chkForm()">
    <div>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">基本信息</a></li>
    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">商品描述</a></li>
    <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">自定义属性</a></li>
    <li role="presentation"><a href="#gallery" aria-controls="gallery" role="tab" data-toggle="tab">商品相册</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="home">
    
  <div class="form-group">
    <label for="title" class="col-sm-2 control-label"><span class="red">*</span>商品名称</label>
    <div class="col-sm-10">
      <input name="title" type="text" class="form-control" id="title">
    </div>
  </div>
    <div class="form-group">
    <label for="thumb" class="col-sm-2 control-label"><span class="red">*</span>商品图片</label>
    <div class="col-sm-10">
      <input name="thumb" type="file" class="form-control" id="thumb">
    </div>
  </div>
    <div class="form-group">
    <label class="col-sm-2 control-label"><span class="red">*</span>商品价格</label>
    <div class="col-sm-10">
       <div class="input-group form-group" style="width:100%; margin:0 auto; margin-top:10px;">
            <span class="input-group-addon">供应价</span>
            <input type="text" name="originalprice" id="productprice" class="form-control" value="" />
            <span class="input-group-addon">元</span>
        </div>

    </div>
  </div>   
    </div>
    <div role="tabpanel" class="tab-pane" id="profile"><textarea name="content" id="container"></textarea></div>
    <div role="tabpanel" class="tab-pane" id="messages">
    <table class="table">
        <thead>
            <tr>
                <th style='width:50px;'></th>
                <th>属性名称</th>
                <th>属性值</th>
            </tr>
        </thead>
        <tbody id="param-items">
        </tbody>
         <tbody>
            <tr>
                <td>&nbsp;</td>
                <td colspan="2">
                    <a href="javascript:;" id='add-param' style="margin-top:10px;" class="btn btn-default"  title="添加属性"><i class='fa fa-plus'></i> 添加属性</a>
                </td>
            </tr>
        </tbody>
            </table>
    </div>
    
     <div role="tabpanel" class="tab-pane" id="gallery">
     
     <input id="btn_add_pic" type="button" value="添加一张" />
     <hr />
     <ul id="ul_pic_list"></ul>
     
     
     </div> 
    
  </div>
</div>
  <div class="form-group" style="margin-top:15px;">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-primary">提交</button> <a href="/6spl/nxp/supply/index.php/Home/goods/index" class="btn btn-default">返回列表</a>
    </div>
  </div>
    </form>
  </div>
</div>


</div>
</div>
</div>
<script>

$("#add-param").click(function(){
    var _str = "";
	_str += "<tr><td style='line-height:30px; text-align:center; cursor:pointer'><i class='glyphicon glyphicon-remove' title='删除' onclick='remove(this)'></i></td>";
	_str +="<td><input name='param_title[]' type='text' class='form-control'/></td>";
	_str +="<td><input name='param_value[]' type='text' class='form-control'/></td>";
	_str += "</tr>";
	$("#param-items").append(_str);
	
})
function remove(obj){
	$(obj).parent().parent().remove();
}
var ue = UE.getEditor('container', {
    initialFrameHeight: 500,
});

$('#myTabs a').click(function (e) {
  e.preventDefault()
  $(this).tab('show')
})

// 添加一张
$("#btn_add_pic").click(function(){
	var file = '<li><span><i class="glyphicon glyphicon-remove" title="删除" onclick="remove(this)"></i></span><input type="file" name="pic[]" style="float:left;" /></li>';
	$("#ul_pic_list").append(file);
});

function chkForm()
{
	if($("input[name=title]").val()==''){
		alert("请输入商品名称");
		$("input[name=title]").focus();
		return false;
	}
	if($("input[name=marketprice]").val()==''){
	alert("请输入商品现价");
	$("input[name=marketprice]").focus();
	return false;
	}
	if($("input[name=thumb]").val()==''){
	alert("请选择商品图片");
	$("input[name=thumb]").focus();
	return false;
	}
}
</script>
</body>
</html>