<script type="text/javascript">
    $('#address_li').addClass('active');
</script>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">
                 
                <div style="float:left;">
                    address List
                </div> 
                <div style="float:right;">
                    <a href="/index.php/address/create" class="btn btn-success" >Add address</a>
                </div>
                <div style="clear:both;"></div> 

            </h3>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="/index.php/address">address</a>
                </li>
                <li class="active">
                    <i class="fa fa-edit"></i> address List
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


    <?php echo form_open('address/index' , array('method'=>'get','name'=>'address_list','id'=>'address_list')) ?>


        <div style="display:none" class="row">
            <div class="col-lg-12">
                <div class="form-inline well center-block">
                    <div class="form-group">
                        <label for="from_date">address Date from:</label>
                        <input type="text" class="form-control dp" name="from_date" style="width:100px;" value="<?php if (isset($_GET['from_date'])) {echo $_GET['from_date'];} ?>">
                    </div>
                    <div class="form-group">
                        <label for="to_date">to:</label>
                        <input type="text" class="form-control dp" name="to_date" style="width:100px;" value="<?php if (isset($_GET['to_date'])) {echo $_GET['to_date'];} ?>">
                    </div>               
                    <input type="hidden" name="delete_address_id" value="">       
                    <button type="submit" class="btn btn-primary">Search</button>
                    <div class="btn-group">
                      <button type="button" class="btn btn-info" onclick="get_address_list(7)" >Last 7 days</button>
                      <button type="button" class="btn btn-info" onclick="get_address_list(14)">Last 2 Weeks</button>
                      <button type="button" class="btn btn-info" onclick="get_address_list(<?php echo date("d")-1; ?>)">This Month</button>
                    </div>
                </div>
            </div>
        </div>
    </form>



    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#address_table" aria-controls="address_table" role="tab" data-toggle="tab">address Table</a></li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">

        <div role="tabpanel" class="tab-pane" id="address_table" >

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
                <div class="col-lg-12">
                    <table class="table table-bordered table-hover table-striped" >
                        <thead>

                            <tr>
                                <th style='display:none'>address id</th>
                                    <th>agent_name</th>
                                    <th>address_detail</th>
                                    <th>phone</th>

                                    <th>recevier_name</th>
                                    <th>recevier_nation_id</th>
                                    <th>entry_time</th>

                                    <th>update_time</th>
                                    <th>操作</th>
                                </tr>
                            </tr>
                        </thead>
                        <tbody>
                        
                        <span style="display:none" id="address_json_list" > <?php echo $address_json=json_encode($address_echart);  ?> </span>
                            
                            <?php foreach ($address as $address_item): ?>
                                    <tr>
                                        <?php echo form_open('address/index/delete') ?>
                                            <td style='display:none'><?php echo $address_item['address_id']; ?></td>
                                            <td><?php echo $address_item['agent_name']; ?></td>
                                            <td><?php echo $address_item['address_detail']; ?></td>
                                            <td><?php echo $address_item['phone']; ?></td>
                                            <td><?php echo $address_item['recevier_name']; ?></td>
                                            <td><?php echo $address_item['recevier_nation_id']; ?></td>
                                            <td><?php echo $address_item['entry_time']; ?></td>
                                            <td><?php echo $address_item['update_time']; ?></td>
                                            <td>
                                                <a href="/index.php/address/edit/<?php echo $address_item['address_id']; ?>" class="btn btn-danger btn-xs" >View/Edit</a>
                                                
                                                <input type="hidden" name="address_id" value="<?php echo $address_item['address_id']; ?>">
                                                <button style="display:none"type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#delete_address_<?php echo $address_item['address_id'];?>">Delete</button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="delete_address_<?php echo $address_item['address_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                                        <button type="button" class="btn btn-primary" onclick="delete_address('<?php echo $address_item['address_id']; ?>')">Yes, Delete</button>
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

    $('#address_table').addClass('active');
    $(".page_section").children("a").each(function(){
        //alert('aaa');
        $(this).attr('href',$(this).attr('href')+'<?php echo $url_para;?>');
        //alert($(this).attr('href'));
      });

    function delete_address(address_id) {
        //alert(product_id);
        $('input[name=delete_address_id]').val(address_id);
        $('#address_list').submit();
    }

    function get_address_list(date_range) {
        var today = new Date();
        var to_date = today.format('yyyy-MM-dd');
        var from_date = new Date(today - date_range * 86400000 ).format('yyyy-MM-dd');
        $('input[name=from_date]').val(from_date);
        $('input[name=to_date]').val(to_date);

        $('#address_list').submit();
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