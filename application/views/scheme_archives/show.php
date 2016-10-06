<div class="wrapper wrapper-content">
    <div class="row wrapper border-bottom white-bg page-heading crumbs">Private Schemes<i
            class="fa fa-chevron-right"></i> Archives
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
                                        <h5 class="center"><?= 'Archived '.$key; ?></h5>
                                    </div>

                                    <?php if (count($instruction_groups) == 0): ?>
                                        No Archived <?= $key; ?>
                                    <?php else: ?>
                                        <table class="table table-striped table-bordered table-hover directives">
                                            <thead>
                                            <?php
                                            foreach ($instruction_groups as $instruction_group):
                                                $instruction_headings = $instruction_group;
                                                ?>
                                                <tr>
                                                    <th style="width: 5px;">#</th>
                                                    <?php for ($x = 0; $x < sizeof($instruction_headings); $x++): ?>
                                                        <th>
                                                            <?= $instruction_headings[$x]->getIndicatorProperty()->getName(); ?>
                                                        </th>
                                                    <?php endfor; ?>
                                                    <th>Date of Issue</th>
                                                </tr>
                                                <?php break; endforeach; ?>
                                            </thead>
                                            <tbody>
                                            <?php $i=1; foreach ($instruction_groups as $instructions): ?>
                                                <tr>
                                                    <td><?= $i; ?></td>
                                                    <?php for ($x = 0; $x < sizeof($instructions); $x++): ?>
                                                        <td><?= $instructions[$x]->getValue(); ?></td>
                                                    <?php endfor; ?>
                                                    <td><?= $instructions[0]->getCreatedAt(); ?></td>
                                                </tr>
                                            <?php $i++; endforeach; ?>
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
