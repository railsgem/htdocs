<script type="text/javascript">
    $('#order_li').addClass('active');
</script>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">
                Add order postage
            </h3>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="/index.php/postage">postage</a>
                </li>
                <li class="active">
                    <i class="fa fa-edit"></i> order Add postage
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

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <b>Cart (Product List)</b>
                    </div>
                    <div class="panel-body">

                        <table class="table table-bordered table-hover table-striped" >
                            <thead>

                                <tr>
                                    <th style='display:none'>postage id</th>
                                        <th style="display:none" >postage_company_id</th>
                                        <th>postage_date</th>
                                        <th>postage_code</th>
                                        <th>postage_company_name</th>
                                        <th>postage_website</th>
                                        <th>postage_fee</th>
                                        <th>postage_weight</th>
                                        <th>remark</th>
                                        <th style="display:none" >entry_time</th>
                                        <th style="display:none" >update_time</th>
                                        <th>操作</th>
                                    </tr>
                                </tr>
                            </thead>
                            <tbody>
                            
                            <span style="display:none" id="postage_json_list" > <?php echo $postage_json=json_encode($postage_echart);  ?> </span>
                                
                                <?php foreach ($postage as $postage_item): ?>
                                        <tr>
                                            <?php echo form_open('postage/index/delete') ?>
                                                <td style='display:none'><?php echo $postage_item['postage_id']; ?></td>
                                                <td style="display:none" ><?php echo $postage_item['postage_company_id']; ?></td>
                                                <td><?php echo $postage_item['postage_date']; ?></td>
                                                <td><?php echo $postage_item['postage_code']; ?></td>
                                                <td><?php echo $postage_item['postage_company_name']; ?></td>
                                                <td><?php echo $postage_item['postage_website']; ?></td>
                                                <td><?php echo $postage_item['postage_fee']; ?></td>
                                                <td><?php echo $postage_item['postage_weight']; ?></td>
                                                <td><?php echo $postage_item['remark']; ?></td>
                                                <td style="display:none" ><?php echo $postage_item['entry_time']; ?></td>
                                                <td style="display:none" ><?php echo $postage_item['update_time']; ?></td>
                                                <td>
                                                    <a href="/index.php/postage/edit/<?php echo $postage_item['postage_id']; ?>" class="btn btn-danger btn-xs" >View/Edit</a>
                                                    
                                                    <input type="hidden" name="postage_id" value="<?php echo $postage_item['postage_id']; ?>">
                                                    <button style="display:none"type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#delete_postage_<?php echo $postage_item['postage_id'];?>">Delete</button>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="delete_postage_<?php echo $postage_item['postage_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                                            <button type="button" class="btn btn-primary" onclick="delete_postage('<?php echo $postage_item['postage_id']; ?>')">Yes, Delete</button>
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

            <div class="col-lg-3">

                <?php echo form_open('order/postage/'.$order_id) ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <b>postage</b>
                        <input style="float:right" class="btn btn-primary btn-xs" type="submit" name="submit" value="post" />
                    </div>
                    <div class="panel-body">
                      
                        <div class="form-group">
                            <label for="postage_company_id"><span class="red"> * </span>postage_company_id:</label>
                            <select class="form-control" name="postage_company_id">
                                <?php foreach ($postage_company as $postage_company_item): ?>
                                    <option value="<?php echo $postage_company_item['postage_company_id'] ?>" 
                                        <?php if ($postage_company_item['postage_company_id'] === set_value('postage_company_id')) { echo "selected"; } ?>>
                                        <?php echo $postage_company_item['postage_company_name'] ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="postage_date"><span class="red"> * </span>postage_date:</label>
                            <?php
                                $today = date("Y-m-d");   
                            ?>
                            <input class="form-control dp" type="input" name="postage_date" value="<?php echo set_value('postage_date',$today); ?>">
                        </div>
                        <div class="form-group">
                            <label for="postage_code"><span class="red"> * </span>postage_code:</label>
                            <input class="form-control" type="input" name="postage_code" value="<?php echo set_value('postage_code'); ?>">
                        </div>
                        <div class="form-group">
                            <label for="postage_fee"><span class="red"> * </span>postage_fee:</label>
                            <input class="form-control" type="input" name="postage_fee" value="<?php echo set_value('postage_fee'); ?>">
                        </div>
                        <div class="form-group">
                            <label for="postage_weight">postage_weight:</label>
                            <input class="form-control" type="input" name="postage_weight" value="<?php echo set_value('postage_weight'); ?>">
                        </div>
                        <div class="form-group">
                            <label for="remark">remark:</label>
                            <input class="form-control" type="input" name="remark" value="<?php echo set_value('remark'); ?>">
                        </div>
                    </div>

                <?php echo form_close();?>
                </div> 
            </div> 

        
        </div>
        <!-- /.row -->



                        <label for="despatch_flag"><span class="red"> * </span>despatch_flag:</label>
                        <select class="form-control" name="despatch_flag">
                            <option value="1" <?php if ("1" === set_value('despatch_flag')) { echo "selected"; } ?>>发货</option>
                            <option value="0" <?php if ("1" === set_value('despatch_flag')) { echo "selected"; } ?>>未发货</option>
                        </select>
</div>