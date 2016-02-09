<script type="text/javascript">
    $('#order_li').addClass('active');
</script>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">
                 
                <div style="float:left;">
                    order List
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


    <?php echo form_open('order/index' , array('method'=>'get','name'=>'order_list','id'=>'order_list')) ?>


        <div style="display:none" class="row">
            <div class="col-lg-12">
                <div class="form-inline well center-block">
                    <div class="form-group">
                        <label for="from_date">order Date from:</label>
                        <input type="text" class="form-control dp" name="from_date" style="width:100px;" value="<?php if (isset($_GET['from_date'])) {echo $_GET['from_date'];} ?>">
                    </div>
                    <div class="form-group">
                        <label for="to_date">to:</label>
                        <input type="text" class="form-control dp" name="to_date" style="width:100px;" value="<?php if (isset($_GET['to_date'])) {echo $_GET['to_date'];} ?>">
                    </div>               
                    <input type="hidden" name="delete_order_id" value="">       
                    <button type="submit" class="btn btn-primary">Search</button>
                    <div class="btn-group">
                      <button type="button" class="btn btn-info" onclick="get_order_list(7)" >Last 7 days</button>
                      <button type="button" class="btn btn-info" onclick="get_order_list(14)">Last 2 Weeks</button>
                      <button type="button" class="btn btn-info" onclick="get_order_list(<?php echo date("d")-1; ?>)">This Month</button>
                    </div>
                </div>
            </div>
        </div>
    </form>



    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#order_table" aria-controls="order_table" role="tab" data-toggle="tab">order Table</a></li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">

        <div role="tabpanel" class="tab-pane" id="order_table" >

            <div class="row" style="margin-bottom:20px;">
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
            <div class="row">
                <div class="table-responsive">  
                <div class="col-lg-12">
                    <table class="table table-bordered table-hover table-striped" >
                        <thead>

                            <tr>
                                <th style='display:none'>order_id</th>
                                    <th>order_id</th>
                                    <th>order_code</th>
                                    <th style='display:none'>agent_id</th>
                                    <th>agent_name</th>
                                    <th style='display:none'>address_id</th>
                                    <th>address_detail</th>
                                    <th>phone</th>
                                    <th>recevier_name</th>
                                    <th>recevier_nation_id</th>
                                    <th>product_list</th>
                                    <th>entry_time</th>
                                    <th style="display:none" >update_time</th>
                                    <th>status</th>
                                    <th>action</th>
                                </tr>
                            </tr>
                        </thead>
                        <tbody>
                        
                        <span style="display:none" id="order_json_list" > <?php echo $order_json=json_encode($order_echart);  ?> </span>
                            
                            <?php foreach ($order as $order_item): ?>
                                    <tr <?php if ($order_item['active'] == 0 ){ echo 'class="danger"';} 
                                              elseif ($order_item['post_flag'] == 1 ) {  echo 'class="info"';} 
                                        ?>>
                                        <?php echo form_open('order/index/delete') ?>
                                            <td style='display:none'><?php echo $order_item['order_id']; ?></td>
                                            <td><?php echo $order_item['order_id']; ?></td>
                                            <td><?php echo $order_item['order_code']; ?></td>
                                            <td style='display:none'><?php echo $order_item['agent_id']; ?></td>
                                            <td><?php echo $order_item['agent_name']; ?></td>
                                            <td style='display:none'><?php echo $order_item['address_id']; ?></td>
                                            <td><?php echo $order_item['address_detail']; ?></td>
                                            <td><?php echo $order_item['phone']; ?></td>
                                            <td><?php echo $order_item['recevier_name']; ?></td>
                                            <td><?php echo $order_item['recevier_nation_id']; ?></td>
                                            <td><?php echo $order_item['product_list']; ?></td>
                                            <td><?php echo $order_item['entry_time']; ?></td>
                                            <td style="display:none" ><?php echo $order_item['update_time']; ?></td>
                                            <td>
                                                <?php echo ($order_item['active']) ? anchor("order/deactivate/".$order_item['order_id'], "active") : anchor("order/activate/". $order_item['order_id'], "inactive");?></br>
                                                <?php echo ($order_item['post_flag']) ? anchor("order/postage/".$order_item['order_id'], "POSTED") : anchor("order/postage/". $order_item['order_id'], "post now!");?>

                                            </td>
                                            <td>
                                                <a target="_blank" href="/index.php/order/order_product_list/<?php echo $order_item['order_id']; ?>" class="btn btn-primary btn-xs" >Edit Product</a>
                                                <a target="_blank" href="/index.php/order/edit/<?php echo $order_item['order_id']; ?>" class="btn btn-warning btn-xs" >Edit Address</a>
                                                <a target="_blank" href="/index.php/order/despatch/<?php echo $order_item['order_id']; ?>" class="btn btn-success btn-xs" >despatch</a>
                                                <a target="_blank" href="/index.php/order/postage/<?php echo $order_item['order_id']; ?>" class="btn btn-info btn-xs" >Postage</a>
                                                
                                                <input type="hidden" name="order_id" value="<?php echo $order_item['order_id']; ?>">
                                                <button style="display:none"type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#delete_order_<?php echo $order_item['order_id'];?>">Delete</button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="delete_order_<?php echo $order_item['order_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                  <div class="modal-dialog">
                                                    <div class="modal-content">
                                                      <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title" id="myModalLabel">Delete Distribution List Confirm</h4>
                                                      </div>
                                                      <div class="modal-body">
                                                        Are you sure you want to delete ?</em>
                                                      </div>
                                                      <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                                        <button type="button" class="btn btn-primary" onclick="delete_order('<?php echo $order_item['order_id']; ?>')">Yes, Delete</button>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                            </td>

                                        </form>
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


        </div>
       
    </div>
