<div class="wrapper wrapper-content">
    <div
        class="row wrapper border-bottom white-bg page-heading crumbs"><?= $indicator->getName(); ?>
        <i class="fa fa-chevron-right"></i> Overview
    </div>

    <div id="mycontent">
        <div class="row utility">
            <div class="col-lg-12 no-gutter">

                <div class="row">

                    <?php foreach ($scheme_objects as $scheme): ?>
                        <?php
                        $indicator_instruction = new Indicator_instruction_model();
                        $statuses = $indicator_instruction->getSchemeInstructionsStatusSummary($scheme, $indicator);
                        $total_instructions = $statuses['ACTIVE'] + $statuses['ALMOST'] + $statuses['OVERDUE'];
                        ?>
                        <div class="col-lg-3" id="<?= $scheme->getId(); ?>">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5><?= $scheme->getName(); ?></h5>
                                </div>
                                <div class="ibox-content indicators">
                                        <span class="font-noraml">
                                            <?php if ($total_instructions == 0): ?>
                                                No <?= $indicator->getName(); ?>
                                            <?php else: ?>
                                                <?= $indicator->getName(); ?>
                                                <span class="label label-success pull-left">
                                                    <?= $total_instructions; ?>
                                                </span>
                                            <?php endif; ?>
                                        </span>
                                    <ul class="folder-list" style="padding: 0">
                                        <li>Active <span
                                                class="label label-info pull-right"><?= $statuses['ACTIVE']; ?></span>
                                        </li>
                                        <li>Almost Due <span
                                                class="label label-warning pull-right"><?= $statuses['ALMOST']; ?></span>
                                        </li>
                                        <li>Over Due <span
                                                class="label label-danger pull-right"><?= $statuses['OVERDUE']; ?></span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                </div>
            </div>
        </div>
    </div>