<script type="text/javascript">
    $('#order_li').addClass('active');
</script>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">
                Add order
            </h3>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="/index.php/order">order</a>
                </li>
                <li class="active">
                    <i class="fa fa-edit"></i> Add order
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
    <?php echo form_open('order/create') ?>

        <div class="row">
            <div class="col-lg-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <b>order</b>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="order_code"><span class="red"> * </span>order_code:</label>
                            <input id="order_code" class="form-control" type="input" name="order_code" value="<?php echo set_value('order_code'); ?>">
                            <?php foreach ($consumer as $consumer_item): ?>
                                    <?php if ($consumer_item['consumer_id'] === set_value('consumer_id')) { echo $consumer_item['consumer_name']; } ?>
                            <?php endforeach ?>



                        </div>
                        <div class="form-group">
                            <label for="consumer_id"><span class="red"> * </span>agent_name:</label>
                            <select id="consumer_id" class="form-control" name="consumer_id">
                                <?php foreach ($consumer as $consumer_item): ?>
                                    <option value="<?php echo $consumer_item['consumer_id'] ?>" 
                                        <?php if ($consumer_item['consumer_id'] === set_value('consumer_id')) { echo "selected"; } ?>>
                                        <?php echo $consumer_item['consumer_name'];?>

                                    </option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                </div> 

            </div> 
<?php echo date('Ymd-His');?>
            
            <div class="col-lg-3">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <b>Consumer info(receiver)</b>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="consumer_name"><span class="red"> * </span>consumer_name:</label>
                            <input class="form-control" type="input" name="consumer_name" value="<?php echo set_value('consumer_name'); ?>">
                        </div>
                        <div class="form-group">
                            <label for="consumer_nation_id"><span class="red"> * </span>consumer_nation_id:</label>
                            <input class="form-control" type="input" name="consumer_nation_id" value="<?php echo set_value('consumer_nation_id'); ?>">
                        </div>
                        <div class="form-group">
                            <label for="consumer_address"><span class="red"> * </span>consumer_address:</label>
                            <input class="form-control" type="input" name="consumer_address" value="<?php echo set_value('consumer_address'); ?>">
                        </div>
                        <div class="form-group">
                            <label for="consumer_phone"><span class="red"> * </span>consumer_phone:</label>
                            <input class="form-control" type="input" name="consumer_phone" value="<?php echo set_value('consumer_phone'); ?>">
                        </div>
                        <div class="form-group">
                            <label for="consumer_postcode"><span class="red"> * </span>consumer_postcode:</label>
                            <input class="form-control" type="input" name="consumer_postcode" value="<?php echo set_value('consumer_postcode'); ?>">
                        </div>
                        <label for="is_agent"><span class="red"> * </span>is_agent:</label>
                        <select class="form-control" name="is_agent">
                            <option value="1" <?php if ("1" === set_value('is_agent')) { echo "selected"; } ?>>1</option>
                            <option value="0" <?php if ("1" === set_value('is_agent')) { echo "selected"; } ?>>0</option>
                        </select>
                    </div>
                </div> 
            </div> 

        </div>
        <!-- /.row -->

        <div class="text-left">
            <input class="btn btn-primary" type="submit" name="submit" value="Add New order" />
        </div>

    <?php echo form_close();?>
</div>

<script type="text/javascript">

    $(document).ready(function(){
        function get_consumer_id(){
            var consumer_id = $("#consumer_id").val();
           
            console.log(consumer_id);
            $("#order_code").val(consumer_id);
            $("#order_code").css("background-color","#FFFFCC");


            var data = {
                consumer_id : consumer_id
            };
            $.ajax({
                type: 'POST',
                url: '/index.php/consumer/get_consumer_json',
                data: data,
                beforeSend: function(){

                },
                success: function(msg){
                    var consumer_Obj = eval(msg);
                    console.log(consumer_Obj);
                    agent_name_code = consumer_Obj[0]['agent_name_code'];
                    console.log(consumer_Obj);
                    console.log(consumer_Obj[0]['agent_name_code']);
                    $("#order_code").val(agent_name_code+"<?php echo date('Ymd_His');?>");
                }
            });
        }
        $("#consumer_id").change(get_consumer_id());

    });
   
</script>
