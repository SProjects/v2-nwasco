<div class="wrapper wrapper-content">
    <div class="row wrapper border-bottom white-bg page-heading crumbs">Commercial Utilities</div>
    <div>
        <div class="col-lg-12 jss">
            <div class="pull-right">
                <div class="btn-group">
                    <a href="<?php echo base_url().'utility/add'; ?>" type="button" class="btn btn-xs btn-success">
                        Add New Commercial Utility
                    </a>
                </div>
                <h3></h3>
            </div>
            <table class="table table-bordered table-hover white-bg">
                <thead>
                <tr role="row">
                    <th>#</th>
                    <th>Name</th>
                    <th>Abbreviation</th>
                    <th>Inspector</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <?php $x = 1;
                foreach ($utilityObjs as $utility) { ?>
                    <tbody>
                    <tr>
                        <td><?php echo $x; ?></td>
                        <td><?php echo $utility->getName(); ?></td>
                        <td><?php echo $utility->getAbbreviation(); ?></td>
                        <td><?php echo $utility->getInspectorName(); ?></td>
                        <td>
                            <div class="btn-group">
                                <a href="<?php echo base_url()."utility/show/".$utility->getId(); ?>"
                                   type="button" title="View" class="btn btn-xs btn-white">
                                    <i class="fa fa-external-link"></i>
                                </a>
                                <a href="<?php echo base_url()."utility/edit/".$utility->getId(); ?>"
                                   type="button" title="Edit" class="btn btn-xs btn-white">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="#"
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