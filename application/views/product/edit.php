<script type="text/javascript">
    $('#product_li').addClass('active');
</script>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">
                View/Edit product
            </h3>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="/index.php/product">product</a>
                </li>
                <li class="active">
                    <i class="fa fa-edit"></i> View/Edit product
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


    <?php echo form_open('product/edit/'.$product['os_product_id']) ?>


        <div class="row">
            <div class="col-lg-3">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <b>View/Edit product</b>
                    </div>
                    <div class="panel-body">
                      
                        <div class="form-group">
                            <label for="os_product_id"><span class="red"> * </span>os_product_id:</label>
                            <input disabled class="form-control" type="input" name="os_product_id" value="<?php echo $product['os_product_id']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="product_name"><span class="red"> * </span>product_name:</label>
                            <input class="form-control" type="input" name="product_name" value="<?php echo $product['product_name']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="small_img_src">small_img_src:</label>
                            <input class="form-control" type="input" name="small_img_src" value="<?php echo $product['small_img_src']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="big_img_src">big_img_src:</label>
                            <input class="form-control" type="input" name="big_img_src" value="<?php echo $product['big_img_src']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="chemist_price"><span class="red"> * </span>chemist_price:</label>
                            <input class="form-control" type="input" name="chemist_price" value="<?php echo $product['chemist_price']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="source_type"><span class="red"> * </span>source_type:</label>
                            <input disabled class="form-control" type="input" name="source_type" value="<?php echo $product['source_type']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="remark">remark:</label>
                            <input class="form-control" type="input" name="remark" value="<?php echo $product['remark']; ?>">
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