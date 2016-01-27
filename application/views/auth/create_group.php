<script type="text/javascript">
    $('#auth_li').addClass('active');
</script>

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">
                 
                <div style="float:left;">
                    <?php echo lang('create_group_heading');?>
                </div> 
                <div style="float:right;">
                </div>
                <div style="clear:both;"></div> 

            </h3>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="/index.php/auth"><?php echo lang('create_group_heading');?></a>
                </li>
                <li class="active">
                    <i class="fa fa-edit"></i> <?php echo lang('create_group_subheading');?>
                </li>
            </ol>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-12">

		    <?php if (validation_errors() !='' ){  ?>
		        <div class="alert alert-danger">
		            <?php echo validation_errors(); ?>
		        </div>
		    <?php  } ?>

			<?php echo form_open("auth/create_group");?>

	        <div class="row">
	            <div class="col-lg-3">

	                <div class="form-group">
	                    <label for="group_name"><span class="red"> * </span> <?php echo lang('create_group_name_label', 'group_name');?> <br /></label>
	                    <input class="form-control" type="input" name="group_name" value="<?php echo set_value('group_name'); ?>">
	                </div>
	                <div class="form-group">
	                    <label for="description"><span class="red">  </span> <?php echo lang('create_group_desc_label', 'description');?> <br /></label>
	                    <input class="form-control" type="input" name="description" value="<?php echo set_value('description'); ?>">
	                </div>
	            </div>

	        </div>
	        <!-- /.row -->

	        <div class="text-left">
	            <input class="btn btn-primary" type="submit" name="submit" value="<?php echo lang('create_group_submit_btn'); ?>" />
	        </div>


			<?php echo form_close();?>
        </div>      
    </div>
</div>