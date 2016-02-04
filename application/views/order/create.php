<script type="text/javascript">
    $('#order_li').addClass('active');
</script>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">
                Add order
            </h3>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="/index.php/order">order</a>
                </li>
                <li class="active">
                    <i class="fa fa-edit"></i> Add order
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
        <div class="col-lg-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <b>Product</b>
                    <button style="float:right;" id="add_product_to_cart" class="btn btn-primary btn-xs" />Add to Cart</button>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="os_product_id"><span class="red"> * </span>product_name:</label>
                        <input id="os_product_id" class="form-control" type="hidden" name="os_product_id" value="<?php echo set_value('os_product_id'); ?>">
                        <input class="form-control" type="text" id="autocomp" />
                    </div>
                    <div class="form-group">
                        <label for="chemist_price"><span class="red"> * </span>chemist_price:</label>
                        <input disabled id="chemist_price" class="form-control" type="input" name="chemist_price" value="<?php echo set_value('real_cost'); ?>">
                    </div>
                    <div class="form-group">
                        <label for="buy_shop"><span class="red"> * </span>source_type:</label>
                        <input disabled id="source_type" class="form-control" type="input" name="buy_shop" value="<?php echo set_value('buy_shop'); ?>">
                    </div>
                    <div class="form-group">
                        <label for="quantity"><span class="red"> * </span>quantity:</label>
                        <input id="quantity" class="form-control" type="input" name="quantity" value="<?php echo set_value('quantity'); ?>">
                    </div>
                    <div class="form-group">
                        <label for="sell_price"><span class="red"> * </span>sell_price:</label>
                        <input id="sell_price" class="form-control" type="input" name="sell_price" value="<?php echo set_value('sell_price'); ?>">
                    </div>
                </div>
            </div> 
        </div> 
        <div class="col-lg-9">
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
                                
                            <?php  foreach ($cart_product as $product_item): ?>
                                        <tr>
                                            <?php echo form_open('order/delete_cart_product') ?>
                                                <td style='display:none'><?php echo $product_item['os_product_id']; ?></td>
                                                <td style='display:none'><?php echo $product_item['os_product_id']; ?></td>
                                                <td><?php echo $product_item['product_name']; ?></td>
                                                <td><?php echo $product_item['chemist_price']; ?></td>
                                                <td><?php echo $product_item['source_type']; ?></td>
                                                <td><?php echo $product_item['quantity']; ?></td>
                                                <td><?php echo $product_item['sell_price']; ?></td>
                                                <td>
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
                                                            <button type="button" class="btn btn-primary" onclick="delete_cart_product('<?php echo $product_item['order_product_id']; ?>')">Yes, Delete</button>
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
    <?php echo form_open('order/create') ?>

        <div class="row">
            <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div style="float:left;" class="col-lg-2">
                            <b>order</b>
                        </div>
                        <div style="float:right;" class="col-lg-6 text-right">
                            <a target="_blank" href="/index.php/consumer/create" class="btn btn-success btn-xs" >Add New Consumer</a>
                            <span id="add_new_address" class="btn btn-primary btn-xs" />New Address</span>
                        </div>
                        <div style="clear:both;"></div>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <input style="display:none" id="order_code" class="form-control" type="input" name="order_code" value="<?php echo set_value('order_code'); ?>" >
                            <label for="order_code_auto"><span class="red"> * </span>order_code:</label>
                            <input disabled="disabled" id="order_code_auto" class="form-control" type="input" name="order_code_auto" value="<?php echo set_value('order_code_auto'); ?>" >
                        </div>
                        <div class="form-group">
                            <label for="consumer_id"><span class="red"> * </span>agent_name:</label>
                            <select id="consumer_id" class="form-control" name="consumer_id">
                                <?php foreach ($consumer as $consumer_item): ?>
                                    <option value="<?php echo $consumer_item['consumer_id'] ?>" 
                                        <?php if ($consumer_item['consumer_id'] === set_value('consumer_id')) { echo "selected"; } ?>>
                                        <?php echo $consumer_item['consumer_name'];?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                        </div>


                        <table class="table table-bordered table-hover table-striped" >
                            <thead>
                                <tr>
                                    <th style='display:none'>address_id</th>
                                    <th>recevier_name</th>
                                    <th>address_detail</th>
                                    <th>phone</th>
                                    <th>recevier_nation_id</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody id="agent_address_list_table">
                                <tr id="add_new_address_tr">
                                    <td style='display:none'></td>
                                    <td><input id="recevier_name" class="form-control" type="input" name="recevier_name" value="<?php echo set_value('recevier_name'); ?>"></td>
                                    <td><input id="address_detail" class="form-control" type="input" name="address_detail" value="<?php echo set_value('address_detail'); ?>"></td>
                                    <td><input id="phone" class="form-control" type="input" name="phone" value="<?php echo set_value('phone'); ?>"></td>
                                    <td><input id="recevier_nation_id" class="form-control" type="input" name="recevier_nation_id" value="<?php echo set_value('recevier_nation_id'); ?>"></td>
                                    <td><span id="save_new_address" class="btn btn-primary" />save</span></td>
                                </tr>
                           <!--  <?php  foreach ($agent_address as $address_item): ?> -->
                               <!--  <tr>
                                    <?php echo form_open('order/delete_cart_product') ?>
                                        <td style='display:none'><?php echo $address_item['address_id']; ?></td>
                                        <td style='display:none'><?php echo $address_item['address_id']; ?></td>
                                        <td><?php echo $address_item['recevier_name']; ?></td>
                                        <td><?php echo $address_item['address_detail']; ?></td>
                                        <td><?php echo $address_item['phone']; ?></td>
                                        <td><?php echo $address_item['recevier_nation_id']; ?></td>
                                        <td>
                                            <a style="display:none" href="/index.php/order/edit_cart/<?php echo $address_item['address_id']; ?>" class="btn btn-danger btn-xs" >View/Edit</a>
                                            
                                            <input type="hidden" name="delete_product_id" value="<?php echo $address_item['address_id']; ?>">
                                            <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#delete_product_<?php echo $address_item['address_id'];?>">Delete</button>
 -->
                                            <!-- Modal -->
                                            <!-- <div class="modal fade" id="delete_product_<?php echo $address_item['address_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                              <div class="modal-dialog">
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title" id="myModalLabel">Delete product List Confirm</h4>
                                                  </div>
                                                  <div class="modal-body">
                                                    Are you sure you want to delete ?</em>--<?php echo $address_item['address_detail']; ?>
                                                  </div>
                                                  <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                                    <button type="button" class="btn btn-primary" onclick="delete_agent_address('<?php echo $address_item['address_id']; ?>')">Yes, Delete</button>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                        </td>

                                    </form>
                                </tr> --><!-- 
                            <?php endforeach ?> -->
                            </tbody>
                        </table>

                    </div>
                </div> 
            </div> 
            
            <div style="display:none;" class="col-lg-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <b>Receiver info(Address)</b>
                        <button style="float:right;" id="add_new_address" class="btn btn-primary btn-xs" />Add New Address</button>
                        <!-- <a target="_blank" style="float:right;" href="/index.php/address/create" class="btn btn-success btn-xs" >Add new address</a> -->
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="address_id"><span class="red"> * </span>address_id:</label>
                            <input disabled id="address_id" class="form-control" type="input" name="address_id" value="<?php echo set_value('address_id'); ?>">
                        </div>
                        <div class="form-group">
                            <label for="recevier_name"><span class="red"> * </span>recevier_name:</label>
                            <select id="recevier_name" class="form-control" name="recevier_name">
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
                            <input disabled id="address_detail" class="form-control" type="input" name="address_detail" value="<?php echo set_value('address_detail'); ?>">
                        </div>
                        <div class="form-group">
                            <label for="phone"><span class="red"> * </span>phone:</label>
                            <input disabled id="phone" class="form-control" type="input" name="phone" value="<?php echo set_value('phone'); ?>">
                        </div>
                        <div class="form-group">
                            <label for="recevier_nation_id"><span class="red"> * </span>recevier_nation_id:</label>
                            <input disabled id="recevier_nation_id" class="form-control" type="input" name="recevier_nation_id" value="<?php echo set_value('recevier_nation_id'); ?>">
                        </div>
                    </div>
                </div> 
            </div> 

        </div>
        <!-- /.row -->

        <div class="text-left">
            <input class="btn btn-primary" type="submit" name="submit" value="Add New order" />
        </div>

    <?php echo form_close();?>
