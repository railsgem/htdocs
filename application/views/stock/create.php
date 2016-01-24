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
                    <label for="os_product_id"><span class="red"> * </span>os_product_id:</label>
                    <select class="form-control" name="os_product_id">
                        <?php foreach ($product as $product_item): ?>
                            <option value="<?php echo $product_item['os_product_id'] ?>" <?php if ($product_item['os_product_id'] === set_value('os_product_id')) { echo "selected"; } ?>><?php echo $product_item['product_name'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="real_cost"><span class="red"> * </span>real_cost:</label>
                    <input class="form-control" type="input" name="real_cost" value="<?php echo set_value('real_cost'); ?>">
                </div>
                <div class="form-group">
                    <label for="stock_num"><span class="red"> * </span>stock_num:</label>
                    <input class="form-control" type="input" name="stock_num" value="<?php echo set_value('stock_num'); ?>">
                </div>
                <div class="form-group">
                    <label for="buy_shop"><span class="red"> * </span>buy_shop:</label>
                    <input class="form-control" type="input" name="buy_shop" value="<?php echo set_value('buy_shop'); ?>">
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