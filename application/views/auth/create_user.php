<h2><i class="fa fa-user-plus"></i> <?php echo lang('create_user_heading'); ?></h2>
<p class="font-bold"><?php echo lang('create_user_subheading'); ?></p>
<div class="col-centered col-lg-8">
    <?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-info" id="infoMessage"><?php echo $message; ?></div>
    <?php endif; ?>

    <?php echo form_open("auth/create_user", "id='branddet'"); ?>
        <p>
            <?php echo form_input($first_name); ?>
        </p>
        <p>
            <?php echo form_input($last_name); ?>
        </p>
        <?php
        if ($identity_column !== 'email') {
            echo lang('create_user_identity_label', 'identity');
            echo '<br />';
            echo form_error('identity');
            echo form_input($identity);
        }
        ?>
        <div class="row">
            <div class="col-md-7">
                <div class="input-group m-b"><span class="input-group-addon">@</span>
                    <?php echo form_input($email); ?>
                </div>
            </div>

            <div class="col-md-5 form-group">
                <?php echo form_input($phone); ?>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-6 form-group">
                <?php echo form_input($password); ?>
            </div>

            <div class="col-md-6 form-group">
                <?php echo form_input($password_confirm); ?>
            </div>
        </div>
        <div class="clearfix"></div>

        <p><?php echo form_submit('submit', lang('create_user_submit_btn'), 'class="btn btn-primary"'); ?></p>
    <?php echo form_close(); ?>
</div>
