<script type="text/javascript">
    $('#category_li').addClass('active');
</script>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">
                <div style="float:left;">
                    Category List
                </div> 
                <div style="float:right;">
                    <a href="/index.php/category/create" class="btn btn-success" >Add Category</a>
                </div>
                <div style="clear:both;"></div> 

            
            </h3>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="/index.php/category">Category</a>
                </li>
                <li class="active">
                    <i class="fa fa-edit"></i> Category List
                </li>
            </ol>
        </div>
    </div>

    <?php if (validation_errors() !='' ){  ?>
        <div class="alert alert-danger">
            <?php echo validation_errors(); ?>
        </div>
    <?php  } ?>

    <?php if ($update_success !='' ){  ?>
        <div class="alert alert-success">
            <?php echo '<strong>Well Done!</strong> '.$update_success; ?>
        </div>
    <?php  } ?>

        <div class="row" style="margin-bottom:10px;">

                <div class="col-lg-4">
                    <input style="display:none;" class="btn btn-success" type="submit" name="submit" value="Export Producdt List" /><span style="color:#337ab7">Total: <?php echo count($category); ?> Results</span> 
                </div>


        </div>

        <div class="row">
            <div class="col-lg-12">
                <table class="table table-bordered table-hover table-striped" >
                    <tr>
                        <th>Category ID</th>
                        <th>Category Name</th>
                        <th>Is Valid</th>
                        <th>Update time</th>
                        <th>Operation</th>
                    </tr>
                    <?php foreach ($category as $category_item): ?>
                            <tr>
                                <?php echo form_open('category/index/delete') ?>
                                    <td><?php echo $category_item['category_id']; ?></td>
                                    <td><?php echo $category_item['category_name']; ?></td>
                                    <td><?php echo $category_item['is_valid']; ?></td>
                                    <td><?php echo $category_item['update_time']; ?></td>
                                    <td>
                                        <a target="_blank" href="/index.php/product?short_name=&barcode=&brand_id=0&category_id=<?php echo $category_item['category_id']; ?>&stock=0" class="btn btn-success btn-xs" >Product List</a>
                                        <a href="/index.php/category/edit/<?php echo $category_item['category_id']; ?>" class="btn btn-danger btn-xs" >View/Edit</a>
                                        
                                        <input type="hidden" name="category_id" value="<?php echo $category_item['category_id']; ?>">
                                        <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#delete_category_<?php echo $category_item['category_id'];?>">Delete</button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="delete_category_<?php echo $category_item['category_id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                          <div class="modal-dialog">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel">Delete category Confirm</h4>
                                              </div>
                                              <div class="modal-body">
                                                Are you sure you want to delete - <em>"<?php echo $category_item['category_name'];?>" ?</em>
                                              </div>
                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                                <button type="submit" class="btn btn-primary">Yes, Delete</button>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                    </td>
                                </form>
                            </tr>
                    <?php endforeach ?>
                </table>

            </div>
        </div>


</div>

