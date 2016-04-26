<?php defined('IN_IA') or exit('Access Denied');?><table class="table table-hover table-bordered">
	<thead>
	<tr>
		<th width="130">标题</th>
		<th>类型</th>
		<th width="100">使用条件</th>
		<th>折扣/减免</th>
		<th>发行/已领</th>
		<th width="185">使用期限</th>
		<th class="text-right">操作</th>
	</tr>
	</thead>
	<tbody>
		<?php  if(is_array($data)) { foreach($data as $da) { ?>
		<tr>
			<td><?php  echo $da['title'];?></td>
			<td>
				<?php  if($da['type'] == 1) { ?>
				<span class="label label-success">折扣券</span>
				<?php  } else { ?>
				<span class="label label-danger">代金券</span>
				<?php  } ?>
			</td>
			<td>满<?php  echo $da['condition'];?>元</td>
			<td>
				<?php  if($da['type'] == 1) { ?>
				<?php  echo $da['discount'];?>折
				<?php  } else { ?>
				<?php  echo $da['discount'];?>元
				<?php  } ?>
			</td>
			<td>
				<?php  echo $da['amount'];?>/<strong class="text-danger"><?php  echo $da['dosage'];?></strong>
			</td>
			<td>
				<?php  echo date('Y-m-d', $da['starttime'])?> ~ <?php  echo date('Y-m-d', $da['endtime'])?>
			</td>
			<td align="right">
				<a href="javascript:;" class="btn btn-default" data-id="<?php  echo $da['couponid'];?>" data-title="<?php  echo $da['title'];?>">选取</a>
			</td>
		</tr>
		<?php  } } ?>
	</tbody>
</table>