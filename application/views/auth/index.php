<h2><i class="fa fa-users"></i> <?php echo lang('index_heading');?></h2>
<p><?php echo lang('index_subheading');?></p>

<div id="infoMessage"><?php echo $message;?></div>

<div class="full-height-scroll">
       <div class="table-responsive users-list">
         	<table class="table table-striped table-hover">
                <thead>
				<tr>
					<th><?php echo lang('index_fname_th');?></th>
					<th><?php echo lang('index_lname_th');?></th>
					<th><?php echo lang('index_email_th');?></th>
					<th><?php echo lang('index_phone_th');?></th>
					<th><?php echo lang('index_status_th');?></th>
					<th><?php echo lang('index_action_th');?></th>
				</tr>
				</thead>
				<tbody>
				<?php foreach ($users as $user):?>
					<tr>
			            <td><?php echo htmlspecialchars($user->first_name,ENT_QUOTES,'UTF-8');?></td>
			            <td><?php echo htmlspecialchars($user->last_name,ENT_QUOTES,'UTF-8');?></td>
			            <td><i class="fa fa-envelope"></i> <?php echo htmlspecialchars($user->email,ENT_QUOTES,'UTF-8');?></td>
						<td><i class="fa fa-phone"> </i> <?php echo htmlspecialchars($user->phone,ENT_QUOTES,'UTF-8');?>
						</td>
						<td class="client-status"><?php echo ($user->active) ? anchor("auth/deactivate/".$user->id, lang('index_active_link')) : anchor("auth/activate/". $user->id, lang('index_inactive_link'));?></td>
						<td class="project-actions"><span class="btn btn-white btn-xs white-bg"><?php echo anchor("auth/edit_user/".$user->id, 'Edit') ;?></span></td>
					</tr>
				<?php endforeach;?>
				</tbody>
			</table>
