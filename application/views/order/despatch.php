<script type="text/javascript">
    $('#order_li').addClass('active');
</script>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">
                View/Edit order despatch
            </h3>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="/index.php/order">order</a>
                </li>
                <li class="active">
                    <i class="fa fa-edit"></i> View/Edit order despatch
                </li>
            </ol>
        </div>
    </div>
    <!-- /.row -->
    <?php if (validation_errors() !='' ){  ?>
        <div class="alert alert-danger">
            <?php echo '<strong>Oh snap!</strong><br/>'.validation_errors(); ?>
        </div>
    <?php  } ?>

    <?php if ($update_success !='' ){  ?>
        <div class="alert alert-success">
            <?php echo '<strong>Well Done!</strong> '.$update_success; ?>
        </div>
    <?php  } ?>

        
    <?php echo form_open('order/edit/'.$order['order_id']) ?>


    <div class="row">

        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <b>Cart (Product List)</b>

                    <button type="button" onclick="auto_despatch(<?php echo $order['order_id']; ?>)" class="btn btn-primary">auto despatch</button>
                </div>
                <div class="panel-body">
                        <table class="table table-bordered table-hover table-striped" >
                            <thead>
                                <tr>
                                    <th style='display:none'>os_product_id</th>
                                        <th>product_name</th>
                                        <th style='display:none'>chemist_price</th>
                                        <th style='display:none'>source_type</th>
                                        <th>sell_price</th>
                                        <th>quantity</th>
                                        <th>despatch list</th>
                                        <th>cost</th>
                                        <th>sell total price</th>
                                        <th>profit
                                        </br>(no incld postage )</th>
                                        <th style="display:none;">操作</th>
                                    </tr>
                                </tr>
                            </thead>
                            <tbody id="product_order_list_table">
                                
           
    <?php $global_sell_price = 0; $global_cost=0; $global_profit=0; $global_post_fee=0; ?>

                            <?php  foreach ($product as $product_item): ?>
                                        <tr>
                                            <?php echo form_open('order/delete_order_product') ?>
                                                <td style='display:none'><?php echo $product_item['os_product_id']; ?></td>
                                                <td style='display:none'><?php echo $product_item['os_product_id']; ?></td>
                                                <td><?php echo $product_item['product_name']; ?></td>
                                                <td style='display:none'><?php echo $product_item['chemist_price']; ?></td>
                                                <td style='display:none'><?php echo $product_item['source_type']; ?></td>
                                                <td><?php echo "$ ".$product_item['sell_price']." / ￥ ".$product_item['sell_price']*5; ?></td>
                                                <td><?php echo $product_item['quantity']; ?></td>
                                                <td style="width:50px;" >

                                                   <!--  <ul class="list-group"> -->
                                                    <?php foreach ($stock as $stock_item): ?>
                                                    <?php if($stock_item['os_product_id'] == $product_item['os_product_id']) { ?>
                                                      <!-- <li class="list-group-item" > -->
                                                        <div class="input-group" id="stock_inputgroup_<?php echo $stock_item['stock_id'].'_'.$stock_item['order_id']?>" >
                                                            <span class="input-group-addon" id="basic-addon1"><?php echo $stock_item['real_cost']; ?><span id="stock_present_num_<?php echo $stock_item['stock_id'].'_'.$stock_item['order_id']?>" class="badge"><?php echo $stock_item['stock_present_num'] ; ?></span></span>
                                                            
                                                            <?php //echo $stock_item['product_name']." * "; ?>
                                                            
                                                            <input style="width:50px;display:inline;" type="text" class="form-control" id="despatch_num_<?php echo $stock_item['stock_id'].'_'.$stock_item['order_id']?>" type="text" class="form-control"  aria-describedby="basic-addon1" value="<?php echo $stock_item['despatch_num']; ?>" disabled="disabled" >
                                                            <span class="input-group-addon" onclick="set_despatch_num(<?php echo $stock_item['stock_id'].','.$stock_item['order_id'].','.$stock_item['os_product_id'].','.$stock_item['despatch_num']?>)"><span id="pencil_<?php echo $stock_item['stock_id'].'_'.$stock_item['order_id']?>" class="glyphicon glyphicon-pencil"></span></span>
                                                         </div>
                                                      <!--</li> -->
                                                    <?php   } ?>
                                                    <?php endforeach ?>
                                                    <!-- </ul> -->

                                                </td>
                                                <td>
                                                    <?php foreach ($despatch_cost as $despatch_cost_item): ?>
                                                    <?php if( $product_item['os_product_id']== $despatch_cost_item['os_product_id']) 
                                                            { echo " $ ".$despatch_cost_item['total_cost']." </br>￥ ".$despatch_cost_item['total_cost']*5; 
                                                                    $global_cost = $global_cost + $despatch_cost_item['total_cost'];
                                                            } ?>
                                                    <?php endforeach ?>
                                                </td>
                                                <td>
                                                    <?php foreach ($despatch_cost as $despatch_cost_item): ?>
                                                    <?php if( $product_item['os_product_id']== $despatch_cost_item['os_product_id']) 
                                                            {   //echo " $ ".$despatch_cost_item['total_cost']." </br>￥ ".$despatch_cost_item['total_cost']*5; 
                                                                $sell_price = "sell_price_".$product_item['os_product_id'];  
                                                                $cost = "cost_".$product_item['os_product_id'];  
                                                                $profit = "profit_".$product_item['os_product_id'];

                                                                $$sell_price = $product_item['sell_price']*$product_item['quantity'];
                                                                $$cost = $despatch_cost_item['total_cost'];
                                                                $$profit = $$sell_price - $$cost;
                                                                echo " $ ".$$sell_price." </br>￥ ".$$sell_price * 5 ; 
                                                                $global_sell_price = $global_sell_price + $$sell_price;
                                                            }?>
                                                    <?php endforeach ?>
                                                </td>
                                                <td>
                                                    <?php foreach ($despatch_cost as $despatch_cost_item): ?>
                                                    <?php if( $product_item['os_product_id']== $despatch_cost_item['os_product_id']) 
                                                            {   //echo " $ ".$despatch_cost_item['total_cost']." </br>￥ ".$despatch_cost_item['total_cost']*5; 
                                                                $sell_price = "sell_price_".$product_item['os_product_id'];  
                                                                $cost = "cost_".$product_item['os_product_id'];  
                                                                $profit = "profit_".$product_item['os_product_id'];

                                                                $$sell_price = $product_item['sell_price']*$product_item['quantity'];
                                                                $$cost = $despatch_cost_item['total_cost'];
                                                                $$profit = $$sell_price - $$cost;
                                                                echo " $ ".$$profit." </br>￥ ".$$profit * 5 ; 
                                                                $global_profit = $global_profit + $$profit;
                                                            }?>
                                                    <?php endforeach ?>
                                                </td>
                                                <td style="display:none;">
                                                    <a style="display:none" href="/index.php/order/edit_cart/<?php echo $product_item['order_product_id']; ?>" class="btn btn-danger btn-xs" >View/Edit</a>
                                                    
                                                    <input type="hidden" name="delete_product_id" value="<?php echo $product_item['os_product_id']; ?>">
                                                    <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#delete_product_<?php echo $product_item['os_product_id'];?>">Delete</button>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="delete_product_<?php echo $product_item['os_product_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                      <div class="modal-dialog">
                                                        <div class="modal-content">
                                                          <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                            <h4 class="modal-title" id="myModalLabel">Delete product List Confirm</h4>
                                                          </div>
                                                          <div class="modal-body">
                                                            Are you sure you want to delete ?</em>--<?php echo $product_item['product_name']; ?>
                                                          </div>
                                                          <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                                            <button type="button" class="btn btn-primary" onclick="delete_cart_product('<?php echo $product_item['order_product_id']."','".$product_item['order_id']; ?>')">Yes, Delete</button>
                                                          </div>
                                                        </div>
                                                      </div>
                                                    </div>
                                                </td>

                                            </form>
                                        </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>


                        <table class="table table-bordered table-hover table-striped" >
                            <thead>

                                <tr>
                                    <th style='display:none'>postage id</th>
                                        <th style="display:none" >postage_company_id</th>
                                        <th>postage_date</th>
                                        <th>postage_code</th>
                                        <th>postage_company_name</th>
                                        <th>postage_website</th>
                                        <th>postage_fee</th>
                                        <th>postage_fee free or not?</th>
                                        <th>postage_weight</th>
                                        <th>remark</th>
                                        <th style="display:none" >entry_time</th>
                                        <th style="display:none" >update_time</th>
                                        <th>操作</th>
                                    </tr>
                                </tr>
                            </thead>
                            <tbody>
                            
                            <span style="display:none" id="postage_json_list" > <?php echo $postage_json=json_encode($postage_echart);  ?> </span>
                                
                                <?php foreach ($postage as $postage_item): ?>
                                        <tr>
                                            <?php echo form_open('postage/index/delete') ?>
                                                <td style='display:none'><?php echo $postage_item['postage_id']; ?></td>
                                                <td style="display:none" ><?php echo $postage_item['postage_company_id']; ?></td>
                                                <td><?php echo $postage_item['postage_date']; ?></td>
                                                <td><?php echo $postage_item['postage_code']; ?></td>
                                                <td><?php echo $postage_item['postage_company_name']; ?></td>
                                                <td><?php echo $postage_item['postage_website']; ?></td>
                                                <td><?php echo "$ ".$postage_item['postage_fee']."</br> ￥".$postage_item['postage_fee']*5; 

                                                                

                                                ?></td>
                                                <td><?php if($postage_item['postage_free']==1)
                                                          {   echo "包邮"; 
                                                                $global_post_fee = $global_post_fee + $postage_item['postage_fee'];
                                                                $global_profit = $global_profit - $postage_item['postage_fee'];} 
                                                          else { echo "不包邮"; 

                                                                } ?></td>
                                                <td><?php echo $postage_item['postage_weight']; ?></td>
                                                <td><?php echo $postage_item['remark']; ?></td>
                                                <td style="display:none" ><?php echo $postage_item['entry_time']; ?></td>
                                                <td style="display:none" ><?php echo $postage_item['update_time']; ?></td>
                                                <td>
                                                    <a href="/index.php/postage/edit/<?php echo $postage_item['postage_id']; ?>" class="btn btn-danger btn-xs" >View/Edit</a>
                                                    
                                                    <input type="hidden" name="postage_id" value="<?php echo $postage_item['postage_id']; ?>">
                                                    <button style="display:none"type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#delete_postage_<?php echo $postage_item['postage_id'];?>">Delete</button>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="delete_postage_<?php echo $postage_item['postage_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                      <div class="modal-dialog">
                                                        <div class="modal-content">
                                                          <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                            <h4 class="modal-title" id="myModalLabel">Delete Distribution List Confirm</h4>
                                                          </div>
                                                          <div class="modal-body">
                                                            Are you sure you want to delete ?</em>
                                                          </div>
                                                          <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                                            <button type="button" class="btn btn-primary" onclick="delete_postage('<?php echo $postage_item['postage_id']; ?>')">Yes, Delete</button>
                                                          </div>
                                                        </div>
                                                      </div>
                                                    </div>
                                                </td>

                                            </form>
                                        </tr>
                                        <tr>
                                        </tr>
                                        <tr>
                                <?php endforeach ?>
                                        <tr class="success">
                                            <th><?php echo "global_sell_price :"; ?></th>
                                            <td><?php echo "$ ".$global_sell_price." |￥".$global_sell_price*5; ?></td>
                                            <th><?php echo "global_cost :"; ?></th>
                                            <td><?php echo "$ ".$global_cost." |￥".$global_cost*5; ?></td>
                                            <th><?php echo "global_post_fee :"; ?></th>
                                            <td><?php echo "$ ".$global_post_fee." |￥".$global_post_fee*5; ?></td>
                                            <th><?php echo "global_profit :"; ?></th>
                                            <td><?php echo "$ ".$global_profit." |￥".$global_profit*5; ?></td>
                                        </tr>
                            </tbody>
                        </table>
                </div>

            </div> 
        </div> 

    </div>
    <!-- /.row -->
    
 <!--    <div class="text-left">
        <input class="btn btn-primary" type="submit" name="submit" value="Save" />
    </div> -->

    </form>
