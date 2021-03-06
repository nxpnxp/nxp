<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
    <li><a href="<?php  echo $this->createWebUrl('entry');?>">活动参与方式</a></li>
    <li><a href="<?php  echo $this->createWebUrl('activity');?>">活动管理</a></li>
    <li><a href="<?php  echo $this->createWebUrl('gifts');?>">礼品设置</a></li>
    <li class="active"><a href="<?php  echo $this->createWebUrl('api');?>">接口参数</a></li>
</ul>
<script>
    require(['jquery', 'util'], function($, u) {
        $(function(){
            $('#theform').submit(function(){
                var message = '';
                if($.trim($(':text[name=appid]').val()) == '') {
                    message += '必须输入AppID<br>';
                }
                if($.trim($(':text[name=secret]').val()) == '') {
                    message += '必须输入AppSecret<br>';
                }
                if($.trim($(':text[name=mchid]').val()) == '') {
                    message += '必须输入微信支付商户号<br>';
                }
                if($.trim($(':text[name=password]').val()) == '') {
                    message += '必须输入微信支付商户密钥<br>';
                }
                if(message) {
                    u.message(message);
                    return false;
                }
                return true;
            });
        });
    });
</script>
<div class='alert alert-warning' style='font-size:14px'>
        现金红包配置说明： <a href='http://bbs.012wz.com/forum.php?mod=forumdisplay&fid=50' target='_blank'>http://bbs.012wz.com/forum.php?mod=forumdisplay&fid=50</a>
    </div>
<div class="clearfix">
    <form id="theform" class="form form-horizontal" action="" method="post">
        <div class="panel panel-default">
            <div class="panel-heading">
                发行商户现金红包的接口参数
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                    <div class="col-sm-9 col-xs-12">
                        <div class="alert alert-info">
                            发放商户现金红包需要使用 <br>
                            <span class="label label-info">认证服务号并开通微信支付</span> <br>
                            如果账号是订阅号也可以借用别人的账号
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">AppID</label>
                    <div class="col-sm-9 col-xs-12">
                        <input type="text" name="appid" value="<?php  echo $config['appid'];?>" class="form-control">
                        <span class="help-block">使用或借用的认证服务号AppID</span>
                        <span class="help-block"><strong>设置好以后请不要更换, 否则会造成重复领取红包</strong></span>
                        <span class="help-block"><strong>请在公众平台中设置oAuth授权域名为当前系统域名, <a href="http://mp.weixin.qq.com/" target="_blank">去设置</a></strong></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">AppSecret</label>
                    <div class="col-sm-9 col-xs-12">
                        <input type="text" name="secret" value="<?php  echo $config['secret'];?>" class="form-control">
                        <span class="help-block">使用或借用的认证服务号AppSecret, 需要使用高级接口鉴权</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">商户号</label>
                    <div class="col-sm-9 col-xs-12">
                        <input type="text" name="mchid" value="<?php  echo $config['mchid'];?>" class="form-control">
                        <span class="help-block">使用或借用的微信支付商户号, 开通微信支付才能获得商户号</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">商户支付密钥</label>
                    <div class="col-sm-9 col-xs-12">
                        <input type="text" name="password" value="<?php  echo $config['password'];?>" class="form-control">
                        <span class="help-block">使用或借用的微信支付商户所使用的支付密钥, 开通微信支付才能获得商户号</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">服务器IP</label>
                    <div class="col-sm-9 col-xs-12">
                        <input type="text" name="ip" value="<?php  echo $config['ip'];?>" class="form-control">
                        <span class="help-block">发放红包接口需要服务器IP. 程序将自动获取你的服务器IP, 如果获取失败, 请手动指定</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">商户支付证书</label>
                    <div class="col-sm-9 col-xs-12">
                        <textarea class="form-control" name="cert" rows="8" placeholder="为保证安全性, 不显示证书内容. 若要修改, 请直接输入"></textarea>
                        <span class="help-block">从商户平台上下载支付证书, 解压并取得其中的 <mark>apiclient_cert.pem</mark> 用记事本打开并复制文件内容, 填至此处</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">支付证书私钥</label>
                    <div class="col-sm-9 col-xs-12">
                        <textarea class="form-control" name="key" rows="8" placeholder="为保证安全性, 不显示证书内容. 若要修改, 请直接输入"></textarea>
                        <span class="help-block">从商户平台上下载支付证书, 解压并取得其中的 <mark>apiclient_key.pem</mark> 用记事本打开并复制文件内容, 填至此处</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">支付根证书</label>
                    <div class="col-sm-9 col-xs-12">
                        <textarea class="form-control" name="ca" rows="8" placeholder="为保证安全性, 不显示证书内容. 若要修改, 请直接输入"></textarea>
                        <span class="help-block">从商户平台上下载支付证书, 解压并取得其中的 <mark>rootca.pem</mark> 用记事本打开并复制文件内容, 填至此处</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">接口最后调用</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php  if($config['error']) { ?>
                        <div class="alert alert-warning">
                            <?php  echo $config['error'];?>
                        </div>
                        <?php  } else { ?>
                        <p class="form-control-static">正常调用</p>
                        <?php  } ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                    <div class="col-md-2 col-lg-1">
                        <input name="submit" type="submit" value="保存" class="btn btn-primary btn-block" />
                        <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
