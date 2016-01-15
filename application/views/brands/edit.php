<script type="text/javascript">
    $('#brand_li').addClass('active');
</script>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">
                View/Edit brand
            </h3>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="/index.php/brands">brand</a>
                </li>
                <li class="active">
                    <i class="fa fa-edit"></i> View/Edit brand
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


    <?php echo form_open('brands/edit/'.$brands['brand_id']) ?>


        <div class="row">
            <div class="col-lg-6">

                <div class="form-group">
                    <label for="brand_name"><span class="red"> * </span>brand Name:</label>
                    <input class="form-control" type="input" name="brand_name" value="<?php echo $brands['brand_name']; ?>">
                </div>
            </div>


        </div>
        <!-- /.row -->

        <div class="text-left">
            <input class="btn btn-primary" type="submit" name="submit" value="Save" />
        </div>

    </form>
</div>