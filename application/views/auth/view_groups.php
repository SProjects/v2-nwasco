<h2><i class="fa fa-square"></i> <?php echo lang('group_heading');?></h2>
<p class="font-bold"><?php echo lang('group_subheading');?></p>

<?php if(isset($_SESSION['message'])): ?>
    <div class="alert alert-info" id="infoMessage"><?php echo $message;?></div>
<?php endif; ?>

<div class="full-height-scroll">
    <div class="table-responsive users-list">
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th><?php echo lang('view_group_name_th');?></th>
                <th><?php echo lang('view_group_description_th');?></th>
                <th><?php echo lang('index_action_th');?></th>
            </tr>
            </thead>
            <tbody>
            <?php $x=1; foreach ($roles as $role):?>
                <tr>
                    <td><?php echo $x; ?></td>
                    <td><?php echo htmlspecialchars($role->name,ENT_QUOTES,'UTF-8');?></td>
                    <td><?php echo htmlspecialchars($role->description,ENT_QUOTES,'UTF-8');?></td>
                    <td>
                        <span class="btn btn-white btn-xs white-bg">
                            <?php echo anchor("auth/edit_group/".$role->id, 'Edit') ;?>
                        </span>
                    </td>
                </tr>
            <?php $x++; endforeach;?>
            </tbody>
        </table>