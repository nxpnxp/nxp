<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header-base', TEMPLATE_INCLUDEPATH)) : (include template('common/header-base', TEMPLATE_INCLUDEPATH));?>
<div id="page-container" class="sidebar-l sidebar-o side-scroll header-navbar-fixed side-overlay-o gw-container">

 <nav id="sidebar">

                <div id="sidebar-scroll" style="">

                    <div class="sidebar-content">

                        <div class="side-header side-content bg-white-op">

                            <button class="btn btn-link text-gray pull-right hidden-md hidden-lg" type="button" data-toggle="layout" data-action="sidebar_close">
                                <i class="fa fa-times"></i>
                            </button>

                            
                            <a class="gw-logo"  href="./?refresh"<?php  if(!empty($_W['setting']['copyright']['blogo'])) { ?>style="background:url('<?php  echo tomedia($_W['setting']['copyright']['blogo']);?>') no-repeat;"<?php  } ?>></a>
                        </div>
<style>
    .newbtn{
    width: 230px;
    background-color: #2c343f; 
    }
    .newbtnchild{
        width: 33.6%;
    border: none;
    border-radius: 0px;
    }

</style>
        <div class="side-content">
            <ul class="nav-main">
<?php  if($GLOBALS['ext_type'] > 0) { ?>
                        <div class="btn-group newbtn">
                            <button class="btn newbtnchild <?php  if($GLOBALS['ext_type'] == 1) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?> ext-type" data-id="1">默认</button>
                            <button class="btn newbtnchild <?php  if($GLOBALS['ext_type'] == 2) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?> ext-type" data-id="2">系统</button>
                            <button class="btn newbtnchild <?php  if($GLOBALS['ext_type'] == 3) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?> ext-type" data-id="3">复合</button>
                        </div>
                    <?php  } ?>
            <?php $frames = empty($frames) ? $GLOBALS['frames'] : $frames; _calc_current_frames($frames);?>
            <?php  if(!empty($frames)) { ?>
                <!-- <li class="nav-main-heading"><span class="sidebar-mini-hide">User Interface</span></li> -->
                <?php  if(is_array($frames)) { foreach($frames as $k => $frame) { ?>
                <li class="open">
    <?php 
        switch ($frame['title']) {
            case '基本功能':
            $snav_icon = 'fontello-icon-cog-1';
            break;
            case '高级功能':
            $snav_icon = 'fontello-icon-beaker';
            break;
            case '数据统计':
            $snav_icon = 'fontello-icon-chart-line';
            break; 
            case '管理':
            $snav_icon = 'fontello-icon-wrench-2';
            break; 
            case '微站管理':
            $snav_icon = 'fontello-icon-globe-2';
            break; 
            case '特殊页面管理':
            $snav_icon = 'fontello-icon-doc-1';
            break; 
            case '功能组件':
            $snav_icon = 'fontello-icon-puzzle';
            break;
            case '粉丝管理':
            $snav_icon = 'fontello-icon-users-1';
            break;
            case '会员中心':
            $snav_icon = 'fontello-icon-user-5';
            break;            
            case '会员卡管理':
            $snav_icon = 'fontello-icon-vcard';
            break;
            case '积分兑换':
            $snav_icon = 'fontello-icon-dollar';
            break;
            case '通知中心':
            $snav_icon = 'fontello-icon-bullhorn';
            break;
            case '公众号选项':
            $snav_icon = 'fontello-icon-chat-1';
            break;
            case '会员及粉丝选项':
            $snav_icon = 'fontello-icon-users';
            break;
            case '其他功能选项':
            $snav_icon = 'fontello-icon-cog-alt';
            break;
            case '主要业务':
            $snav_icon = 'fontello-icon-th-3';
            break;
            case '营销及活动':
            $snav_icon = 'fontello-icon-gift';
            break;
            case '客户关系':
            $snav_icon = 'fontello-icon-share-1';
            break;
            case '常用服务及工具':
            $snav_icon = 'fontello-icon-wrench';
            break;
            case '其他':
            $snav_icon = 'fontello-icon-dot-3';
            break;
            default:
            $snav_icon = 'fontello-icon-list-add';
            }
      ?>
                       <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="<?php  echo $snav_icon;?>"></i><span class="sidebar-mini-hide"><?php  echo $frame['title'];?></span></a>

                <ul>
                    <?php  if(is_array($frame['items'])) { foreach($frame['items'] as $link) { ?>
                        <?php  if(!empty($link['append'])) { ?>
                        <li onclick="window.location.href = '<?php  echo $link['url'];?>';"  kw="<?php  echo $link['title'];?>">
                            <a href="<?php  echo $link['append']['url'];?>"><?php  echo $link['title'];?></a>
                        </li>
                        <?php  } else { ?>
                        <a href="<?php  echo $link['url'];?>" kw="<?php  echo $link['title'];?>"><?php  echo $link['title'];?></a>
                        <?php  } ?>
                    <?php  } } ?>
               </ul>
            </li>
            	<?php  } } ?>
     <script type="text/javascript">
       $('.nav-main ul a>i').css({"display":"none","padding-right":"0px"});
                        require(['bootstrap'], function(){
                            $('.ext-type').click(function(){
                                var id = $(this).data('id');
                                util.cookie.del('ext_type');
                                util.cookie.set('ext_type', id, 7*86400);

                                location.reload();
                                return false;
                            });

                            // $('#search-menu input').keyup(function() {
                            //     var a = $(this).val();
                            //     $('.big-menu .list-group-item, .big-menu .panel-heading').hide();
                            //     $('.big-menu .list-group-item').each(function() {
                            //         $(this).css('border-left', '0');
                            //         if(a.length > 0 && $(this).attr('kw').indexOf(a) >= 0) {
                            //             $(this).parents(".panel").find('.panel-heading').show();
                            //             $(this).show().css('border-left', '3px #428bca double');
                            //         }
                            //     });
                            //     if(a.length == 0) {
                            //         $('.big-menu .list-group-item, .big-menu .panel-heading').show();
                            //     }
                            // });
                        });
                    </script>
<!--             	<script type="text/javascript">
                        require(['bootstrap'], function(){
                            $('#search-menu input').keyup(function() {
                                var a = $(this).val();
                                $('.big-menu .list-group-item, .big-menu .panel-heading').hide();
                                $('.big-menu .list-group-item').each(function() {
                                    $(this).css('border-left', '0');
                                    if(a.length > 0 && $(this).attr('kw').indexOf(a) >= 0) {
                                        $(this).parents(".panel").find('.panel-heading').show();
                                        $(this).show().css('border-left', '3px #428bca double');
                                    }
                                });
                                if(a.length == 0) {
                                    $('.big-menu .list-group-item, .big-menu .panel-heading').show();
                                }
                            });
                        });
                    </script> -->
                
                <?php  } ?>
           </ul>
        </div>
                        
                    </div>
                    
                </div>
               
    </nav>
    

    <!-- Header -->
    <header id="header-navbar" class="content-mini content-mini-full">
        <!-- Header Navigation Right -->
        <ul class="nav-header pull-right">

        <li class="dropdown topbar-notice">
                    <a type="button"  data-toggle="dropdown" style="padding-left:15px">
                        <span class="badge badge-primary"><i class="fa fa-bell"></i> 
                        <?php  if($_W['notice']['total'] > 0) { ?>
                        <?php  echo $_W['notice']['total'];?>
                        <?php  } else { ?>
                        0
                        <?php  } ?></span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dLabel">
                        <div class="topbar-notice-panel">
                            <div class="topbar-notice-arrow"></div>
                            <div class="topbar-notice-head">
                                系统公告
                            </div>
                            <div class="topbar-notice-body">
                                <ul>
                                    <?php  if(is_array($_W['notice']['notices'])) { foreach($_W['notice']['notices'] as $row) { ?>
                                    <li>
                                        <a href="<?php  echo url('article/notice-show/detail', array('id' => $row['id']));?>" target="_blank" class="clearfix">
                                            <div class="pull-left">
                                                <h3><?php  echo $row['title'];?></h3>
                                                <div class="date"><?php  echo date('Y-m-d', $row['createtime']);?></div>
                                            </div>
                                            <span class="label label-info pull-right"><?php  echo $row['catename'];?></span>
                                        </a>
                                    </li>
                                    <?php  } } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>
            <li id="liebiao">
               <div class="btn-group">
                <button class="btn btn-default dropdown-toggle" data-toggle="dropdown" type="button" >
                    <i class="fa fa-th-list"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-right">
                    <?php  global $top_nav;?>
                    <?php  if(is_array($top_nav)) { foreach($top_nav as $nav) { ?>
                        <?php  if(!empty($_W['isfounder']) || empty($_W['setting']['permurls']['sections']) || in_array($nav['name'], $_W['setting']['permurls']['sections'])) { ?><li<?php  if(FRAME == $nav['name']) { ?> class="active"<?php  } ?>><a href="<?php  echo url('home/welcome/' . $nav['name']);?>"><i class="<?php  echo $nav['append_title'];?> pull-right"></i> <?php  echo $nav['title'];?></a></li><?php  } ?>
                    <?php  } } ?>  
                    
                </ul>
                </div>
            </li>    
            <li>
                <div class="btn-group">
                    <button class="btn btn-default btn-image dropdown-toggle" data-toggle="dropdown" type="button">
                        <img src="<?php  echo $_W['attachurl'];?>headimg_<?php  echo $_W['uniacid'];?>.jpg?$acid=<?php  echo $_W['uniacid'];?>" onerror="this.src='resource/images/gw-wx.gif'" />
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li class="dropdown-header"><?php  echo $_W['user']['username'];?> (<?php  if($_W['role'] == 'founder') { ?>系统管理员<?php  } else if($_W['role'] == 'manager') { ?>公众号管理员<?php  } else { ?>公众号操作员<?php  } ?>)</li>
                        <li>
                            <a tabindex="-1" href="###">
                                <i class="fontello-icon-comment-alt-1 pull-right"></i>
                                <?php  echo $_W['account']['name'];?>
                            </a>
                        </li>

                        <?php  if($_W['role'] != 'operator') { ?>
                        <li>
                            <a tabindex="-1" href="<?php  echo url('account/post', array('uniacid' => $_W['uniacid']));?>" target="_blank">
                                <i class="fontello-icon-edit pull-right"></i>编辑当前账号资料
                            </a>
                        </li>
                        <?php  } ?>
                        <li>
                            <a tabindex="-1" href="<?php  echo url('account/display');?>" target="_blank">
                                <i class="fontello-icon-chat-1 pull-right"></i>管理其它公众号
                            </a>
                        </li>
                        <li>
                            <a tabindex="-1" href="<?php  echo url('utility/emulator');?>" target="_blank">
                                <i class="fontello-icon-edit-2 pull-right"></i>模拟测试
                            </a>
                        </li>
                        <li class="divider"></li>

                        <li><a href="<?php  echo url('user/profile/profile');?>" target="_blank"><i class="fontello-icon-vcard pull-right"></i> 我的账号</a></li>
                <?php  if($_W['role'] == 'founder') { ?>
                <li><a href="<?php  echo url('system/welcome');?>" target="_blank"><i class="fontello-icon-cog-alt pull-right"></i> 系统选项</a></li>
                <li><a href="<?php  echo url('system/welcome');?>" target="_blank"><i class="fontello-icon-spin3 pull-right"></i> 自动更新</a></li>
                <li><a href="<?php  echo url('system/updatecache');?>" target="_blank"><i class="fontello-icon-loop-alt pull-right"></i> 更新缓存</a></li>
                <li class="divider"></li>
                <?php  } ?>
                <li><a href="<?php  echo url('user/logout');?>"><i class="fontello-icon-logout-1 pull-right"></i> 退出系统</a></li>
                    </ul>
                </div>
            </li>
            
        </ul>
        <!-- END Header Navigation Right -->

        <!-- Header Navigation Left -->
        <ul class="nav-header pull-left">
            <li class="hidden-md hidden-lg" style="margin-right: 1px;">
                <button class="btn btn-default" data-toggle="layout" data-action="sidebar_toggle" type="button">
                    <i class="fa fa-navicon"></i>
                </button>
            </li>
            <li class="hidden-xs hidden-sm">
                <button class="btn btn-default" data-toggle="layout" data-action="sidebar_mini_toggle" type="button">
                    <i class="fa fa-ellipsis-v"></i>
                </button>
            </li>
            
			<?php  if(!empty($_W['isfounder']) || empty($_W['setting']['permurls']['sections']) || in_array('platform', $_W['setting']['permurls']['sections'])) { ?><li<?php  if(FRAME == 'platform') { ?> class="active"<?php  } ?> id="liebiaoyuan"><a href="<?php  echo url('home/welcome/platform');?>"><i class="fa fa-cog"></i>基础设置</a></li><?php  } ?>
 <li><a href="<?php echo $_W['siteroot'].'web/index.php?c=home&a=welcome&do=ext&m=ewei_shop'?>"><i class="pull-right"></i> 人人店管理</a></li>
             <li><a href="<?php echo $_W['siteroot'].'web/index.php?c=site&a=entry&method=cover&p=commission&do=plugin&m=ewei_shop'?>"><i class="pull-right"></i>分销快捷设置</a></li>   
 
 <li><a href="<?php echo $_W['siteroot'].'web/index.php?c=site&a=entry&op=display&do=order&m=ewei_shop'?>"><i class="pull-right"></i>订单查询</a></li>   


 

 
 <?php  if(!empty($_W['isfounder']) || empty($_W['setting']['permurls']['sections']) || in_array('setting', $_W['setting']['permurls']['sections'])) { ?><li<?php  if(FRAME == 'setting') { ?> class="active"<?php  } ?>><a href="<?php  echo url('home/welcome/setting');?>" id="liebiaoyuan"><i class="fa fa-umbrella"></i>支付设置</a></li><?php  } ?>

                <?php  if(!empty($_W['isfounder']) || empty($_W['setting']['permurls']['sections']) || in_array('ext', $_W['setting']['permurls']['sections'])) { ?><li<?php  if(FRAME == 'ext') { ?> class="active"<?php  } ?> id="liebiaoyuan"><a href="<?php  echo url('home/welcome/ext');?>"><i class="fa fa-cubes"></i>营销模块</a></li><?php  } ?>
 
	<!--		   <?php  if(!empty($_W['isfounder']) || empty($_W['setting']['permurls']['sections']) || in_array('ext', $_W['setting']['permurls']['sections'])) { ?><li<?php  if(FRAME == 'ext') { ?> class="active"<?php  } ?> id="liebiaoyuan"><a href="$_W['siteroot']./web/index.php?c=home&a=welcome&do=ext&m=ewei_shop"><i class="fa fa-cubes"></i>分销管理</a></li><?php  } ?>-->
			  <?php  if(!empty($_W['isfounder']) || empty($_W['setting']['permurls']['sections']) || in_array('mc', $_W['setting']['permurls']['sections'])) { ?><li<?php  if(FRAME == 'mc') { ?> class="active"<?php  } ?> id="liebiaoyuan"><a href="<?php  echo url('home/welcome/mc');?>"><i class="fa fa-gift"></i>粉丝营销</a></li><?php  } ?>
			  <?php  if(!empty($_W['isfounder']) || empty($_W['setting']['permurls']['sections']) || in_array('site', $_W['setting']['permurls']['sections'])) { ?><li<?php  if(FRAME == 'site') { ?> class="active"<?php  } ?> id="liebiaoyuan"><a href="<?php  echo url('home/welcome/site');?>"><i class="fa fa-life-bouy"></i>微站功能</a></li><?php  } ?>
                
			
			
			
			

 
			
                       
		                                        
        </ul>
        <!-- END Header Navigation Left -->
    </header>
    <?php  if(empty($_COOKIE['check_setmeal']) && !empty($_W['account']['endtime']) && ($_W['account']['endtime'] - TIMESTAMP < (6*86400))) { ?>
        <div class="upgrade-tips" id="setmeal-tips">
            <a href="<?php  echo url('user/edit', array('uid' => $_W['account']['uid']));?>" target="_blank">
                您的服务有效期限：<?php  echo date('Y-m-d', $_W['account']['starttime']);?> ~ <?php  echo date('Y-m-d', $_W['account']['endtime']);?>.
                <?php  if($_W['account']['endtime'] < TIMESTAMP) { ?>
                目前已到期，请联系管理员续费
                <?php  } else { ?>
                将在<?php  echo ($_W['account']['endtime'] - strtotime(date('Y-m-d')))/86400?>天后到期，请及时付费
                <?php  } ?>
            </a><span class="tips-close" style="background:#d03e14;" onclick="check_setmeal_hide();"><i class="fa fa-times-circle"></i></span>
        </div>
        <script>
            function check_setmeal_hide() {
                util.cookie.set('check_setmeal', 1, 1800);
                $('#setmeal-tips').hide();
                return false;
            }
        </script>
    <?php  } ?>
