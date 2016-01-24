<script type="text/javascript">
    $('#product_li').addClass('active');
</script>

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">
                <div style="float:left;">
                    Product List
                </div> 
                <div style="float:right;">
                    <a href="/index.php/product/create" class="btn btn-success " >Add a Product</a>
                    <a href="/index.php/product/import_product" class="btn btn-success " >Batch Import Product</a>
                    <a href="/index.php/product/import_record" class="btn btn-success " >Update Stock</a>
                    <a href="/index.php/product/download_kounta_file" class="btn btn-success " >Download Kounta Stock File</a>
                    <a href="/index.php/product/download_products" class="btn btn-success " >Export All Product</a>
                    <a style="display:none;" href="/index.php/product/import_purchase" class="btn btn-success " >Import Purchase Order</a>
                    <a href="/index.php/product/report" class="btn btn-success " >Transaction Report</a>
                    <a style="display:none;" href="/index.php/product/history" class="btn btn-success " >Operation History</a>
                    
                </div>
                <div style="clear:both;"></div>
            </h3>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="/index.php/product">Warehouse</a>
                </li>
                <li class="active">
                    <i class="fa fa-edit"></i> Product List
                </li>
            </ol>
        </div>
    </div>

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

    <?php echo form_open('product' , array('method'=>'get','name'=>'productlist','id'=>'productlist')) ?>

        <div class="row">
            <div class="col-lg-12">
                <div class="form-inline well center-block">
                    <div class="form-group">
                        <label for="short_name">Product Name:</label>
                        <input type="text" style="width:180px;" class="form-control" name="short_name" value="<?php if (isset($_GET['short_name'])) {echo $_GET['short_name'];} ?>">
                    </div>
                    <div class="form-group">
                        <label for="barcode">Barcode:</label>
                        <input type="text" style="width:100px;" class="form-control" name="barcode" value="<?php if (isset($_GET['barcode'])) {echo $_GET['barcode'];} ?>">
                    </div>

                    <div class="form-group">
                        <label for="stock">Location:</label>
                        <select class="form-control" name="location" >
                            <option value="all">All</option>

                            <?php foreach ($location as $location_item): ?>
                                <option value="<?php echo $location_item['wh_loc']?>"<?php 
                            if (isset($_GET['location']))
                            {
                                if ( $_GET['location'] == $location_item['wh_loc']) 
                                    {echo 'selected';}
                            }
                            ?>><?php echo $location_item['wh_loc']?></option>
                            <?php endforeach ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="stock">Stock:</label>
                        <select class="form-control" name="stock" >
                            <option value=0>All</option>
                            <option value=1 <?php 
                            if (isset($_GET['stock']))
                            {
                                if ( $_GET['stock'] == '1') 
                                    {echo 'selected';}
                            }
                            ?>>Under Purchase Line</option>
                            <option value=2 <?php 
                            if (isset($_GET['stock']))
                            {
                                if ( $_GET['stock'] == '2') 
                                    {echo 'selected';}
                            }
                            ?>>Under Min Reserve Line</option>
                        </select>
                    </div>
                    <input type="hidden" name="delete_product_id" value="">
                    <button type="submit" class="btn btn-primary">Search</button>
                    
                </div>
            </div>
        </div>
    </form>

        <?php echo form_open('product' , array('target'=>'_blank','method'=>'post','name'=>'batch_delete','id'=>'batch_delete')) ?>
            <input type="hidden" name="batch_delete_product_id" id="batch_delete_product_id" value="">
        </form>

        <?php echo form_open('product' , array('target'=>'_blank')) ?>

            <div class="row" style="margin-bottom:10px;">

                    <div class="col-lg-4">
                        <button type="submit" class="btn btn-info btn-xs" >Print Label</button>&nbsp;&nbsp;&nbsp;
                        <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#batch_delete_product">Delete</button>&nbsp;&nbsp;&nbsp;
                        <span style="color:#337ab7">Total: <?php echo $total; ?> Results</span> 
                    </div>
                    <div class="col-lg-8 text-right">
                        <div class="page_section" style="float:right; ">
                        <?php echo $page_section; ?>
                        </div>
                    </div>

            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped" >
                            <thead>
                                <tr>
                                    <th><input type="checkbox" name="tickall" id="tickall" value="ON"> All</th>
                                    <th>Chemist Product ID</th>
                                    <th>Product Name</th>
                                    <th>Chemist Price</th>
                                    <th>Chemist img(click to big img)</th>
                                    <th>Source</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $indexID = 0;?>
                            <?php foreach ($product as $product_item): ?>
                                <?php $indexID = $indexID+1;?>

                                <tr>
                                    <td>
                                        <input type="checkbox" name="print_<?php echo $indexID?>" class="tick" value="ON">
                                        <input type="hidden" name="temp_product_id"  value="<?php echo $product_item['os_product_id']; ?>">
                                    </td>
                                    <td><?php echo $product_item['chemist_product_id']; ?></td>
                                    <td><?php echo $product_item['product_name']; ?></td>
                                    <td><?php echo $product_item['chemist_price']; ?></td>
                                    <div class="col-xs-1 col-md-1">
                                    <td class="col-xs-1 col-md-1">
                                        <a  target="_blank" href="<?php echo $product_item['big_img_src']; ?>" class="thumbnail">
                                          <img src="<?php echo $product_item['small_img_src']; ?>" alt="<?php echo $product_item['small_img_src']; ?>">
                                        </a>
                                    </td>
                                    </div>
                                    <td><?php echo $product_item['source_type']; ?></td>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="row" style="margin-bottom:10px;">

                    <div class="col-lg-4">
                        <span style="color:#337ab7">Total: <?php echo $total; ?> Results</span> 
                    </div>
                    <div class="col-lg-8 text-right">
                        <div class="page_section" style="float:right; ">
                        <?php echo $page_section; ?>
                        </div>
                    </div>

            </div>

        </form>
