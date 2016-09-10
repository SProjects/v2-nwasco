<div class="wrapper wrapper-content">
    <div class="row wrapper border-bottom white-bg page-heading crumbs">User Manager
    </div>
<div class="fh-breadcrumb no-gutter">


                <div class="fh-column col-lg-3">
                        <ul class="nav-list">
                <h5>User Manager Menu</h5>
                            <li class="<?=($this->uri->uri_string()==='auth')?'active':''?>"><i class="fa fa-inbox"></i>&nbsp;&nbsp;<?php echo anchor('auth/', lang('index_view_user_link'))?></li>
                            <li class="<?=($this->uri->uri_string()==='auth/create_user')?'active':''?>"><i class="fa fa-user-plus"></i>  <?php echo anchor('auth/create_user', lang('index_create_user_link'))?></li>
                        </ul>
                </div>
   <div class="full-height col-lg-c9">
                    <div class="full-height-scroll white-bg border-left">

                        <div class="element-detail-box">