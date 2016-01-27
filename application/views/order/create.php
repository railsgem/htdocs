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
    <?php echo form_open('order/create') ?>

        <div class="row">
            <div class="col-lg-3">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <b>order</b>
                    </div>
                    <div class="panel-body">
                      
                        <div class="form-group">
                            <label for="order_id"><span class="red"> * </span>order_id:</label>
                            <input class="form-control" type="input" name="order_id" value="<?php echo set_value('order_id'); ?>">
                        </div>
                        <div class="form-group">
                            <label for="os_product_id"><span class="red"> * </span>os_product_id:</label>
                            <input id="os_product_id" class="form-control" type="hidden" name="os_product_id" value="<?php echo set_value('os_product_id'); ?>">
                            <input class="form-control" type="text" id="autocomp" />
                        </div>
                        <div class="form-group">
                            <label for="chemist_price"><span class="red"> * </span>chemist_price:</label>
                            <input disabled id="chemist_price" class="form-control" type="input" name="chemist_price" value="<?php echo set_value('chemist_price'); ?>">
                        </div>
                        <div class="form-group">
                            <label for="sell_price"><span class="red"> * </span>sell_price:</label>
                            <input class="form-control" type="input" name="sell_price" value="<?php echo set_value('sell_price'); ?>">
                        </div>
                    </div>
                </div> 
            </div> 


            <div class="col-lg-6">
                
            </div>

        </div>
        <!-- /.row -->

        <div class="text-left">
            <input class="btn btn-primary" type="submit" name="submit" value="Add New order" />
        </div>

    <?php echo form_close();?>
</div>


<script type="text/javascript">
 
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

</script>

