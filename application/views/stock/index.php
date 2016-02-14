<script type="text/javascript">
    $('#stock_li').addClass('active');
</script>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">
                 
                <div style="float:left;">
                    stock List
                </div> 
                <div style="float:right;">
                    <a href="/index.php/stock/create" class="btn btn-success" >Add stock</a>
                </div>
                <div style="clear:both;"></div> 

            </h3>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="/index.php/stock">stock</a>
                </li>
                <li class="active">
                    <i class="fa fa-edit"></i> stock List
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

    <?php echo form_open('stock' , array('method'=>'get','name'=>'productlist','id'=>'productlist')) ?>

        <div class="row">
            <div class="col-lg-12">
                <div class="form-inline well center-block">
                    <div class="form-group">
                        <label for="product_name">Product Name:</label>
                        <input type="text" style="width:180px;" class="form-control" name="product_name" value="<?php if (isset($_GET['product_name'])) {echo $_GET['product_name'];} ?>">
                    </div>
                    <div class="form-group">
                        <label for="buyer">Buyer:</label>
                        <input type="text" style="width:100px;" class="form-control" name="buyer" value="<?php if (isset($_GET['buyer'])) {echo $_GET['buyer'];} ?>">
                    </div>
                    <div class="form-group">
                        <label for="buy_shop">Shop:</label>
                        <input type="text" style="width:100px;" class="form-control" name="buy_shop" value="<?php if (isset($_GET['buy_shop'])) {echo $_GET['buy_shop'];} ?>">
                    </div>

                    <div class="form-group">
                        <label for="is_despatched">Despatched:</label>
                        <select class="form-control" name="is_despatched" >
                            <option value="">All</option>
                            <option value=1 <?php 
                            if (isset($_GET['is_despatched']))
                            {
                                if ( $_GET['is_despatched'] == '1') 
                                    {echo 'selected';}
                            }
                            ?>>YES</option>
                            <option value=0 <?php 
                            if (isset($_GET['is_despatched']))
                            {
                                if ( $_GET['is_despatched'] == '0') 
                                    {echo 'selected';}
                            }
                            ?>>NO</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="is_out_of_stock">Out of stock:</label>
                        <select class="form-control" name="is_out_of_stock" >
                            <option value="">All</option>
                            <option value=1 <?php 
                            if (isset($_GET['is_out_of_stock']))
                            {
                                if ( $_GET['is_out_of_stock'] == '1') 
                                    {echo 'selected';}
                            }
                            ?>>YES</option>
                            <option value=0 <?php 
                            if (isset($_GET['is_out_of_stock']))
                            {
                                if ( $_GET['is_out_of_stock'] == '0') 
                                    {echo 'selected';}
                            }
                            ?>>NO</option>
                        </select>
                    </div>

                    </br></br>
                    <div style="clear:both"></div>
                    <div class="form-group">
                        <label for="expire_date_from">Expire date from:</label>
                        <input type="text" class="form-control dp" name="expire_date_from" style="width:100px;" value="<?php if (isset($_GET['expire_date_from'])) {echo $_GET['expire_date_from'];} ?>">
                    </div>
                    <div class="form-group">
                        <label for="expire_date_to">to:</label>
                        <input type="text" class="form-control dp" name="expire_date_to" style="width:100px;" value="<?php if (isset($_GET['expire_date_to'])) {echo $_GET['expire_date_to'];} ?>">
                    </div>
                    <div class="form-group">
                        <label for="purchase_time_from">Purchase time from:</label>
                        <input type="text" class="form-control dp" name="purchase_time_from" style="width:100px;" value="<?php if (isset($_GET['purchase_time_from'])) {echo $_GET['purchase_time_from'];} ?>">
                    </div>
                    <div class="form-group">
                        <label for="purchase_time_to">to:</label>
                        <input type="text" class="form-control dp" name="purchase_time_to" style="width:100px;" value="<?php if (isset($_GET['purchase_time_to'])) {echo $_GET['purchase_time_to'];} ?>">
                    </div>

                    <input type="hidden" name="delete_product_id" value="">
                    <button type="submit" class="btn btn-primary">Search</button>
                    
                </div>
            </div>
        </div>
    </form>
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

        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped" >
                    <tr>
                        <th>stock ID</th>
                        <th style="display:none" >os product id</th>
                        <th>os product name</th>
                        <th>real cost</th>
                        <th>stock number</th>
                        <th>despatched number</th>
                        <th>present number</th>
                        <th>buy shop</th>
                        <th>buyer</th>
                        <th>purchase time</th>
                        <th>entry time</th>
                        <th>Update time</th>
                        <th>expire_date</th>
                        <th>Operation</th>
                    </tr>
                    <?php foreach ($stock as $stock_item): ?>
                            <tr>
                                <?php echo form_open('stock/delete') ?>
                                    <td><?php echo $stock_item['stock_id']; ?></td>
                                    <td style="display:none" ><?php echo $stock_item['os_product_id']; ?></td>
                                    <td><?php echo $stock_item['product_name']; ?></td>
                                    <td><?php echo $stock_item['real_cost']; ?></td>
                                    <td><?php echo $stock_item['stock_entry_num']; ?></td>
                                    <td><?php echo $stock_item['stock_despatch_num']; ?></td>
                                    <td><?php echo $stock_item['stock_present_num']; ?></td>
                                    <td><?php echo $stock_item['buy_shop']; ?></td>
                                    <td><?php echo $stock_item['buyer']; ?></td>
                                    <td><?php echo $stock_item['purchase_time']; ?></td>
                                    <td><?php echo $stock_item['entry_time']; ?></td>
                                    <td><?php echo $stock_item['update_time']; ?></td>
                                    <td><?php echo $stock_item['expire_date']; ?></td>
                                    <td >
                                        <a href="/index.php/stock/edit/<?php echo $stock_item['stock_id']; ?>" class="btn btn-warning btn-xs" >Edit</a>
                                        
                                        <input type="hidden" name="stock_id" value="<?php echo $stock_item['stock_id']; ?>">
                                        <?php if($stock_item['stock_despatch_num']==0){
                                                 echo '<button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#delete_stock_'.$stock_item['stock_id'].'">Delete</button>'; 
                                             } else {
                                                echo '<a target="_blank" href="/index.php/stock/order_list?stock_id='.$stock_item['stock_id'].'" class="btn btn-success btn-xs" >Order List</a>';
                                             }

                                         ?>
                                        <!-- Modal -->
                                        <div class="modal fade" id="delete_stock_<?php echo $stock_item['stock_id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                          <div class="modal-dialog">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel">Delete stock Confirm</h4>
                                              </div>
                                              <div class="modal-body">
                                                Are you sure you want to delete - <em>"<?php echo $stock_item['product_name'];?>" ?</em> - <em>"<?php echo "stock_present_num: ".$stock_item['stock_present_num'];?>" ?</em>
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
</div>

<?php
    $url_para = '?';
    if (isset($_GET['product_name']))
        {$url_para .='product_name='.str_replace('\'','',$_GET['product_name']);}
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

</script>