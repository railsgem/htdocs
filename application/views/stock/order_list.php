<script type="text/javascript">
    $('#stock_li').addClass('active');
</script>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">
                 
                <div style="float:left;">
                   despatched order List
                </div> 
                <div style="float:right;">
                    <a href="/index.php/order/create" class="btn btn-success" >Add order</a>
                </div>
                <div style="clear:both;"></div> 

            </h3>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="/index.php/order">order</a>
                </li>
                <li class="active">
                    <i class="fa fa-edit"></i> order List
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
                        <th>order_code</th>
                        <th>address_detail</th>
                        <th>remark</th>
                        <th>product_list</th>

                        <th>os product name</th>
                        <th>despatch_num</th>
                        <th>despatch_time</th>
                    </tr>
                    <?php foreach ($order as $order_item): ?>
                            <tr>
                                    <td><?php echo $order_item['order_code']; ?></td>
                                    <td><?php echo " Address: ".$order_item['address_detail']."</br>Phone:   ".$order_item['phone']."</br>Name: ".$order_item['recevier_name']."</br>ID: ".$order_item['recevier_nation_id']; ?></td>
                                    <td><?php echo $order_item['remark']; ?></td>
                                    <td><?php echo $order_item['product_list']; ?></td>
                                    <td><?php echo $order_item['product_name']; ?></td>
                                    <td><?php echo $order_item['despatch_num']; ?></td>
                                    <td><?php echo $order_item['despatch_time']; ?></td>
                                   
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