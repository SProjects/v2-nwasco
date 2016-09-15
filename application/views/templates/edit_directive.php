<div class="wrapper wrapper-content">
    <div class="row wrapper border-bottom white-bg page-heading crumbs">Edit / Update Directive
    </div>
    <div id="mycontent">
        <div class="row">
            <div class="col-centered col-lg-9">
                <div class="ibox float-e-margins">
                    <div class="ibox-content" style="float:left;">
                        <?php foreach ($single_directive as $directive): ?>
                            <form id="directive_update" class="form-horizontal" method="post">

                                <input type="hidden" name="dir_id" value="<?= $directive->dir_id; ?>">
                                <div class="col-lg-12">
                                    <div class='row'>
                                        <div class='col-md-6'>
                                            <div class="form-group" id="data_1">
                                                <label class="font-noraml">Start Date</label>
                                                <div class="input-group date">
                                                    <span class="input-group-addon"><i
                                                            class="fa fa-calendar"></i></span><input type="text"
                                                                                                     class="form-control"
                                                                                                     name="issue_date"
                                                                                                     value="<?= date('Y-m-d', strtotime($directive->issue_date)); ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class='col-md-6'>
                                            <div class="form-group" id="data_2">
                                                <label class="font-noraml">End Date</label>
                                                <div class="input-group date">
                                                    <span class="input-group-addon"><i
                                                            class="fa fa-calendar"></i></span><input type="text"
                                                                                                     class="form-control"
                                                                                                     name="due_date"
                                                                                                     value="<?= date('Y-m-d', strtotime($directive->due_date)); ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input type="hidden" name="directive" class="form-control"
                                               value="<?= $directive->dir_id; ?>">
                                        <div class="ibox-content no-padding">
                        			<textarea name="directive" class="summernote">
		                                <?= $directive->directive; ?>
		                            </textarea>
                                            <label class="">Add Comments</label>
                                            <textarea name="comment" class="form-control"
                                                      placeholder="Write comment here..."><?= $directive->comments; ?></textarea>
                                            <a href="#" type="button" class="btn btn-sm btn-info pull-left col-sm-2"><i
                                                    class="fa fa-caret-left"></i> Go Back</a>
                                            <div class="col-lg-7">
                                                <div class="errorresponse alert-danger"
                                                     style="text-align:center;"></div>
                                                <div class="response" style="text-align:center;"></div>
                                                <div id="response" class="alert-success"
                                                     style="text-align:center;"></div>
                                            </div>
                                            <button class="btn btn-primary btn-sm pull-right col-sm-3" id="button"
                                                    name="submit" type="submit"><i class="fa fa-save"></i> Save changes
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    $(document).ready(function () {
        $("#directive_update").submit(function (e) {
            e.preventDefault();
            $(".response").text("please wait...").fadeIn("slow");
            $(".response").fadeOut();
            $("#response").fadeOut("slow");
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url() ?>indicator/update_directive/',
                dataType: 'text',
                data: $("#directive_update").serialize(),
                timeout: 5000,
                success: function () {
                    $('#response').text("Updated Successfully.")
                        .hide()
                        .fadeIn(1500, function () {
                            $('#directive_update');
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