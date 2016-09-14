<?php $psid = $this->uri->segment(4);

 /*
											$this->db->select('*');
											$this->db->from('sindicators');
											$this->db->join('solicence', 'solicence.sin_id = sindicators.sin_id');
											$this->db->join('sdirectives', 'sindicators.sin_id = sdirectives.sin_id');
											$this->db->join('sslas', 'sindicators.sin_id = sslas.sin_id');
											$this->db->join('projects', 'sindicators.sin_id = projects.sin_id'); */?>
<?php $query = $this->db->get_where('private_schemes', array('ps_id' => $psid)); $row = $query->row(); $ps_id = $row->ps_id;  ?>
				<?php
						//sdirectives SUMMARY PER CU
						//For Zero days
                        $this->db->where('due_date < now()');
                        $this->db->where('sdirectives.ps_id', $ps_id);
                        $dquery0 = $this->db->count_all_results('sdirectives');

						//For five days left
                        $this->db->where('due_date between now() - interval 6 day and now() + interval 5 day');
                        $this->db->where('sdirectives.ps_id', $ps_id);
                        $dquery5 = $this->db->count_all_results('sdirectives');

                        //For more than 5 days left
                        $this->db->where('due_date > now() + interval 6 day and now() - interval 100 day');
                        $this->db->where('sdirectives.ps_id', $ps_id);
                        $dquery6 = $this->db->count_all_results('sdirectives');
                        //TARIFF CONDITIONS SUMMARY PER CU

						//For Zero days
                        $this->db->where('due_date < now()');
                        $this->db->where('solicence.ps_id', $ps_id);
                        $tquery0 = $this->db->count_all_results('solicence');

						//For five days left
                        $this->db->where('due_date between now() - interval 6 day and now() + interval 5 day');
                        $this->db->where('solicence.ps_id', $ps_id);
                        $tquery5 = $this->db->count_all_results('solicence');

                        //For more than 5 days left
                        $this->db->where('due_date > now() + interval 6 day and now() - interval 100 day');
                        $this->db->where('solicence.ps_id', $ps_id);
                        $tquery6 = $this->db->count_all_results('solicence');

                        //sslas SUMMARY PER CU
						//For Zero days
                        $this->db->where('due_date < now()');
                        $this->db->where('sslas.ps_id', $ps_id);
                        $squery0 = $this->db->count_all_results('sslas');

						//For five days left
                        $this->db->where('due_date between now() - interval 6 day and now() + interval 5 day');
                        $this->db->where('sslas.ps_id', $ps_id);
                        $squery5 = $this->db->count_all_results('sslas');

                        //For more than 5 days left
                        $this->db->where('due_date > now() + interval 6 day and now() - interval 100 day');
                        $this->db->where('sslas.ps_id', $ps_id);
                        $squery6 = $this->db->count_all_results('sslas');

				?>

	<div class="wrapper wrapper-content">
		<div class="row wrapper border-bottom white-bg page-heading crumbs">Private Scheme  <i class="fa fa-chevron-right"></i>  Overview
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
                                    <?php echo $row->scheme; ?>
                                </h2>
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
		<h3 class="head">Private Scheme Indicators</h3>

	                <?php if (count($sindicators) > 0 )
	                	if(isset($sindicators) && $sindicators) : $i = 0; foreach ($sindicators as $sindicator) : $sin_id = $sindicator->sin_id;  ?>
						 <div class="col-md-4">

					                <div class="ibox float-e-margins">
					                    <div class="ibox-content">

					                        <h4 class="no-margins"><?=$sindicator->sname;?></h4>
											<div class="sindicator-elements">

											<small>
											<?php if($sin_id == 1) {
											$this->db->where('sdirectives.ps_id', $ps_id);
											$this->db->from('sdirectives');
											$query = $this->db->count_all_results(); // Produces an integer, like 17
											echo 'Total '.$query.'</small>';

                        echo '<div class="indicators">';
                        echo '<ul class="folder-list" style="padding: 0">
                                <li>Active <span class="label label-info pull-right">'.$dquery6.'</span></li>
                                <li>Almost Due <span class="label label-warning pull-right">'.$dquery5.'</span></li>
                                <li>Over Due <span class="label label-danger pull-right">'.$dquery0.'</span></a></li>
                            </ul>';
                        echo '</div>';
								} else if($sin_id == 2) { 
											$this->db->where('solicence.ps_id', $ps_id);
											$this->db->from('solicence');
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
											else if($sin_id == 3) { 
											$this->db->where('sslas.ps_id', $ps_id);
											$this->db->from('sslas');
											$query = $this->db->count_all_results(); // Produces an integer, like 17
											echo 'Total '.$query.'</small>';

					                        echo '<div class="indicators">';
					                        echo '<ul class="folder-list" style="padding: 0">
					                                <li>Active <span class="label label-info pull-right">'.$squery6.'</span></li>
					                                <li>Almost Due <span class="label label-warning pull-right">'.$squery5.'</span></li>
					                                <li>Over Due <span class="label label-danger pull-right">'.$squery0.'</span></a></li>
					                            </ul>';
					                        echo '</div>';
											} ?>

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
                        <?php if(isset($sindicators) && $sindicators) : $i = 0; foreach($sindicators as $sindicator) : ?>
					<li class="tab<?php if($i === 0): ?> active<?php endif; ?>">
						<a data-toggle="tab" href="#tab-<?=$sindicator->sin_id; ?>"><?=$sindicator->fname; ?></a>
					</li>
					<?php $i++; endforeach; endif; ?>

                        </ul>
                        <div class="tab-content">

			  <?php if(isset($sindicators) && $sindicators) : $i = 0;  foreach($sindicators as $sindicator) : $sin_id = $sindicator->sin_id; ?>
			  <div id="tab-<?=$sindicator->sin_id;?>" class="tab-pane<?php if($i === 0): ?> active<?php endif; ?>">
                                <div class="panel-body">
                                <?php if($sin_id == 1) {
								    echo '<div class="ibox-title"  style="border-top: 0px; padding-right:0;">
                                    <h5 class="center">Directives</h5>
                                    <div class="pull-right">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-xs btn-success">Add New</button> 
                                        </div>
                                    </div>
                                </div>';
								    ?>
								    <table class="table table-bordered table-hover sdirectives">
				                    <thead>
				                    <tr>
				                        <th>Directives</th>
				                        <th>Due Date</th>
				                        <th>Status</th>
				                        <th>Action</th>
				                    </tr>
				                    </thead><tbody>
				                   <?php
										if (count($sdirectives) > 0)
										foreach ($sdirectives as $directive)
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
		                                         <a href="<?php echo base_url()."sindicator/edit_directive/".$directive->dir_id; ?>"  type="button" title="Edit" class="btn btn-xs btn-white"><i class="fa fa-edit"></i></a> 
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
		                                                <td>No Inspection sdirectives</td>
		                                                <td></td>
		                                                <td></td>
		                                                <td></td>
		                                            </tr>';
						                }
				                 ?>
                                	    </tbody>
                                	    <tfoot>
                                	    	<tr>
		                                	    <th>sdirectives</th>
						                        <th>Due Date</th>
						                        <th>Status</th>
						                        <th>Action</th>
                                	    	</tr>
                                	    </tfoot>
                                    </table>
								    <?php
									}
									else if($sin_id == 2) {
								    echo '<h4 class="center">Operating Licences</h4>';
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
									else if($sin_id == 3) {
								    echo '<h4 class="center">Service Level Guarantees and Agreements</h4>';
									}
									else if($sin_id == 4) {
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
									else if($sin_id == 5) {
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