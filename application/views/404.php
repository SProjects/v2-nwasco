<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?= CI_title() ?></title>
        <?= CI_head() ?>
    </head>
    <body class="gray-bg">
        <div class="middle-box text-center animated fadeInDown" style="border:0;box-shadow:none;">
            <h1>404</h1>
            <h3 class="font-bold">Page Not Found</h3>

            <div class="error-desc">
                Sorry, but the page you are looking for has note been found. Try checking the URL for error, then hit the
                refresh button on your browser or try finding something else in our app.<br/>
                <div class="clearfix"></div>
                <br/>
                <div class="clearfix"></div>
                <a class="label label-info" role="button" type="button" href="<?php echo base_url(); ?>dashboard">Go Back to
                    Dashboard</a>
            </div>
        </div>

        <?= CI_footer() ?>
    </body>
</html>