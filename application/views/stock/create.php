<script type="text/javascript">
    $('#stock_li').addClass('active');
</script>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">
                Add stock
            </h3>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="/index.php/stock">stock</a>
                </li>
                <li class="active">
                    <i class="fa fa-edit"></i> Add stock
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
    <?php echo form_open('stock/create') ?>

        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="os_product_id"><span class="red"> * </span>os_product_name:</label>
                    <!-- <input id="os_product_id" class="form-control" type="hidden" name="os_product_id" value="<?php //echo set_value('os_product_id'); ?>">
                    <input class="form-control" type="text" id="autocomp" /> -->

                    <select id="os_product_id" name="os_product_id" data-placeholder="Choose a Product..." class="chosen-select" tabindex="3">
                        <?php foreach ($product as $product_item): ?>
                            <option value="<?php echo $product_item['os_product_id'] ?>" <?php if ($product_item['os_product_id'] === set_value('os_product_id')) { echo "selected"; } ?>><?php echo $product_item['product_name'] ?></option>
                        <?php endforeach ?>
                    </select>

                </div>
                <div class="form-group">
                    <label for="real_cost"><span class="red"> * </span>real_cost:</label>
                    <input id="chemist_price" class="form-control" type="input" name="real_cost" value="<?php echo set_value('real_cost'); ?>">
                </div>
                <div class="form-group">
                    <label for="stock_entry_num"><span class="red"> * </span>stock_entry_num:</label>
                    <input class="form-control" type="input" name="stock_entry_num" value="<?php echo set_value('stock_entry_num'); ?>">
                </div>
                <div class="form-group">
                    <label for="buy_shop"><span class="red"> * </span>buy_shop:</label>
                    <input id="source_type" class="form-control" type="input" name="buy_shop" value="<?php echo set_value('buy_shop'); ?>">
                </div>
                <div class="form-group">
                    <label for="buyer"><span class="red"> * </span>buyer:</label>
                    <input class="form-control" type="input" name="buyer" value="<?php echo set_value('buyer'); ?>">
                </div>
                <div class="form-group" >
                    <label for="purchase_time"><span class="red"> * </span>purchase_time:</label>
                    <?php
                        $today = date("Y-m-d");   
                    ?>
                    <input id="purchase_time" type="text" class="form-control dp" type="input" name="purchase_time" value="<?php echo set_value('purchase_time',$today); ?>">
                </div>
                <div class="form-group" >
                    <label for="expire_date"><span class="red"> * </span>expire_date:</label>
                    <?php
                        $today = date("Y-m-d");   
                    ?>
                    <input id="expire_date" type="text" class="form-control dp" type="input" name="expire_date" value="<?php echo set_value('expire_date',$today); ?>">
                </div>
            </div>

        </div>
        <!-- /.row -->

        <div class="text-left">
            <input class="btn btn-primary" type="submit" name="submit" value="Add New stock" />
        </div>

    <?php echo form_close();?>
</div>

<script type="text/javascript">
    $("#autocomp").autocomplete({
        source: "get_product_json",
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
                url: 'get_product_json_by_id',
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
    })
</script>
