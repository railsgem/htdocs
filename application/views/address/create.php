<script type="text/javascript">
    $('#address_li').addClass('active');
</script>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">
                Add address
            </h3>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="/index.php/address">address</a>
                </li>
                <li class="active">
                    <i class="fa fa-edit"></i> Add address
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
    <?php echo form_open('address/create') ?>

        <div class="row">
            <div class="col-lg-3">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <b>address</b>
                    </div>
                    <div class="panel-body">
                      
                        <div class="form-group">
                            <label for="address_detail"><span class="red"> * </span>address_detail:</label>
                            <input class="form-control" type="input" name="address_detail" value="<?php echo set_value('address_detail'); ?>">
                        </div>
                        <div class="form-group">
                            <label for="phone"><span class="red"> * </span>phone:</label>
                            <input class="form-control" type="input" name="phone" value="<?php echo set_value('phone'); ?>">
                        </div>
                        <div class="form-group">
                            <label for="recevier_name"><span class="red"> * </span>recevier_name:</label>
                            <input class="form-control" type="input" name="recevier_name" value="<?php echo set_value('recevier_name'); ?>">
                        </div>
                    </div>
                </div> 
            </div> 


        </div>
        <!-- /.row -->

        <div class="text-left">
            <input class="btn btn-primary" type="submit" name="submit" value="Add New address" />
        </div>

    <?php echo form_close();?>
</div>