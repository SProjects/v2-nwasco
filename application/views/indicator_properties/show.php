<div class="wrapper wrapper-content">
    <div class="row wrapper border-bottom white-bg page-heading crumbs">
        <?php echo $indicator->getName(); ?> <i class="fa fa-chevron-right"></i> Indicator Properties
    </div>
    <div>
        <div class="col-lg-12 jss">
            <div class="pull-left">
                <div class="btn-group">
                    <a href="<?php echo base_url().'indicator' ?>"
                       type="button" class="btn btn-xs btn-success">
                        Back
                    </a>
                </div>
                <h3></h3>
            </div>
            <div class="pull-right">
                <div class="btn-group">
                    <a href="<?php echo base_url().'indicator_properties/add/'.$indicator->getId(); ?>"
                       type="button" class="btn btn-xs btn-success">
                        Add Property
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
                    <th>Data Type</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                    <?php if(sizeof($indicator_properties) == 0): ?>
                        <tr>
                            <td colspan="5">No properties</td>
                        </tr>
                    <?php endif; ?>

                    <?php $x = 1;
                    foreach ($indicator_properties as $indicator_property) { ?>
                        <tr>
                            <td><?php echo $x; ?></td>
                            <td><?php echo $indicator_property->getName(); ?></td>
                            <td><?php echo $indicator_property->getDescription(); ?></td>
                            <td><?php echo $indicator_property->getDatatype(); ?></td>
                            <td>
                                <div class="btn-group">
                                    <a href="<?php echo base_url().'indicator_properties/edit/'.$indicator->getId().'/'.$indicator_property->getId(); ?>"
                                       type="button" title="Edit" class="btn btn-xs btn-white">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <?php if(!$indicator_property->hasData($indicator_property)): ?>
                                        <a href="<?= base_url().'indicator_properties/delete/'.$indicator->getId().'/'.$indicator_property->getId(); ?>"
                                           type="button" title="Delete" class="btn btn-xs btn-white">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                        <?php $x++;
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>