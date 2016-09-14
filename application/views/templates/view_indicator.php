<?php $in_id = $this->uri->segment(4);?>

	<div class="wrapper wrapper-content">
				<div class="row wrapper border-bottom white-bg page-heading crumbs"><?php $query = $this->db->get_where('indicators', array('in_id' => $in_id)); $row = $query->row(); ?>
				<?php echo $row->fname; ?>  <i class="fa fa-chevron-right"></i>  Overview <div class="pull-right"><a href="<?=base_url();?>indicator/add_directive" class="btn btn-success btn-xs" type="button" role="button"><i class="fa fa-plus"> </i> New Directive</a></div>
</div>
        <div id="mycontent">
	<div class="row utility">
	<div class="col-lg-12 no-gutter">

	                <div class="row">
	                <?php if (count($utilities) > 0 )
	                if(isset($utilities) && $utilities) : $i = 0; foreach ($utilities as $utility) :  $cu_id = $utility->cu_id;
//TARIFF CONDITIONS SUMMARY PER CU

						//For Zero days
                        $this->db->where('due_date < now()');
                        $this->db->where('tariff_conditions.utility_id', $cu_id);
                        $tquery0 = $this->db->count_all_results('tariff_conditions');

						//For five days left
                        $this->db->where('due_date between now() - interval 6 day and now() + interval 5 day');
                        $this->db->where('tariff_conditions.utility_id', $cu_id);
                        $tquery5 = $this->db->count_all_results('tariff_conditions');

                        //For more than 5 days left
                        $this->db->where('due_date > now() + interval 6 day and now() - interval 100 day');
                        $this->db->where('tariff_conditions.utility_id', $cu_id);
                        $tquery6 = $this->db->count_all_results('tariff_conditions');

						//PROJECTS SUMMARY PER CU
						//For Zero days
                        $this->db->where('end_date < now()');
                        $this->db->where('projects.utility_id', $cu_id);
                        $pquery0 = $this->db->count_all_results('projects');

						//For five days left
                        $this->db->where('end_date between now() - interval 6 day and now() + interval 5 day');
                        $this->db->where('projects.utility_id', $cu_id);
                        $pquery5 = $this->db->count_all_results('projects');

                        //For more than 5 days left
                        $this->db->where('end_date > now() + interval 6 day and now() - interval 100 day');
                        $this->db->where('projects.utility_id', $cu_id);
                        $pquery6 = $this->db->count_all_results('projects');

						//For Zero days
                        $this->db->where('due_date < now()');
                        $this->db->where('directives.utility_id', $cu_id);
                        $drquery0 = $this->db->count_all_results('directives');

						//For five days left
                        $this->db->where('due_date between now() - interval 6 day and now() + interval 5 day');
                        $this->db->where('directives.utility_id', $cu_id);
                        $drquery5 = $this->db->count_all_results('directives');

                        //For more than 5 days left
                        $this->db->where('due_date > now() + interval 6 day and now() - interval 100 day');
                        $this->db->where('directives.utility_id', $cu_id);
                        $drquery6 = $this->db->count_all_results('directives');?>

 						<div class="col-lg-3" id="<?=$utility->cu_id;?>">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                              <!--  <span class="label label-primary pull-right">//$this->db->where('indicators.in_id',''); $rnum = $this->db->count_all_results(); -->
                                <h5><?=$utility->utility;?></h5>
                            </div>
                            <div class="ibox-content indicators">
							<?php if($in_id == 1) {
											$this->db->where('directives.utility_id', $cu_id);
											$this->db->from('directives');
											$dquery = $this->db->count_all_results();
											?>

			                                <span class="font-noraml"><?php if($dquery == 0) {echo 'No Inspection Directives';} else { echo '&nbsp;&nbsp;Inspection Directives <span class="label label-success pull-left">'.$dquery;} ?> </span></span>
			                                <ul class="folder-list" style="padding: 0">
                                <li>Active <span class="label label-info pull-right"><?=$drquery6;?></span></li>
                                <li>Almost Due <span class="label label-warning pull-right"><?=$drquery5;?></span></li>
                                <li>Over Due <span class="label label-danger pull-right"><?=$drquery0;?></span></li>
                            </ul>
										<?php
										} elseif ($in_id == 2) {
											$this->db->where('tariff_conditions.utility_id', $cu_id);
											$this->db->from('tariff_conditions');
											$tquery = $this->db->count_all_results();
											?>

			                                <span class="font-noraml"><?php if($tquery == 0) {echo 'No Tariff Conditions';} else { echo '&nbsp;&nbsp;Tariff Conditions <span class="label label-success pull-left">'.$tquery;} ?> </span>
			                                <ul class="folder-list" style="padding: 0">
                                <li>Active <span class="label label-info pull-right"><?=$tquery6;?></span></li>
                                <li>Almost Due <span class="label label-warning pull-right"><?=$tquery5;?></span></li>
                                <li>Over Due <span class="label label-danger pull-right"><?=$tquery0;?></span></li>
                            </ul>
									<?php
										} elseif ($in_id == 3) {
											$this->db->where('tariff_conditions.utility_id', $cu_id);
											$this->db->from('tariff_conditions');
											$tquery = $this->db->count_all_results();
											?>
			                                <span class="font-noraml"><?php if($tquery == 0) {echo 'No Tariff Conditions';} else { echo '&nbsp;&nbsp;Tariff Conditions <span class="label label-success pull-left">'.$tquery;} ?> </span>
			                                <ul class="folder-list" style="padding: 0">
                                <li>Active <span class="label label-info pull-right"><?=$tquery0;?></span></li>
                                <li>Almost Due <span class="label label-warning pull-right"><?=$tquery5;?></span></li>
                                <li>Over Due <span class="label label-danger pull-right"><?=$tquery0;?></span></li>
                            </ul>
									<?php
										}elseif ($in_id == 4) {
											$this->db->where('projects.utility_id', $cu_id);
											$this->db->from('projects');
											$pquery = $this->db->count_all_results();
											?>
			                                <span class="font-noraml"><?php if($pquery == 0) {echo 'No Projects';} else { echo '&nbsp;&nbsp;Projects <span class="label label-success pull-left">'.$pquery;} ?> </span></span>
			                                <ul class="folder-list" style="padding: 0">
                                <li>Active <span class="label label-info pull-right">0</span> </a></li>
                                <li>Almost Due <span class="label label-warning pull-right">0</span> </a></li>
                                <li>Over Due <span class="label label-danger pull-right">0</span></a></li>
                            </ul>
									<?php
										} elseif ($in_id == 5) {
											echo "No Regulations Found";
										} elseif ($in_id == 6) {
											echo "No SLAs FOUND";
										} else {
											echo 'No result found';
										} ?>
                            </div>
                        </div>
                    </div>
	                <?php $i++; endforeach; endif; ?>
                </div>
        </div>
        </div>
</div>