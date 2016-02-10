<script type="text/javascript">
    $('#stock_li').addClass('active');
</script>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">
                View/Edit stock
            </h3>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="/index.php/stock">stock</a>
                </li>
                <li class="active">
                    <i class="fa fa-edit"></i> View/Edit stock
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


    <?php echo form_open('stock/edit/'.$stock['stock_id']) ?>


        <div class="row">
            <div class="col-lg-3">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <b>View/Edit stock</b>
                    </div>
                    <div class="panel-body">
                      
                        <div class="form-group">
                            <label for="stock_id"><span class="red"> * </span>stock_id:</label>
                            <input disabled class="form-control" type="input" name="stock_id" value="<?php echo $stock['stock_id']; ?>">
                            <input type="hidden" class="form-control" type="input" name="stock_id" value="<?php echo $stock['stock_id']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="os_product_id"><span class="red"> * </span>os_product_name:</label>
                            <input id="os_product_id" class="form-control" type="hidden" name="os_product_id" value="<?php echo $stock['os_product_id'];set_value('os_product_id'); ?>">
                            <input disabled class="form-control" type="text" id="autocomp" value="<?php echo $stock['product_name']; ?>"/>
                        </div><!-- 
                        <div class="form-group">
                            <label for="product_name"><span class="red"> * </span>product_name:</label>
                            <input class="form-control" type="input" name="product_name" value="<?php echo $stock['product_name']; ?>">
                        </div> -->
                        <div class="form-group">
                            <label for="real_cost"><span class="red"> * </span>real_cost:</label>
                            <input class="form-control" type="input" name="real_cost" value="<?php echo $stock['real_cost']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="stock_entry_num"><span class="red"> * </span>stock_entry_num:</label>
                            <input disabled class="form-control" type="input" name="stock_entry_num" value="<?php echo $stock['stock_entry_num']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="stock_despatch_num"><span class="red"> * </span>stock_despatch_num:</label>
                            <input disabled class="form-control" type="input" name="stock_despatch_num" value="<?php echo $stock['stock_despatch_num']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="stock_present_num"><span class="red"> * </span>stock_present_num:</label>
                            <input disabled class="form-control" type="input" name="stock_present_num" value="<?php echo $stock['stock_present_num']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="buy_shop"><span class="red"> * </span>buy_shop:</label>
                            <input class="form-control" type="input" name="buy_shop" value="<?php echo $stock['buy_shop']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="buyer"><span class="red"> * </span>buyer:</label>
                            <input class="form-control" type="input" name="buyer" value="<?php echo $stock['buyer']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="purchase_time"><span class="red"> * </span>purchase_time:</label>
                            <input class="form-control dp" type="input" name="purchase_time" value="<?php echo $stock['purchase_time']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="expire_date"><span class="red"> * </span>expire_date:</label>
                            <input class="form-control dp" type="input" name="expire_date" value="<?php echo $stock['expire_date']; ?>">
                        </div>
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