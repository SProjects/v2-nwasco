<?php $cid = $this->uri->segment(3); ?>
    <div class="wrapper wrapper-content">
                <div class="row wrapper border-bottom white-bg page-heading crumbs"><?php $query = $this->db->get_where('cus', array('cu_id' => $cid)); $row = $query->row(); ?>
                <?php echo $row->utility. '&nbsp;-&nbsp;'; echo $row->abr_utility; ?>
</div>
        <div id="mycontent">
    <div class="row utility">
    <div class="col-lg-12 no-gutter">

                    <div class="row">
                    <?php if (count($indicators) > 0 )
                        foreach ($indicators as $indicator) { ?>
                        <div class="col-lg-4" id="<?=$indicator->fname;?>">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                              <!--  <span class="label label-primary pull-right">//$this->db->where('indicators.in_id',''); $rnum = $this->db->count_all_results(); -->
                                <h5><?=$indicator->fname;?></h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins"></h1>
                                <div class="stat-percent font-bold text-navy">20% <i class="fa fa-level-up"></i></div>
                                <small>New orders</small>
                            </div>
                        </div>
                    </div>

                    <?php
                        }
                    ?>
                </div>
        </div>
        </div>
</div>