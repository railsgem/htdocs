<script type="text/javascript">
    $('#product_li').addClass('active');
</script>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">
                Add product
            </h3>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="/index.php/product">product</a>
                </li>
                <li class="active">
                    <i class="fa fa-edit"></i> Add product
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
    <?php echo form_open('product/create') ?>

        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="product_name"><span class="red"> * </span>product_name:</label>
                    <input id="product_name" class="form-control" name="product_name" value="<?php echo set_value('product_name'); ?>">
                   <!--  <input class="form-control" type="text" id="autocomp" /> -->
                </div>
                <div class="form-group">
                    <label for="chemist_price"><span class="red"> * </span>cost price:</label>
                    <input id="chemist_price" class="form-control" type="input" name="chemist_price" value="<?php echo set_value('chemist_price'); ?>">
                </div>
                <div class="form-group">
                    <label for="small_img_src">small_img_src:</label>
                    <input class="form-control" type="input" name="small_img_src" value="<?php echo set_value('small_img_src'); ?>">
                </div>
                <div class="form-group">
                    <label for="big_img_src">big_img_src:</label>
                    <input id="big_img_src" class="form-control" type="input" name="big_img_src" value="<?php echo set_value('big_img_src'); ?>">
                </div>
                <div class="form-group">
                    <label for="remark">remark:</label>
                    <input class="form-control" type="input" name="remark" value="<?php echo set_value('remark'); ?>">
                </div>
            </div>

        </div>
        <!-- /.row -->

        <div class="text-left">
            <input class="btn btn-primary" type="submit" name="submit" value="Add New product" />
        </div>

    <?php echo form_close();?>
</div>

<script type="text/javascript">
 
    $("#autocomp").autocomplete({
        source: "get_product_json",
        minLength: 2, 
        select: function(e, ui) {
            console.log(ui);
            $("#os_product_id").val(ui.item.id);
            $("#chemist_price").val(ui.item.chemist_price);
            $("#source_type").val(ui.item.source_type);
            //$("#autocomp").val(ui.item.label);
            //alert(ui.item.label + ui.item.value) ;
        }
    });

</script>