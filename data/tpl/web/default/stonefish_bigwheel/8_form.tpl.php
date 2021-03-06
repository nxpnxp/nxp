<?php defined('IN_IA') or exit('Access Denied');?><style type="text/css">
.right_nav{list-style:none;margin:0;padding:0;width:50px;position:fixed;top:173px;right:27px; z-index:10; background:#f0f0f0; border: 1px solid #ccc;
  -webkit-border-radius: 6px;-moz-border-radius: 6px;border-radius: 6px;
  -webkit-box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.2);-moz-box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.2);box-shadow: 2px 2px 5px 2px rgba(0, 0, 0, 0.2);}
.right_nav li{border-bottom:1px solid #d3d3d3;height:50px;line-height:50px;text-align:center; cursor:pointer}
.right_nav li a{display:block; height:50px;font-size:12px;}
.right_nav li a:hover{background:#f9f9f9; text-decoration:none}
.right_nav li:last-child{border-right:none}
/*.right_nav li a.cur{background:#f9f9f9;color:#f60}*/
</style>
<ul class="right_nav">
   	<li><a href="javascript:scroll(0,0)">顶部</a></li>
	<li><a class="nav_ra" href="#nav_ra">开始</a></li>
   	<li><a class="nav_rb" href="#nav_rb">结束</a></li>
	<li><a class="nav_rc" href="#nav_rc">详细</a></li>
	<li><a class="nav_rd" href="#nav_rd">次数</a></li>
	<li><a class="nav_re" href="#nav_re">显示</a></li>
	<li><a class="nav_rf" href="#nav_rf">奖品</a></li>
	<li><a class="nav_rg" href="#nav_rg">兑奖</a></li>
	<li><a class="nav_rh" href="#nav_rh">分享</a></li>
	<li><a class="nav_r1" href="#nav_r1">底部</a></li>
</ul>
<input type="hidden" name="reply_id" value="<?php  echo $reply['id'];?>" />
<input type="hidden" name="exchange_id" value="<?php  echo $exchange['id'];?>" />
<?php  if($reply['id']) { ?>
<div class="account panel panel-default">
    <div class="panel-heading">
        活动数据
    </div>
	<div class="panel-body">
	<div class="row-fluid">
    	<div class="span8 control-group">
			<a class="btn btn-default" href="<?php  echo $this->createWebUrl('fansdata',array('rid' => $rid));?>" style="margin-right:5px;"><i class="fa fa-users"></i> 参与粉丝</a>
			<a class="btn btn-default" href="<?php  echo $this->createWebUrl('sharedata',array('rid' => $rid));?>" style="margin:0 5px;"><i class="fa fa-share-alt"></i> 分享数据</a>
			<a class="btn btn-default" href="<?php  echo $this->createWebUrl('prizedata',array('rid' => $rid));?>" style="margin:0 5px;"><i class="fa fa-gift"></i> 中奖名单</a>
			<a class="btn btn-default" href="<?php  echo $this->createWebUrl('rankdata',array('rid' => $rid));?>" style="margin:0 5px;"><i class="fa fa-list-ol"></i> 粉丝排行</a>
			<a class="btn btn-default" href="<?php  echo $this->createWebUrl('trend',array('rid' => $rid));?>" style="margin:0 5px;"><i class="fa fa-bar-chart-o"></i> 活动分析</a>
			<a class="btn btn-default" href="<?php  echo $this->createWebUrl('posttmplmsg',array('rid' => $rid));?>" style="margin:0 5px;"><i class="fa fa-volume-up"></i> 消息通知</a>
			<?php  if($stonefish_branch) { ?><a class="btn btn-default" href="<?php  echo $this->createWebUrl('branch',array('rid' => $rid));?>" style="margin-left:5px;"><i class="fa fa-plus-square"></i> 商家赠送项</a><?php  } ?>
        </div>
		<div class="span8 control-group" style="margin-top:10px;">
		    <?php  if(is_array($ids)) { foreach($ids as $idsname) { ?>
			<p><span class="label label-success" style="padding:8px;" target="_blank"><?php  echo $acid_arr[$idsname]['name'];?>活动链接：<?php  echo $_W['siteroot'];?>app/<?php  echo substr($this->createMobileUrl('entry', array('j' => $acid_arr[$idsname]['acid'],'rid' => $rid,'entrytype' => 'index')),2)?></span></p>
			<?php  } } ?>
		</div>
    </div>
    </div>
</div>
<?php  } ?>
<div class="panel panel-default" id="nav_ra">
    <div class="panel-heading">
        活动开始设置
    </div>
    <div class="panel-body">        
		<div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span> 活动名称</label>
            <div class="col-sm-9 col-xs-12">
               	<input type="text" id="title" class="form-control" placeholder="" name="title" value="<?php  echo $reply['title'];?>">
            </div>
        </div>
 		<div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span> 活动图片</label>
            <div class="col-sm-9 col-xs-12">
               	<?php  echo tpl_form_field_image('start_picurl',$reply['start_picurl']);?>
				<div class="help-block">图片大小建议900 * 500</div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span> 活动说明</label>
            <div class="col-sm-9 col-xs-12">
               	<textarea style="height:60px;" id='description' name="description" class="form-control" cols="60"><?php  echo $reply['description'];?></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span> 活动时间</label>
            <div class="col-sm-9 col-xs-12">
               	<?php  echo tpl_form_field_daterange('datelimit', array('start'=>date('Y-m-d H:i',$reply['starttime']),'end'=>date('Y-m-d H:i',$reply['endtime'])), true)?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label">版权信息</label>
            <div class="col-sm-9 col-xs-12">
                    <input type="text" id="copyright" class="form-control" placeholder="" name="copyright" value="<?php  echo $reply['copyright'];?>">
					<div class="help-block">版权信息，如果不填写，默认为公众号名称！</div>
            </div>
        </div>
    </div>
</div>
<div class="panel panel-default" id="nav_rb">
    <div class="panel-heading">
        活动结束设置
    </div>
    <div class="panel-body">
        <div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span> 结束标题</label>
            <div class="col-sm-9 col-xs-12">
               	<input type="text" id="end_title" class="form-control" placeholder="" name="end_title" value="<?php  echo $reply['end_title'];?>">
            </div>
        </div>
 		<div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span> 结束图片</label>
            <div class="col-sm-9 col-xs-12">
               	<?php  echo tpl_form_field_image('end_picurl',$reply['end_picurl']);?>
				<div class="help-block">图片大小建议900 * 500</div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span> 结束说明</label>
            <div class="col-sm-9 col-xs-12">
               	<textarea style="height:60px;" id='end_description' name="end_description" class="form-control" cols="60"><?php  echo $reply['end_description'];?></textarea>
            </div>
        </div>
    </div>
</div>
<div class="panel panel-default" id="nav_rc">
    <div class="panel-heading">
        活动详细设置
    </div>
    <div class="panel-body">        
		<div class="form-group" id="award_times">
 			<label class="col-xs-12 col-sm-3 col-md-2 control-label">选择模板</label>
            <div class="col-sm-9 col-xs-6">
               	<select name="templateid" class="form-control">
					<?php  if(is_array($template)) { foreach($template as $templates) { ?>
					<option value="<?php  echo $templates['id'];?>" <?php  if($templates['id'] == $reply['templateid']) { ?>selected<?php  } ?>><?php  echo $templates['title'];?></option>
					<?php  } } ?>
				</select>
            </div>
        </div>
		<div class="form-group">
 			<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span> 参与用户类型</label>
            <div class="col-sm-9 col-xs-6">
               	<div class="input-group">
					<label for="issubscribe0" class="radio-inline"><input type="radio" name="issubscribe" value="0" id="issubscribe0" <?php  if($reply['issubscribe'] == 0) { ?>checked="true"<?php  } ?>/> 任意粉丝</label>&nbsp;&nbsp;&nbsp;
					<label for="issubscribe1" class="radio-inline"><input type="radio" name="issubscribe" value="1" id="issubscribe1" <?php  if($reply['issubscribe'] == 1) { ?>checked="true"<?php  } ?>/> 关注粉丝</label><?php  if($stonefish_member) { ?>&nbsp;&nbsp;&nbsp;
					<label for="issubscribe2" class="radio-inline"><input type="radio" name="issubscribe" value="2" id="issubscribe2" <?php  if($reply['issubscribe'] == 2) { ?>checked="true"<?php  } ?>/> 正常会员</label>&nbsp;&nbsp;&nbsp;
					<label for="issubscribe3" class="radio-inline"><input type="radio" name="issubscribe" value="3" id="issubscribe3" <?php  if($reply['issubscribe'] == 3) { ?>checked="true"<?php  } ?>/> 手机验证会员</label>&nbsp;&nbsp;&nbsp;
					<label for="issubscribe4" class="radio-inline"><input type="radio" name="issubscribe" value="4" id="issubscribe4" <?php  if($reply['issubscribe'] == 4) { ?>checked="true"<?php  } ?>/> 分组验证会员</label><?php  if($stonefish_branch) { ?>&nbsp;&nbsp;&nbsp;
					<label for="issubscribe5" class="radio-inline"><input type="radio" name="issubscribe" value="5" id="issubscribe5" <?php  if($reply['issubscribe'] == 5) { ?>checked="true"<?php  } ?>/> 商家网点验证会员</label><?php  } ?><?php  } ?>
				</div>
            </div>
        </div>
		<!--
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">初始值</label>
			<div class="col-sm-9 col-xs-12">
				<div class="input-group">
					<span class="input-group-addon">系统随机增送初始</span>
					<input type="text" class="form-control" name="inpointstart" id="inpointstart" value="<?php  echo $reply['inpointstart'];?>" />
					<span class="input-group-addon" style="border-left:0px;border-right:0px;"> 至</span>
					<input type="text" class="form-control" name="inpointend" id="inpointend" value="<?php  echo $reply['inpointend'];?>" />
					<span class="input-group-addon">值给参与者</span>
				</div>
			</div>
		</div>
		-->
		<div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label"> 用户中奖提示</label>
            <div class="col-sm-9 col-xs-12">
               	<textarea style="height:80px;" id='awardtext' name="awardtext" class="form-control" cols="60"><?php  echo $reply['awardtext'];?></textarea>
				<div class="help-block">每行一个提示，用于变化提示内容 <span style='color:red'>变量：#奖品名称#</span> 分享人所中的最大奖品名称，没有中奖则不显示</div>
            </div>
        </div>
		<div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label"> 没有中奖提示</label>
            <div class="col-sm-9 col-xs-12">
               	<textarea style="height:80px;" id='notawardtext' name="notawardtext" class="form-control" cols="60"><?php  echo $reply['notawardtext'];?></textarea>
				<div class="help-block">每行一个提示，用于变化提示内容 <span style='color:red'>变量：#奖品名称#</span> 分享人所中的最大奖品名称，没有中奖则不显示</div>
            </div>
        </div>
		<div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label"> 没有奖品提示</label>
            <div class="col-sm-9 col-xs-12">
               	<textarea style="height:80px;" id='notprizetext' name="notprizetext" class="form-control" cols="60"><?php  echo $reply['notprizetext'];?></textarea>
				<div class="help-block">每行一个提示，用于变化提示内容</div>
            </div>
        </div>        
		<div class="form-group">
 			<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span> 是否获取助力者头像昵称</label>
            <div class="col-sm-9 col-xs-6">
               	<div class="input-group">
					<label for="power1" class="radio-inline"><input type="radio" name="power" value="1" id="power1" <?php  if($reply['power'] == 1) { ?>checked="true"<?php  } ?> onclick="$('#poweravatar').hide();"/> 只获取openid值</label>&nbsp;&nbsp;&nbsp;
					<label for="power2" class="radio-inline"><input type="radio" name="power" value="2" id="power2" <?php  if($reply['power'] == 2) { ?>checked="true"<?php  } ?> onclick="$('#poweravatar').show();"/> 获取用户头像昵称</label>
				</div>
            </div>
        </div>
		<div class="form-group" id="poweravatar"<?php  if($reply['power'] == 1) { ?>style="display:block"<?php  } ?>>
 			<label class="col-xs-12 col-sm-3 col-md-2 control-label"> 头像大小</label>
            <div class="col-sm-9 col-xs-6">
               	<div class="input-group">
					<label for="poweravatar46" class="radio-inline"><input type="radio" name="poweravatar" value="46" id="poweravatar46" <?php  if($reply['poweravatar'] == '46') { ?>checked="true"<?php  } ?>/> 46 * 46</label>&nbsp;&nbsp;&nbsp;
					<label for="poweravatar64" class="radio-inline"><input type="radio" name="poweravatar" value="64" id="poweravatar64" <?php  if($reply['poweravatar'] == '64') { ?>checked="true"<?php  } ?>/> 64 * 64</label>&nbsp;&nbsp;&nbsp;
					<label for="poweravatar96" class="radio-inline"><input type="radio" name="poweravatar" value="96" id="poweravatar96" <?php  if($reply['poweravatar'] == '96') { ?>checked="true"<?php  } ?>/> 96 * 96</label>&nbsp;&nbsp;&nbsp;
					<label for="poweravatar132" class="radio-inline"><input type="radio" name="poweravatar" value="132" id="poweravatar132" <?php  if($reply['poweravatar'] == '132') { ?>checked="true"<?php  } ?>/> 132 * 132</label>&nbsp;&nbsp;&nbsp;
					<label for="poweravatar0" class="radio-inline"><input type="radio" name="poweravatar" value="0" id="poweravatar0" <?php  if($reply['poweravatar'] == 0) { ?>checked="true"<?php  } ?>/> 640 * 640</label>
				</div>
            </div>
        </div>
		<div class="form-group">
 			<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span> 助力类型</label>
            <div class="col-sm-9 col-xs-6">
               	<div class="input-group">
					<label for="powertype0" class="radio-inline"><input type="radio" name="powertype" value="0" id="powertype0" <?php  if($reply['powertype'] == 0) { ?>checked="true"<?php  } ?>/> 访问助力</label>&nbsp;&nbsp;&nbsp;
					<label for="powertype1" class="radio-inline"><input type="radio" name="powertype" value="1" id="powertype1" <?php  if($reply['powertype'] == 1) { ?>checked="true"<?php  } ?>/> 点击助力</label>
				</div>
            </div>
        </div>
		<div class="form-group">
 			<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span> 互助类型</label>
            <div class="col-sm-9 col-xs-6">
               	<div class="input-group">
					<label for="helptype0" class="radio-inline"><input type="radio" name="helptype" value="0" id="helptype0" <?php  if($reply['helptype'] == 0) { ?>checked="true"<?php  } ?>/> 允许互助</label>&nbsp;&nbsp;&nbsp;
					<label for="helptype1" class="radio-inline"><input type="radio" name="helptype" value="1" id="helptype1" <?php  if($reply['helptype'] == 1) { ?>checked="true"<?php  } ?>/> 禁止互助</label>
				</div>
            </div>
        </div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">助力限制类型</label>
			<div class="col-sm-9 col-xs-12">
				<label for="limitType0" class="radio-inline"><input type="radio" id="limitType0" name="limittype" value="0" <?php  if($reply['limittype'] == 0) { ?>checked="checked"<?php  } ?> onclick="$('#totallimit').hide();">限制一次</label>&nbsp;&nbsp;&nbsp;
				<label for="limitType1" class="radio-inline"><input type="radio" id="limitType1" name="limittype" value="1" <?php  if($reply['limittype'] == 1) { ?>checked="checked"<?php  } ?> onclick="$('#totallimit').show();">每天一次</label>
			</div>
		</div>
		<div class="form-group" id="totallimit"<?php  if($reply['limittype'] == 0) { ?> style="display:none"<?php  } ?>>
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">每个好友总助力次数限制</label>
			<div class="col-sm-9 col-xs-12">
				<div class="input-group">
					<span class="input-group-addon">每个好友最多助力</span>
					<input type="text" name="totallimit" class="form-control" value="<?php  echo $reply['totallimit'];?>" />
					<span class="input-group-addon">次</span>
				</div>
			</div>
		</div>
		<!--
        <div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">助力值</label>
			<div class="col-sm-9 col-xs-12">
               	<div class="input-group">
					<span class="input-group-addon">系统随机增送用户</span>
					<input type="text" class="form-control" name="randompointstart" id="randompointstart" value="<?php  echo $reply['randompointstart'];?>" />
					<span class="input-group-addon" style="border-left:0px;border-right:0px;">至</span>
					<input type="text" class="form-control" name="randompointend" id="randompointend" value="<?php  echo $reply['randompointend'];?>" />
					<span class="input-group-addon">助力值</span>
				</div>
            </div>
		</div>		
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">增加助力值概率</label>
			<div class="col-sm-9 col-xs-12">
				<div class="input-group">
					<span class="input-group-addon">好友助力成功概率</span>					
					<input type="text" class="form-control" name="addp" id="addp" value="<?php  echo $reply['addp'];?>" />
					<span class="input-group-addon">%(0-100)不足100%有可能为负助力</span>
				</div>
			</div>
		</div>
		-->
    </div>
</div>

<div class="panel panel-default" id="nav_rd">
    <div class="panel-heading">
        参与次数设置
    </div>
    <div class="panel-body">
		<div class="form-group">
 			<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span> 每人最多获奖次数</label>
            <div class="col-sm-9 col-xs-6">
               	<div class="input-group">
					<input type="text" class="form-control" name="award_num" value="<?php  echo $reply['award_num'];?>" />
					<span class="input-group-addon">次</span>
				</div>
				<div class="help-block">单个用户最多共享几个奖项，0为不限制，推荐设置为1次!</div>
            </div>
        </div>
		<div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span> 超过中奖数量提示</label>
            <div class="col-sm-9 col-xs-6">
               	<input type="text" class="form-control" name="award_num_tips" value="<?php  echo $reply['award_num_tips'];?>" />
            </div>
        </div>
		<div class="form-group">
 			<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span> 参与次数选项</label>
            <div class="col-sm-9 col-xs-6">
               	<div class="input-group">
					<label for="opportunity1" class="radio-inline"><input type="radio" name="opportunity" value="0" id="opportunity1" <?php  if(empty($reply) || $reply['opportunity'] == 0) { ?>checked="true"<?php  } ?> onclick="<?php  if($stonefish_branch) { ?>$('#opportunity_text').hide();<?php  } ?>$('#number_times').show();$('#credit').hide();"/> 活动设置次数</label>&nbsp;&nbsp;&nbsp;
					<?php  if($stonefish_branch) { ?><label for="opportunity2" class="radio-inline"><input type="radio" name="opportunity" value="1" id="opportunity2" <?php  if(!empty($reply) && $reply['opportunity'] == 1) { ?>checked="true"<?php  } ?> onclick="$('#opportunity_text').show();$('#number_times').hide();$('#credit').hide();"/> 商户赠送次数</label>&nbsp;&nbsp;&nbsp;<?php  } ?>
					<label for="opportunity3" class="radio-inline"><input type="radio" name="opportunity" value="2" id="opportunity3" <?php  if(!empty($reply) && $reply['opportunity'] == 2) { ?>checked="true"<?php  } ?> onclick="<?php  if($stonefish_branch) { ?>$('#opportunity_text').hide();<?php  } ?>$('#number_times').hide();$('#credit').show();"/> 积分购买次数</label>
				</div>				
            </div>
        </div>
		<?php  if($stonefish_branch) { ?>
		<div class="form-group" id="opportunity_text"<?php  if(!empty($reply) && $reply['opportunity'] == 1) { ?> style="display:block"<?php  } else { ?> style="display:none"<?php  } ?>>
            <label class="col-xs-12 col-sm-3 col-md-2 control-label">商家赠送参数</label>
            <div class="col-sm-9 col-xs-12">
               	<textarea style="height:200px;" id='opportunity_txt' name="opportunity_txt" class="form-control richtext2" cols="60"><?php  echo $reply['opportunity_txt'];?></textarea>
                <span class="help-block">商家赠送次数为0时 即商家赠次数审核状态下给用户的说明 </span>
				<div class="help-block"><span style='color:red'>设置为商户赠送次数后，<b>每人最多参与次数</b>将以商户赠送的次数为准！</span></div>
            </div>
        </div>
        <?php  } ?>		
		<div class="form-group" id="credit"<?php  if(!empty($reply) && $reply['opportunity'] == 2) { ?> style="display:block"<?php  } else { ?> style="display:none"<?php  } ?>>
            <label class="col-xs-12 col-sm-3 col-md-2 control-label">积分购买次数</label>
            <div class="col-sm-9 col-xs-6">
               	<div class="input-group">
					<span class="input-group-addon">每</span>
					<input type="text" class="form-control" name="credit_value" id="credit_value" value="<?php  echo $reply['credit_value'];?>" />
					<span class="input-group-addon" style="border-left:0px;border-right:0px;">个</span>
					<select name="credit_type" class="form-control">
						<?php  if(is_array($creditnames)) { foreach($creditnames as $key => $credit) { ?>
						<option value="<?php  echo $key;?>" <?php  if($key == $reply['credit_type']) { ?>selected<?php  } ?>><?php  echo $credit;?></option>
						<?php  } } ?>
					</select>
					<span class="input-group-addon" style="border-left:0px;border-right:0px;">购买一次  最多购买</span>
					<input type="text" class="form-control" name="number_time" value="<?php  echo $reply['number_times'];?>" />
					<span class="input-group-addon">次</span>
				</div>
				<div class="help-block">每参与一次，系统自动扣除多少积分    最多购买为0时不限制 直至积分不足无法购买停止</div>
				<div class="help-block"><span style='color:red'>设置为积分购买次数后，<b>每人最多参与次数</b>将以粉丝购买的次数为准！</span></div>
            </div>
        </div>
     	<div class="form-group" id="number_times"<?php  if(!empty($reply) && $reply['opportunity'] == 0) { ?> style="display:block"<?php  } else { ?> style="display:none"<?php  } ?>>
            <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span> 每人最多参与次数</label>
            <div class="col-sm-9 col-xs-6">
               	<div class="input-group">
					<input type="text" class="form-control" name="number_times" value="<?php  echo $reply['number_times'];?>" />
					<span class="input-group-addon">个</span>
				</div>
				<div class="help-block">参与次数限制,0为不限制</div>
            </div>
        </div>
		<div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span> 超过总次数提示</label>
            <div class="col-sm-9 col-xs-6">
               	<input type="text" class="form-control" name="number_times_tips" value="<?php  echo $reply['number_times_tips'];?>" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span> 每人每天最多参与次数</label>
            <div class="col-sm-9 col-xs-6">
               	<div class="input-group">
					<input type="text" class="form-control" name="day_number_times" value="<?php  echo $reply['day_number_times'];?>" />
					<span class="input-group-addon">个</span>
				</div>
				<div class="help-block">必须小于总次数！ 0 为不限制 可以参与天数 = 总次数/每天次数!</div>
            </div>
        </div>
		<div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span> 超过每天次数提示</label>
            <div class="col-sm-9 col-xs-6">
               	<input type="text" class="form-control" name="day_number_times_tips" value="<?php  echo $reply['day_number_times_tips'];?>" />
            </div>
        </div>
		<div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label"> 参与次数提示</label>
            <div class="col-sm-9 col-xs-12">
               	<textarea style="height:80px;" id='tips' name="tips" class="form-control" cols="60"><?php  echo $reply['tips'];?></textarea>
				<div class="help-block">刮奖次数提示词： <span style='color:red'>变量：#最多次数#</span> 每人最多参与次数 <span style='color:red'>变量：#每天次数#</span> 每人每天最多参与次数 <span style='color:red'>变量：#参与次数#</span> 共计参与了多少次刮奖 <span style='color:red'>变量：#今日次数#</span> 今日共计参与了多少次刮奖 <span style='color:red'>变量：#赠送次数#</span> 分享赠送多少次刮奖机会 <span style='color:red'>变量：#剩余次数#</span> 总次数剩余 <span style='color:red'>变量：#今日剩余#</span> 当天次数剩余</div>
            </div>
        </div>
    </div>
</div>

<div class="panel panel-default" id="nav_re">
    <div class="panel-heading">
        活动显示设置
    </div>
    <div class="panel-body">
        <div class="form-group">
 			<label class="col-xs-12 col-sm-3 col-md-2 control-label">首页滚动中奖人数</label>
            <div class="col-sm-9 col-xs-6">
				<div class="input-group">
					<span class="input-group-addon">首页　显示</span>
					<input type="text" class="form-control" name="viewawardnum" value="<?php  echo $reply['viewawardnum'];?>" />
					<span class="input-group-addon">位中奖粉丝 0为不显示中奖信息</span>
				</div>
            </div>
        </div>
		<div class="form-group">
 			<label class="col-xs-12 col-sm-3 col-md-2 control-label">排行榜显示人数</label>
            <div class="col-sm-9 col-xs-6">
				<div class="input-group">
					<span class="input-group-addon">排行榜显示</span>
					<input type="text" class="form-control" name="viewranknum" value="<?php  echo $reply['viewranknum'];?>" />
					<span class="input-group-addon">位粉丝</span>
				</div>
            </div>
        </div>
		<div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span> 显示奖品数量</label>
            <div class="col-sm-9 col-xs-12">
               	<label class="radio-inline">
                	<input type="radio" name="showprize" value="0" <?php  if($reply['showprize'] == 0) { ?> checked="checked"<?php  } ?>/>不显示
                </label>
                <label class="radio-inline">
                	<input type="radio" name="showprize" value="1" <?php  if($reply['showprize'] == 1) { ?> checked="checked"<?php  } ?>/>仅显示奖品
                </label>
				<label class="radio-inline">
                	<input type="radio" name="showprize" value="2" <?php  if($reply['showprize'] == 2) { ?> checked="checked"<?php  } ?>/>显示奖品以及数量
                </label>
            </div>
        </div>
		<div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label">奖品详细介绍</label>
            <div class="col-sm-9 col-xs-12">
               	<textarea style=" height:200px;" id='prizeinfo' name="prizeinfo" class="form-control richtextinfo"><?php  echo $reply['prizeinfo'];?></textarea>
            </div>
        </div>
		<div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label"> 秒显广告次数</label>
            <div class="col-sm-9 col-xs-12">
               	<label class="radio-inline">
                	<input type="radio" name="homepictype" value="1" <?php  if($reply['homepictype'] == 1) { ?> checked="checked"<?php  } ?>/>每次
                </label>
                <label class="radio-inline">
                	<input type="radio" name="homepictype" value="2" <?php  if($reply['homepictype'] == 2) { ?> checked="checked"<?php  } ?>/>每天
                </label>
				<label class="radio-inline">
                	<input type="radio" name="homepictype" value="3" <?php  if($reply['homepictype'] == 3) { ?> checked="checked"<?php  } ?>/>每周
                </label>
				<label class="radio-inline">
                	<input type="radio" name="homepictype" value="4" <?php  if($reply['homepictype'] == 4) { ?> checked="checked"<?php  } ?>/>仅1次
                </label>				
            </div>
        </div>
		<div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label"> 秒显广告时间</label>
            <div class="col-sm-9 col-xs-12">
               	<div class="input-group">
					<span class="input-group-addon">首页显示</span>
					<input type="text" class="form-control" name="homepictime" value="<?php  echo $reply['homepictime'];?>" />
					<span class="input-group-addon">秒广告图    0秒为不显示</span>
				</div>
            </div>
        </div>
		<div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label"> 秒显广告图</label>
            <div class="col-sm-9 col-xs-12">
               	<?php  echo tpl_form_field_image('homepic',$reply['homepic']);?>
            </div>
        </div>
		<div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label"> 虚拟人数显示</label>
            <div class="col-sm-9 col-xs-12">
               	<div class="input-group">
					<span class="input-group-addon">首页显示</span>
					<input type="text" class="form-control" name="xuninum" value="<?php  echo $reply['xuninum'];?>" />
					<span class="input-group-addon">位虚拟人数+真实参与人数　此数值随下面设置自动变化</span>
				</div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label"> 虚拟人数设置</label>
            <div class="col-sm-9 col-xs-12">
               	<div class="input-group">
					<span class="input-group-addon">每次间隔</span>
                    <input type="text" class="form-control" name="xuninumtime" id="xuninumtime" value="<?php  echo $reply['xuninumtime'];?>" />
                    <span class="input-group-addon" style="border-left:0px;border-right:0px;">秒　系统自动增加</span>
					<input type="text" class="form-control" name="xuninuminitial" id="xuninuminitial" value="<?php  echo $reply['xuninuminitial'];?>" />
					<span class="input-group-addon" style="border-left:0px;border-right:0px;">至</span>
					<input type="text" class="form-control" name="xuninumending" id="xuninumending" value="<?php  echo $reply['xuninumending'];?>" />
					<span class="input-group-addon">名虚拟人参与本活动</span>
				</div>
            </div>
        </div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">活动页背景音乐</label>
			<div class="col-sm-9 col-xs-12">
				<?php  echo tpl_form_field_audio('musicurl', $reply['musicurl'], $options = array());?>
				<label class="checkbox-inline"><input type="checkbox" name="music" value="1" <?php  if($reply['music'] == 1) { ?> checked<?php  } ?>> 开启音乐</label>
				<label class="checkbox-inline"><input type="checkbox" name="mauto" value="1" <?php  if($reply['mauto'] == 1) { ?> checked<?php  } ?>> 自动播放</label>
				<label class="checkbox-inline"><input type="checkbox" name="mloop" value="1" <?php  if($reply['mloop'] == 1) { ?> checked<?php  } ?>> 自动循环</label>
				<div class="help-block">选择上传的音频文件或直接输入URL地址，常用格式：mp3</div>
			</div>	
		</div>
		<div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label">顶部广告图</label>
            <div class="col-sm-9 col-xs-12">
               	<?php  echo tpl_form_field_image('adpic',$reply['adpic']);?>
            </div>
        </div>
		<div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label"> 广告图链接</label>
            <div class="col-sm-9 col-xs-12">
				<?php  echo tpl_form_field_link('adpicurl',$reply['adpicurl']);?>
				<div class="help-block">广告图链接必需填写完整的URL地址如：http://www.baidu.com</div>
            </div>
        </div>
    </div>
</div>

<div class="panel panel-default" id="nav_rf">
	<div class="panel-heading">
		奖品信息
	</div>
	<div class="panel-body">
		<?php  if($reply['id']=='') { ?>
		<div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label">转盘样式</label>
			<div class="col-sm-9 col-xs-12">
			    <label class="radio-inline">
                	<input type="radio" name="turntable" value="0" <?php  if($reply['turntable'] == 0) { ?> checked="checked"<?php  } ?> onclick="$('#turntable1').hide();$('#turntable0').show();$('#prizeid6').hide();$('#prizeid7').hide();$('#prizeid8').hide();$('#prizeid9').hide();$('#prizeid10').hide();$('#prizeid11').hide();"/>大转盘样式
                </label>
                <label class="radio-inline">
                	<input type="radio" name="turntable" value="1" <?php  if($reply['turntable'] == 1) { ?> checked="checked"<?php  } ?> onclick="$('#turntable0').hide();$('#turntable1').show();"/>九宫格样式
                </label>
				<div class="help-block" style='color:red'>不可修改，请谨慎选择类型</div>
			</div>			
        </div>
		<?php  } else { ?>
		<input type="hidden" name="turntable" value="<?php  echo $reply['turntable'];?>" />
		<?php  } ?>
		<div id="turntable0"<?php  if($reply['turntable'] == 0) { ?> style="display:block"<?php  } else { ?> style="display:none"<?php  } ?>>
		<div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
			<div class="col-sm-9 col-xs-12">
			    <div class="input-group " style="margin-top:.5em;">
				    <img src="../addons/stonefish_bigwheel/template/images/turntable0.jpg" class="img-responsive img-thumbnail" width="250"/>
				</div>				
			</div>
        </div>
		<div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label">指针图</label>
            <div class="col-sm-9 col-xs-12">
               	<?php  echo tpl_form_field_image('bigwheelimg',$reply['bigwheelimg']);?>
				<div class="help-block">大转盘样式抽奖默认指针图片 图片大小114px X 90px</div>
            </div>			
        </div>		
		<div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label">转盘图</label>
            <div class="col-sm-9 col-xs-12" id="bigwheelpic">
               	<?php  echo tpl_form_field_image('bigwheelpic',$reply['bigwheelpic']);?>
				<div class="help-block"><a href="../addons/stonefish_bigwheel/template/images/activity-lottery.psd" target="_black">下载原图参考设置</a> 图片大小500px X 500px <br/>请根据<font color="red">转盘奖项数量</font>设置上面默认图activity-lottery-<font color="red">奖项数量</font>.png<br/>转盘图默认图一：activity-lottery-<font color="red">奖项数量</font>.png  转盘图默认图二：activity-lottery-i<font color="red">奖项数量</font>.png</div>
            </div>
        </div>		
		<div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label">转盘奖项</label>
            <div class="col-sm-9 col-xs-12">
				<?php  if($reply['id']=='') { ?>
				<?php  if(is_array($jiangxiang)) { foreach($jiangxiang as $jiangxiangs) { ?>
				<label class="radio-inline" style="width:100px;">
					<input type="radio" name="turntablenum" value="<?php  echo $jiangxiangs['turntablenum'];?>" <?php  if($reply['turntablenum'] == $jiangxiangs['turntablenum']) { ?> checked="checked"<?php  } ?> onclick="$('#prizeDeg').val('<?php  echo $jiangxiangs['prizeDeg'];?>');$('#lostDeg').val('<?php  echo $jiangxiangs['lostDeg'];?>');<?php  echo $jiangxiangs['prizeid'];?>"/><?php  echo $jiangxiangs['turntablenum'];?>个奖品
				</label>
				<?php  } } ?>
				<div class="help-block">根据选择的奖项设置奖品 10个12个奖品默认为全部中奖 <span style='color:red'>不可修改，请谨慎选择</span></div>
				<?php  } else { ?>
				<label class="radio-inline" style="width:100px;"><span style='color:red'><?php  echo $reply['turntablenum'];?>个奖品</span></label><input type="hidden" name="turntablenum" value="<?php  echo $reply['turntablenum'];?>" />
				<?php  } ?>				
            </div>
        </div>
		<div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span> 中奖角度设置</label>
            <div class="col-sm-9 col-xs-12">
               	<input type="text" id="prizeDeg" class="form-control" placeholder="" name="prizeDeg" value="<?php  echo $reply['prizeDeg'];?>">
            </div>
        </div>		
		<div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span> 未中奖角度设置</label>
            <div class="col-sm-9 col-xs-12">
               	<input type="text" id="lostDeg" class="form-control" placeholder="" name="lostDeg" value="<?php  echo $reply['lostDeg'];?>">
            </div>
        </div>
		</div>
		<div id="turntable1"<?php  if($reply['turntable'] == 1) { ?> style="display:block"<?php  } else { ?> style="display:none"<?php  } ?>>
		<div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
			<div class="col-sm-9 col-xs-12">
			    <div class="input-group " style="margin-top:.5em;">
				    <img src="../addons/stonefish_bigwheel/template/images/turntable1.jpg" class="img-responsive img-thumbnail" width="250"/>
				</div>				
			</div>
        </div>
		<div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label">转动背景</label>
            <div class="col-sm-9 col-xs-12">
               	<?php  echo tpl_form_field_image('bigwheelimgbg',$reply['bigwheelimgbg']);?>
				<div class="help-block">九宫格样式抽奖默认转动背景图片 图片大小73px X 73px</div>
            </div>			
        </div>
		<div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label">抽奖按钮</label>
            <div class="col-sm-9 col-xs-12">
               	<?php  echo tpl_form_field_image('bigwheelimgan',$reply['bigwheelimgan']);?>
				<div class="help-block">九宫格样式抽奖默认按钮图片 图片大小132px X 132px</div>
            </div>			
        </div>		
		</div>
		<hr/>
		<div class="form-group">
            <div class="col-sm-12 col-xs-12">               	
				    <!-- Nav tabs -->
            	    <ul class="nav nav-tabs" role="tablist">
               	        <?php  if(is_array($prize)) { foreach($prize as $id => $prizes) { ?>
						<li role="presentation"<?php  if($id==0) { ?> class="active"<?php  } ?> id="prizeid<?php  echo $id;?>"<?php  if($reply['turntable']==0 && $id>=$reply['turntablenum']) { ?> style="display: none;"<?php  } ?>>
                  	        <a href="#prize<?php  echo $id;?>" role="tab" data-toggle="tab">奖品<?php  echo $id+1?></a>
                	    </li>
					    <?php  } } ?>
            	    </ul>
					<!-- Tab panes -->
            		<div class="tab-content">
					    <?php  if(is_array($prize)) { foreach($prize as $id => $prizes) { ?>
						<input type="hidden" name="prize_id_<?php  echo $id;?>" value="<?php  echo $prizes['id'];?>" />
                		<div role="tabpanel" class="tab-pane<?php  if($id==0) { ?> active<?php  } ?>" id="prize<?php  echo $id;?>">
                		<h5>奖品<?php  echo $id+1?>参数设置<?php  if($reply['turntable'] == 1) { ?>  <span style="color:red;" id="spaceprizetip">空奖即使粉丝中奖也不会记录，可以设置为谢谢参与等用于没有过多奖品的设置</span><?php  } ?></h5>
                		<div class="form-group">
                    		<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span> 奖品类型</label>
                    		<div class="col-sm-9">
					    		<label class="radio-inline">
						    		<input type="radio" name="prizetype[<?php  echo $id;?>]" value="physical"<?php  if($prizes['prizetype']=='physical') { ?> checked="checked"<?php  } ?> onclick="$('#p_name_<?php  echo $id;?>').html('真实物品');"/>真实物品
					    		</label>
					    		<label class="radio-inline">
						    		<input type="radio" name="prizetype[<?php  echo $id;?>]" value="virtual"<?php  if($prizes['prizetype']=='virtual') { ?> checked="checked"<?php  } ?> onclick="$('#p_name_<?php  echo $id;?>').html('虚拟物品');"/>虚拟物品
					    		</label>
					    		<?php  if(is_array($creditnames)) { foreach($creditnames as $key => $credit) { ?>
					    		<label class="radio-inline">
						    		<input type="radio" name="prizetype[<?php  echo $id;?>]" value="<?php  echo $key;?>"<?php  if($prizes['prizetype']==$key) { ?> checked="checked"<?php  } ?> onclick="$('#p_name_<?php  echo $id;?>').html('<?php  echo $credit;?>');"/>会员（<?php  echo $credit;?>）
					    		</label>
					    		<?php  if($prizes['prizetype']==$key) { ?><?php  $credit_name = $credit;?><?php  } ?>
					    		<?php  } } ?>
					    		<label class="radio-inline">
						    		<input type="radio" name="prizetype[<?php  echo $id;?>]" value="spaceprize"<?php  if($prizes['prizetype']=='spaceprize') { ?> checked="checked"<?php  } ?> onclick="$('#p_name_<?php  echo $id;?>').html('空奖');"/>空奖
					    		</label>
								<label class="radio-inline">
						    		<input type="radio" name="prizetype[<?php  echo $id;?>]" value="againprize"<?php  if($prizes['prizetype']=='againprize') { ?> checked="checked"<?php  } ?> onclick="$('#p_name_<?php  echo $id;?>').html('再来一次');"/>再来一次
					    		</label>
					    		<div class="help-block">奖品类型为会员（积分）、会员（余额）等会员积分类型时，价值为增送的积分或余额等积分/余额值 <span style='color:red'>空奖、再来一次不保存记录</span></div>
				    		</div>
               		    </div>					
			    		<div class="form-group">
                    		<label class="col-xs-12 col-sm-2 col-md-2 control-label"><span style='color:red'>*</span> <span id="p_name_<?php  echo $id;?>"><?php  if($prizes['prizetype']=='physical') { ?>真实物品<?php  } ?><?php  if($prizes['prizetype']=='virtual') { ?>虚拟物品<?php  } ?><?php  if($prizes['prizetype']=='spaceprize') { ?>空奖<?php  } ?><?php  if($prizes['prizetype']=='againprize') { ?>再来一次<?php  } ?><?php  echo $credit_name;?></span>价值</label>
                    		<div class="col-sm-4">
                        		<input class="form-control" type="text" value="<?php  echo $prizes['prizevalue'];?>" name="prizevalue[<?php  echo $id;?>]" placeholder="请填写奖品价值或积分等值">
                    		</div>
							<!--
				    		<label class="col-xs-12 col-sm-2 col-md-2 control-label">助力人次</label>
                    		<div class="col-sm-3">
                        		<div class="input-group">
                            		<input class="form-control" type="text" value="<?php  echo $prizes['break'];?>" name="break[<?php  echo $id;?>]">
                            		<span class="input-group-addon">人次</span>
                        		</div>
                    		</div>
							-->
                		</div>			
			    		<div class="form-group">
                    		<label class="col-xs-12 col-sm-2 col-md-2 control-label"><span style='color:red'>*</span> 奖品等级</label>
                    		<div class="col-sm-4">
                       		    <input class="form-control" type="text" value="<?php  echo $prizes['prizerating'];?>" name="prizerating[<?php  echo $id;?>]">
                    		</div>
				    		<label class="col-xs-12 col-sm-2 col-md-2 control-label"><span style='color:red'>*</span> 奖品数量</label>
                    		<div class="col-sm-3">
                        		<div class="input-group">
                            		<input class="form-control" type="text" value="<?php  echo $prizes['prizetotal'];?>" name="prizetotal[<?php  echo $id;?>]">
                            		<span class="input-group-addon">份</span>
                        		</div>
                    		</div>							
                		</div>						
                		<div class="form-group">
                    		<label class="col-xs-12 col-sm-2 col-md-2 control-label"><span style='color:red'>*</span> 奖品名称</label>
                    		<div class="col-sm-4">
                        		<input class="form-control" type="text" value="<?php  echo $prizes['prizename'];?>" name="prizename[<?php  echo $id;?>]" placeholder="请填写奖品名称">
                    		</div>
				    		<label class="col-xs-12 col-sm-2 col-md-2 control-label"><span style='color:red'>*</span> 中奖概率</label>
                    		<div class="col-sm-3">
                        		<div class="input-group">
                            		<input class="form-control" type="text" value="<?php  echo $prizes['probalilty'];?>" name="probalilty[<?php  echo $id;?>]">
                            		<span class="input-group-addon">%</span>
                        		</div>
                    		</div>
                		</div>
			    		<div class="form-group">
                    		<label class="col-xs-12 col-sm-2 col-md-2 control-label">每人中奖</label>
                    		<div class="col-sm-4">
                        		<div class="input-group">
                            		<span class="input-group-addon">每人最多</span>
						    		<input class="form-control" type="text" value="<?php  echo $prizes['prizeren'];?>" name="prizeren[<?php  echo $id;?>]">
                            		<span class="input-group-addon">个 0为不限制</span>
                        		</div>
                    		</div>
				    		<label class="col-xs-12 col-sm-2 col-md-2 control-label">每天发奖</label>
                    		<div class="col-sm-3">
                        		<div class="input-group">
                            		<span class="input-group-addon">每天最多</span>
						    		<input class="form-control" type="text" value="<?php  echo $prizes['prizeday'];?>" name="prizeday[<?php  echo $id;?>]">
                            		<span class="input-group-addon">个 0为不限制</span>
                        		</div>
                    		</div>
                		</div>
                		<div class="form-group">
                    		<label class="col-xs-12 col-sm-3 col-md-2 control-label">奖品图片</label>
                    		<div class="col-sm-9">
				        		<?php  echo tpl_form_field_image('prizepic['.$id.']',$prizes['prizepic']);?>
					    		<div class="help-block">奖品显示图片 图片大小418px X 418px</div>
				    		</div>
                		</div>
                		</div>
						<?php  } } ?>
					</div>
			</div>
        </div>		
	</div>
</div>

<div class="panel panel-default" id="nav_rg">
    <div class="panel-heading">
        兑奖配置
    </div>
    <div class="panel-body">
		<div class="form-group" id="award_times">
 			<label class="col-xs-12 col-sm-3 col-md-2 control-label">参与消息模板</label>
            <div class="col-sm-9 col-xs-6">
               	<select name="tmplmsg_participate" class="form-control">
					<option value="" <?php  if($exchange['tmplmsg_participate']=='') { ?>selected<?php  } ?>><?php  if(empty($tmplmsg)) { ?>暂时没有参与消息模板<?php  } else { ?>选择参与消息模板<?php  } ?></option>
					<?php  if(is_array($tmplmsg)) { foreach($tmplmsg as $tmplmsgs) { ?>
					<option value="<?php  echo $tmplmsgs['id'];?>" <?php  if($tmplmsgs['id'] == $exchange['tmplmsg_participate']) { ?>selected<?php  } ?>><?php  echo $tmplmsgs['template_name'];?></option>
					<?php  } } ?>
				</select>
            </div>
        </div>
		<div class="form-group" id="award_times">
 			<label class="col-xs-12 col-sm-3 col-md-2 control-label">中奖消息模板</label>
            <div class="col-sm-9 col-xs-6">
               	<select name="tmplmsg_winning" class="form-control">
					<option value="" <?php  if($exchange['tmplmsg_winning']=='') { ?>selected<?php  } ?>><?php  if(empty($tmplmsg)) { ?>暂时没有中奖消息模板<?php  } else { ?>选择中奖消息模板<?php  } ?></option>
					<?php  if(is_array($tmplmsg)) { foreach($tmplmsg as $tmplmsgs) { ?>
					<option value="<?php  echo $tmplmsgs['id'];?>" <?php  if($tmplmsgs['id'] == $exchange['tmplmsg_winning']) { ?>selected<?php  } ?>><?php  echo $tmplmsgs['template_name'];?></option>
					<?php  } } ?>
				</select>
            </div>
        </div>
		<div class="form-group" id="award_times">
 			<label class="col-xs-12 col-sm-3 col-md-2 control-label">兑奖消息模板</label>
            <div class="col-sm-9 col-xs-6">
               	<select name="tmplmsg_exchange" class="form-control">
					<option value="" <?php  if($exchange['tmplmsg_exchange']=='') { ?>selected<?php  } ?>><?php  if(empty($tmplmsg)) { ?>暂时没有兑奖消息模板<?php  } else { ?>选择兑奖消息模板<?php  } ?></option>
					<?php  if(is_array($tmplmsg)) { foreach($tmplmsg as $tmplmsgs) { ?>
					<option value="<?php  echo $tmplmsgs['id'];?>" <?php  if($tmplmsgs['id'] == $exchange['tmplmsg_exchange']) { ?>selected<?php  } ?>><?php  echo $tmplmsgs['template_name'];?></option>
					<?php  } } ?>
				</select>
            </div>
        </div>
		<div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span> 兑奖时间</label>
            <div class="col-sm-9 col-xs-12">
               	<?php  echo tpl_form_field_daterange('awardingdatelimit', array('start'=>date('Y-m-d H:i',$exchange['awardingstarttime']),'end'=>date('Y-m-d H:i',$exchange['awardingendtime'])), true)?>
            </div>
        </div>
		<div class="form-group">
 			<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span> 兑奖方式</label>
            <div class="col-sm-9 col-xs-6">
               	<div class="input-group">
					<label for="tickettype1" class="radio-inline"><input type="radio" name="tickettype" value="1" id="tickettype1" <?php  if($exchange['tickettype'] == 1) { ?>checked="true"<?php  } ?> onclick="$('#address').show();$('#awardingpas').hide();$('#beihuo').hide();$('#beihuo_tips').hide();"/> 后台兑奖</label>&nbsp;&nbsp;&nbsp;
					<label for="tickettype2" class="radio-inline"><input type="radio" name="tickettype" value="2" id="tickettype2" <?php  if($exchange['tickettype'] == 2) { ?>checked="true"<?php  } ?> onclick="$('#address').show();$('#awardingpas').hide();$('#beihuo').show();<?php  if($exchange['beihuo']==1) { ?>$('#beihuo_tips').show();<?php  } ?>"/> 店员兑奖</label><?php  if($stonefish_branch) { ?>&nbsp;&nbsp;&nbsp;
					<label for="tickettype3" class="radio-inline"><input type="radio" name="tickettype" value="3" id="tickettype3" <?php  if($exchange['tickettype'] == 3) { ?>checked="true"<?php  } ?> onclick="$('#address').hide();$('#awardingpas').hide();$('#beihuo').show();<?php  if($exchange['beihuo']==1) { ?>$('#beihuo_tips').show();<?php  } ?>"/> 商家网点兑奖</label><?php  } ?>&nbsp;&nbsp;&nbsp;
					<label for="tickettype4" class="radio-inline"><input type="radio" name="tickettype" value="4" id="tickettype4" <?php  if($exchange['tickettype'] == 4) { ?>checked="true"<?php  } ?> onclick="$('#address').show();$('#awardingpas').show();$('#beihuo').hide();$('#beihuo_tips').hide();"/> 密码兑奖</label>
				</div>				
            </div>
        </div>
		<div class="form-group" id="beihuo"<?php  if($exchange['tickettype'] == 1 || $exchange['tickettype'] == 4) { ?> style="display:none"<?php  } ?>>
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">备货选项</label>
			<div class="col-sm-9 col-xs-12">
				<div class="input-group">
					<label for="beihuo0" class="radio-inline"><input type="radio" name="beihuo" value="0" id="beihuo0" <?php  if($exchange['beihuo'] == 0) { ?>checked="true"<?php  } ?> onclick="$('#beihuo_tips').hide();"/> 关闭备货</label>&nbsp;&nbsp;&nbsp;
					<label for="beihuo1" class="radio-inline"><input type="radio" name="beihuo" value="1" id="beihuo1" <?php  if($exchange['beihuo'] == 1) { ?>checked="true"<?php  } ?> onclick="$('#beihuo_tips').show();"/> 开启备货</label>
				</div>
				<span class="help-block">开启备货，粉丝中奖后可选择兑奖地点，后台查看数据备货 <span style="color:red">注：兑奖开始时间前才启作用</span></span>
			</div>
		</div>
		<div class="form-group" id="beihuo_tips"<?php  if($exchange['beihuo']==0) { ?> style="display:none"<?php  } ?>>
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">备货按钮</label>
			<div class="col-sm-9 col-xs-12">
				<div class="input-group">
					<span class="input-group-addon">备货自定义提示词</span>
					<input type="text" name="beihuo_tips" class="form-control" value="<?php  echo $exchange['beihuo_tips'];?>" />
					<span class="input-group-addon">不超过20个汉字</span>
				</div>
			</div>
		</div>
		<div class="form-group" id="awardingpas"<?php  if($exchange['tickettype'] < 4) { ?> style="display:none"<?php  } ?>>
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">兑奖密码</label>
			<div class="col-sm-9 col-xs-12">
				<div class="input-group">
					<span class="input-group-addon">兑奖人密码</span>
					<input type="text" name="awardingpas" class="form-control" value="<?php  echo $exchange['awardingpas'];?>" />
					<span class="input-group-addon">6-10位数字字母</span>
				</div>
			</div>
		</div>
		<div id="address">
		<div class="form-group">
 			<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span> 兑奖地点</label>
            <div class="col-sm-9 col-xs-6">
				<input type="text" name="awardingaddress" class="form-control" value="<?php  echo $exchange['awardingaddress'];?>" />			
            </div>
        </div>
		<div class="form-group">
 			<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span> 兑奖联系电话</label>
            <div class="col-sm-9 col-xs-6">
				<input type="text" name="awardingtel" class="form-control" value="<?php  echo $exchange['awardingtel'];?>" />				
            </div>
        </div>
		<div class="form-group">
 			<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span> 兑奖导航</label>
            <div class="col-sm-9 col-xs-6">
				<?php  echo tpl_form_field_coordinate('baidumap', array('lng'=>$exchange['baidumaplng'],'lat'=>$exchange['baidumaplat']))?>
            </div>
        </div>
		</div>
		<div class="form-group">
 			<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span> 兑奖类型</label>
            <div class="col-sm-9 col-xs-6">
               	<div class="input-group">
					<label for="awardingtype1" class="radio-inline"><input type="radio" name="awardingtype" value="1" id="awardingtype1" <?php  if($exchange['awardingtype'] == 1) { ?>checked="true"<?php  } ?>/> 单独兑奖(每个奖品可单独兑奖)</label>&nbsp;&nbsp;&nbsp;
					<label for="awardingtype2" class="radio-inline"><input type="radio" name="awardingtype" value="2" id="awardingtype2" <?php  if($exchange['awardingtype'] == 2) { ?>checked="true"<?php  } ?>/> 统一兑奖(所有奖品统一兑奖)</label>
				</div>				
            </div>
        </div>
		<div class="form-group">
 			<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span> 库存类型</label>
            <div class="col-sm-9 col-xs-6">
               	<div class="input-group">
					<label for="inventory1" class="radio-inline"><input type="radio" name="inventory" value="1" id="inventory1" <?php  if($exchange['inventory'] == 1) { ?>checked="true"<?php  } ?>/> 抽中立即减少库存</label>&nbsp;&nbsp;&nbsp;
					<label for="inventory2" class="radio-inline"><input type="radio" name="inventory" value="2" id="inventory2" <?php  if($exchange['inventory'] == 2) { ?>checked="true"<?php  } ?>/> 兑奖后才减少库存</label>
				</div>
            </div>
        </div>
		<div class="form-group">
 			<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span> 输入项类型</label>
            <div class="col-sm-9 col-xs-6">
               	<div class="input-group">
					<label for="before1" class="radio-inline"><input type="radio" name="before" value="1" id="before1" <?php  if($exchange['before'] == 1) { ?>checked="true"<?php  } ?>/> 参与前提示输入</label>&nbsp;&nbsp;&nbsp;
					<label for="before2" class="radio-inline"><input type="radio" name="before" value="2" id="before2" <?php  if($exchange['before'] == 2) { ?>checked="true"<?php  } ?>/> 中奖后提示输入</label>
				</div>
            </div>
        </div>
		<div class="form-group">
 			<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span> 兑奖输入项提示词</label>
            <div class="col-sm-9 col-xs-6">
				<input type="text" class="form-control" name="awarding_tips" value="<?php  echo $exchange['awarding_tips'];?>" />
            </div>
        </div>
		<div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span> 兑奖输入参数项</label>
            <div class="col-sm-9 col-xs-12">
				<div style="border:1px #eee dashed; padding:10px;background:#F5F5F5;">					
               	    <label for="isrealname" class="checkbox-inline"><input id="isrealname" type="checkbox" name="isrealname" value="1" <?php  if($exchange['isrealname'] == 1) { ?>checked="checked"<?php  } ?>> 姓名</label>
				    <label for="ismobile" class="checkbox-inline"><input id="ismobile" type="checkbox" name="ismobile" value="1" <?php  if($exchange['ismobile'] == 1) { ?>checked="checked"<?php  } ?>> 手机</label>
				    <label for="isqq" class="checkbox-inline"><input id="isqq" type="checkbox" name="isqq" value="1" <?php  if($exchange['isqq'] == 1) { ?>checked="checked"<?php  } ?>> QQ号</label>
				    <label for="isemail" class="checkbox-inline"><input id="isemail" type="checkbox" name="isemail" value="1" <?php  if($exchange['isemail'] == 1) { ?>checked="checked"<?php  } ?>> 邮箱</label>
				    <label for="isaddress" class="checkbox-inline"><input id="isaddress" type="checkbox" name="isaddress" value="1" <?php  if($exchange['isaddress'] == 1) { ?>checked="checked"<?php  } ?>> 地址</label>
					<label for="isgender" class="checkbox-inline"><input id="isgender" type="checkbox" name="isgender" value="1" <?php  if($exchange['isgender'] == 1) { ?>checked="checked"<?php  } ?>> 性别</label>
					<label for="istelephone" class="checkbox-inline"><input id="istelephone" type="checkbox" name="istelephone" value="1" <?php  if($exchange['istelephone'] == 1) { ?>checked="checked"<?php  } ?>> 固话</label>
					<label for="isidcard" class="checkbox-inline"><input id="isidcard" type="checkbox" name="isidcard" value="1" <?php  if($exchange['isidcard'] == 1) { ?>checked="checked"<?php  } ?>> 证件</label>
					<label for="iscompany" class="checkbox-inline"><input id="iscompany" type="checkbox" name="iscompany" value="1" <?php  if($exchange['iscompany'] == 1) { ?>checked="checked"<?php  } ?>> 公司</label>
					<label for="isoccupation" class="checkbox-inline"><input id="isoccupation" type="checkbox" name="isoccupation" value="1" <?php  if($exchange['isoccupation'] == 1) { ?>checked="checked"<?php  } ?>> 职业</label>
					<label for="isposition" class="checkbox-inline"><input id="isposition" type="checkbox" name="isposition" value="1" <?php  if($exchange['isposition'] == 1) { ?>checked="checked"<?php  } ?>> 职位</label>
					</div>
					<div class="help-block">必需选择一个参数兑奖 活动开启后最好不要修改 请谨慎选择 重命显示请修改下面的参数</div>
            </div>
        </div>
		<div class="form-group">
 			<label class="col-xs-12 col-sm-3 col-md-2 control-label">兑奖输入参数重命名</label>
            <div class="col-sm-9 col-xs-6">
				<input type="text" class="form-control" name="isfansname" value="<?php  echo $exchange['isfansname'];?>" />
				<div class="help-block">与上面的参数一一对应，请直接修改不要改变','这个字符</div>
            </div>
        </div>
		<div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label"> 兑奖输入参数同步</label>
            <div class="col-sm-9 col-xs-12">
				<label for="isfans_0" class="radio-inline"><input id="isfans_0" type="radio" name="isfans" value="0" <?php  if($exchange['isfans'] == 0) { ?>checked="checked"<?php  } ?>> 参数项只保留本模块下</label>
				<label for="isfans_1" class="radio-inline"><input id="isfans_1" type="radio" name="isfans" value="1"  <?php  if($exchange['isfans'] == 1) { ?>checked="checked"<?php  } ?>> 参数项同步更新至官方会员信息表中</label>
            </div>
        </div>
    </div>
</div>

<div class="panel panel-default" id="nav_rh">
    <div class="panel-heading">
        <?php  if($ids_num>1) { ?>多子公众号分享设置<?php  } else { ?>分享设置<?php  } ?>
    </div>
    <div class="panel-body table-responsive">
		<?php  if($ids_num>1) { ?>
		<!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <?php  if(is_array($ids)) { foreach($ids as $idsname) { ?>
			<li role="presentation"<?php  if($idsname==$one) { ?> class="active"<?php  } ?>>
                <a href="#acid<?php  echo $idsname;?>" role="tab" data-toggle="tab"><?php  echo $acid_arr[$idsname]['name'];?></a>
            </li>
			<?php  } } ?>
        </ul>
		<!-- Tab panes -->
		<?php  } ?>
        <div class="tab-content">
			<?php  if(is_array($share)) { foreach($share as $shares) { ?>
			<input type="hidden" name="acid_<?php  echo $shares['acid'];?>" value="<?php  echo $shares['id'];?>"/>
            <div role="tabpanel" class="tab-pane<?php  if($shares['acid']==$one) { ?> active<?php  } ?>" id="acid<?php  echo $shares['acid'];?>">
		    <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span> 参与活动关注引导页</label>
                <div class="col-sm-9 col-xs-12">
               	    <input type="text" id="share_url_<?php  echo $shares['acid'];?>" class="form-control" name="share_url_<?php  echo $shares['acid'];?>" value="<?php  echo $shares['share_url'];?>">
                    <div class="help-block">关注引导页的链接! 推荐用微信平台的素材库，转成短地址。<a target="_blank" href="http://www.dwz.cn/">短网址转换</a></div>
                </div>
            </div>
			<div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">助力关注引导页</label>
                <div class="col-sm-9 col-xs-12">
               	    <input type="text" id="help_url_<?php  echo $shares['acid'];?>" class="form-control" name="help_url_<?php  echo $shares['acid'];?>" value="<?php  echo $shares['help_url'];?>">
                    <div class="help-block">关注引导页的链接! 推荐用微信平台的素材库，转成短地址。<a target="_blank" href="http://www.dwz.cn/">短网址转换</a></div>
                </div>
            </div>		    
			<div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">参与规则</label>
                <div class="col-sm-9 col-xs-12">
     	            <textarea style="height:200px;" id="share_txt_<?php  echo $shares['acid'];?>" name="share_txt_<?php  echo $shares['acid'];?>" class="form-control richtext_<?php  echo $shares['acid'];?>" cols="60"><?php  echo $shares['share_txt'];?></textarea>
                </div>
            </div>
			<div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">分享权限</label>
                <div class="col-sm-9 col-xs-12">
                   <div class="input-group">
					   <label for="share_open_close0_<?php  echo $shares['acid'];?>" class="radio-inline"><input type="radio" name="share_open_close_<?php  echo $shares['acid'];?>" value="0" id="share_open_close0_<?php  echo $shares['acid'];?>" <?php  if($shares['share_open_close'] == 0) { ?>checked="true"<?php  } ?> onclick="$('#share_open_close_<?php  echo $shares['acid'];?>').hide();"/> 关闭分享</label>&nbsp;&nbsp;&nbsp;
					   <label for="share_open_close1_<?php  echo $shares['acid'];?>" class="radio-inline"><input type="radio" name="share_open_close_<?php  echo $shares['acid'];?>" value="1" id="share_open_close1_<?php  echo $shares['acid'];?>" <?php  if($shares['share_open_close'] == 1) { ?>checked="true"<?php  } ?> onclick="$('#share_open_close_<?php  echo $shares['acid'];?>').show();"/> 开启分享</label>
				    </div>
                </div>
            </div>
			<div id="share_open_close_<?php  echo $shares['acid'];?>"<?php  if($shares['share_open_close'] == 0) { ?> style="display: none;"<?php  } ?>>
			<div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span> 分享标题</label>
                <div class="col-sm-9 col-xs-12">
               	    <input type="text" id="share_title_<?php  echo $shares['acid'];?>" class="form-control" name="share_title_<?php  echo $shares['acid'];?>" value="<?php  echo $shares['share_title'];?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span> 分享描述</label>
                <div class="col-sm-9 col-xs-12">
     	            <textarea style="height:60px;" id="share_desc_<?php  echo $shares['acid'];?>" name="share_desc_<?php  echo $shares['acid'];?>" class="form-control" cols="60"><?php  echo $shares['share_desc'];?></textarea>
				    <span class="help-block">分享标题以及分享描述可用变量<br/><span style='color:red'>#参与人数# </span>所有参与活动的总数 + 虚拟人数<br/><span style='color:red'>#粉丝昵称# </span>粉丝昵称<br/><span style='color:red'>#真实姓名# </span>粉丝真实姓名<br/><span style='color:red'>#奖品名称# </span>分享人所中的最大奖品名称，没有中奖则不显示</span>
                </div>
            </div>
			<div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">分享按钮</label>
                <div class="col-sm-9 col-xs-12">
               	    <?php  echo tpl_form_field_image('share_anniu_'.$shares['acid'],$shares['share_anniu']);?>
					<div class="help-block">输入文字则显示文字按钮 图片大小建议250 * 35</div>
                </div>
            </div>
			<div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">助力亲友团按钮</label>
                <div class="col-sm-9 col-xs-12">
               	    <?php  echo tpl_form_field_image('share_firend_'.$shares['acid'],$shares['share_firend']);?>
					<div class="help-block">输入文字则显示文字按钮 图片大小建议250 * 35</div>
                </div>
            </div>
			<div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">分享朋友或朋友圈图</label>
                <div class="col-sm-9 col-xs-12">
               	    <?php  echo tpl_form_field_image('share_img_'.$shares['acid'],$shares['share_img']);?>
					<div class="help-block">留空则显示活动图片 图片大小建议150 * 150</div>
                </div>
            </div>
		    <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">分享弹出提示图</label>
                <div class="col-sm-9 col-xs-12">
                   	<?php  echo tpl_form_field_image('share_pic_'.$shares['acid'],$shares['share_pic']);?>
                </div>
            </div>
			<div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">分享赠送方式</label>
                <div class="col-sm-9 col-xs-12">
                   <div class="input-group">
					   <label for="sharetimes1_<?php  echo $shares['acid'];?>" class="radio-inline"><input type="radio" name="sharetimes_<?php  echo $shares['acid'];?>" value="1" id="sharetimes1_<?php  echo $shares['acid'];?>" <?php  if($shares['sharetimes'] == 1) { ?>checked="true"<?php  } ?>/> 赠送于每天数</label>&nbsp;&nbsp;&nbsp;
					   <label for="sharetimes2_<?php  echo $shares['acid'];?>" class="radio-inline"><input type="radio" name="sharetimes_<?php  echo $shares['acid'];?>" value="2" id="sharetimes2_<?php  echo $shares['acid'];?>" <?php  if($shares['sharetimes'] == 2) { ?>checked="true"<?php  } ?>/> 赠送于总次数</label>
				    </div>				    
                </div>
            </div>
			<div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">分享赠送类型</label>
                <div class="col-sm-9 col-xs-12">
                   <div class="input-group">
					   <label for="sharetype0_<?php  echo $shares['acid'];?>" class="radio-inline"><input type="radio" name="sharetype_<?php  echo $shares['acid'];?>" value="0" id="sharetype0_<?php  echo $shares['acid'];?>" <?php  if($shares['sharetype'] == 0) { ?>checked="true"<?php  } ?> onclick="$('#share_<?php  echo $shares['acid'];?>_name').hide();"/> 分享立即赠送</label>&nbsp;&nbsp;&nbsp;
					   <label for="sharetype1_<?php  echo $shares['acid'];?>" class="radio-inline"><input type="radio" name="sharetype_<?php  echo $shares['acid'];?>" value="1" id="sharetype1_<?php  echo $shares['acid'];?>" <?php  if($shares['sharetype'] == 1) { ?>checked="true"<?php  } ?> onclick="$('#share_<?php  echo $shares['acid'];?>_name').show();"/> 分享成功赠送（需要打开分享的链接）</label>
				    </div>				    
                </div>
            </div>
		    <div class="form-group" id="share_<?php  echo $shares['acid'];?>_name"<?php  if($shares['sharetype'] == 0) { ?>style="display: none;"<?php  } ?>>
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">分享赠送次数</label>
                <div class="col-sm-9 col-xs-12">
                   <div class="input-group">
					   <label for="sharenumtype0_<?php  echo $shares['acid'];?>" class="radio-inline"><input type="radio" name="sharenumtype_<?php  echo $shares['acid'];?>" value="0" id="sharenumtype0_<?php  echo $shares['acid'];?>" <?php  if(empty($shares) || $shares['sharenumtype'] == 0) { ?>checked="true"<?php  } ?> /> 单独赠送机会</label>&nbsp;&nbsp;&nbsp;
					   <label for="sharenumtype1_<?php  echo $shares['acid'];?>" class="radio-inline"><input type="radio" name="sharenumtype_<?php  echo $shares['acid'];?>" value="1" id="sharenumtype1_<?php  echo $shares['acid'];?>" <?php  if(!empty($shares) && $shares['sharenumtype'] == 1) { ?>checked="true"<?php  } ?> /> 每人赠送机会</label>&nbsp;&nbsp;&nbsp;
					   <label for="sharenumtype2_<?php  echo $shares['acid'];?>" class="radio-inline"><input type="radio" name="sharenumtype_<?php  echo $shares['acid'];?>" value="2" id="sharenumtype2_<?php  echo $shares['acid'];?>" <?php  if(!empty($shares) && $shares['sharenumtype'] == 2) { ?>checked="true"<?php  } ?> /> 分享共计赠送</label>
				    </div>
				    <div class="help-block">仅对 <span style='color:red'>分享成功赠送（需要打开分享的链接）</span>启作用 PS：<span style='color:red'>如果非认证服务号需借用启作用，否则以分享共计赠送计算</span><br/><span style='color:red'>单独赠送机会</span>:分享以后,每个朋友第一次打开即获取分享赠送基数,累计计算赠送次数;(第一次打开数*分享赠送基数)<br/><span style='color:red'>每人赠送基数</span>:分享以后,每个朋友打开即获取分享赠送基数,累计计算赠送次数;(打开数*分享赠送基数)<br/><span style='color:red'>分享共计赠送</span>:只要分享有一个打开即计算不累计（分享赠送基数）</div>
                </div>
            </div>			
		    <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">分享赠送基数</label>
                <div class="col-sm-9 col-xs-6">
               	    <div class="input-group">
					    <input type="text" class="form-control" name="sharenum_<?php  echo $shares['acid'];?>" value="<?php  echo $shares['sharenum'];?>" />
					    <span class="input-group-addon">次</span>
				    </div>
				    <div class="help-block"><?php  if($acid_arr[$idsname]['level']==2) { ?>分享以后，被邀约人打开分享链接一次，分享人获取多少次机会 0为分享不赠送<?php  } else { ?>分享以后，只要有被邀约人打开分享链接，分享人获取多少次机会 0为分享不赠送<?php  } ?></div>
                </div>
            </div>			
			<div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">分享成功提示语</label>
                <div class="col-sm-9 col-xs-6">
					<input type="text" class="form-control" name="share_confirm_<?php  echo $shares['acid'];?>" value="<?php  echo $shares['share_confirm'];?>" />
                </div>
            </div>
			<div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">分享成功后跳转</label>
                <div class="col-sm-9 col-xs-12">
				    <?php  echo tpl_form_field_link('share_confirmurl_'.$shares['acid'],$shares['share_confirmurl']);?>
				    <div class="help-block">请选择跳转活动页,<span style='color:red'>活动首页</span>跳转重新开始活动页， <span style='color:red'>我的奖品</span>跳转至奖品页， <span style='color:red'>选择链接</span>跳转到其他活动</div>
                </div>
            </div>
			<div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">分享失败提示语</label>
                <div class="col-sm-9 col-xs-6">
					<input type="text" class="form-control" name="share_fail_<?php  echo $shares['acid'];?>" value="<?php  echo $shares['share_fail'];?>" />		    
                </div>
            </div>
			<div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">分享中途取消提示语</label>
                <div class="col-sm-9 col-xs-6">
					<input type="text" class="form-control" name="share_cancel_<?php  echo $shares['acid'];?>" value="<?php  echo $shares['share_cancel'];?>" />		    
                </div>
            </div>
			</div>
			</div>
			<?php  } } ?>
		</div>
	</div>	
</div>
<div id="nav_r1"></div>
<script type="text/javascript">
<!--
	function validateReplyForm(formobj, jq, underscore, util, $scope, $http) {
		if (!formobj['title'].value) {
			util.message('请输入活动标题');
			return false;
		}
		if (!formobj['description'].value) {
			util.message('请输入活动说明');
			return false;
		}
		if (!formobj['end_title'].value) {
			util.message('请输入活动结束标题');
			return false;
		}
		if (!formobj['end_description'].value) {
			util.message('请输入活动结束说明');
			return false;
		}
	}
	
	require(['jquery', 'util'], function($, u){
		$(function(){
			u.editor($('.richtextinfo')[0]);
			<?php  if($stonefish_branch) { ?>u.editor($('.richtext2')[0]);<?php  } ?>
			<?php  if(is_array($ids)) { foreach($ids as $idsname) { ?>
			u.editor($('.richtext_<?php  echo $idsname;?>')[0]);
			<?php  } } ?>
		});
    });	
//-->
</script>