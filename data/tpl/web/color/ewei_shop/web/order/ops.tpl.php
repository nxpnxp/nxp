<?php defined('IN_IA') or exit('Access Denied');?><!--a class="btn btn-primary btn-sm" href="<?php  echo $this->createWebUrl('order', array('op' => 'express_print','id' => $item['id']))?>" onclick="return confirm('确认打印快递单吗？');return false;">快递打印</a>
<a class="btn btn-primary btn-sm" href="<?php  echo $this->createWebUrl('order', array('op' => 'normal_print','id' => $item['id']))?>" onclick="return confirm('确认打印发货单吗？');return false;">发货打印</a-->
  <?php  if(empty($item['statusvalue'])) { ?>
		<!--未付款-->
                                <?php if(cv('order.op.pay')) { ?>
                                <a class="btn btn-primary btn-sm" href="<?php  echo $this->createWebUrl('order', array('op' => 'deal','to'=>'confirmpay','id' => $item['id']))?>" onclick="return confirm('确认此订单已付款吗？');return false;">确认付款</a>                               
                                <?php  } ?>
                            
                            <?php  } else if($item['statusvalue'] == 1) { ?>
                               <!--已付款-->
                            
                                <?php  if(!empty($item['addressid']) ) { ?>
                                      <!--快递 发货-->
                                        <?php if(cv('order.op.send')) { ?>
                                        <a class="btn btn-primary btn-sm" href="javascript:;" onclick="$('#modal-confirmsend').find(':input[name=id]').val('<?php  echo $item['id'];?>')" data-toggle="modal" data-target="#modal-confirmsend">确认发货</a>
                                        <?php  } ?>
                                <?php  } else { ?>
                                        <?php  if($item['isverify']==1) { ?>
                                            <!--核销 确认核销-->
                                             <?php if(cv('order.op.verify')) { ?>
                                                 <a class="btn btn-primary btn-sm" href="<?php  echo $this->createWebUrl('order', array('op' => 'deal','to'=>'confirmsend1','id' => $item['id']))?>" onclick="return confirm('确认核销吗？');return false;">确认核销</a>
                                             <?php  } ?>
                                        <?php  } else { ?>
                                            <!--自提 确认取货-->
                                              <?php if(cv('order.op.fetch')) { ?>
                                                 <a class="btn btn-primary btn-sm" href="<?php  echo $this->createWebUrl('order', array('op' => 'deal','to'=>'confirmsend1','id' => $item['id']))?>" onclick="return confirm('确认取货吗？');return false;">确认取货</a>
                                            <?php  } ?>
                                        <?php  } ?>
                                
                                <?php  } ?>
                                
                            
                            <?php  } else if($item['statusvalue'] == 2) { ?>
                                       <!--已发货-->
                                <?php  if(!empty($item['addressid'])) { ?>
                                 <!--快递 取消发货-->
                                   <?php if(cv('order.op.sendcancel')) { ?>
                                      <a class="btn btn-danger btn-sm" href="javascript:;" onclick="$('#modal-cancelsend').find(':input[name=id]').val('<?php  echo $item['id'];?>')" data-toggle="modal" data-target="#modal-cancelsend">取消发货</a>
                                   <?php  } ?>
                                   <?php if(cv('order.op.finish')) { ?>
                                       <a class="btn btn-primary btn-sm" href="<?php  echo $this->createWebUrl('order', array('op' => 'deal','to'=>'finish','id' => $item['id']))?>" onclick="return confirm('确认订单收货吗？');return false;">确认收货</a>
                              
                                   <?php  } ?>
                                <?php  } ?>
                                
                            <?php  } else if($item['statusvalue'] == 3) { ?>
 
                            <?php  } ?>