</div>




<?php
    $url_para = '?';
    if (isset($_GET['from_date']))
        {$url_para .='from_date='.$_GET['from_date'];}
    if (isset($_GET['to_date']))
        {$url_para .='&to_date='.$_GET['to_date'];}
    if (isset($_GET['status']))
        {$url_para .='&status='.$_GET['status'];}
?>

<script type="text/javascript">

    $('#order_table').addClass('active');
    $(".page_section").children("a").each(function(){
        //alert('aaa');
        $(this).attr('href',$(this).attr('href')+'<?php echo $url_para;?>');
        //alert($(this).attr('href'));
      });

    function delete_order(order_id) {
        //alert(product_id);
        $('input[name=delete_order_id]').val(order_id);
        $('#order_list').submit();
    }

    function get_order_list(date_range) {
        var today = new Date();
        var to_date = today.format('yyyy-MM-dd');
        var from_date = new Date(today - date_range * 86400000 ).format('yyyy-MM-dd');
        $('input[name=from_date]').val(from_date);
        $('input[name=to_date]').val(to_date);

        $('#order_list').submit();
    }
    /**
    *日期格式化函数
    *
    */
    Date.prototype.format = function(format)
    {
        var o = {
        "M+" : this.getMonth()+1, //month
        "d+" : this.getDate(),    //day
        "h+" : this.getHours(),   //hour
        "m+" : this.getMinutes(), //minute
        "s+" : this.getSeconds(), //second
        "q+" : Math.floor((this.getMonth()+3)/3),  //quarter
        "S" : this.getMilliseconds() //millisecond
        }

        if(/(y+)/.test(format)) 
        {
            format=format.replace(RegExp.$1,(this.getFullYear()+"").substr(4 - RegExp.$1.length));
        }
        
        for(var k in o)
        {
            if(new RegExp("("+ k +")").test(format))
            {
                format = format.replace(RegExp.$1,RegExp.$1.length==1 ? o[k] : ("00"+ o[k]).substr((""+ o[k]).length));
            }
        }
        return format;
    }

</script>