</div>

<script type="text/javascript">

    $(document).ready(function(){
        $("#add_new_address_tr").hide();
        $("#add_new_address").click(function(){
            $("#add_new_address_tr").show();
        });

        $("#save_new_address").click(function(){
            save_new_address();
        });

        get_consumer_id();
        $("#consumer_id").change(function(){
            get_consumer_id();
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
        $("#add_product_to_cart").click(function(){
            console.log("add_product_to_cart button is clicked!");
            //get product_item data
            var data = {
                os_product_id : $("#os_product_id").val(),
                product_name : $("#autocomp").val(),
                chemist_price : $("#chemist_price").val(),
                source_type : $("#source_type").val(),
                quantity : $("#quantity").val(),
                sell_price : $("#sell_price").val()
            };
            //post product_item to session
            $.ajax({
                type: 'POST',
                url: 'add_product_to_cart',
                data: data,
                beforeSend: function(data){
                    console.log("this data will post---");
                    console.log(data);
                },
                success: function(msg){
                    console.log(msg);
                }
            });
            parent.document.location.href = "create";
        });

    });
    //save new agent address
    function save_new_address() {
        console.log("save_new_address");
        $("#add_new_address_tr").hide();
       console.log($("#recevier_name").val());

        var recevier_name= $("#recevier_name").val();
        var address_detail=$("#address_detail").val();
        var phone=$("#phone").val();
        var recevier_nation_id=$("#recevier_nation_id").val();
        var agent_id = $("#consumer_id").val();

        // appended new tr
        var newTrStr = '<tr>'+
            '<td style="display:none"></td>'+
            '<td>' + recevier_name + '</td>'+
            '<td>' + address_detail + '</td>'+
            '<td>' + phone + '</td>' +
            '<td>' + recevier_nation_id + '</td>' +
            '<td></td>'+
        '</tr>';
        //$("#agent_address_list_table").prepend(newTrStr);

        var data = {
            recevier_name : recevier_name,
            address_detail : address_detail,
            phone : phone,
            recevier_nation_id : recevier_nation_id,
            agent_id : agent_id
        };
        console.log(data);
        $.ajax({
            type: 'POST',
            url: 'save_new_address',
            data: data,
            beforeSend: function(data){
                console.log("this save_new_address data will post---");
                console.log(data);
            },
            success: function(msg){
                //console.log(msg);
                if(msg == "success") {
                    message('save_new_address Success',1);
                    $("#agent_address_list_table").prepend(newTrStr);
                } else {
                    message('save_new_address fails',0);
                }
               // parent.document.location.href = "create";
            }
        });

    }
    function delete_cart_product(order_product_id) {

        var data = {
            order_product_id : order_product_id
        };
        $.ajax({
            type: 'POST',
            url: 'delete_cart_product',
            data: data,
            beforeSend: function(data){
                console.log("this data will post---");
                console.log(data);
            },
            success: function(msg){
                console.log(msg);
                parent.document.location.href = "create";
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
    function get_consumer_id(){
        var consumer_id = $("#consumer_id").val();
       
        console.log(consumer_id);
        $("#order_code").val(consumer_id);
        //$("#order_code").css("background-color","#FFFFCC");


        var data = {
            consumer_id : consumer_id
        };
        $.ajax({
            type: 'POST',
            url: '/index.php/consumer/get_consumer_json',
            data: data,
            beforeSend: function(){

            },
            success: function(msg){
                var consumer_Obj = new Array();
                consumer_Obj = JSON.parse(msg);//eval(msg);
                console.log(consumer_Obj);
                agent_name_code = consumer_Obj[0]['agent_name_code'];
                console.log(consumer_Obj);
                console.log(consumer_Obj[0]['agent_name_code']);
                $("#order_code").val(agent_name_code+"<?php echo date('Ymd_His');?>");
                $("#order_code_auto").val(agent_name_code+"<?php echo date('Ymd_His');?>");
            }
        });

        $.ajax({
            type: 'POST',
             url: 'get_agent_address_list',
            data: data,
            beforeSend: function(){

            },
            success: function(msg){
                if(msg == "success") {
                    message('save_new_address Success',1);
                   // $("#agent_address_list_table").prepend(newTrStr);
                } else {
                    message('save_new_address fails',0);
                }
               /* var consumer_Obj = new Array();
                consumer_Obj = JSON.parse(msg);//eval(msg);
                console.log(consumer_Obj);
                agent_name_code = consumer_Obj[0]['agent_name_code'];
                console.log(consumer_Obj);
                console.log(consumer_Obj[0]['agent_name_code']);
                $("#order_code").val(agent_name_code+"<?php echo date('Ymd_His');?>");
                $("#order_code_auto").val(agent_name_code+"<?php echo date('Ymd_His');?>");*/
            }
        });

    }
</script>