<main id="main-container">

    <div class="content content-boxed">

        <div class="block"style="box-shadow: 0 1px 3px rgba(195, 194, 194, 0.51)">
            <div class="block-content block-content-narrow" style="padding-bottom: 50px;"> 
            <?php  if(CRUMBS_NAV == 1) { ?>
                        <?php  global $module_types;global $module;global $ptr_title;?>
                        <ol class="breadcrumb" style="padding:5px 0;">
                            <li><a href="<?php  echo url('home/welcome/ext');?>"><i class="fa fa-cogs"></i> &nbsp; 扩展功能</a></li>
                            <li><a href="<?php  echo url('home/welcome/ext', array('m' => $module['name']));?>"><?php  echo $module_types[$module['type']]['title'];?>模块 - <?php  echo $module['title'];?></a></li>
                            <li class="active"><?php  echo $ptr_title;?></li>
                        </ol>
                    <?php  } else if(CRUMBS_NAV == 2) { ?>
                        <?php  global $module_types;global $module;global $ptr_title; global $site_urls; $m = $_GPC['m'];?>
                        <ul class="nav nav-tabs">
                            <li><a href="<?php  echo url('platform/reply', array('m' => $m));?>">管理<?php  echo $module['title'];?></a></li>
                            <li><a href="<?php  echo url('platform/reply/post', array('m' => $m));?>"><i class="fa fa-plus"></i> 添加<?php  echo $module['title'];?></a></li>
                            <?php  if(!empty($site_urls)) { ?>
                                <?php  if(is_array($site_urls)) { foreach($site_urls as $site_url) { ?>
                                    <li <?php  if($_GPC['do'] == $site_url['do']) { ?> class="active"<?php  } ?>><a href="<?php  echo $site_url['url'];?>"> <?php  echo $site_url['title'];?></a></li>
                                <?php  } } ?>
                            <?php  } ?>
                        </ul>
                    <?php  } ?>
               <?php  if(defined('IN_MESSAGE')) { ?>
            <div class="row text-center">
                <div class="col-xs-12 col-sm-12 col-lg-12">
                <div class="alert alert-<?php  echo $label;?> alert-dismissable">
                    
                    <?php  if(is_array($msg)) { ?>
                        <h3 class="font-w300 push-15">MYSQL 错误：</h3>
                        <p><?php  echo cutstr($msg['sql'], 300, 1);?></p>
                        <p><b><?php  echo $msg['error']['0'];?> <?php  echo $msg['error']['1'];?>：</b><?php  echo $msg['error']['2'];?></p>
                    <?php  } else { ?>
                    <h3 class="font-w300 push-15"><i class="fa fa-<?php  if($label=='success') { ?>check-circle<?php  } ?><?php  if($label=='danger') { ?>times-circle<?php  } ?><?php  if($label=='info') { ?>info-circle<?php  } ?><?php  if($label=='warning') { ?>exclamation-triangle<?php  } ?>"></i> <?php  echo $msg;?></h3>
                    <?php  } ?>
                    <?php  if($redirect) { ?>
                    <p><a href="<?php  echo $redirect;?>">如果你的浏览器没有自动跳转，请点击此链接</a></p>
                    <script type="text/javascript">
                        setTimeout(function () {
                            location.href = "<?php  echo $redirect;?>";
                        }, 3000);
                    </script>
                    <?php  } else { ?>
                        <p>[<a href="javascript:history.go(-1);">点击这里返回上一页</a>] &nbsp; [<a href="./?refresh">首页</a>]</p>
                    <?php  } ?>
                </div>
            </div>    
        </div>
        <?php  } ?>
<script>
    var h = document.documentElement.clientHeight;
    $("#main-container").css('min-height',h-60);
</script>