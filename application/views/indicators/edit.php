<div class="wrapper wrapper-content">
    <div class="row wrapper border-bottom white-bg page-heading crumbs">Edit/Update Indicator</div>
    <div id="mycontent">
        <div class="row">
            <div class="col-centered col-lg-6">
                <div class="ibox float-e-margins white-bg">
                    <form id="update_indicator" class="form-horizontal" method="post">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <input type="hidden" name="id" value="<?php echo $indicator->getId(); ?>"/>

                                <label class="">Name</label>
                                <input name="name" class="form-control" placeholder="Enter name"
                                       value="<?php echo $indicator->getName(); ?>"/>

                                <label class="">Description</label>
                                <textarea name="description" class="form-control"
                                          placeholder="Enter description"><?php echo $indicator->getDescription(); ?>
                                </textarea>

                                <a href="<?php echo base_url().'indicator'?>" type="button"
                                   class="btn btn-sm btn-info pull-left col-sm-2">
                                    <i class="fa fa-caret-left"></i> Go Back
                                </a>

                                <div class="col-lg-7">
                                    <div class="errorresponse alert-danger" style="text-align:center;"></div>
                                    <div id="moment" style="text-align:center;"></div>
                                    <div id="response" class="alert-success" style="text-align:center;"></div>
                                </div>

                                <button class="btn btn-primary btn-sm pull-right col-sm-3" id="button"
                                        name="submit" type="submit"><i class="fa fa-save"></i> Save changes
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
        $("#update_indicator").submit(function (e) {
            e.preventDefault();
            $("#moment").text("please wait...").fadeIn("slow");
            $("#moment").fadeOut();
            $("#response").fadeOut("slow");
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url() ?>indicator/update',
                dataType: 'text',
                data: $("#update_indicator").serialize(),
                timeout: 5000,
                success: function () {
                    $('#response').text("Updated successfully.")
                        .hide()
                        .fadeIn(1500, function () {
                            $('#update_indicator');
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