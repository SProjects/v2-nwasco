<div class="wrapper wrapper-content">
    <div class="row wrapper border-bottom white-bg page-heading crumbs">Indicators</div>
    <div>
        <div class="col-lg-12 jss">
            <div class="pull-right">
                <div class="btn-group">
                    <a href="<?php echo base_url().'indicator/add'; ?>" type="button" class="btn btn-xs btn-success">
                        Add New Indicator
                    </a>
                </div>
                <h3></h3>
            </div>
            <table class="table table-bordered table-hover white-bg">
                <thead>
                <tr role="row">
                    <th>#</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th></th>
                </tr>
                </thead>
                <?php $x = 1;
                foreach ($indicatorObjs as $indicator) { ?>
                    <tbody>
                    <tr>
                        <td><?php echo $x; ?></td>
                        <td><?php echo $indicator->getName(); ?></td>
                        <td><?php echo $indicator->getDescription(); ?></td>
                        <td>
                            <div class="btn-group">
                                <a href="<?php echo base_url()."indicator/details/directives/".$indicator->getId(); ?>"
                                   type="button" title="View" class="btn btn-xs btn-white">
                                    <i class="fa fa-external-link"></i>
                                </a>
                                <a href="<?php echo base_url()."indicator/edit/".$indicator->getId(); ?>"
                                   type="button" title="Edit" class="btn btn-xs btn-white">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="<?php echo base_url()."indicator/delete/".$indicator->getId(); ?>"
                                   type="button" title="Delete" class="btn btn-xs btn-white">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                    <?php $x++;
                } ?>
            </table>
        </div>
    </div>
</div>