<div class="wrapper wrapper-content">
    <div class="row wrapper border-bottom white-bg page-heading crumbs">Requests <i
            class="fa fa-chevron-right"></i> Manage pending <?= strtolower($heading); ?> requests</div>
    <div id="mycontent">
        <div class="col-lg-12 jss">
            <form id="bulk_request_action" class="form-horizontal" method="post">
                <div class="pull-right">
                    <div class="btn-group">
                        <button type="button" class="btn btn-xs btn-success" id="approve-all">
                            Bulk Approve
                        </button>
                        <button type="button" class="btn btn-xs btn-danger" id="deny-all">
                            Bulk Deny
                        </button>
                    </div>
                    <h3></h3>
                </div>

                <div class="form-group">
                    <div class="col-lg-7">
                        <div class="errorresponse alert-danger" style="text-align:center;"></div>
                        <div class="response" style="text-align:center;"></div>
                        <div id="response" class="alert-success" style="text-align:center;"></div>
                    </div>
                </div>

                <table class="table table-bordered table-hover white-bg">
                    <thead>
                    <tr role="row">
                        <th style="width: 3%;">
                            <input type="checkbox" name="select-all" id="select-all" />
                        </th>
                        <th style="width: 3%;">#</th>
                        <th style="width: 15%;">Requested by</th>
                        <th style="width: 10%;">Type</th>
                        <th>Reason</th>
                        <th style="width: 15%;">Date/Time</th>
                        <th style="width: 5%;">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php if (sizeof($requests) == 0): ?>
                            <tr>
                                <td colspan="7">No pending requests</td>
                            </tr>
                        <?php else: ?>
                            <?php $x = 1;
                            foreach ($requests as $request): ?>

                                <tr>
                                    <td>
                                        <input type="checkbox" name="requests[]" value="<?= $request->getId(); ?>">
                                    </td>
                                    <td><?= $x; ?></td>
                                    <td><?= $request->getRequesterName(); ?></td>
                                    <td><?= $request->getKind(); ?></td>
                                    <td><?= $request->getReason(); ?></td>
                                    <td><?= $request->getCreatedAt(); ?></td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="<?php echo base_url()."requests/approve/".$request->getId().'/ACCEPTED/'.$heading; ?>"
                                               type="button" title="Approve" class="btn btn-xs btn-white">
                                                <i class="fa fa-external-link"></i>
                                            </a>
                                            <a href="<?php echo base_url()."requests/delete/".$request->getId().'/'.$heading; ?>"
                                               type="button" title="Delete"
                                               class="btn btn-xs btn-white" onclick="return confirm('Are you sure? This action is irreversible.');">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>

                            <?php $x++; endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#select-all').click(function(event) {
            if(this.checked) {
                // Iterate each checkbox
                $(':checkbox').each(function() {
                    this.checked = true;
                });
            } else {
                $(":checkbox").each(function() {
                    this.checked = false;
                });
            }
        });

        $('#approve-all').click(function(event) {
            $(".response").text("please wait...").fadeIn("slow");
            $(".response").fadeOut();
            $("#response").fadeOut("slow");
            $.ajax({
                type: 'POST',
                url: '<?= base_url() ?>requests/bulk_approve/',
                dataType: 'text',
                data: $("#bulk_request_action").serialize(),
                timeout: 5000,
                success: function () {
                    $('#response').text("Approved Successfully.")
                        .hide()
                        .fadeIn(1500, function () {
                            $('#bulk_request_action');
                            $("#response").fadeOut(7000);
                        });
                    window.location.href = "<?php echo base_url()."requests/show/".$heading; ?>";
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

        $('#deny-all').click(function(event) {
            $(".response").text("please wait...").fadeIn("slow");
            $(".response").fadeOut();
            $("#response").fadeOut("slow");
            $.ajax({
                type: 'POST',
                url: '<?= base_url() ?>requests/bulk_deny/',
                dataType: 'text',
                data: $("#bulk_request_action").serialize(),
                timeout: 5000,
                success: function () {
                    $('#response').text("Approved Successfully.")
                        .hide()
                        .fadeIn(1500, function () {
                            $('#bulk_request_action');
                            $("#response").fadeOut(7000);
                        });
                    window.location.href = "<?php echo base_url()."requests/show/".$heading; ?>";
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