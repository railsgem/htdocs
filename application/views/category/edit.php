<script type="text/javascript">
    $('#category_li').addClass('active');
</script>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">
                View/Edit Category
            </h3>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="/index.php/category">Category</a>
                </li>
                <li class="active">
                    <i class="fa fa-edit"></i> View/Edit Category
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
            <a href="/index.php/category" class="btn btn-success btn-xs">Return Category List</a>
            <a href="/index.php/category/create" class="btn btn-success btn-xs">Add New Category</a>
        </div>

    <?php  } ?>


    <?php echo form_open('category/edit/'.$category['category_id']) ?>


        <div class="row">
            <div class="col-lg-6">

                <div class="form-group">
                    <label for="category_name"><span class="red"> * </span>Category Name:</label>
                    <input class="form-control" type="input" name="category_name" value="<?php echo $category['category_name']; ?>">
                </div>

                <div class="form-group">
                <label for="is_valid"><span class="red"> * </span>is_valid:</label>
                <select class="form-control" name="is_valid">
                  <option value ="1" <?php if ($category['is_valid'] === "1") { echo "selected"; } ?> >生效</option>
                  <option value ="0" <?php if ($category['is_valid'] === "0") { echo "selected"; } ?>>失效</option>
                </select>
                </div>
            </div>

        </div>
        <!-- /.row -->

        <div class="text-left">
            <input class="btn btn-primary" type="submit" name="submit" value="Save" />
        </div>

    </form>
</div>