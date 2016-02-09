<script type="text/javascript">
    $('#order_li').addClass('active');
</script>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">
                View/Edit order
            </h3>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="/index.php/order">order</a>
                </li>
                <li class="active">
                    <i class="fa fa-edit"></i> View/Edit order
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

            <div class="col-lg-6">
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

            <div class="col-lg-3">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <b>View/Edit order</b>
                    </div>
                    <div class="panel-body">
                      
                        <div class="form-group">
                            <label for="order_id"><span class="red"> * </span>order_id:</label>
                            <input disabled class="form-control" type="input" name="order_id" value="<?php echo $order['order_id']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="order_code"><span class="red"> * </span>order_code:</label>
                            <input disabled id="order_code" class="form-control" type="input" name="order_code" value="<?php echo $order['order_code']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="agent_name"><span class="red"> * </span>agent_name:</label>
                            <input disabled id="agent_name" class="form-control" type="input" name="agent_name" value="<?php echo $order['agent_name']; ?>">
                        </div>
                    </div>
                </div> 
            </div> 
            <div class="col-lg-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <b>Receiver info(Address)</b>
                    </div>
                    <div class="panel-body">
                        <div   class="form-group">
                            <label for="address_id"><span class="red"> * </span>address_id:</label>
                            <input style="display:none" id="post_address_id" class="form-control" type="input" name="post_address_id" value="<?php echo $order['address_id']; set_value('address_id'); ?>">
                            <input disabled id="address_id" class="form-control" type="input" name="address_id" value="<?php echo $order['address_id'];set_value('address_id'); ?>">
                        </div>
                        <div class="form-group">
                            <label for="recevier_name"><span class="red"> * </span>recevier_name:</label>
                            <select id="recevier_name" class="form-control" name="recevier_name">
                                <option value="<?php echo $order['address_id'] ?>" >
                                        <?php echo $order['recevier_name']; ?>
                                </option>
                                <?php foreach ($address as $address_item): ?>
                                    <option value="<?php echo $address_item['address_id'] ?>" 
                                        <?php if ($address_item['address_id'] === set_value('address_id')) { echo "selected"; } ?>>
                                        <?php echo $address_item['recevier_name'];?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="address_detail"><span class="red"> * </span>address_detail:</label>
                            <input disabled id="address_detail" class="form-control" type="input" name="address_detail" value="<?php echo $order['address_detail']; set_value('address_detail'); ?>">
                        </div>
                        <div class="form-group">
                            <label for="phone"><span class="red"> * </span>phone:</label>
                            <input disabled id="phone" class="form-control" type="input" name="phone" value="<?php echo $order['phone'];set_value('phone'); ?>">
                        </div>
                        <div class="form-group">
                            <label for="recevier_nation_id"><span class="red"> * </span>recevier_nation_id:</label>
                            <input disabled id="recevier_nation_id" class="form-control" type="input" name="recevier_nation_id" value="<?php echo $order['recevier_nation_id']; set_value('recevier_nation_id'); ?>">
                        </div>
                        <a id="edit_agent_address" target="_blank" href="/index.php/address/edit/<?php echo $order['address_id'];?>" class="btn btn-danger btn-xs" >Edit Address</a>
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
        //get_address_id();
        $("#recevier_name").change(function(){
            console.log("get_address_id");
            get_address_id();
        });


    });

    function get_address_id(){

        var address_id = $("#recevier_name").val();
       
        console.log("address_id:" + address_id);
        $("#address_id").val(address_id);
        //$("#order_code").css("background-color","#FFFFCC");

        var data = {
            address_id : address_id
        };
        console.log(data);
        $.ajax({
            type: 'POST',
            url: '/index.php/address/get_address_json',
            data: data,
            beforeSend: function(){

            },
            success: function(address_json){
                var addressObj;
                addressObj = JSON.parse(address_json);

                console.log("address_json:"+JSON.parse(address_json));

                var address_detail;
                var phone;
                var recevier_name;
                var recevier_nation_id;


                phone = addressObj['phone'];
                recevier_name = addressObj['recevier_name'];
                recevier_nation_id = addressObj['recevier_nation_id'];
                address_detail = addressObj['address_detail'];
                $("#address_detail").val(address_detail);
                $("#phone").val(phone);
                $("#post_address_id").val(address_id);
                var edit_address_href = '/index.php/address/edit/' + address_id;
                $("#edit_agent_address").attr("href",edit_address_href);
                //$("#recevier_name").val(recevier_name);
                $("#recevier_nation_id").val(recevier_nation_id);
            }
        });
    }
</script>
