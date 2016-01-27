<script type="text/javascript">
    $('#postage_li').addClass('active');
</script>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">
                Add postage
            </h3>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="/index.php/postage">postage</a>
                </li>
                <li class="active">
                    <i class="fa fa-edit"></i> Add postage
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
    <?php echo form_open('postage/create') ?>

        <div class="row">
            <div class="col-lg-3">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <b>postage</b>
                    </div>
                    <div class="panel-body">
                      
                        <div class="form-group">
                            <label for="postage_company_id"><span class="red"> * </span>postage_company_id:</label>
                            <input class="form-control" type="input" name="postage_company_id" value="<?php echo set_value('postage_company_id'); ?>">
                        </div>
                        <div class="form-group">
                            <label for="postage_date"><span class="red"> * </span>postage_date:</label>
                            <input class="form-control" type="input" name="postage_date" value="<?php echo set_value('postage_date'); ?>">
                        </div>
                        <div class="form-group">
                            <label for="postage_code"><span class="red"> * </span>postage_code:</label>
                            <input class="form-control" type="input" name="postage_code" value="<?php echo set_value('postage_code'); ?>">
                        </div>
                    </div>
                </div> 
            </div> 


        </div>
        <!-- /.row -->

        <div class="text-left">
            <input class="btn btn-primary" type="submit" name="submit" value="Add New postage" />
        </div>

    <?php echo form_close();?>
</div>