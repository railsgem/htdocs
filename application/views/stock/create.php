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
                    <input id="os_product_id" class="form-control" type="hidden" name="os_product_id" value="<?php echo set_value('os_product_id'); ?>">
                    <input class="form-control" type="text" id="autocomp" />
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

</script>