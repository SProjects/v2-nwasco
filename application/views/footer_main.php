<div class="footer fixed_full">
    <div class="pull-right">
        <?php echo lang('system_title'); ?> <strong> <?php echo lang('system_title_sht'); ?> </strong>
    </div>
    <div>
        <a class="navbar-minimalize minimalize-styl-2 btn btn-success " href="#"><i class="fa fa-bars"></i> </a>
        <strong>Copyright</strong>&copy; <?php echo date('Y'); ?>
    </div>
</div>

</div>
</div>

<?= CI_footer() ?>

<script>

    jQuery(document).ready(function ($) {

        Tinycon.setBubble(<?php echo $nots;?>);

        Tinycon.setOptions({
            width: 7,
            height: 9,
            font: '10px sans-serif',
            colour: '#ffffff',
            background: '#ec5645',
            fallback: true
        });
    });
</script>
</body>
</html>
