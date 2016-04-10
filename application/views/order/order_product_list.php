<script type="text/javascript">
    $('#order_li').addClass('active');
</script>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">
                order_product_list - <?php echo $order['order_code']; ?><span style="display:none;" id="order_id"><?php echo $order_id ?></span>
            </h3>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="/index.php/order">order</a>
                </li>
                <li class="active">
                    <i class="fa fa-edit"></i> order_product_list
                </li>
            </ol>
        </div>
    </div>
    <!-- /.row -->
    <?php if (validation_errors() !='' ){  ?>
        <div class="alert alert-danger">
            <?php echo validation_errors(); ?>
        </div>
    <?php  } ?>



    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <b>Product</b>
                </div>
                <div class="panel-body">
                    <div class="form-group col-lg-7">
                        <label for="os_product_id"><span class="red"> * </span>os_product_name:</label>
                        <select id="os_product_id" name="os_product_id" data-placeholder="Choose a Product..." class="chosen-select" tabindex="3">
                            <?php foreach ($product as $product_item): ?>
                                <option value="<?php echo $product_item['os_product_id'] ?>" <?php if ($product_item['os_product_id'] === set_value('os_product_id')) { echo "selected"; } ?>><?php echo $product_item['product_name'] ?></option>
                            <?php endforeach ?>
                        </select>

                    </div>
                    <div class="form-group col-lg-5">
                        <button id="add_order_product" class="btn btn-primary" />Add to Cart</button>
                    </div>
                    <div class="form-group col-lg-3">
                        <label for="chemist_price"><span class="red"> * </span>chemist_price:</label>
                        <input disabled id="chemist_price" class="form-control" type="input" name="chemist_price" value="<?php echo set_value('real_cost'); ?>">
                    </div>
                    <div class="form-group col-lg-3">
                        <label for="buy_shop"><span class="red"> * </span>source_type:</label>
                        <input disabled id="source_type" class="form-control" type="input" name="buy_shop" value="<?php echo set_value('buy_shop'); ?>">
                    </div>
                    <div class="form-group col-lg-3">
                        <label for="quantity"><span class="red"> * </span>quantity:</label>
                        <input id="quantity" class="form-control" type="input" name="quantity" value="<?php echo set_value('quantity'); ?>">
                    </div>
                    <div class="form-group col-lg-3">
                        <label for="sell_price"><span class="red"> * </span>sell_price:</label>
                        <input id="sell_price" class="form-control" type="input" name="sell_price" value="<?php echo set_value('sell_price'); ?>">
                    </div>
                </div>
            </div> 
        </div> 
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
                                        <th>操作</th>
                                    </tr>
                                </tr>
                            </thead>
                            <tbody id="product_order_list_table">
                                
           
                            <?php  foreach ($order_product as $product_item): ?>
                                        <tr>
                                                <td style='display:none'><?php echo $product_item['os_product_id']; ?></td>
                                                <td style='display:none'><?php echo $product_item['os_product_id']; ?></td>
                                                <td><?php echo $product_item['product_name']; ?></td>
                                                <td><?php echo $product_item['chemist_price']; ?></td>
                                                <td><?php echo $product_item['source_type']; ?></td>
                                                <td><?php echo $product_item['quantity']; ?></td>
                                                <td><?php echo $product_item['sell_price']; ?></td>
                                                <td>
                                                    <a style="display:none" href="/index.php/order/edit_cart/<?php echo $product_item['order_product_id']; ?>" class="btn btn-danger btn-xs" >View/Edit</a>
                                                    
                                            <?php echo form_open('order/delete_order_product') ?>
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
                                            </form>


                                            <?php echo form_open('order/edit_order_product') ?>
                                                    <input type="hidden" name="edit_product_id" value="<?php echo $product_item['os_product_id']; ?>">
                                                    <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#edit_product_<?php echo $product_item['os_product_id'];?>">Edit</button>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="edit_product_<?php echo $product_item['os_product_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                      <div class="modal-dialog">
                                                        <div class="modal-content">
                                                          <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                            <h4 class="modal-title" id="myModalLabel">Edit product List Confirm</h4>
                                                          </div>
                                                          <div class="modal-body">
                                                            <div class="col-lg-12">
                                                                <div class="form-group">
                                                                    <label for="os_product_id"><span class="red"> * </span>os_product_name:</label>
                                                                   <input disabled id="m_os_product_id" class="form-control" type="input" name="m_os_product_id" value="<?php echo $product_item['product_name']; ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="form-group">
                                                                    <label for="chemist_price"><span class="red"> * </span>chemist_price:</label>
                                                                    <input disabled id="m_chemist_price" class="form-control" type="input" name="m_chemist_price" value="<?php echo $product_item['chemist_price'];?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="form-group">
                                                                    <label for="buy_shop"><span class="red"> * </span>source_type:</label>
                                                                    <input disabled id="m_source_type" class="form-control" type="input" name="m_buy_shop" value="<?php echo $product_item['source_type'];set_value('buy_shop'); ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="form-group">
                                                                    <label for="quantity"><span class="red"> * </span>quantity:</label>
                                                                    <input id="m_quantity" class="form-control" type="input" name="m_quantity" value="<?php echo $product_item['quantity']; ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="form-group">
                                                                    <label for="sell_price"><span class="red"> * </span>sell_price:</label>
                                                                    <input id="m_sell_price" class="form-control" type="input" name="m_sell_price" value="<?php echo $product_item['sell_price']; ?>">
                                                                </div>
                                                            </div>
                                                            <div style="clear:both;"></div>
                                                          </div>
                                                          <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                                            <span type="button" class="btn btn-primary" onclick="edit_cart_product('<?php echo $product_item['order_product_id']."','".$product_item['order_id']; ?>')">Yes, SAVE</span>
                                                          </div>
                                                        </div>
                                                      </div>
                                                    </div>
                                            </form>

                                                </td>
                                        </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                </div>

            </div> 
        </div> 
    </div>
    <!-- /.row -->
