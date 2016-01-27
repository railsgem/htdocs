<script type="text/javascript">
    $('#auth_li').addClass('active');
</script>

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">
                 
                <div style="float:left;">
                    <?php echo lang('edit_user_heading');?>
                </div> 
                <div style="float:right;">
                </div>
                <div style="clear:both;"></div> 

            </h3>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="/index.php/auth"><?php echo lang('edit_user_heading');?></a>
                </li>
                <li class="active">
                    <i class="fa fa-edit"></i> <?php echo lang('edit_user_subheading');?>
                </li>
            </ol>
        </div>
    </div>

<div id="infoMessage"><?php echo $message;?></div>

    <?php if (validation_errors() !='' ){  ?>
        <div class="alert alert-danger">
            <?php echo $message;?>
        </div>
    <?php  } ?>
<?php echo form_open(uri_string());?>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="user_name"><span class="red"> * </span> <?php echo "User Name:";?> <br /></label>
                <input class="form-control" type="input" name="user_name" value="<?php echo $user->username; ?>" disabled>
            </div>
            <div class="form-group">
                <label for="first_name"><span class="red"> * </span> <?php echo lang('edit_user_fname_label', 'first_name');?> <br /></label>
                <input class="form-control" type="input" name="first_name" value="<?php echo $user->first_name; ?>">
            </div>
            <div class="form-group">
                <label for="last_name"><span class="red"> * </span> <?php echo lang('edit_user_lname_label', 'last_name');?> <br /></label>
                <input class="form-control" type="input" name="last_name" value="<?php echo $user->last_name; ?>">
            </div>
            <div class="form-group">
                <label for="company"><span class="red"> * </span> <?php echo lang('edit_user_company_label', 'company');?> <br /></label>
                <input class="form-control" type="input" name="company" value="<?php echo $user->company; ?>">
            </div>
            <div class="form-group">
                <label for="phone"><span class="red"> * </span> <?php echo lang('edit_user_phone_label', 'phone');?> <br /></label>
                <input class="form-control" type="input" name="phone" value="<?php echo $user->phone; ?>">
            </div>

            <div class="form-group">
                <label for="password"><span class="red"> * </span><?php echo lang('edit_user_password_label', 'password');?> </label>
                <input class="form-control" type="input" name="password" value="">
            </div>
            <div class="form-group">
                <label for="password_confirm"><span class="red"> * </span> <?php echo lang('edit_user_password_confirm_label', 'password_confirm');?> <br /></label>
                <input class="form-control" type="input" name="password_confirm" value="">
            </div>
        </div>
        <div style="display:none" class="col-lg-6">
        <?php if ($this->ion_auth->is_admin()): ?>

                <h3><?php echo lang('edit_user_groups_heading');?></h3>
                <?php foreach ($groups as $group):?>
                    <label class="checkbox">
                    <?php
                        $gID=$group['id'];
                        $checked = null;
                        $item = null;
                        foreach($currentGroups as $grp) {
                            if ($gID == $grp->id) {
                                $checked= ' checked="checked"';
                            break;
                            }
                        }
                    ?>
                    <input type="checkbox" name="groups[]" value="<?php echo $group['id'];?>"<?php echo $checked;?>>
                    <?php echo htmlspecialchars($group['name'],ENT_QUOTES,'UTF-8');?>
                    </label>
                <?php endforeach?>

            <?php endif ?>

            <?php echo form_hidden('id', $user->id);?>
            <?php echo form_hidden($csrf); ?>
        </div>

        <div class="col-lg-6">
        <?php if ($this->ion_auth->is_admin()): ?>

                <h3><?php echo "User privileges";?></h3>
                <?php foreach ($privileges as $privilege):?>
                    <div <?php if($privilege['id']==9 ) echo "style='display:none'"; ?> class="checkbox">
                        <label class="checkbox">
                        <?php
                            $pID=$privilege['id'];
                            $checked = null;
                            $item = null;
                            foreach($currentPrivileges as $prg) {
                                if ($pID == $prg->id) {
                                    $checked= ' checked="checked"';
                                break;
                                }
                            }
                        ?>
                        <input type="checkbox" name="privileges[]" value="<?php echo $privilege['id'];?>"<?php echo $checked;?>>
                        <?php echo htmlspecialchars($privilege['description'],ENT_QUOTES,'UTF-8');?>
                        </label>
                    </div>
                <?php endforeach?>

            <?php endif ?>

            <?php echo form_hidden('id', $user->id);?>
            <?php echo form_hidden($csrf); ?>
        </div>
    </div>
    <!-- /.row -->
    <div class="text-left">
        <input class="btn btn-primary" type="submit" name="submit" value="<?php echo lang('edit_user_submit_btn');?>" />
    </div>


<?php echo form_close();?>
