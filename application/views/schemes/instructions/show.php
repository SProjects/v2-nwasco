<div class="wrapper wrapper-content">
    <div class="row wrapper border-bottom white-bg page-heading crumbs">Private Schemes<i
            class="fa fa-chevron-right"></i> Overview
    </div>
    <div id="mycontent">
        <!--Insert header info about scheme here-->
        <div class="row m-b-lg m-t-lg">
            <div class="col-md-4">

                <div class="profile-image">
                    <img src="<?php echo base_url(); ?>assets/images/nkana.png" class="img-circle circle-border m-b-md"
                         alt="profile">
                </div>
                <div class="profile-info">
                    <div class="">
                        <div>
                            <h2><?= $scheme->getName(); ?></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--End of header info-->

        <!--Insert summery info about indicators-->
        <div class="row utility">
            <div class="col-lg-12 no-gutter">
                <h3 class="head">Indicators</h3>
                <?php $i = 0;
                foreach ($instructions as $key => $instruction_groups): ?>
                    <div class="col-lg-2">
                        <div class="ibox float-e-margins">
                            <div class="ibox-content">

                                <h4 class="no-margins"><?= $key; ?></h4>
                                <div class="indicator-elements">
                                    <small>
                                        <div class="indicators">
                                            <ul class="folder-list" style="padding: 0">
                                                <li>Active <span class="label label-info pull-right">0</span></li>
                                                <li>Almost Due <span class="label label-warning pull-right">0</span>
                                                </li>
                                                <li>Over Due <span class="label label-danger pull-right">1</span></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $i++; endforeach; ?>
            </div>
        </div>
        <!--End of summery info-->

        <!--Begin tab content div-->
        <div class="row">
            <div class="col-lg-12">
                <div class="tabs-container">
                    <ul class="nav nav-tabs">
                        <?php $i = 0; foreach ($instructions as $key => $instruction_groups): ?>
                            <li class="tab<?php if ($i === 0): ?> active<?php endif; ?>">
                                <a data-toggle="tab"
                                   href="#tab-<?= strtolower(str_replace('/', '', preg_replace('/\s+/', '', $key))); ?>">
                                    <?= $key; ?>
                                </a>
                            </li>
                            <?php $i++; endforeach; ?>
                    </ul>

                    <div class="tab-content">
                        <?php $i = 0; foreach ($instructions as $key => $instruction_groups): ?>
                            <div id="tab-<?= strtolower(str_replace('/', '', preg_replace('/\s+/', '', $key))); ?>"
                                 class="tab-pane<?php if ($i === 0): ?> active<?php endif; ?>">
                                <div class="panel-body">

                                    <div class="ibox-title"  style="border-top: 0; padding-right:0;">
                                        <h5 class="center"><?= $key; ?></h5>
                                        <div class="pull-right">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-xs btn-success">Add New</button>
                                            </div>
                                        </div>
                                    </div>

                                    <?php if (count($instruction_groups) == 0): ?>
                                        No <?= $key; ?>
                                    <?php else: ?>
                                        <table class="table table-striped table-bordered table-hover directives">
                                            <thead>
                                            <?php
                                            foreach ($instruction_groups as $instruction_group):
                                                $instruction_headings = $instruction_group;
                                                ?>
                                                <tr>
                                                    <?php for ($x = 0; $x < sizeof($instruction_headings); $x++): ?>
                                                        <th>
                                                            <?= $instruction_headings[$x]->getIndicatorProperty()->getName(); ?>
                                                        </th>
                                                    <?php endfor; ?>
                                                    <th>Status</th>
                                                    <th style="width: 80px;">Actions</th>
                                                </tr>
                                                <?php break; endforeach; ?>
                                            </thead>
                                            <tbody>
                                            <?php foreach ($instruction_groups as $instructions): ?>
                                                <tr>
                                                    <?php for ($x = 0; $x < sizeof($instructions); $x++): ?>
                                                        <td><?= $instructions[$x]->getValue(); ?></td>
                                                    <?php endfor; ?>
                                                    <td></td>
                                                    <td>
                                                        <?php if ($this->ion_auth->is_admin()) { ?>
                                                            <div class="btn-group">
                                                                <a href="#"
                                                                   type="button" title="Edit"
                                                                   class="btn btn-xs btn-white"><i
                                                                        class="fa fa-edit"></i></a>
                                                                <button type="button" data-toggle="tooltip"
                                                                        data-placement="bottom" title="Archive"
                                                                        class="btn btn-xs btn-white"><i
                                                                        class="fa fa-archive"></i></button>
                                                            </div>
                                                        <?php } else { ?>

                                                            <div class="btn-group">
                                                                <button data-toggle="tooltip"
                                                                        data-placement="bottom"
                                                                        title="Request Edit" data-toggle="modal"
                                                                        data-target="#myModal"
                                                                        class="btn btn-sm btn-white"><i
                                                                        class="fa fa-edit"></i></button>
                                                                <button type="button" data-toggle="tooltip"
                                                                        data-placement="bottom"
                                                                        title="Request Archive"
                                                                        class="btn btn-sm btn-white"><i
                                                                        class="fa fa-archive"></i></button>
                                                            </div>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    <?php endif; ?>

                                </div>
                            </div>
                            <?php $i++; endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        <!--End of tab content div-->

    </div>
</div>
