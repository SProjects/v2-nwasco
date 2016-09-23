<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?= CI_title() ?></title>
    <link rel="shortcut icon" type="image/icon" href="<?php echo base_url(); ?>assets/images/favicon.ico"/>
    <?= CI_head() ?>
</head>
<body<?= CI_body_attr() ?>>
<div id="wrapper">


    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="upperspace">
                </li>

                <!--Commericial Utilities menu-->
                <li class="<?= ($this->uri->segment(1) === 'dashboard') ? 'active' : '' ?>">
                    <a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-desktop"></i> <span class="nav-label">Home</span></a>
                </li>
                <li class="<?= ($this->uri->segment(1) === 'utility') ? 'active' : '' ?>">
                    <a href="#"><i class="fa fa-th-large"></i> <span class="nav-label">Commercial Utilities</span><span
                            class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse" style="height: 0px;">
                        <li class="<?= ($this->uri->segment(1) === 'utility' && $this->uri->segment(2) == NULL) ? 'active' : '' ?>">
                            <a href="<?php echo base_url() . "utility"; ?>">Manage Utilities</a>
                        </li>
                        <?php if (count($utilities) > 0): ?>
                            <?php foreach ($utilities as $utility): ?>
                                <li class="<?= ($this->uri->segment(3) === '' . $utility->getId() . '') ? 'active' : '' ?>">
                                    <a href="<?= base_url().'utility/show/'.$utility->getId(); ?>">
                                        <?= $utility->getName(); ?>
                                    </a></li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            No Utilities
                        <?php endif; ?>
                    </ul>
                </li>
                <!--End: Commercial Utilities menu-->

                <!--Indicators menu-->
                <li class="<?= ($this->uri->segment(1) === 'indicator') ? 'active' : '' ?>">
                    <a href="#"><i class="fa fa-bar-chart-o"></i> <span class="nav-label">Indicators</span><span
                            class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse" style="height: 0px;">
                        <li class="<?= ($this->uri->segment(1) === 'indicator' && $this->uri->segment(2) == NULL) ? 'active' : '' ?>">
                            <a href="<?php echo base_url() . "indicator"; ?>">Manage Indicators</a>
                        </li>
                        <?php if (count($indicators) > 0): ?>
                            <?php foreach ($indicators as $indicator): ?>
                                <li class="<?= ($this->uri->segment(4) === '' .$indicator->getId(). '') ? 'active' : '' ?>">
                                    <a href="<?php
                                                if ($indicator->getKind() == 'UTILITY') {
                                                    echo base_url().'indicator/show_utility/'.$indicator->getId(); ?>
                                                <?php } elseif ($indicator->getKind() == 'SCHEME') { ?>
                                                    <?php echo base_url().'indicator/show_scheme/'.$indicator->getId(); ?>
                                                <?php } ?>
                                                "><?= $indicator->getName();
                                            ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            No Indicators
                        <?php endif; ?>
                    </ul>
                </li>
                <!--End: Indicators menu-->

                <!--Private Schemes menu-->
                <li class="<?= ($this->uri->segment(1) === 'scheme') ? 'active' : '' ?>">
                    <a href="#"><i class="fa fa-user"></i> <span class="nav-label">Private Schemes</span><span
                            class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse" style="height: 0px;">
                        <li class="<?= ($this->uri->segment(1) === 'scheme' && $this->uri->segment(2) == NULL) ? 'active' : '' ?>">
                            <a href="<?php echo base_url() . "scheme"; ?>">Manage Schemes</a>
                        </li>
                        <?php if (count($schemes) > 0): ?>
                            <?php foreach ($schemes as $scheme): ?>
                                <li class="<?= ($this->uri->segment(4) === '' . $scheme->getId() . '') ? 'active' : '' ?>">
                                    <a href="<?= base_url().'scheme/show/'.$scheme->getId(); ?>">
                                        <?= $scheme->getName(); ?>
                                    </a></li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>No schemes</p>
                        <?php endif; ?>
                    </ul>
                </li>
                <!--End: Private Schemes menu-->

                <!--User management-->
                <?php if ($this->ion_auth->is_admin()): ?>
                    <li class="<?= ($this->uri->segment(1) === 'auth') ? 'active' : '' ?>">
                        <a href="<?php echo base_url().'auth/'; ?>"><i class="fa fa-users"></i>
                            <span class="nav-label">Manage Users</span>
                        </a>
                    </li>
                <?php endif; ?>
                <!--End: User management-->

                <li class="upperspace">
                </li>
            </ul>

        </div>
    </nav>

    <div id="page-wrapper" class="gray-bg sidebar-content">
        <div class="row border-bottom">
            <nav class="navbar navbar-fixed-top" role="navigation" style="margin-bottom: 0">
                <div id="logo-dashboard"><a href="<?php echo base_url(); ?>dashboard"><img
                            src="<?php echo base_url(); ?>assets/images/logo.jpg" width="133"/></a></div>
                <div class="navbar-header">
                </div>
                <div
                    class="m-r-sm welcome text-muted welcome-message success col-md-7"><?php echo lang('dashboard_heading'); ?></div>
                <ul class="nav navbar-top-links navbar-right col-md-3">
                    <li>
                        <span class="m-r-sm text-muted welcome-message"><small>Welcome <b><?php echo $user->last_name; ?></b></small></span>
                    </li>
                    <li>
                        <a class="count-info" data-toggle="dropdown" href="index.html#">
                            <i class="fa fa-bell"></i> <span
                                class="label label-danger">
                                <?= $request_summary['TOTAL_EDIT_PENDING'] + $request_summary['TOTAL_ARCHIVE_PENDING']; ?>
                            </span>
                        </a>
                    </li>


                    <li>
                        <a href="<?php echo base_url(); ?>auth/logout">
                            <i class="fa fa-sign-out"></i> Log out
                        </a>
                    </li>
                </ul>

            </nav>
        </div>

        <div class="sidebard-panel border-left full-height">
            <li class="upperspace">

            </li>
            <div class="full-height-scroll ">

                <div class="m-t-md">
                    <h4>Editing Requests <span class="badge badge-info pull-right"><?= $request_summary['TOTAL_EDIT']; ?></span>
                    </h4>
                    <div>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <span class="badge badge-danger"><?= $request_summary['TOTAL_EDIT_PENDING']; ?></span>
                                Pending
                            </li>
                            <li class="list-group-item ">
                                <span class="badge badge-success"><?= $request_summary['TOTAL_EDIT_ACCEPTED']?></span>
                                Accepted
                            </li>
                        </ul>
                    </div>
                    <div>
                        <a href="<?= base_url().'requests/show/EDIT' ?>"
                           type="button" title="View edit requests"
                           class="btn btn-xs btn-info"><i
                                class="fa fa-folder-open"></i> Open edit requests</a>
                    </div>
                </div>

                <div class="m-t-md">
                    <h4>Archive Requests <span class="badge badge-info pull-right"><?= $request_summary['TOTAL_ARCHIVE']; ?></span>
                    </h4>
                    <div>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <span class="badge badge-danger"><?= $request_summary['TOTAL_ARCHIVE_PENDING']; ?></span>
                                Pending
                            </li>
                            <li class="list-group-item ">
                                <span class="badge badge-success"><?= $request_summary['TOTAL_ARCHIVE_ACCEPTED']; ?></span>
                                Accepted
                            </li>
                        </ul>
                    </div>
                    <div>
                        <a href="<?= base_url().'requests/show/ARCHIVE' ?>"
                           type="button" title="View archive requests"
                           class="btn btn-xs btn-info"><i
                                class="fa fa-folder-open"></i> Open archive requests</a>
                    </div>
                </div>
            </div>
        </div>