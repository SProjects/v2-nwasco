<h1><i class="fa fa-plus-square"></i> <?php echo lang('create_group_heading'); ?></h1>

<p class="font-bold"><?php echo lang('create_group_subheading'); ?></p>

<div class="col-centered col-lg-8">
    <?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-info" id="infoMessage"><?php echo $message; ?></div>
    <?php endif; ?>

    <?php echo form_open("auth/create_group", '', 'class="form-horizontal"'); ?>

        <p>
            <?php echo form_input(
                $group_name,
                lang('create_group_name_label'),
                'class="form-control" placeholder="Enter name i.e. admin"');
            ?>
        </p>

        <p>
            <?php echo form_input(
                $description,
                lang('create_group_desc_label'),
                'class="form-control" placeholder="Enter description i.e. Administrator"');
            ?>
        </p>

        <p>
            <?php echo form_submit('submit', lang('create_group_submit_btn'), 'class="btn btn-primary"'); ?>
        </p>

    <?php echo form_close(); ?>
</div>
