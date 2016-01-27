<script type="text/javascript">
    $('#auth_li').addClass('active');
</script>

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">
                 
                <div style="float:left;">
                    <?php echo lang('create_user_heading');?>
                </div> 
                <div style="float:right;">
                </div>
                <div style="clear:both;"></div> 

            </h3>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="/index.php/auth"><?php echo lang('create_user_heading');?></a>
                </li>
                <li class="active">
                    <i class="fa fa-edit"></i> <?php echo lang('create_user_subheading');?>
                </li>
            </ol>
        </div>
    </div>



      <?php if (validation_errors() !='' ){  ?>
        <div class="alert alert-danger">
            <?php echo $message;?>
        </div>
      <?php  } ?>

      <?php echo form_open("auth/create_user");?>
      <div class="row">
            <div class="col-lg-3">

                <div class="form-group">
                    <label for="username"><span class="red"> * </span> <?php echo lang('create_user_name_label', 'username');?> <br /></label>
                    <input class="form-control" type="input" name="username" value="<?php echo set_value('username'); ?>">
                </div>
                <div class="form-group">
                    <label for="first_name"><span class="red"> * </span> <?php echo lang('create_user_fname_label', 'first_name');?> <br /></label>
                    <input class="form-control" type="input" name="first_name" value="<?php echo set_value('first_name'); ?>">
                </div>
                <div class="form-group">
                    <label for="last_name"><span class="red">  </span> <?php echo lang('create_user_lname_label', 'last_name');?> <br /></label>
                    <input class="form-control" type="input" name="last_name" value="<?php echo set_value('last_name'); ?>">
                </div>
                <div class="form-group">
                    <label for="company"><span class="red">  </span> <?php echo lang('create_user_company_label', 'company');?> <br /></label>
                    <input class="form-control" type="input" name="company" value="<?php echo set_value('company'); ?>">
                </div>
                <div class="form-group">
                    <label for="email"><span class="red">  </span> <?php echo lang('create_user_email_label', 'email');?> <br /></label>
                    <input class="form-control" type="input" name="email" value="<?php echo set_value('email'); ?>">
                </div>
                <div class="form-group">
                    <label for="phone"><span class="red">  </span> <?php echo lang('create_user_phone_label', 'phone');?> <br /></label>
                    <input class="form-control" type="input" name="phone" value="<?php echo set_value('phone'); ?>">
                </div>
                <div class="form-group">
                    <label for="password"><span class="red">  </span> <?php echo lang('create_user_password_label', 'password');?> <br /></label>
                    <input class="form-control" type="password" name="password" value="<?php echo set_value('password'); ?>">
                </div>
                <div class="form-group">
                    <label for="password_confirm"><span class="red">  </span> <?php echo lang('create_user_password_confirm_label', 'password_confirm');?> <br /></label>
                    <input class="form-control" type="password" name="password_confirm" value="<?php echo set_value('password_confirm'); ?>">
                </div>
            </div>

        </div>
        <!-- /.row -->

        <div class="text-left">
            <input class="btn btn-primary" type="submit" name="submit" value="<?php echo lang('create_user_submit_btn'); ?>" />
        </div>

      <?php echo form_close();?>

</div>