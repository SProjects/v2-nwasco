<?php $cuid = $this->uri->segment(3);


						$format = "%Y-%m-%d"; $tariff['due_date'] = mdate($format); $date_expire = $tariff['due_date'];
										$date = new DateTime($date_expire);
										$now = new DateTime();
										$tdays_left = $date->diff($now)->format("%d"); 
						$format1 = "%Y-%m-%d"; $directive['due_date'] = mdate($format1); $date_expire = $directive['due_date'];
										$date = new DateTime($date_expire);
										$now = new DateTime();
										$ddays_left = $date->diff($now)->format("%d"); 

						$format2 = "%Y-%m-%d"; $project['due_date'] = mdate($format2); $date_expire = $project['due_date'];
										$date = new DateTime($date_expire);
										$now = new DateTime();
										$pdays_left = $date->diff($now)->format("%d"); ?>
										<?php /*
											$this->db->select('*');
											$this->db->from('indicators');
											$this->db->join('tariff_conditions', 'tariff_conditions.in_id = indicators.in_id');
											$this->db->join('directives', 'indicators.in_id = directives.in_id');
											$this->db->join('srs', 'indicators.in_id = srs.in_id');
											$this->db->join('projects', 'indicators.in_id = projects.in_id'); */?>
<?php $query = $this->db->get_where('cus', array('cu_id' => $cuid)); $row = $query->row(); ?>


