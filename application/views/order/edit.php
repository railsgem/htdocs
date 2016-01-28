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

