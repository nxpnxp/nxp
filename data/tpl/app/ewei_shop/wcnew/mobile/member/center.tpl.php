<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<title>个人中心</title>
<style type="text/css">
    body {margin:0px; background:#eee; -moz-appearance:none;}
    a {text-decoration:none;}
    .header {height: auto; width:100%; padding:0px; background: url(../addons/ewei_shop/template/mobile/wcnew/static/images/bg6.png) 0 0 no-repeat;background-size: 100% 100%;}
    .header .user {height:48px; padding:10px;}
    .header .user .user-head {height:48px; width:48px; background:#fff; border-radius:50%; float:left;border:2px solid #fff;}
    .header .user .user-head img {height:48px; width:48px; border-radius:24px;}
    .header .user .user-info {height:48px; width:auto; float:left; margin-left:14px; color:#fff;padding-top:5px;}
    .header .user .user-info .user-name {height:24px; width:auto; font-size:16px; line-height:24px;}
    .header .user .user-info .user-other {height:24px; width:auto; font-size:12px;}
    .header .user-gold {height:35px; width:94%; padding:5px 3%; border-bottom:1px solid #ddd; background:#fff; font-size:16px; line-height:35px;}
    .header .user-gold .title {height:35px; width:auto; float:left; color:#666;}
    .header .user-gold .num {height:35px; width:auto; float:left; color:#f90;}
    
    .header .user-gold .draw {width:80px; height:30px; background:#6c9; float:right;}
    .header .user .set {height:26px; width:26px; float:right; margin-top:10px;}

    .header .user-op { height:35px; width:94%; padding:5px 3%; border-bottom:1px solid #ddd; background:#fff; font-size:16px; line-height:35px; }
    .take {height:30px; width:auto; padding:0 10px; line-height:30px; font-size:16px; float:right; background:#ff6600; border-radius:5px; margin-top:5px; color:#fff;}
    .take1 {height:30px; width:auto; padding:0 10px; line-height:30px; font-size:16px; float:right; background:#00cc00; border-radius:5px; margin-top:5px; color:#fff;}
    
    .order {height:135px; width:100%; background:#fff; margin-top:20px; border-bottom:1px solid #ddd;}
    .order_all {height:100px; width:100%; padding:16px 0px; color:#666;}
    .order_pub {height:18px; float:left; border-left:1px solid #eee; padding-top:5px; text-align:center; color:#666; position:relative;}
    .order_pub span {height:16px; width:16px; background:#f30; border-radius:8px; position:absolute; top:0; right:25%; font-size:12px; color:#fff; line-height:16px;}
    .order_1 {width:24%;}
    .order_2 {width:25%;}
    .order_3 {width:25%;}
    .order_4 {width:25%;}

    .list1 {height:44px; width:94%; background:#fff; padding:0px 3%; margin-top:20px; border-bottom:1px solid #ddd; border-top:1px solid #ddd; line-height:44px; color:#666;}
    .list1 i {font-size:20px; margin-right:10px;}
    .allorder {float:right; color:#aaa; margin-right:45px; text-decoration:none;}


    .cart {height:auto; width:100%; background:#fff; margin-top:20px; border-bottom:1px solid #ddd;}
    .address {height:38px; width:100%; background:#fff; margin-top:20px; border-bottom:1px solid #ddd; border-top:1px solid #ddd; line-height:38px;}

    .copyright {height:40px; width:100%; text-align:center; line-height:40px; font-size:12px; color:#999; margin-top:10px;}

</style>

<div id="container"></div>
<script id="member_center" type="text/html">
    <div class="header">
        <div class="user">
            <div class="user-head"><img src="<%member.avatar%>" /></div>
            <div class="user-info">
                <div class="user-name"><%member.nickname%></div>
                <div class="user-other" <?php  if(!empty($set['shop']['levelurl'])) { ?>onclick='location.href="<?php  echo $set['shop']['levelurl'];?>"'<?php  } ?>>[<%level.levelname%>] <?php  if(!empty($set['shop']['levelurl'])) { ?><i class='fa fa-question-circle' ></i><?php  } ?>
                </div>
            </div>
            <div class="set" onclick='location.href="<?php  echo $this->createMobileUrl('member/info')?>"'><i class="fa fa-gear" style="font-size:26px; color:#fff;"></i></div>
        </div>

</div>
 <div class="cart" style='margin-top:-20px;'>
     <a href="javascript:;"><div class="list1" style=" border-bottom:0px;border-top:0px;"><i class="fa fa-camera-retro"  style="color:#ee7a46;margin-top:2px;" ></i>余额: <span style='color:#f90'><%member.credit2%></span> <div class="take"  style="background:##ee7a46" onclick="location.href='<?php  echo $this->createMobileUrl('member/recharge',array('openid'=>$openid))?>'">充值</div></div></a>
    <a href="javascript:;"><div class="list1" style="margin:0px; border-bottom:0px;"><i class="fa fa-cc"   style="color:#ee7a46"></i>积分: <%member.credit1%>
            <%if open_creditshop%>
            <div class="take1" style="background:#827A8D;" onclick="location.href='<?php  echo $this->createPluginMobileUrl('creditshop')?>'">积分兑换</div>
            <%/if%>
        </div></a>
</div>
<div class="order">
    <a href="<?php  echo $this->createMobileUrl('order')?>">
        <div class="list1" style="margin-top:-10px;">
            <i class="fa fa-reorder" style="float:left;color:#ffffff;margin-left:0px;border:1px solid #ee7a46 ;background:#ee7a46;line-height:25px;border-radius:100px;height:25px; width:25px;margin-top:9px;text-align:center;"></i>
            <span style="float:left;">我的订单</span>
            <i class="fa fa-angle-right" style="color:#999; font-size:26px; float:right; line-height:44px;"></i>
            <div class="allorder">查看我的全部订单</div>
        </div>
    </a>
    <div class="order_all"   style="color:#8A8A8A">
        <a href="<?php  echo $this->createMobileUrl('order',array('status'=>0))?>"><div class="order_pub order_1" style="border:0px; color:#8A8A8A  "><i class="fa fa-credit-card" style="font-size:30px"></i><br>待付款<%if order.status0>0%><span><%order.status0%></span><%/if%></div></a>
        <a href="<?php  echo $this->createMobileUrl('order',array('status'=>1))?>"><div class="order_pub order_2" style="color:#8A8A8A  "   ><i class="fa fa-suitcase" style="font-size:30px"></i><br>待发货<%if order.status1>0%><span><%order.status1%></span><%/if%></div></a>
        <a href="<?php  echo $this->createMobileUrl('order',array('status'=>2))?>"><div class="order_pub order_3" style="color:#8A8A8A  "   ><i class="fa fa-truck" style="font-size:30px"></i><br>待收货<%if order.status2>0%><span><%order.status2%></span><%/if%></div></a>
        <a href="<?php  echo $this->createMobileUrl('order',array('status'=>4))?>"><div class="order_pub order_4" style="color:#8A8A8A  "  ><i class="fa fa-money" style="font-size:30px"></i><br>待退款<%if order.status4>0%><span><%order.status4%></span><%/if%></div></a>
    </div>
</div>

<div class="cart"  style="margin-top:10px;">

<a href="<?php  echo $this->createPluginMobileUrl('commission')?>"><div class="list1" style="margin:0px; border-bottom:0px;"><i class="fa fa-users" style="  float:left;color:#ffffff;  border:1px solid #ee7a46 ;background:#ee7a46;border-radius:50px;height:25px; width:25px;margin-top:10px;text-align:center;line-height:25px;  "></i>分销中心<i class="fa fa-angle-right" style="color:#999; font-size:26px; float:right; line-height:44px;"></i></div></a>
<a href="<?php  echo $this->createMobileUrl('member/phb')?>"><div class="list1" style="margin:0px; border-bottom:0px;"><i class="fa fa-thumbs-o-up" style="  float:left;color:#ffffff;  border:1px solid #ee7a46 ;background:#ee7a46;border-radius:50px;height:25px; width:25px;margin-top:10px;text-align:center;line-height:25px;  "></i>积分排行榜<i class="fa fa-angle-right" style="color:#999; font-size:26px; float:right; line-height:44px;"></i></div></a>



</div>




<div class="cart"  style="margin-top:10px;">
    <a href="<?php  echo $this->createMobileUrl('shop/cart')?>"><div class="list1" style="margin:0px; border-bottom:0px;"><i class="fa fa-shopping-cart" style="float:left;color:#ffffff;  border:1px solid #ee7a46 ;background:#ee7a46;border-radius:50px;height:25px; width:25px;margin-top:10px;text-align:center;line-height:25px;"></i>我的购物车<i class="fa fa-angle-right" style="color:#999; font-size:26px; float:right; line-height:44px;"></i></div></a>
    <a href="<?php  echo $this->createMobileUrl('shop/favorite')?>"><div class="list1" style="margin:0px; border-bottom:0px;"><i class="fa fa-heart" style="float:left;color:#ffffff;  border:1px solid #ee7a46 ;background:#ee7a46;border-radius:50px;height:25px; width:25px;margin-top:10px;text-align:center;line-height:25px;"></i>我的收藏<i class="fa fa-angle-right" style="color:#999; font-size:26px; float:right; line-height:44px;"></i></div></a>
    <a href="<?php  echo $this->createMobileUrl('shop/history')?>"><div class="list1" style="margin:0px; border-bottom:0px;"><i class="fa fa-list" style="  float:left;color:#ffffff;  border:1px solid #ee7a46 ;background:#ee7a46;border-radius:50px;height:25px; width:25px;margin-top:10px;text-align:center;line-height:25px;   "></i>我的足迹<i class="fa fa-angle-right" style="color:#999; font-size:26px; float:right; line-height:44px;"></i></div></a>
    <a href="<?php  echo $this->createMobileUrl('member/notice')?>"><div class="list1" style="margin:0px; border-bottom:0px;"><i class="fa fa-volume-up" style="  float:left;color:#ffffff;  border:1px solid #ee7a46 ;background:#ee7a46;border-radius:50px;height:25px; width:25px;margin-top:10px;text-align:center ;line-height:25px; "></i>消息提醒设置<i class="fa fa-angle-right" style="color:#999; font-size:26px; float:right; line-height:44px;"></i></div></a>
    
</div>
    <?php  if(isset($set['trade']) && $set['trade']['withdraw']==1) { ?>
    <a href="javascript:;" id="btnwithdraw"><div class="list1" style="border-bottom:0px;margin-top:10px;"><i class="fa fa-money" style="  float:left;color:#ffffff;  border:1px solid #ee7a46 ;background:#ee7a46;border-radius:50px;height:25px; width:25px;margin-top:10px;text-align:center;line-height:25px;"></i>余额提现<i class="fa fa-angle-right" style="color:#999; font-size:26px; float:right; line-height:44px;"></i></div></a>    
    <?php  } ?>
    <a href="<?php  echo $this->createMobileUrl('member/log')?>"><div class="list1" style="<?php  if(isset($set['trade']) && $set['trade']['withdraw']==1) { ?>margin-top:0px;<?php  } ?>"><i class="fa fa-file-text" style="  float:left;color:#ffffff;  border:1px solid #ee7a46 ;background:#ee7a46;border-radius:50px;height:25px; width:25px;margin-top:10px;text-align:center;line-height:25px;  "></i>
            <?php  if(isset($set['trade']) && $set['trade']['withdraw']==1) { ?>余额明细<?php  } else { ?>充值记录<?php  } ?>
            <i class="fa fa-angle-right" style="color:#999; font-size:26px; float:right; line-height:44px;"></i></div></a>    
    
<a href="<?php  echo $this->createMobileUrl('shop/address')?>"><div class="list1"  style="margin-top:10px;"><i class="fa fa-street-view" style="  float:left;color:#ffffff;  border:1px solid #ee7a46 ;background:#ee7a46;border-radius:50px;height:25px; width:25px;margin-top:10px;text-align:center;line-height:25px;"></i>收货地址管理<i class="fa fa-angle-right" style="color:#999; font-size:26px; float:right; line-height:44px;"></i></div></a>

<div class="copyright">版权所有 ©<?php  if(empty($set['shop']['name'])) { ?><?php  echo $_W['account']['name'];?><?php  } else { ?><?php  echo $set['shop']['name'];?><?php  } ?> </div>
</script>
<script language="javascript">
    require(['tpl', 'core'], function(tpl, core) {
        
        core.json('member/center',{},function(json){
            
           $('#container').html(  tpl('member_center',json.result) );
           var withdrawmoney = <?php echo empty($set['trade']['withdrawmoney'])?0:floatval($set['trade']['withdrawmoney'])?>;
           $('#btnwithdraw').click(function(){
 
               if(json.result.member.credit2<=0){
                   core.tip.show('无余额可提!');
                   return;
               }
               if(withdrawmoney>0 && json.result.member.credit2<withdrawmoney){
                   core.tip.show('满' +withdrawmoney + "元才能提现!" ); 
                   return;
               }
               location.href = core.getUrl('member/withdraw');
           })
            
        },true);
        
    })
</script>
<?php  $show_footer=true?>
<?php  $footer_current='member'?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>