<?php defined('IN_IA') or exit('Access Denied');?><div class="form-group">
    <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>供货商</label>
    <div class="col-sm-9 col-xs-12">
         <div class='form-control-static'><input readonly type="text" name="aname" value="<?php  echo $apply[0]['ca_name'] ?>" style="border:0"/></div>
    </div>
</div>

<div class="form-group">
    <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>商品名称</label>
    <div class="col-sm-9 col-xs-12">
         <div class='form-control-static'><input readonly type="text" name="title" value="<?php  echo $goods['title'];?>" style="border:0"/></div>
    </div>
</div>


<div class="form-group">
    <label class="col-xs-12 col-sm-3 col-md-2 control-label">商品编号</label>
    <div class="col-sm-6 col-xs-6">
           <div class='form-control-static'><input readonly type="text" name="goodssn" value="<?php  echo $goods['goodssn'];?>" style="border:0"/></div>
    </div>
</div>



<div class="form-group">
    <label class="col-xs-12 col-sm-3 col-md-2 control-label">商品图片</label>
    <div class="col-sm-9 col-xs-12 detail-logo">

                            <a href="/supply/Public/Uploads/<?php  echo $goods['thumb']?>" target="_blank"><img src="/supply/Public/Uploads/<?php  echo $goods['thumb']?>" style='width:100px;border:1px solid #ccc;padding:1px' /></a>

    </div>
</div>
 
<div class="form-group">
    <label class="col-xs-12 col-sm-3 col-md-2 control-label">商品原价</label>
    <div class="col-sm-4 col-xs-12">
           <div class='form-control-static'>￥<input type="text" name="marketprice" value="<?php  echo $goods['marketprice'];?>"/></div>
    </div>
</div>
<div class="form-group">
    <label class=" col-sm-3 col-md-2 control-label">供应价</label>
    <div class="col-sm-4 col-xs-12">
           <div class='form-control-static'>￥<input readonly type="text" name="productprice" value="<?php  echo $goods['productprice'];?>" style="border:0"/></div>
    </div>
</div>



<div class="form-group">
    <label class="col-xs-12 col-sm-3 col-md-2 control-label">状态</label>
    <div class="col-sm-9 col-xs-12">
          
        <label for="totalcnf1" class="radio-inline"><input type="radio" name="status" value="0" id="totalcnf1" <?php  if($goods['status'] == 0) { ?>checked="true"<?php  } ?> /> 待审核</label>
        &nbsp;&nbsp;&nbsp;
        <label for="totalcnf2" class="radio-inline"><input type="radio" name="status" value="1" id="totalcnf2"  <?php  if($goods['status'] == 1) { ?>checked="true"<?php  } ?> /> 通过</label>
        &nbsp;&nbsp;&nbsp;
        <label for="totalcnf3" class="radio-inline"><input type="radio" name="status" value="2" id="totalcnf3"  <?php  if($goods['status'] == 2) { ?>checked="true"<?php  } ?> /> 未通过</label>
        
    </div>
</div>

<div class="form-group" id="category" style="display:none">
    <label class=" col-sm-3 col-md-2 control-label">选择分类</label>
    <div class="col-sm-4 col-xs-12">
           <div class='form-control-static'>
           <select name="ccate">
           <option value="0">选择分类</option>
           <option value="1" <?php  if($goods['ccate'] == 1) { ?>selected<?php  } ?>>旅游类产品</option>
           <option value="2" <?php  if($goods['ccate'] == 2) { ?>selected<?php  } ?>>实物类产品</option>
           <option value="5" <?php  if($goods['ccate'] == 5) { ?>selected<?php  } ?>>F2C商品</option>
           </select>
           </div>
    </div>
</div>

<div class="form-group" id="reason" style="display:none">
    <label class=" col-sm-3 col-md-2 control-label">未过审原因</label>
    <div class="col-sm-4 col-xs-12">
           <div class='form-control-static'><textarea name="reply" id="reply" cols="60" rows="6"><?php  echo $goods['reply'] ?></textarea></div>
    </div>
</div>