</div>

<?php
    $url_para = '?';
    if (isset($_GET['short_name']))
        {$url_para .='short_name='.str_replace('\'','',$_GET['short_name']);}
    if (isset($_GET['barcode']))
        {$url_para .='&barcode='.$_GET['barcode'];}
    if (isset($_GET['location']))
        {$url_para .='&location='.$_GET['location'];}
    if (isset($_GET['stock']))
        {$url_para .='&stock='.$_GET['stock'];}
?>
<script type="text/javascript">

    $(".page_section").children("a").each(function(){
        //alert('aaa');
        $(this).attr('href',$(this).attr('href')+'<?php echo $url_para;?>');
        //alert($(this).attr('href'));
      });
    $('#batch_delete').prop('action','/index.php/product<?php echo $url_para;?>')

    function delete_product(product_id) {
        //alert(product_id);
        $('input[name=delete_product_id]').val(product_id);
        $('#productlist').submit();
    }

    function batch_delete_product() {
        var batch_product_id = '';
        $(".tick").each(function(){
            if ($(this).is(':checked')) {
               if (batch_product_id == '') {
                    batch_product_id = $(this).next().val();
               } else{
                    batch_product_id = batch_product_id+','+$(this).next().val();
               }
            }
          });
        //alert(batch_product_id);
        $('#batch_delete_product_id').val(batch_product_id);
        $('#batch_delete').submit();
    }



      $(document).ready(function(){

        $('#tickall').click(function(){
            if ($('#tickall').is(':checked')) {
                $(".tick").prop("checked",true);
            }else{
                $(".tick").prop("checked",false);
            }

        });

        $(".purchase_line").blur(function(){
                var product_id = $(this).prev().val();
                var old_value = $(this).attr('data');
                var new_value = $(this).val();
                if ( product_id == parseInt(product_id, 10) && new_value == parseInt(new_value, 10) && old_value == parseInt(old_value, 10)) {
                    if (parseInt(old_value, 10) != parseInt(new_value, 10)) {
                        $.ajax({
                            url:'/index.php/product/quick_update_purchase_line/'+product_id+'/'+new_value,
                            type: "GET",

                            dataType: "text",
                            success: function(response) {
                                if (response =='success') {
                                    message('Update Purchase Warning Line Success',1);
                                }else{
                                    message('Update Purchase Warning Line Fail',0);
                                }
                            }

                        })
                    }
                }else{
                    message("Invalid Value!",0)
                }
        });   

        $(".reserve_line").blur(function(){
                var product_id = $(this).prev().val();
                var old_value = $(this).attr('data');
                var new_value = $(this).val();
                if ( product_id == parseInt(product_id, 10) && new_value == parseInt(new_value, 10) && old_value == parseInt(old_value, 10)) {
                    if (parseInt(old_value, 10) != parseInt(new_value, 10)) {
                        $.ajax({
                            url:'/index.php/product/quick_update_reserve_line/'+product_id+'/'+new_value,
                            type: "GET",

                            dataType: "text",
                            success: function(response) {
                                if (response =='success') {
                                    message('Update Minimum Reserve Line Success',1);
                                }else{
                                    message('Update Minimum Reserve Line Fail',0);
                                }
                            }

                        })
                    }
                }else{
                    message("Invalid Value!",0)
                }
        });  

        $(".wh_loc").blur(function(){
        var product_id = $(this).prev().val();
        var old_value = $(this).attr('data');
        var new_value = $(this).val();
        if ( product_id == parseInt(product_id, 10)) {
            if (old_value!= new_value) {
                $.ajax({
                    url:'/index.php/product/quick_update_wh_loc/'+product_id+'/'+new_value,
                    type: "GET",

                    dataType: "text",
                    success: function(response) {
                        if (response =='success') {
                            message('Update Warehouse Location Success',1);
                        }else{
                            message('Update Warehouse Location Fail',0);
                        }
                    }

                })
            }
        }else{
            message("Invalid Value!",0)
        }
        }); 

        $(".purchase_stock").blur(function(){
                var product_id = $(this).prev().val();
                var new_value = $(this).val();
                var old_stock = $(this).attr('id');
                if ( product_id == parseInt(product_id, 10) && new_value == parseInt(new_value, 10) && old_stock == parseInt(old_stock, 10) ) {
                        if (parseInt(new_value, 10)!=parseInt($(this).attr('data'), 10)) {
                            $(this).attr('data',new_value);
                            var new_stock = parseInt(old_stock, 10)+parseInt(new_value, 10);
                            $.ajax({
                                url:'/index.php/product/quick_update_purchase_stock/'+product_id+'/'+new_value+'/'+new_stock,
                                type: "GET",

                                dataType: "text",
                                success: function(response) {
                                    if (response =='success') {
                                        message('Add Purchase Stock Success',1);
                                    }else{
                                        message('Add Purchase Stock Fail',0);
                                    }
                                }

                            })
                        }
                }else{
                    message("Invalid Value!",0)
                }
        }); 

    }); 

</script>
