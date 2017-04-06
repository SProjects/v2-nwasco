<div class="wrapper wrapper-content">
    <div class="row wrapper border-bottom white-bg page-heading crumbs">Commercial Utility <i
            class="fa fa-chevron-right"></i> Overview
    </div>
    <div id="mycontent">
        <!--Insert header info about utility here-->
        <div class="row m-b-lg m-t-lg">
            <div class="col-md-4">

                <div class="profile-image">
                    <img src="<?php echo base_url(); ?>assets/images/nkana.png" class="img-circle circle-border m-b-md"
                         alt="profile">
                </div>
                <div class="profile-info">
                    <div class="">
                        <div>
                            <h2>
                                <?= $utility->getAbbreviation(); ?>
                            </h2>
                            <h4><?= $utility->getName(); ?></h4>
                            <h5>Inspector:
                                <?php $inspectorName = $utility->getInspectorName();
                                if ($inspectorName == NULL): ?>
                                    Unassigned
                                <?php else:
                                    echo $inspectorName;
                                endif; ?>
                            </h5>
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
                foreach ($instructions as $key => $instruction_groups):

                    $indicatordao = new Indicator_dao();
                    $indicator = $indicatordao->get(array(
                        Indicator_dao::NAME_FIELD => $key,
                        Indicator_dao::KIND_FIELD => Indicator_model::getUtilityKind()
                    ))[0];

                    $indicator_instruction = new Indicator_instruction_model();
                    $statuses = $indicator_instruction->getUtilityInstructionsStatusSummary($utility, $indicator);
                    ?>
                    <div class="col-lg-2">
                        <div class="ibox float-e-margins">
                            <div class="ibox-content">

                                <h4 class="no-margins"><?= $key; ?></h4>
                                <div class="indicator-elements">
                                    <small>
                                        <div class="indicators">
                                            <ul class="folder-list" style="padding: 0">
                                                <li>Active <span class="label label-info pull-right"><?= $statuses['ACTIVE']; ?></span></li>
                                                <li>Almost Due <span class="label label-warning pull-right"><?= $statuses['ALMOST']; ?></span>
                                                </li>
                                                <li>Over Due <span class="label label-danger pull-right"><?= $statuses['OVERDUE']; ?></span></a>
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
                                                <?php
                                                    $indicatordao = new Indicator_dao();
                                                    $indicator = $indicatordao->get(array(
                                                        Indicator_dao::NAME_FIELD => $key,
                                                        Indicator_dao::KIND_FIELD => Indicator_model::getUtilityKind()
                                                    ));
                                                ?>
                                                <a href="<?= base_url().'utility_indicator_instructions/add/'.$utility->getId().'/'.$indicator[0]->getId(); ?>"
                                                   class="btn btn-xs btn-success">Add New</a>
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
                                                    <th>#</th>
                                                    <?php for ($x = 0; $x < sizeof($instruction_headings); $x++): ?>
                                                        <th>
                                                            <?= $instruction_headings[$x]->getIndicatorProperty()->getName(); ?>
                                                        </th>
                                                    <?php endfor; ?>
                                                    <th>Date of Issue</th>
                                                    <th>Status</th>
                                                    <th style="width: 80px;">Actions</th>
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
                                                    <td>
                                                        <?php
                                                            $indicator_instruction = new Indicator_instruction_model();
                                                            switch($indicator_instruction->getStatus($instructions)) {
                                                                case 'ACTIVE':
                                                                    echo '<span class="label label-primary right">Active</span>';
                                                                    break;
                                                                case 'ALMOST':
                                                                    echo '<span class="label label-warning right">Almost due</span>';
                                                                    break;
                                                                case 'OVERDUE':
                                                                    echo '<span class="label label-danger right">Over due</span>';
                                                                    break;
                                                                case 'MISSING':
                                                                    echo '<span class="label label-info right">Missing date</span>';
                                                                    break;
                                                                case 'COMPLETE':
                                                                    echo '<span class="label label-info right">Complete</span>';
                                                                    break;
                                                            }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php $instruction = $instructions[0];
                                                        if ($this->ion_auth->is_admin()): ?>
                                                            <div class="btn-group">
                                                                <?php if(!$instruction->isCompleted($instruction)):?>
                                                                    <a href="<?= base_url().'utility_indicator_instructions/edit/'.$utility->getId().'/'.$indicator[0]->getId().'/'. $instruction->getUnionToken(); ?>"
                                                                       type="button" title="Edit"
                                                                       class="btn btn-xs btn-white"><i
                                                                            class="fa fa-edit"></i></a>
                                                                <?php endif; ?>
                                                                <a href="<?= base_url().'utility_indicator_instructions/archive/'.$utility->getId().'/'.$indicator[0]->getId().'/'. $instruction->getUnionToken(); ?>"
                                                                   type="button" title="Archive"
                                                                   class="btn btn-xs btn-white" onclick="return confirm('Are you sure?');"><i
                                                                        class="fa fa-archive"></i></a>
                                                            </div>
                                                        <?php else: ?>
                                                            <?php if($utility->getInspectorId() == $this->session->userdata('user_id')): ?>
                                                                <?php $hasPendingEditRequest = $instruction->hasPendingEditRequest($instruction);
                                                                      if ($hasPendingEditRequest): ?>
                                                                        <span class="label label-info right"><i
                                                                                class="fa fa-edit"></i> Pending Edit Request</span>
                                                                <?php endif; ?>

                                                                <?php $hasPendingArchiveRequest = $instruction->hasPendingArchiveRequest($instruction);
                                                                      if ($hasPendingArchiveRequest): ?>
                                                                        <span class="label label-info right"><i
                                                                                class="fa fa-archive"></i> Pending Archive Request</span>
                                                                <?php endif; ?>

                                                                <?php $hasAcceptedEditRequest = $instruction->hasAcceptedEditRequest($instruction);
                                                                      if ($hasAcceptedEditRequest): ?>
                                                                        <a href="<?= base_url().'utility_indicator_instructions/edit/'.$utility->getId().'/'.$indicator[0]->getId().'/'. $instruction->getUnionToken(); ?>"
                                                                           type="button" title="Click to Edit"
                                                                           class="btn btn-xs btn-white"><i
                                                                                class="fa fa-edit"></i> Click to edit
                                                                        </a>
                                                                <?php endif; ?>

                                                                <?php $hasAcceptedArchiveRequest = $instruction->hasAcceptedArchiveRequest($instruction);
                                                                      if ($hasAcceptedArchiveRequest): ?>
                                                                        <a href="<?= base_url().'utility_indicator_instructions/archive/'.$utility->getId().'/'.$indicator[0]->getId().'/'. $instruction->getUnionToken(); ?>"
                                                                           type="button" title="Click to Archive"
                                                                           class="btn btn-xs btn-white" onclick="return confirm('Are you sure?');"><i
                                                                                class="fa fa-archive"></i> Click to archive
                                                                        </a>
                                                                <?php endif; ?>

                                                                <!--Prevent these actions from showing if there is an active request-->
                                                                <?php if (!$hasPendingArchiveRequest && !$hasPendingEditRequest && !$hasAcceptedEditRequest && !$hasAcceptedArchiveRequest):?>
                                                                    <div class="btn-group">
                                                                        <?php if(!$instruction->isCompleted($instruction)):?>
                                                                            <a href="#" type="button" title="Edit" class="btn btn-xs btn-white"
                                                                               data-toggle="modal" data-target="#utilityEditModal_<?= $instruction->getUnionToken(); ?>"><i
                                                                                    class="fa fa-edit"></i></a>
                                                                        <?php endif; ?>

                                                                        <a href="#" type="button" title="Request Archive" class="btn btn-xs btn-white"
                                                                           data-toggle="modal" data-target="#utilityArchiveModal_<?= $instruction->getUnionToken(); ?>"><i
                                                                                class="fa fa-archive"></i></a>

                                                                        <?php if(!$instruction->isCompleted($instruction)):?>
                                                                            <a href="<?= base_url().'utility_indicator_instructions/complete/'. $instruction->getUnionToken().'/'.$utility->getId(); ?>"
                                                                               type="button" title="Mark Task As Complete"
                                                                               class="btn btn-xs btn-white"><i
                                                                                    class="fa fa-check-circle" onclick="return confirm('Are you sure the task is complete?');"></i>
                                                                            </a>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                <?php endif; ?>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>

                                                <?php if(!$instruction->isCompleted($instruction)):?>
                                                    <!-- Utility Edit Modal -->
                                                    <div id="utilityEditModal_<?= $instruction->getUnionToken(); ?>" class="modal fade" role="dialog">
                                                        <div class="modal-dialog">

                                                            <!-- Modal content-->
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    <h4 class="modal-title">Utility Instruction Edit Request</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="<?= base_url().'requests/create'?>" method="post" id="edit_reason" class="form-horizontal">
                                                                        <label class="required">Describe reason for edit</label>
                                                                        <textarea name="reason" class="form-control" placeholder="Enter reason here"></textarea>

                                                                        <input type="hidden" name="kind" value="EDIT">
                                                                        <input type="hidden" name="status" value="PENDING">
                                                                        <input type="hidden" name="indicator_id" value="<?= $indicator[0]->getId(); ?>">
                                                                        <input type="hidden" name="instruction_token" value="<?= $instruction->getUnionToken(); ?>">
                                                                        <input type="hidden" name="user_id" value="<?= $user->id; ?>">
                                                                        <input type="hidden" name="source" value="utility">
                                                                        <input type="hidden" name="facility_id" value="<?= $utility->getId(); ?>">

                                                                        <button class="btn btn-primary pull-right col-sm-3 btn-sm" id="button"
                                                                                name="submit" type="submit"><i class="fa fa-save"></i> Save
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                <?php endif; ?>

                                                <!-- Utility Archive Modal -->
                                                <div id="utilityArchiveModal_<?= $instruction->getUnionToken(); ?>" class="modal fade" role="dialog">
                                                    <div class="modal-dialog">

                                                        <!-- Modal content-->
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                <h4 class="modal-title">Utility Instruction Archive Request</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="<?= base_url().'requests/create'?>" method="post" id="edit_reason" class="form-horizontal">
                                                                    <label class="required">Describe reason for archiving</label>
                                                                    <textarea name="reason" class="form-control" placeholder="Enter reason here"></textarea>

                                                                    <input type="hidden" name="kind" value="ARCHIVE">
                                                                    <input type="hidden" name="status" value="PENDING">
                                                                    <input type="hidden" name="indicator_id" value="<?= $indicator[0]->getId(); ?>">
                                                                    <input type="hidden" name="instruction_token" value="<?= $instruction->getUnionToken(); ?>">
                                                                    <input type="hidden" name="user_id" value="<?= $user->id; ?>">
                                                                    <input type="hidden" name="source" value="utility">
                                                                    <input type="hidden" name="facility_id" value="<?= $utility->getId(); ?>">

                                                                    <button class="btn btn-primary pull-right col-sm-3 btn-sm" id="button"
                                                                            name="submit" type="submit"><i class="fa fa-save"></i> Save
                                                                    </button>
                                                                </form>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

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
