<script type="text/javascript">
    $('#consumer_li').addClass('active');
</script>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">
                View/Edit consumer
            </h3>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="/index.php/consumer">consumer</a>
                </li>
                <li class="active">
                    <i class="fa fa-edit"></i> View/Edit consumer
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


    <?php echo form_open('consumer/edit/'.$consumer['consumer_id']) ?>


        <div class="row">
            <div class="col-lg-3">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <b>View/Edit consumer</b>
                    </div>
                    <div class="panel-body">
                      
                    <div class="form-group">
                        <label for="consumer_name"><span class="red"> * </span>consumer_name:</label>
                        <input class="form-control" type="input" name="consumer_name" value="<?php echo $consumer['consumer_name']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="consumer_nation_id"><span class="red"> * </span>consumer_nation_id:</label>
                        <input class="form-control" type="input" name="consumer_nation_id" value="<?php echo $consumer['consumer_nation_id']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="consumer_address"><span class="red"> * </span>consumer_address:</label>
                        <input class="form-control" type="input" name="consumer_address" value="<?php echo $consumer['consumer_address']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="consumer_phone"><span class="red"> * </span>consumer_phone:</label>
                        <input class="form-control" type="input" name="consumer_phone" value="<?php echo $consumer['consumer_phone']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="consumer_postcode"><span class="red"> * </span>consumer_postcode:</label>
                        <input class="form-control" type="input" name="consumer_postcode" value="<?php echo $consumer['consumer_postcode']; ?>">
                    </div>
                    <label for="is_agent"><span class="red"> * </span>is_agent:</label>
                    <select class="form-control" name="is_agent">
                      <option value ="1" <?php if ($consumer['is_agent'] === "1") { echo "selected"; } ?> >1</option>
                      <option value ="0" <?php if ($consumer['is_agent'] === "0") { echo "selected"; } ?>>0</option>
                    </select>
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