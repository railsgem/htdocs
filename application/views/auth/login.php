<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">
                Sign in
            </h3>
        </div>
    </div>
    <!-- /.row -->
    <?php echo $message;?>
    <?php echo form_open("auth/login");?>


      <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Username</label>
          <div class="col-sm-4">
            <?php echo form_input($identity);?>
          </div>
        </div>
        <div class="form-group">
          <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
          <div class="col-sm-4">
            <?php echo form_input($password);?>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-4">
            <div class="checkbox">
              <label>
                <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?> Remember me
              </label>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-4">
            <button type="submit" class="btn btn-success">Sign in</button>
          </div>
        </div>

    <?php echo form_close();?>
</div>
<script type="text/javascript">
$("#identity").addClass("form-control");
$("#password").addClass("form-control");
$("form").addClass("form-horizontal");
</script>