<div class="wrapper wrapper-content">
    <div class="row wrapper border-bottom white-bg page-heading crumbs">Requests <i
            class="fa fa-chevron-right"></i> Manage pending <?= strtolower($heading); ?> requests</div>
    <div id="mycontent">
        <div class="col-lg-12 jss">
            <h1></h1>
            <table class="table table-bordered table-hover white-bg">
                <thead>
                <tr role="row">
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
                            <td colspan="4">No pending requests</td>
                        </tr>
                    <?php else: ?>
                        <?php $x = 1;
                        foreach ($requests as $request): ?>

                            <tr>
                                <td><?= $x; ?></td>
                                <td><?= $request->getUser()->last_name.' '.$request->getUser()->first_name; ?></td>
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
        </div>
    </div>
</div>