<?php $cu_id = $row->cu_id;  ?>
				<?php
						//DIRECTIVES SUMMARY PER CU
						//For Zero days
                        $this->db->where('due_date < now()');
                        $this->db->where('directives.utility_id', $cu_id);
                        $dquery0 = $this->db->count_all_results('directives');

						//For five days left
                        $this->db->where('due_date between now() - interval 6 day and now() + interval 5 day');
                        $this->db->where('directives.utility_id', $cu_id);
                        $dquery5 = $this->db->count_all_results('directives');

                        //For more than 5 days left
                        $this->db->where('due_date > now() + interval 6 day and now() - interval 100 day');
                        $this->db->where('directives.utility_id', $cu_id);
                        $dquery6 = $this->db->count_all_results('directives');


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

						//SRS SUMMARY PER CU
						//For Zero days
                        $this->db->where('due_date < now()');
                        $this->db->where('srs.utility_id', $cu_id);
                        $squery0 = $this->db->count_all_results('srs');

						//For five days left
                        $this->db->where('due_date between now() - interval 6 day and now() + interval 5 day');
                        $this->db->where('srs.utility_id', $cu_id);
                        $squery5 = $this->db->count_all_results('srs');

                        //For more than 5 days left
                        $this->db->where('due_date > now() + interval 6 day and now() - interval 100 day');
                        $this->db->where('srs.utility_id', $cu_id);
                        $squery6 = $this->db->count_all_results('srs');
				?>

	<div class="wrapper wrapper-content">
		<div class="row wrapper border-bottom white-bg page-heading crumbs">Commercial Utility  <i class="fa fa-chevron-right"></i>  Overview
		</div>
        <div id="mycontent">
  <div class="row m-b-lg m-t-lg">
                <div class="col-md-4">

                    <div class="profile-image">
                        <img src="<?php echo base_url(); ?>assets/images/nkana.png" class="img-circle circle-border m-b-md" alt="profile">
                    </div>
                    <div class="profile-info">
                        <div class="">
                            <div>
                                <h2>
                                    <?php echo $row->abr_utility; ?>
                                </h2>
                                <h4><?php echo $row->utility;?></h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                                <small><p>&nbsp;</p>
                                    There are many variations of passages of Lorem Ipsum available, but the majority
                                    have suffered alteration in some form Ipsum available.
                                </small>
                </div>

            </div>
		<div class="row utility">
		<div class="col-lg-12 no-gutter">
		<h3 class="head">Indicators</h3>

	                <?php if (count($indicators) > 0 )
	                	if(isset($indicators) && $indicators) : $i = 0; foreach ($indicators as $indicator) : $in_id = $indicator->in_id;  ?>
						 <div class="col-lg-2">

					                <div class="ibox float-e-margins">
					                    <div class="ibox-content">

					                        <h4 class="no-margins"><?=$indicator->sname;?></h4>
											<div class="indicator-elements">

											<small>
											<?php if($in_id == 1) {
											$this->db->where('directives.utility_id', $cu_id);
											$this->db->from('directives');
											$query = $this->db->count_all_results(); // Produces an integer, like 17
											echo 'Total '.$query.'</small>';

                        echo '<div class="indicators">';
                        echo '<ul class="folder-list" style="padding: 0">
                                <li>Active <span class="label label-info pull-right">'.$dquery6.'</span></li>
                                <li>Almost Due <span class="label label-warning pull-right">'.$dquery5.'</span></li>
                                <li>Over Due <span class="label label-danger pull-right">'.$dquery0.'</span></a></li>
                            </ul>';
                        echo '</div>';
								} else if($in_id == 2) { 
											$this->db->where('tariff_conditions.utility_id', $cu_id);
											$this->db->from('tariff_conditions');
											$query = $this->db->count_all_results(); // Produces an integer, like 17
											echo 'Total '.$query.'</small>';

                        echo '<div class="indicators">';
                        echo '<ul class="folder-list" style="padding: 0">
                                <li>Active <span class="label label-info pull-right">'.$tquery6.'</span></li>
                                <li>Almost Due <span class="label label-warning pull-right">'.$tquery5.'</span></li>
                                <li>Over Due <span class="label label-danger pull-right">'.$tquery0.'</span></a></li>
                            </ul>';
                        echo '</div>';
											}
											else if($in_id == 3) { 
											$this->db->where('srs.utility_id', $cu_id);
											$this->db->from('srs');
											$query = $this->db->count_all_results(); // Produces an integer, like 17
											echo 'Total '.$query.'</small>';

					                        echo '<div class="indicators">';
					                        echo '<ul class="folder-list" style="padding: 0">
					                                <li>Active <span class="label label-info pull-right">'.$squery6.'</span></li>
					                                <li>Almost Due <span class="label label-warning pull-right">'.$squery5.'</span></li>
					                                <li>Over Due <span class="label label-danger pull-right">'.$squery0.'</span></a></li>
					                            </ul>';
					                        echo '</div>';
											}
											else if($in_id == 4) {
											$this->db->where('projects.utility_id', $cu_id);
											$this->db->from('projects');
											$query = $this->db->count_all_results(); // Produces an integer, like 17
											echo 'Total '.$query.'</small>';

					                        echo '<div class="indicators">';
					                        echo '<ul class="folder-list" style="padding: 0">
					                                <li>Active <span class="label label-info pull-right">'.$pquery6.'</span></li>
					                                <li>Almost Due <span class="label label-warning pull-right">'.$pquery5.'</span></li>
					                                <li>Over Due <span class="label label-danger pull-right">'.$pquery0.'</span></a></li>
					                            </ul>';
					                        echo '</div>';
											//}
											/*else if($in_id == 5) {
											$this->db->where('rbi.utility_id', $cu_id);
											$this->db->from('projects');
											$query = $this->db->count_all_results(); // Produces an integer, like 17
											echo 'Total '.$query;
											}
											else if($in_id == 6) {
											$this->db->where('sla.utility_id', $cu_id);
											$this->db->from('projects');
											$query = $this->db->count_all_results(); // Produces an integer, like 17
											echo 'Total '.$query;
											} else { */
											 /*
											$this->db->select('*');
											$this->db->from('indicators');
											$this->db->join('tariff_conditions', 'tariff_conditions.in_id', $in_id);
											$this->db->join('directives', 'directives.in_id', $in_id);
											$this->db->join('srs', 'srs.in_id', $in_id);
											$this->db->join('projects', 'projects.in_id', $in_id);*/} ?>

											</small>
											</div>
					                    </div>
					                </div>
					            </div>
	                <?php $i++; endforeach; endif; ?>
        </div>
        </div>
  		<div class="row">
                <div class="col-lg-12">
                    <div class="tabs-container">
                        <ul class="nav nav-tabs">
                        <?php if(isset($indicators) && $indicators) : $i = 0; foreach($indicators as $indicator) : ?>
					<li class="tab<?php if($i === 0): ?> active<?php endif; ?>">
						<a data-toggle="tab" href="#tab-<?=$indicator->in_id; ?>"><?=$indicator->sname; ?></a>
					</li>
					<?php $i++; endforeach; endif; ?>

                        </ul>
                        <div class="tab-content">

			  <?php if(isset($indicators) && $indicators) : $i = 0;  foreach($indicators as $indicator) : $in_id = $indicator->in_id; ?>
			  <div id="tab-<?=$indicator->in_id;?>" class="tab-pane<?php if($i === 0): ?> active<?php endif; ?>">
                                <div class="panel-body">
                                <?php if($in_id == 1) {
								    echo '<div class="ibox-title"  style="border-top: 0px; padding-right:0;">
                                    <h5 class="center">Inspection Directives</h5>
                                    <div class="pull-right">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-xs btn-success">Add New</button> 
                                        </div>
                                    </div>
                                </div>';
								    ?>
								    <table class="table table-bordered table-hover directives">
				                    <thead>
				                    <tr>
				                        <th>Directives</th>
				                        <th>Due Date</th>
				                        <th>Status</th>
				                        <th>Action</th>
				                    </tr>
				                    </thead><tbody>
				                   <?php
										if (count($directives) > 0)
										foreach ($directives as $directive)
						                    {

						                 ?>
				         					<tr>
                                                <td><?=$directive->directive; ?></td>
                                                <td class="project-status"><?=date('d/m/Y',strtotime($directive->due_date)); ?></td>
                                                <td class="project-status">
												<?php
													$now = time();
												     $your_date = strtotime($directive->due_date);
												     $datediff = $your_date - $now;
												     $ddays_left = floor($datediff/(60*60*24));

												if($ddays_left <= 0){
												  echo '<span class="label label-danger right">Over Due</span>';
												}
												elseif($ddays_left <= 5 && $ddays_left >= 1) {
												  echo '<span class="label label-warning right">Almost due</span>';
												}
												elseif($ddays_left > 5){
												  echo '<span class="label label-primary right">Not due</span>';
												}
												?>

                                                </td>
                                                <td style="width: 80px;">
                                                <?php if($this->ion_auth->is_admin()) { ?>



                                                <div class="btn-group">
		                                            <a type="button" href="" data-toggle="tooltip" data-placement="bottom" title="View" data-toggle="modal" data-target="#myModal" class="btn btn-xs btn-white"><i class="fa fa-external-link"></i></a>
		                                         <a href="<?php echo base_url()."indicator/edit_directive/".$directive->dir_id; ?>"  type="button" title="Edit" class="btn btn-xs btn-white"><i class="fa fa-edit"></i></a> 
		                                            <button type="button" data-toggle="tooltip" data-placement="bottom" title="Archive" class="btn btn-xs btn-white"><i class="fa fa-archive"></i></button>
		                                        </div>
                                               <?php } else { ?>

                                                <div class="btn-group">
		                                            <button data-toggle="tooltip" data-placement="bottom" title="Request Edit" data-toggle="modal" data-target="#myModal" class="btn btn-sm btn-white"><i class="fa fa-edit"></i></button>
		                                            <button type="button" data-toggle="tooltip" data-placement="bottom" title="Request Archive" class="btn btn-sm btn-white"><i class="fa fa-archive"></i></button>
		                                        </div>
                                              <?php } ?>
                                        </td>
		                                            </tr>
						            	<?php   } 
							                else //when there is no comment
								                {
						                    echo '</td>
		                                                <td>No Inspection Directives</td>
		                                                <td></td>
		                                                <td></td>
		                                                <td></td>
		                                            </tr>';
						                }
				                 ?>
                                	    </tbody>
                                	    <tfoot>
                                	    	<tr>
		                                	    <th>Directives</th>
						                        <th>Due Date</th>
						                        <th>Status</th>
						                        <th>Action</th>
                                	    	</tr>
                                	    </tfoot>
                                    </table>
								    <?php
									}
									else if($in_id == 2) {
								    echo '<h4 class="center">Tariff Conditions</h4>';
								    ?>
									<table class="table table-striped table-bordered table-hover tariffs">
				                    <thead>
				                    <tr>
				                        <th>Condition</th>
				                        <th>Weight</th>
				                        <th>Status</th>
				                        <th>Action</th>
				                    </tr>
				                    </thead><tbody>
				                   <?php
										if (count($tariffs) > 0)
										foreach ($tariffs as $tariff)
						                    {

						                 ?>
				         					<tr>
                                                <td><?=$tariff->condition; ?>
                                                	<small><?=$tariff->due_date; ?></small>
                                                </td>
                                                <td><?=$tariff->weight;?></td>
                                                <td class="project-status"><span class="label label-danger">Over Due</span></td>
                                               <td style="width: 80px;">
                                                <div class="btn-group">
		                                            <button type="button" data-toggle="tooltip" data-placement="bottom" title="View" data-toggle="modal" data-target="#myModal2" class="btn btn-xs btn-white"><i class="fa fa-external-link"></i></button>
		                                            <a href=""  type="button"  data-toggle="tooltip" data-placement="bottom" title="Edit" class="btn btn-xs btn-white"><i class="fa fa-edit"></i></a> 
		                                            <button type="button" data-toggle="tooltip" data-placement="bottom" title="Archive" class="btn btn-xs btn-white"><i class="fa fa-archive"></i></button>
		                                        </div>
                                        </td>
		                                            </tr>
						            	<?php   }
							                else //when there is no comment
								                {
						                    echo '</td>
		                                                <td>No Tariff Conditions</td>
		                                                <td></td>
		                                                <td></td>
		                                                <td></td>
		                                            </tr>';
						                }
				                 ?>
                                	                                            </tbody>
                                    </table>
								    <?php
									}
									else if($in_id == 3) {
								    echo '<h4 class="center">Special Regulatory Supervision</h4>';
									}
									else if($in_id == 4) {
								    echo '<h4 class="center">WSS Projects</h4>'; ?>
								     <table class="table table-striped table-bordered table-hover projects">
				                    <thead>
				                    <tr>
				                        <th>Project</th>
				                        <th>End Date</th>
				                        <th>Status</th>
				                        <th>Action</th>
				                    </tr>
				                    </thead>
				                    <tbody>
				                   <?php
										if (count($projects) > 0)
										foreach ($projects as $project)
						                    {

						                 ?>
				         					<tr>
                                                <td><?php echo $project->project; ?></td>
                                                <td class="project-status"><?=$project->end_date;?></td>
                                                <td class="project-status"><span class="label label-danger">Over Due</span></td>
                                                  <td style="width: 80px;">
                                                <div class="btn-group">
		                                            <button type="button" data-toggle="tooltip" data-placement="bottom" title="View" data-toggle="modal" data-target="#myModal2" class="btn btn-xs btn-white"><i class="fa fa-external-link"></i></button>
		                                            <a href=""  type="button"  data-toggle="tooltip" data-placement="bottom" title="Edit" class="btn btn-xs btn-white"><i class="fa fa-edit"></i></a> 
		                                            <button type="button" data-toggle="tooltip" data-placement="bottom" title="Archive" class="btn btn-xs btn-white"><i class="fa fa-archive"></i></button>
		                                        </div>
                                        </td>
		                                            </tr>
						            	<?php   }
							                else //when there is no comment
								                {
						                    echo '</td>
		                                                <td>No Projects</td>
		                                                <td></td>
		                                                <td></td>
		                                                <td></td>
		                                            </tr>';
						                }
				                 ?>
                                	    </tbody>
                                	    <tfoot>
				                    <tr>
				                        <th>Projects</th>
				                        <th>End Date</th>
				                        <th>Status</th>
				                        <th>Action</th>
				                    </tr>
				                    </tfoot>
                                    </table>
								    <?php
									}
									else if($in_id == 5) {
								    echo '<h4 class="center">Regulation by Incentives</h4>';
									}
									else{
								    echo '<h4 class="center">Service Level Guarantees and Agreements</h4>';
									}
								?>

                                </div>
                            </div>

	  			<?php $i++; endforeach; endif; ?>
                        </div>

                    </div>
                </div>
		    </div>
	</div>