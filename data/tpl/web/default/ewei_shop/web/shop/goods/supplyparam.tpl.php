<?php defined('IN_IA') or exit('Access Denied');?><div class="panel-body table-responsive" style="padding:0px;">
    <table class="table">
        <thead>
            <tr>
                <th style='width:50px;'></th>
                <th>属性名称</th>
                <th>属性值</th>
            </tr>
        </thead>
        <tbody id="param-items">
           <?php  foreach($params as $k=>$v){ ?>
            <tr>
                <td>
                   
                </td>
                <td>
                    <input type="text" name="title1[]" value="<?php  echo $v['title'] ?>" style="border:0" />
                </td>
                <td>
                     <input type="text" name="value1[]" value="<?php  echo $v['value'] ?>" style="border:0" />
                </td>
            </tr>
          <?php  } ?>
        </tbody>

    </table>
</div>

