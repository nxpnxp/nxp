<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header-base', TEMPLATE_INCLUDEPATH)) : (include template('common/header-base', TEMPLATE_INCLUDEPATH));?>
<style>
	body{
		background: url('themes/color/user/001.jpg');
		background-repeat:no-repeat; 
		background-size:cover;
	}
	.bg-white{
		  background-color: rgba(255, 255, 255, 0.81);
	}
	.text-muted {
  color: #565656;
}
</style>
<div class="bg-white pulldown">
	<div class="content content-boxed overflow-hidden">
		<div class="row">
			<div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">
				<div class="push-10-t push-10 animated fadeIn">

					<div class="text-center">
						<a href="./?refresh" <?php  if(!empty($_W['setting']['copyright']['flogo'])) { ?>style="background:url('<?php  echo tomedia($_W['setting']['copyright']['flogo']);?>') no-repeat;"<?php  } else { ?>style="background: url('resource/color/img/gw-logo.png') no-repeat;height:34px;display:block;
						background-position:center;"<?php  } ?>></a>

						<p class="text-muted push-5-t">微信分销,让您没有难做的生意</p>
					</div>


					<form class="form-horizontal push-5-t" action="" method="post" role="form" onsubmit="return formcheck();">
						<div class="form-group">
							<label class="col-xs-12" for="login1-username">请输入用户名登录</label>
							<div class="col-xs-12">
								<input class="form-control" type="text" id="login1-username" name="username" >
							</div>
						</div>
						<div class="form-group">
							<label class="col-xs-12" for="login1-password">请输入登录密码</label>
							<div class="col-xs-12">
								<input class="form-control" type="password" id="login1-password" name="password" >
							</div>
						</div>
						<div class="form-group">
							<div class="col-xs-12">
								<label class="css-input switch switch-sm switch-primary">
									<input type="checkbox" id="login1-remember-me" value="true" name="rember"><span></span> 记住用户名
								</label>
							</div>
						</div>
						<div class="form-group">
							<div class="col-xs-12" style="text-align: right;">
								<input class="btn btn-sm btn-primary" type="submit" name="submit" value="登 录" >
								<?php  if(!$_W['siteclose']) { ?><a href="<?php  echo url('user/register');?>" class="btn btn-sm btn-primary">注 册</a><?php  } ?>
								<input name="token" value="<?php  echo $_W['token'];?>" type="hidden" />
							</div>
						</div>
					</form>

				</div>
			</div>
		</div>
	</div>
</div>


<!--
<div class="pulldown push-30-t text-center animated fadeInUp">
	<small class="text-muted"><?php  if(empty($_W['setting']['copyright']['footerleft'])) { ?>Powered by <a href="http://www.we7.cc"><b>微擎</b></a> v<?php echo IMS_VERSION;?> &copy; 2014-2015 <a href="http://www.we7.cc">www.we7.cc</a><?php  } else { ?><?php  echo $_W['setting']['copyright']['footerleft'];?><?php  } ?></small>
</div>-->

<script>
	function formcheck() {
		if($('#remember:checked').length == 1) {
			cookie.set('remember-username', $(':text[name="username"]').val());
		} else {
			cookie.del('remember-username');
		}
		return true;
	}
</script>

<script src="./resource/color/js/animations.js"></script>

</body>
</html>