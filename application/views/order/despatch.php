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
                </div>
                <div class="panel-body">
                        <table class="table table-bordered table-hover table-striped" >
                            <thead>
                                <tr>
                                    <th style='display:none'>os_product_id</th>
                                        <th>product_name</th>
                                        <th>chemist_price</th>
                                        <th>source_type</th>
                                        <th>quantity</th>
                                        <th>sell_price</th>
                                        <th>stock list</th>
                                        <th style="display:none;">操作</th>
                                    </tr>
                                </tr>
                            </thead>
                            <tbody id="product_order_list_table">
                                
           
                            <?php  foreach ($product as $product_item): ?>
                                        <tr>
                                            <?php echo form_open('order/delete_order_product') ?>
                                                <td style='display:none'><?php echo $product_item['os_product_id']; ?></td>
                                                <td style='display:none'><?php echo $product_item['os_product_id']; ?></td>
                                                <td><?php echo $product_item['product_name']; ?></td>
                                                <td><?php echo $product_item['chemist_price']; ?></td>
                                                <td><?php echo $product_item['source_type']; ?></td>
                                                <td><?php echo $product_item['quantity']; ?></td>
                                                <td><?php echo $product_item['sell_price']; ?></td>
                                                <td style="width:50px;" >

                                                   <!--  <ul class="list-group"> -->
                                                    <?php foreach ($stock as $stock_item): ?>
                                                    <?php if($stock_item['os_product_id'] == $product_item['os_product_id']) { ?>
                                                      <!-- <li class="list-group-item" > -->
                                                        <div class="input-group" id="stock_inputgroup_<?php echo $stock_item['stock_id'].'_'.$stock_item['order_id']?>" >
                                                            <span class="input-group-addon" id="basic-addon1"><?php echo $stock_item['real_cost']; ?><span id="stock_present_num_<?php echo $stock_item['stock_id'].'_'.$stock_item['order_id']?>" class="badge"><?php echo $stock_item['stock_present_num'] ; ?></span></span>
                                                            
                                                            <?php //echo $stock_item['product_name']." * "; ?>
                                                            
                                                            <input style="width:50px;display:inline;" type="text" class="form-control" id="despatch_num_<?php echo $stock_item['stock_id'].'_'.$stock_item['order_id']?>" type="text" class="form-control"  aria-describedby="basic-addon1" value="<?php echo $stock_item['stock_despatch_num']; ?>" disabled="disabled" >
                                                            <span class="input-group-addon" onclick="set_despatch_num(<?php echo $stock_item['stock_id'].','.$stock_item['order_id'].','.$stock_item['os_product_id'].','.$stock_item['stock_despatch_num']?>)"><span id="pencil_<?php echo $stock_item['stock_id'].'_'.$stock_item['order_id']?>" class="glyphicon glyphicon-pencil"></span></span>
                                                         </div>
                                                      <!--</li> -->
                                                    <?php   } ?>
                                                    <?php endforeach ?>
                                                    <!-- </ul> -->

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
                </div>

            </div> 
        </div> 

    </div>
    <!-- /.row -->
    
    <div class="text-left">
        <input class="btn btn-primary" type="submit" name="submit" value="Save" />
    </div>

    </form>
</div>


<script type="text/javascript">

    $(document).ready(function(){


    });
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