</div>

<script type="text/javascript">

    var config = {
        '.chosen-select' : {}
    }
    for (var selector in config) {
        $(selector).chosen(config[selector]);
    }

    $(document).ready(function(){

        $("#os_product_id").change(function(){
            console.log($("#os_product_id").val());
            //get product_item data
            var data = {
                os_product_id : $("#os_product_id").val()
            };
            //post product_item to session
            $.ajax({
                type: 'POST',
                url: '/index.php/stock/get_product_json_by_id',
                data: data,
                beforeSend: function(data){
                    console.log("this data will post---");
                    console.log(data);
                },
                success: function(product_json){
                    //console.log(product_json);
                    var productObj;
                    productObj = JSON.parse(product_json);

                    //console.log("productObj:"+JSON.parse(product_json));

                    var chemist_price;
                    var phone;
                    var recevier_name;
                    var recevier_nation_id;
                    var remark;


                    chemist_price = productObj['chemist_price'];
                    small_img_src = productObj['small_img_src'];
                    big_img_src = productObj['big_img_src'];
                    source_type = productObj['source_type'];
                    remark = productObj['remark'];
                    $("#chemist_price").val(chemist_price);
                    $("#source_type").val(source_type);

                    message('get product success!',1);
                }
            });
        });

        get_address_id();
        $("#recevier_name").change(function(){
            console.log("get_address_id");
            get_address_id();
        });
        //find product
        $("#autocomp").autocomplete({
            source: "/index.php/stock/get_product_json",
            minLength: 2, 
            select: function(e, ui) {
                console.log(ui);
                $("#os_product_id").val(ui.item.id);
                $("#chemist_price").val(ui.item.chemist_price);
                $("#source_type").val(ui.item.source_type);
                //$("#autocomp").val(ui.item.label);
                //alert(ui.item.label + ui.item.value) ;
            }
        });

        //
        $("#add_order_product").click(function(){
            console.log("add_order_product button is clicked!");
            //get product_item data
            var data = {
                os_product_id : $("#os_product_id").val(),
                product_name : $("#autocomp").val(),
                chemist_price : $("#chemist_price").val(),
                source_type : $("#source_type").val(),
                quantity : $("#quantity").val(),
                sell_price : $("#sell_price").val(),
                order_id : $("#order_id").html()
            };
            //post product_item to session
            $.ajax({
                type: 'POST',
                url: '/index.php/order/add_order_product',
                data: data,
                beforeSend: function(data){
                    console.log("this data will post---");
                    console.log(data);
                },
                success: function(msg){
                    console.log(msg);
                    parent.document.location.href = "/index.php/order/order_product_list/"+$("#order_id").html();
                }
            });
        });

    });

    function delete_cart_product(order_product_id,order_id) {

        var data = {
            order_product_id : order_product_id
        };
        console.log(data);
        $.ajax({
            type: 'POST',
            url: '/index.php/order/delete_order_product',
            data: data,
            beforeSend: function(data){
                console.log("this data will post---");
                console.log(data);
            },
            success: function(msg){
                console.log(msg);
                parent.document.location.href = "/index.php/order/order_product_list/"+order_id;
            }
        });
    }
    function edit_cart_product(edit_order_product_id,order_id) {

        var data = {
            order_product_id : edit_order_product_id,
            quantity : $("#m_quantity").val(),
            sell_price : $("#m_sell_price").val()
        };
        console.log(data);
        $.ajax({
            type: 'POST',
            url: '/index.php/order/edit_order_product',
            data: data,
            beforeSend: function(data){
                console.log("this data will post---");
                console.log(data);
            },
            success: function(msg){
                console.log(msg);
                parent.document.location.href = "/index.php/order/order_product_list/"+order_id;
            }
        });
    }
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
                //$("#recevier_name").val(recevier_name);
                $("#recevier_nation_id").val(recevier_nation_id);
            }
        });
    }
</script>
