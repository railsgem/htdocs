<script type="text/javascript">
    $('#postage_company_li').addClass('active');
</script>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">
                View/Edit postage_company
            </h3>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="/index.php/postage_company">postage_company</a>
                </li>
                <li class="active">
                    <i class="fa fa-edit"></i> View/Edit postage_company
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


    <?php echo form_open('postage_company/edit/'.$postage_company['postage_company_id']) ?>


        <div class="row">
            <div class="col-lg-3">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <b>View/Edit postage_company</b>
                    </div>
                    <div class="panel-body">
                      
                        <div class="form-group">
                            <label for="postage_company_name"><span class="red"> * </span>postage_company_name:</label>
                            <input class="form-control" type="input" name="postage_company_name" value="<?php echo $postage_company['postage_company_name']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="postage_website"><span class="red"> * </span>postage_website:</label>
                            <input class="form-control" type="input" name="postage_website" value="<?php echo $postage_company['postage_website']; ?>">
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