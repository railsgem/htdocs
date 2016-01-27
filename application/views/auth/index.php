<script type="text/javascript">
    $('#auth_li').addClass('active');
</script>

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">
                 
                <div style="float:left;">
                    <?php echo lang('index_heading');?>
                </div> 
                <div style="float:right;">
                	
                    <a href="/index.php/auth/create_user" class="btn btn-success" ><?php echo lang('index_create_user_link') ?></a>
                    <a style="display:none" href="/index.php/auth/create_group" class="btn btn-success" ><?php echo lang('index_create_group_link') ?></a>
                </div>
                <div style="clear:both;"></div> 

            </h3>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="/index.php/auth"><?php echo lang('index_heading');?></a>
                </li>
                <li class="active">
                    <i class="fa fa-edit"></i> <?php echo lang('index_subheading');?>
                </li>
            </ol>
        </div>
    </div>

	<div id="infoMessage"><?php echo $message;?></div>


    <div class="row">
        <div class="col-lg-12">
            <table class="table table-bordered table-hover table-striped" >
				<tr>
					<th><?php echo "User Name";?></th>
					<th><?php echo lang('index_fname_th');?></th>
					<th><?php echo lang('index_lname_th');?></th>
					<th><?php echo lang('index_email_th');?></th>
					<th style="display:none"><?php echo lang('index_groups_th');?></th>
					<th><?php echo "Privilege";?></th>
					<th><?php echo lang('index_status_th');?></th>
					<th><?php echo lang('index_action_th');?></th>
				</tr>
				<?php foreach ($users as $user):?>
					<tr>
			            <td><?php echo htmlspecialchars($user->username,ENT_QUOTES,'UTF-8');?></td>
			            <td><?php echo htmlspecialchars($user->first_name,ENT_QUOTES,'UTF-8');?></td>
			            <td><?php echo htmlspecialchars($user->last_name,ENT_QUOTES,'UTF-8');?></td>
			            <td><?php echo htmlspecialchars($user->email,ENT_QUOTES,'UTF-8');?></td>
						<td style="display:none">
							<?php foreach ($user->groups as $group):?>
								<?php echo anchor("auth/edit_group/".$group->id, htmlspecialchars($group->name,ENT_QUOTES,'UTF-8')) ;?><br />
			                <?php endforeach?>
						</td>
						<td>
							<?php foreach ($user->privileges as $privilege):?>
								<?php if($privilege->id != 9) { echo htmlspecialchars($privilege->description,ENT_QUOTES,'UTF-8').'<br />';} ?>
			                <?php endforeach?>
						</td>
						<td><?php echo ($user->active) ? anchor("auth/deactivate/".$user->id, lang('index_active_link')) : anchor("auth/activate/". $user->id, lang('index_inactive_link'));?></td>
						<td><?php echo anchor("auth/edit_user/".$user->id, 'Edit') ;?></td>
					</tr>
				<?php endforeach;?>
			</table>

			<p >

		</div>	
	</div>
</div>