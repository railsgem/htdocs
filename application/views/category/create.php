<script type="text/javascript">
    $('#category_li').addClass('active');
</script>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">
                Add Category
            </h3>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="/index.php/category">Category</a>
                </li>
                <li class="active">
                    <i class="fa fa-edit"></i> Add Category
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
    <?php echo form_open('category/create') ?>


        <div class="row">
            <div class="col-lg-6">

                <div class="form-group">
                    <label for="category_name"><span class="red"> * </span>Category Name:</label>
                    <input class="form-control" type="input" name="category_name" value="<?php echo set_value('category_name'); ?>">
                </div>

                <div class="form-group">
                <label for="is_valid"><span class="red"> * </span>is_valid:</label>
                <select class="form-control" name="is_valid">
                    <option value="1" <?php if ("1" === set_value('size_id')) { echo "selected"; } ?>>生效</option>
                    <option value="0" <?php if ("1" === set_value('size_id')) { echo "selected"; } ?>>失效</option>
                </select>
                </div>
            </div>

        </div>
        <!-- /.row -->

        <div class="text-left">
            <input class="btn btn-primary" type="submit" name="submit" value="Add New Category" />
        </div>

    </form>
</div>