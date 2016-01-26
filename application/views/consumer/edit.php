<script type="text/javascript">
    $('#consumer_li').addClass('active');
</script>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">
                View/Edit consumer
            </h3>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="/index.php/consumer">consumer</a>
                </li>
                <li class="active">
                    <i class="fa fa-edit"></i> View/Edit consumer
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
        </div>
    <?php  } ?>


    <?php echo form_open('consumer/edit/'.$consumer['consumer_id']) ?>


        <div class="row">
            <div class="col-lg-3">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <b> 操作员</b>
                    </div>
                    <div class="panel-body">
                        <div class="form-group" >
                                <label for="consumer_rep_date"><span class="red"> * </span>consumer 日期:</label>
                                <input type="text" class="form-control dp" type="input" name="consumer_rep_date" value="<?php echo $consumer['consumer_rep_date']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="operator"><span class="red"> * </span>操作员:</label>
                            <input class="form-control" type="input" name="operator" value="<?php echo $consumer['operator']; ?>">
                        </div>
                    </div>
                </div> 
            </div>
            <div class="col-lg-3">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <b>打单区</b>
                    </div>
                    <div class="panel-body">
                      
                    <div class="form-group">
                        <label for="print_total"><span class="red"> * </span>AT打单总数量:</label>
                        <input class="form-control" type="input" name="print_total" value="<?php echo $consumer['print_total']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="print_error"><span class="red"> * </span>AT错单数量:</label>
                        <input class="form-control" type="input" name="print_error" value="<?php echo $consumer['print_error']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="print_total"><span class="red"> * </span>APP打单总数量:</label>
                        <input class="form-control" type="input" name="print_total_app" value="<?php echo $consumer['print_total_app']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="print_error"><span class="red"> * </span>APP错单数量:</label>
                        <input class="form-control" type="input" name="print_error_app" value="<?php echo $consumer['print_error_app']; ?>">
                    </div>
                    </div>
                </div> 
            </div> 


            <div class="col-lg-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <b>发货区</b>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="delivery_scan_total"><span class="red"> * </span>总扫单数量:</label>
                            <input class="form-control" type="input" name="delivery_scan_total" value="<?php echo $consumer['delivery_scan_total']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="delivery_express_receive"><span class="red"> * </span>快递收包裹量:</label>
                            <input class="form-control" type="input" name="delivery_express_receive" value="<?php echo $consumer['delivery_express_receive']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="delivery_missed"><span class="red"> * </span>漏发单量:</label>
                            <input class="form-control" type="input" name="delivery_missed" value="<?php echo $consumer['delivery_missed']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="delivery_error"><span class="red"> * </span>错发单量:</label>
                            <input class="form-control" type="input" name="delivery_error" value="<?php echo $consumer['delivery_error']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="delivery_remark">其他备注详情:</label>
                            <input class="form-control" type="input" name="delivery_remark" value="<?php echo $consumer['delivery_remark']; ?>">
                        </div>
                    </div>
                </div> 
            </div> 


            <div class="col-lg-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <b>配货区</b>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="picking_total"><span class="red"> * </span>总配货商品数量:</label>
                            <input class="form-control" type="input" name="picking_total" value="<?php echo $consumer['picking_total']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="picking_missed"><span class="red"> * </span>漏配商品数量:</label>
                            <input class="form-control" type="input" name="picking_missed" value="<?php echo $consumer['picking_missed']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="picking_error"><span class="red"> * </span>错配商品数量:</label>
                            <input class="form-control" type="input" name="picking_error" value="<?php echo $consumer['picking_error']; ?>">
                        </div>
                    </div>
                </div> 
            </div> 



        </div>
        <!-- /.row -->
        
        <div class="row">

            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <b>consumer update history</b>
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered table-hover table-striped" >
                            <thead>
                                <tr>
                                        <th>update column</th>
                                        <th>new value</th>

                                        <th>old value</th>
                                        <th>update time</th>

                                        <th>operator</th>
                                    </tr>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <?php foreach ($consumer_update_history as $consumer_item): ?>
                                        <tr>
                                            <td><?php echo $consumer_item['update_column']; ?></td>
                                            <td><?php echo $consumer_item['new_value']; ?></td>
                                            <td><?php echo $consumer_item['old_value']; ?></td>
                                            <td><?php echo $consumer_item['update_time']; ?></td>
                                            <td><?php echo $consumer_item['operator']; ?></td>
                                        </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div> 
            </div> 
        </div> 


        <div class="text-left">
            <input class="btn btn-primary" type="submit" name="submit" value="Save" />
        </div>

    </form>
</div>