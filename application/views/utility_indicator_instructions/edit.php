<div class="wrapper wrapper-content">
    <div class="row wrapper border-bottom white-bg page-heading crumbs">
        <?= $utility->getName(); ?> <i class="fa fa-chevron-right"></i> Edit/Update <?= $indicator->getName(); ?>
    </div>
    <div id="mycontent">

        <div class="row">
            <div class="col-centered col-lg-9">
                <div class="ibox float-e-margins">
                    <div class="ibox-content" style="float:left;">
                        <?php if (sizeof($existing_instructions) == 0): ?>
                            <div class="col-lg-12">
                                <div class='row'>
                                    <div class="col-lg-12">
                                        <h3>No instructions</h3>
                                        <h4></h4>
                                        <a href="<?= base_url().'utility/show/'.$utility->getId(); ?>"
                                           type="button" class="btn btn-default btn-sm pull-left col-sm-2"><i
                                                class="fa fa-caret-left"> </i> Back</a>
                                    </div>
                                </div>
                            </div>
                        <?php else: ?>
                            <form id="update_instruction" class="form-horizontal" method="post">
                                <?php foreach ($existing_instructions as $existing_instruction):
                                    $indicator_property = $existing_instruction->getIndicatorProperty(); ?>
                                    <?php switch ($indicator_property->getDatatype()):
                                    case 'TEXT': ?>
                                        <div class="col-lg-12">
                                            <div class='row'>
                                                <div class='col-md-12'>
                                                    <div class="form-group">
                                                        <label
                                                            class="font-noraml required"><?= $indicator_property->getName(); ?></label>
                                                        <input type="text" class="form-control"
                                                               name="<?= $indicator_property->getToken() ?>"
                                                               placeholder="<?= strtolower($indicator_property->getName()); ?>"
                                                               value="<?= $existing_instruction->getValue(); ?>"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php break; ?>

                                    <?php case 'DATE': ?>
                                        <div class="col-lg-12">
                                            <div class='row'>
                                                <div class='col-md-6'>
                                                    <div class="form-group">
                                                        <label
                                                            class="font-noraml required"><?= $indicator_property->getName(); ?></label>
                                                        <div class="input-group date">
                                                            <span class="input-group-addon"><i
                                                                    class="fa fa-calendar"></i></span>
                                                            <input type="date" class="form-control"
                                                                   name="<?= $indicator_property->getToken(); ?>"
                                                                   placeholder="Enter <?= strtolower($indicator_property->getName()); ?>"
                                                                   value="<?= $existing_instruction->getValue(); ?>"/>
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
                                                            <label
                                                                class="font-noraml required"><?= $indicator_property->getName(); ?></label>
                                                            <textarea class="form-control"
                                                                      name="<?= $indicator_property->getToken() ?>"
                                                                      placeholder="Enter <?= strtolower($indicator_property->getName()); ?>"
                                                            ><?= $existing_instruction->getValue(); ?>
                                                            </textarea>
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
                                                        <label
                                                            class="font-noraml required"><?= $indicator_property->getName(); ?></label>
                                                        <input type="number" class="form-control"
                                                               name="<?= $indicator_property->getToken() ?>"
                                                               placeholder="Enter <?= strtolower($indicator_property->getName()); ?>"
                                                               value="<?= $existing_instruction->getValue(); ?>"/>
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
                                        <input type="hidden" name="utility_id" value="<?= $utility->getId(); ?>"/>
                                        <input type="hidden" name="union_token" value="<?= $union_token; ?>"/>

                                        <div class="ibox-content">
                                            <a href="<?= base_url().'utility/show/'.$utility->getId(); ?>"
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
        $("#update_instruction").submit(function (e) {
            e.preventDefault();
            $(".response").text("please wait...").fadeIn("slow");
            $(".response").fadeOut();
            $("#response").fadeOut("slow");
            $.ajax({
                type: 'POST',
                url: '<?= base_url() ?>utility_indicator_instructions/update/',
                dataType: 'text',
                data: $("#update_instruction").serialize(),
                timeout: 5000,
                success: function () {
                    $('#response').text("Created Successfully.")
                        .hide()
                        .fadeIn(1500, function () {
                            $('#update_instruction');
                            $("#response").fadeOut(7000);
                        });
                    window.location.href = "<?= base_url().'utility/show/'.$utility->getId(); ?>";
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