</div>


<script type="text/javascript">

    $(document).ready(function(){


    });

    function auto_despatch(order_id)
    {
        console.log("auto_despatch");
        //get product_item data
        var data = {
            order_id : order_id
        };
        //post product_item to session
        $.ajax({
            type: 'POST',
            url: 'auto_despatch',
            data: data,
            beforeSend: function(data){
                console.log("this data will post---");
            },
            success: function(msg){
                console.log(msg);
                message(msg,1);
               // message('auto_despatch is success!',1);
               parent.document.location.href = "/index.php/order/despatch/"+order_id;
            }
        });
    }

    function set_despatch_num(stock_id,order_id,os_product_id,stock_despatch_num)
    {

        console.log(stock_id,order_id);
        vSpanId="despatch_num_"+stock_id+'_'+order_id;
        //var stock_entry_num = $("#stock_entry_num_"+stock_id+'_'+order_id).html();
        console.log(vSpanId);
        if ($("#pencil_"+stock_id+'_'+order_id).hasClass("glyphicon-pencil")){
            $("#stock_inputgroup_"+stock_id+'_'+order_id).addClass(" has-success");
            $("#pencil_"+stock_id+'_'+order_id).removeClass("glyphicon glyphicon-pencil");
            $("#pencil_"+stock_id+'_'+order_id).toggleClass(" glyphicon glyphicon-ok");
            $("#"+vSpanId).removeAttr("disabled");
            console.log("old value:"+stock_despatch_num);
        } else {
            $("#stock_inputgroup_"+stock_id+'_'+order_id).removeClass(" has-success");
            $("#pencil_"+stock_id+'_'+order_id).removeClass("glyphicon glyphicon-ok");
            $("#pencil_"+stock_id+'_'+order_id).toggleClass(" glyphicon glyphicon-pencil");
            $("#"+vSpanId).attr("disabled","disabled");
            var newValue=$("#"+vSpanId).val();
            console.log("new value:"+newValue);
            if ( order_id == parseInt(order_id, 10) && newValue == parseInt(newValue, 10) && stock_id == parseInt(stock_id, 10) ) {
                $.ajax({
                    url: '/index.php/order/set_despatch_num/'+stock_id+'/'+order_id+'/'+os_product_id +'/'+ newValue,
                    type: "GET",

                    dataType: "text",
                    success: function(response) {
                        if (response =='success') {
                           // message('Add Purchase Stock Take Success:'+stock_id+'/'+order_id+'/'+newValue,1);
                            message('Add Purchase Stock Take Success',1);
                            //var stock_present_num = stock_entry_num - newValue;
                            console.log("stock_entry_num:" + stock_entry_num);
                           // $("#stock_present_num_"+stock_id+'_'+order_id).html(stock_present_num);
                        }else{
                            message('Add Purchase Stock Take Fail',0);
                            
                            message(response,0);
                        }
                    }

                });
                console.log("save success");
            }else{
                message("Invalid Value!",0);
                //$("#"+vSpanId).val(stock_despatch_num);
            }
            parent.document.location.href = "/index.php/order/despatch/"+order_id;
        }
    }

</script>
