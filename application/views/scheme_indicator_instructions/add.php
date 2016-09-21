<div class="wrapper wrapper-content">
    <div class="row wrapper border-bottom white-bg page-heading crumbs">
        <?= $scheme->getName(); ?> <i class="fa fa-chevron-right"></i> Add <?= $indicator->getName(); ?>
    </div>
    <div id="mycontent">

        <div class="row">
            <div class="col-centered col-lg-9">
                <div class="ibox float-e-margins">
                    <div class="ibox-content" style="float:left;">
                        <?php if (sizeof($indicator_properties) == 0): ?>
                            <div class="col-lg-12">
                                <div class='row'>
                                    <div class="col-lg-12">
                                        <h3>No properties attached to this indicator</h3>
                                        <h4></h4>
                                        <a href="<?= base_url().'scheme/show/'.$scheme->getId(); ?>"
                                           type="button" class="btn btn-default btn-sm pull-left col-sm-2"><i
                                                class="fa fa-caret-left"> </i> Back</a>
                                    </div>
                                </div>
                            </div>
                        <?php else: ?>
                            <form id="add_new_instruction" class="form-horizontal" method="post">

                                <?php foreach ($indicator_properties as $indicator_property): ?>
                                    <?php switch($indicator_property->getDatatype()):
                                        case 'TEXT': ?>
                                            <div class="col-lg-12">
                                                <div class='row'>
                                                    <div class='col-md-12'>
                                                        <div class="form-group">
                                                            <label class="font-noraml"><?= $indicator_property->getName(); ?></label>
                                                            <input type="text" class="form-control"
                                                                   name="<?= $indicator_property->getToken()?>"
                                                                   placeholder="Enter <?= strtolower($indicator_property->getName()); ?>"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php break;?>

                                        <?php case 'DATE': ?>
                                            <div class="col-lg-12">
                                                <div class='row'>
                                                    <div class='col-md-6'>
                                                        <div class="form-group">
                                                            <label class="font-noraml"><?= $indicator_property->getName(); ?></label>
                                                            <div class="input-group date">
                                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                                <input type="date" class="form-control"
                                                                       name="<?= $indicator_property->getToken(); ?>"
                                                                       placeholder="Enter <?= strtolower($indicator_property->getName()); ?>"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php break; ?>

                                        <?php case 'LONG_TEXT': ?>
                                            <div class="col-lg-12">
                                                <div class='row'>
                                                    <div class='col-md-12'>
                                                        <div class="form-group">
                                                            <div class="ibox-content no-padding">
                                                                <label class="font-noraml"><?= $indicator_property->getName(); ?></label>
                                                                <textarea class="form-control"
                                                                          name="<?= $indicator_property->getToken() ?>"
                                                                          placeholder="Enter <?= strtolower($indicator_property->getName()); ?>"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php break; ?>

                                        <?php case 'INTEGER': ?>
                                            <div class="col-lg-12">
                                                <div class='row'>
                                                    <div class='col-md-6'>
                                                        <div class="form-group">
                                                            <label class="font-noraml"><?= $indicator_property->getName(); ?></label>
                                                            <input type="number" class="form-control"
                                                                   name="<?= $indicator_property->getToken()?>"
                                                                   placeholder="Enter <?= strtolower($indicator_property->getName()); ?>"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php break; ?>
                                        <?php endswitch; ?>
                                <?php endforeach; ?>

                                <div class="col-lg-12">
                                    <div class="form-group">

                                        <input type="hidden" name="indicator_id" value="<?= $indicator->getId(); ?>"/>
                                        <input type="hidden" name="scheme_id" value="<?= $scheme->getId(); ?>"/>

                                        <div class="ibox-content">
                                            <a href="<?= base_url().'scheme/show/'.$scheme->getId(); ?>"
                                               type="button" class="btn btn-default btn-sm pull-left col-sm-2"><i
                                                    class="fa fa-caret-left"> </i> Back</a>

                                            <div class="col-lg-7">
                                                <div class="errorresponse alert-danger" style="text-align:center;"></div>
                                                <div class="response" style="text-align:center;"></div>
                                                <div id="response" class="alert-success" style="text-align:center;"></div>
                                            </div>

                                            <button class="btn btn-primary pull-right col-sm-3 btn-sm" id="button"
                                                    name="submit" type="submit"><i class="fa fa-save"></i> Save changes
                                            </button>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    $(document).ready(function () {
        $("#add_new_instruction").submit(function (e) {
            e.preventDefault();
            $(".response").text("please wait...").fadeIn("slow");
            $(".response").fadeOut();
            $("#response").fadeOut("slow");
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url() ?>scheme_indicator_instructions/create/',
                dataType: 'text',
                data: $("#add_new_instruction").serialize(),
                timeout: 5000,
                success: function () {
                    $('#response').text("Created Successfully.")
                        .hide()
                        .fadeIn(1500, function () {
                            $('#add_new_instruction');
                            $("#response").fadeOut(7000);
                        });
                },
                error: function () {
                    $('.errorresponse').text("Something is going wrong...")
                        .hide()
                        .fadeIn(1500, function () {
                            $('.errorresponse');
                        });
                }
            });
            return false;
        });
    });
</script>