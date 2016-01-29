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
     <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <b>Product</b>
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
                <button id="add_product_to_cart" class="btn btn-primary" />Add to Cart</button>
            </div>
        </div> 
    </div> 

    <?php echo form_open('order/create') ?>

        <div class="row">
            <div class="col-lg-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <b>order</b>
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
                    </div>
                </div> 

            </div> 
            
            <div class="col-lg-3">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <b>Receiver info(Address)</b>
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
            }
            console.log(data);

            var cart_data = new Array();
            cart_data.push(data);
            console.log(cart_data);

            //post product_item to session
            $.ajax({
                type: 'POST',
                url: 'order_cart',
                data: data,
                beforeSend: function(data){
                    console.log("this data will post---");
                    console.log(data);
                },
                success: function(msg){
                    console.log(msg);
                }
            });

           /* var data = {
                product : $("#product").html()
            }
            console.log("product:"+product);
            console.log(product);
            $.ajax({
                type: 'POST',
                url: 'fetch/save_fetch',
                data: data,
                beforeSend: function(){
                },
                success: function(msg){
                }
            });*/

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
    }
</script>
