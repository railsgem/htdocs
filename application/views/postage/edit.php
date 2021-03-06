<script type="text/javascript">
    $('#postage_li').addClass('active');
</script>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">
                View/Edit postage
            </h3>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="/index.php/postage">postage</a>
                </li>
                <li class="active">
                    <i class="fa fa-edit"></i> View/Edit postage
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


    <?php echo form_open('postage/edit/'.$postage['postage_id']) ?>


        <div class="row">
            <div class="col-lg-3">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <b>View/Edit postage</b>
                    </div>
                    <div class="panel-body">
                      
                        <div class="form-group">
                            <label for="postage_company_id"><span class="red"> * </span>postage_company_id:</label>


                            <select class="form-control" name="postage_company_id">

                            <?php foreach ($postage_company as $postage_company_item): ?>
                                <option value="<?php echo $postage_company_item['postage_company_id'] ?>" <?php if ($postage_company_item['postage_company_id'] === $postage['postage_company_id']) { echo "selected"; } ?>><?php echo $postage_company_item['postage_company_name'] ?></option>
                            <?php endforeach ?>

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="postage_date"><span class="red"> * </span>postage_date:</label>
                            <input class="form-control dp" type="input" name="postage_date" value="<?php echo $postage['postage_date']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="postage_code"><span class="red"> * </span>postage_code:</label>
                            <input class="form-control" type="input" name="postage_code" value="<?php echo $postage['postage_code']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="postage_fee"><span class="red"> * </span>postage_fee:</label>
                            <input class="form-control" type="input" name="postage_fee" value="<?php echo $postage['postage_fee']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="postage_weight">postage_weight:</label>
                            <input class="form-control" type="input" name="postage_weight" value="<?php echo $postage['postage_weight']; ?>">
                        </div>
                        <div class="form-group">
                        <label for="postage_free"><span class="red"> * </span>postage_free:</label>
                            <select class="form-control" name="postage_free">
                                <option value="1" <?php if ("1" === set_value('postage_free')) { echo "selected"; } ?>>包邮</option>
                                <option value="0" <?php if ("0" === set_value('postage_free')) { echo "selected"; } ?>>不包邮</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="remark">remark:</label>
                            <input class="form-control" type="input" name="remark" value="<?php echo set_value('remark'); ?>">
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