<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">
                Change Password
            </h3>
        </div>
    </div>
    <!-- /.row -->
    <?php echo $message;?>
    <?php echo form_open("auth/change_password");?>


      <div class="form-group">
          <label for="old_password" class="col-sm-2 control-label">Old Password</label>
          <div class="col-sm-4">
            <?php echo form_input($old_password);?>
          </div>
        </div>
        <div class="form-group">
          <label for="new_password" class="col-sm-2 control-label">New Password</label>
          <div class="col-sm-4">
            <?php echo form_input($new_password);?>
          </div>
        </div>
        <div class="form-group">
          <label for="new_password_confirm" class="col-sm-2 control-label">Confirm New Password</label>
          <div class="col-sm-4">
            <?php echo form_input($new_password_confirm);?>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-4">
            <button type="submit" class="btn btn-success">Submit</button>
          </div>
        </div>

    <?php echo form_close();?>
</div>
<script type="text/javascript">
$("#old").addClass("form-control");
$("#new").addClass("form-control");
$("#new_confirm").addClass("form-control");
$("form").addClass("form-horizontal");
</script>
