<div class="wrapper wrapper-content">
    <div class="row wrapper border-bottom white-bg page-heading crumbs">Indicators</div>
    <div id="mycontent">
        <div class="col-lg-12 jss">
            <div class="pull-right">
                <div class="btn-group">
                    <a href="<?php echo base_url().'indicator/add'; ?>" type="button" class="btn btn-xs btn-success">
                        Add New Indicator
                    </a>
                </div>
                <h3></h3>
            </div>

            <h3>Commercial Utility Indicators</h3>
            <table class="table table-bordered table-hover white-bg">
                <thead>
                <tr role="row">
                    <th>#</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Properties/Fields(#)</th>
                    <th title="Send alert when days to expiry date are less than those in this field">
                        Days to Expire(#)
                    </th>
                    <th>Chart</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php if(sizeof($utilityIndicatorObjs) == 0): ?>
                    <tr>
                        <td colspan="6">No indicators</td>
                    </tr>
                <?php endif; ?>

                <?php $x = 1;
                foreach ($utilityIndicatorObjs as $indicator) { ?>
                    <tr>
                        <td><?php echo $x; ?></td>
                        <td><?php echo $indicator->getName(); ?></td>
                        <td><?php echo $indicator->getDescription(); ?></td>
                        <td>
                            <?= sizeof($indicator->getIndicatorProperties($indicator)).' '; ?>
                            <a href="<?= base_url().'indicator_properties/show/'.$indicator->getId(); ?>"
                               type="button" title="View/Add property" class="btn btn-xs btn-white">
                                <i class="fa fa-search-plus"></i>
                            </a>
                        </td>
                        <td>
                            <?php echo ($indicator->getDaysToExpire() == NULL) ? "Not set" : $indicator->getDaysToExpire(); ?>
                        </td>
                        <td style="text-align: center;">
                            <?php if($indicator->getHaveChart()): ?>
                                <span class="fa fa-check-circle"></span>
                            <?php else: ?>
                                <span class="fa fa-times-circle"></span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="btn-group">
                                <a href="<?php echo base_url()."indicator/show_utility/".$indicator->getId(); ?>"
                                   type="button" title="View" class="btn btn-xs btn-white">
                                    <i class="fa fa-external-link"></i>
                                </a>
                                <a href="<?php echo base_url()."indicator/edit/".$indicator->getId(); ?>"
                                   type="button" title="Edit" class="btn btn-xs btn-white">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <?php if(!$indicator->hasData($indicator)): ?>
                                    <a href="<?php echo base_url()."indicator/delete/".$indicator->getId(); ?>"
                                       type="button" title="Delete" class="btn btn-xs btn-white"
                                       onclick="return confirm('Are you sure? This action is irreversible.');">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                    <?php $x++;
                } ?>
            </table>

            <h3>Private Scheme Indicators</h3>
            <table class="table table-bordered table-hover white-bg">
                <thead>
                <tr role="row">
                    <th>#</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Properties/Fields(#)</th>
                    <th title="Send alert when days to expiry date are less than those in this field">
                        Days to Expire(#)
                    </th>
                    <th>Chart</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php if(sizeof($schemeIndicatorObjs) == 0): ?>
                    <tr>
                        <td colspan="6">No indicators</td>
                    </tr>
                <?php endif; ?>

                <?php $x = 1;
                foreach ($schemeIndicatorObjs as $indicator) { ?>
                    <tbody>
                    <tr>
                        <td><?php echo $x; ?></td>
                        <td><?php echo $indicator->getName(); ?></td>
                        <td><?php echo $indicator->getDescription(); ?></td>
                        <td>
                            <?= sizeof($indicator->getIndicatorProperties($indicator)).' '; ?>
                            <a href="<?= base_url().'indicator_properties/show/'.$indicator->getId(); ?>"
                               type="button" title="View/Add property" class="btn btn-xs btn-white">
                                <i class="fa fa-search-plus"></i>
                            </a>
                        </td>
                        <td>
                            <?php echo ($indicator->getDaysToExpire() == NULL) ? "Not set" : $indicator->getDaysToExpire(); ?>
                        </td>
                        <td style="text-align: center;">
                            <?php if($indicator->getHaveChart()): ?>
                                <span class="fa fa-check-circle"></span>
                            <?php else: ?>
                                <span class="fa fa-times-circle"></span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="btn-group">
                                <a href="<?php echo base_url()."indicator/show_scheme/".$indicator->getId(); ?>"
                                   type="button" title="View" class="btn btn-xs btn-white">
                                    <i class="fa fa-external-link"></i>
                                </a>
                                <a href="<?php echo base_url()."indicator/edit/".$indicator->getId(); ?>"
                                   type="button" title="Edit" class="btn btn-xs btn-white">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <?php if(!$indicator->hasData($indicator)): ?>
                                    <a href="<?php echo base_url()."indicator/delete/".$indicator->getId(); ?>"
                                       type="button" title="Delete" class="btn btn-xs btn-white"
                                       onclick="return confirm('Are you sure? This action is irreversible.');">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                <?php endif; ?>
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