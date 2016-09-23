<div class="wrapper wrapper-content">
    <div class="row wrapper border-bottom white-bg page-heading crumbs">
        <?php echo $indicator->getName(); ?> <i class="fa fa-chevron-right"></i> Edit/Update Indicator Property
    </div>
    <div id="mycontent">
        <div class="row">
            <div class="col-centered col-lg-6">
                <div class="ibox float-e-margins white-bg">
                    <form id="update_property" class="form-horizontal" method="post">
                        <div class="col-lg-12">
                            <div class="form-group">

                                <label class="required">Name</label>
                                <input name="name" class="form-control"
                                       placeholder="Enter name" value="<?= $indicator_property->getName(); ?>"/>

                                <label class="required">Description</label>
                                <textarea name="description" class="form-control"
                                          placeholder="Enter description"><?= $indicator_property->getDescription(); ?>
                                </textarea>

                                <label class="required">Type of property</label>
                                <?php if($indicator_property->hasData($indicator_property) && $indicator_property->getDatatype() != NULL): ?>
                                    <br/>
                                    <input type="text" title="Can not be edited" name="datatype" value="<?= $indicator_property->getDatatype(); ?>" readonly/>
                                <?php else: ?>
                                    <select name="datatype" class="select2_demo_1 form-control">
                                        <option value="-1">None</option>
                                        <?php foreach ($datatypes as $key => $value) :
                                            if(!strcmp($key, $indicator_property->getDatatype())): ?>
                                                <option value="<?=$key;?>" selected="selected">
                                                    <?= $value; ?>
                                                </option>
                                            <?php else: ?>
                                                <option value="<?=$key;?>">
                                                    <?= $value; ?>
                                                </option>
                                            <?php endif; ?>
                                        <?php endforeach;?>
                                    </select>
                                <?php endif; ?>

                                <input name="id" type="hidden" value="<?= $indicator_property->getId(); ?>"/>
                                <input name="indicator_id" type="hidden" value="<?= $indicator->getId(); ?>"/>

                                <h3></h3>

                                <a href="<?php echo base_url().'indicator_properties/show/'.$indicator->getId(); ?>"
                                   type="button" class="btn btn-sm btn-info pull-left col-sm-2">
                                    <i class="fa fa-caret-left"></i> Go Back
                                </a>

                                <div class="col-lg-7">
                                    <div class="errorresponse alert-danger" style="text-align:center;"></div>
                                    <div id="moment" style="text-align:center;"></div>
                                    <div id="response" class="alert-success" style="text-align:center;"></div>
                                </div>

                                <button class="btn btn-primary btn-sm pull-right col-sm-3" id="button"
                                        name="submit" type="submit"><i class="fa fa-save"></i> Save
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $("#update_property").submit(function (e) {
            e.preventDefault();
            $("#moment").text("please wait...").fadeIn("slow");
            $("#moment").fadeOut();
            $("#response").fadeOut("slow");
            $.ajax({
                type: 'POST',
                url: '<?= base_url() ?>indicator_properties/update/',
                dataType: 'text',
                data: $("#update_property").serialize(),
                timeout: 5000,
                success: function () {
                    $('#response').text("Updated successfully.")
                        .hide()
                        .fadeIn(1500, function () {
                            $('#update_property');
                            $("#response").fadeOut(7000);
                        });
                    window.location.href = "<?= base_url().'indicator_properties/show/'.$indicator->getId(); ?>";
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