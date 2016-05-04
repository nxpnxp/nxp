<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>供货商登录</title>
<link href="/6spl/nxp/supply/Public/css/bootstrap.min.css" rel="stylesheet">
<!--[if lte IE 9]>
<script src="/6spl/nxp/supply/Public/js/respond.js"></script>
<![endif]-->
<style>
body{ background-color:#2c87d8; font-family:"微软雅黑", "宋体";}
#loginbox{ width:500px; height:320px;position:absolute;top:50%;left:50%;margin-top:-200px;margin-left:-250px;}
#loginbox p{ text-align:center; font-size:24px; color:#FFF;}
#login{ width:482px; height:271px; background:url(/6spl/nxp/supply/Public/images/login_bg.png) no-repeat 0 0; margin:10px auto;}
form{ width:70%; margin:10px auto; margin-top:50px;}
</style>
<script src="/6spl/nxp/supply/Public/js/jquery-1.10.2.min.js"></script>
</head>

<body>
    <div id="loginbox">
    <p>供货商登录</p>
	<div id="login" class="clearfix">
    <form class="form-horizontal" method="post" onSubmit="return chkForm()" action="">
  <div class="form-group">
    <label for="user" class="col-sm-3 control-label">手机号</label>
    <div class="col-sm-9">
      <input type="text" name="user" class="form-control" id="user" >
    </div>
  </div>
  <div class="form-group">
    <label for="password" class="col-sm-3 control-label">密码</label>
    <div class="col-sm-9">
      <input type="password" name="password" class="form-control" id="password" >
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-3 col-sm-9">
      <button type="submit" class="btn btn-default">登录</button>
    </div>
  </div>
</form>
    </div>
    </div>
    <script>
	function chkForm()
	{
		if($("input[name=user]").val() == ''){
			alert("请输入用户名");
			$("input[name=user]").focus();
			return false;
		}
		if($("input[name=password]").val() == ''){
			alert("请输入密码");
			$("input[name=password]").focus();
			return false;
		}
	}
	</script>
</body>
</html>