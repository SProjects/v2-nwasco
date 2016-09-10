<!DOCTYPE html>
<html lang="en">
<head>
    <title><?= CI_title() ?></title>
    <?= CI_head() ?>
</head>
<body>
<div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
<div id="login-logo"><img src="<?php echo base_url(); ?>assets/images/logo.jpg" /></div>
<div id="infoMessage"><?php echo $message;?></div>

<?php echo form_open("auth/login");?>

  <div class="form-group">
<?php $elattrs = array('name' => 'identity', 'type' => 'email', 'id' => 'identity', 'class' => 'form-control', 'placeholder' => 'Username', 'required' =>'');
    ?>
    <?php echo form_input($elattrs);?>
 </div>
 <div class="form-group">
    <?php 
$pwattrs = array('name' => 'password', 'type' => 'password', 'id' => 'password', 'class' => 'form-control', 'placeholder' => 'Password', 'required' =>''); 
    ?>

    <?php echo form_input($pwattrs);?>
  </div>
    

  <p><?php echo form_submit('submit', lang('login_submit_btn'), 'class="btn btn-success block full-width m-b"');?></p>
            <!--    <a href="forgot_password"><small><?php echo lang('login_forgot_password');?></small></a> -->
<?php echo form_close();?>
   </div>
    </div>
<?= CI_footer() ?>
</body>
</html>