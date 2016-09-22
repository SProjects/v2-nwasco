<div class="wrapper wrapper-content">
    <div class="row wrapper border-bottom white-bg page-heading crumbs">Dashboard</div>
    <div id="mycontent">
        <div class="col-lg-12 jss">
            <div class="row no-gutter">
                <div id="slideshow">
                    <div>
                        <img class="col-sm-3" src="<?php echo base_url(); ?>assets/images/img1.jpg">
                        <span class="col-sm-9"><b>Stylization and effects,</b> enhancing the web app without sacrificing your semantic structure or performance. Additionally Web Open Font Format (WOFF) provides typographic flexibility<b> and control far beyond anything the</b> web has offered before.
					</span>
                    </div>

                    <div>
                        <img class="col-sm-3" src="<?php echo base_url(); ?>assets/images/img2.jpg">
                        <span class="col-sm-9">Additionally <b>Web Open Font Format</b> (WOFF) provides typographic stylization and effects, <b>enhancing the web app without sacrificing</b> your semantic structure or performance. flexibility and control far beyond anything the web has offered before.
					</span>
                    </div>
                    <div>

                        <img class="col-sm-3" src="<?php echo base_url(); ?>assets/images/img3.jpg">
                        <span class="col-sm-9">Font Format <b>(WOFF)</b> provides typographic flexibility and control farstylization and effects, enhancing the web app without sacrificing your semantic structure or performance. <b>Additionally Web Open  beyond anything</b> the web has offered before.
					</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row utility">
            <div class="col-lg-12 no-gutter">
                <h3 class="head"> Status </h3>
                <ul class="maj-sum">
                    <?php //if there is comments then print the comments

                    if (count($utilities) > 0)
                        foreach ($utilities as $utility):
                            $name = explode(' ', trim($utility->utility));
                            $cu_id = $utility->cu_id;
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

                            $overdue = $dquery0 + $tquery0 + $pquery0 + $squery0;
                            $neardue = $dquery5 + $tquery5 + $pquery5 + $squery5;
                            $active = $dquery6 + $tquery6 + $pquery6 + $squery6;

                            ?>

                            <li class="col-lg-1 summary">
                                <div class="ibox-content">
                                    <h1 class="no-margins"><?= $utility->abr_utility; ?></h1>
                                    <small><?= $name[0]; ?></small>
                                </div>
                                <ul class="status-numbers">
                                    <li class="dropdown label-danger">
                                        <a class="dropdown-toggle" data-toggle="dropdown"><?= $overdue; ?></a>
                                        <ul class="dropdown-menu">
                                            <div>
                                                <span>Inspection Directives</span>
                                                <div class="stat-percent font-bold text-danger"><?= $dquery0; ?></div>
                                                <div class="clearfix"></div>
                                                <span>Tariff Conditions</span>
                                                <div class="stat-percent font-bold text-danger"><?= $tquery0; ?></div>
                                                <div class="clearfix"></div>
                                                <span>Projects</span>
                                                <div class="stat-percent font-bold text-danger"><?= $pquery0; ?></div>
                                                <div class="clearfix"></div>
                                                <span>SRS</span>
                                                <div class="stat-percent font-bold text-danger"><?= $squery0; ?></div>
                                            </div>
                                            <span class="pull-right label label-danger"><a href="<?php

                                                $url = str_replace(' ', '-', $utility->utility);
                                                $url = str_replace(":", '', $url);
                                                $url = str_replace("'", '', $url);
                                                $url = preg_replace('/[^A-Za-z0-9\-]/', '', $url);

                                                echo base_url(); ?>utility/details/<?php echo $utility->cu_id; ?>/<?php echo urlencode(strtolower($url)); ?>">
                              VIEW DETAILS
               </a></span>
                                        </ul>
                                    </li>
                                    <li class="dropdown label-warning">
                                        <a class="dropdown-toggle" data-toggle="dropdown"><?= $neardue; ?></a>
                                        <ul class="dropdown-menu">
                                            <div>
                                                <span>Inspection Directives</span>
                                                <div class="stat-percent font-bold text-warning"><?= $dquery5; ?></div>
                                                <div class="clearfix"></div>
                                                <span>Tariff Conditions</span>
                                                <div class="stat-percent font-bold text-warning"><?= $tquery5; ?></div>
                                                <div class="clearfix"></div>
                                                <span>Projects</span>
                                                <div class="stat-percent font-bold text-warning"><?= $pquery5; ?></div>
                                                <div class="clearfix"></div>
                                                <span>SRS</span>
                                                <div class="stat-percent font-bold text-warning"><?= $squery5; ?></div>
                                            </div>
                                            <span class="pull-right label label-warning"><a href="<?php

                                                $url = str_replace(' ', '-', $utility->utility);
                                                $url = str_replace(":", '', $url);
                                                $url = str_replace("'", '', $url);
                                                $url = preg_replace('/[^A-Za-z0-9\-]/', '', $url);

                                                echo base_url(); ?>utility/details/<?php echo $utility->cu_id; ?>/<?php echo urlencode(strtolower($url)); ?>">
                              VIEW DETAILS
               </a></span>
                                        </ul>
                                    </li>
                                    <li class="dropdown label-primary">
                                        <a class="dropdown-toggle" data-toggle="dropdown"><?= $active; ?></a>
                                        <ul class="dropdown-menu">
                                            <div>
                                                <span>Inspection Directives</span>
                                                <div class="stat-percent font-bold text-navy"><?= $dquery6; ?></div>
                                                <div class="clearfix"></div>
                                                <span>Tariff Conditions</span>
                                                <div class="stat-percent font-bold text-navy"><?= $tquery6; ?></div>
                                                <div class="clearfix"></div>
                                                <span>Projects</span>
                                                <div class="stat-percent font-bold text-navy"><?= $pquery6; ?></div>
                                                <div class="clearfix"></div>
                                                <span>SRS</span>
                                                <div class="stat-percent font-bold text-navy"><?= $squery6; ?></div>
                                            </div>
                                            <span class="pull-right label label-primary"><a href="<?php

                                                $url = str_replace(' ', '-', $utility->utility);
                                                $url = str_replace(":", '', $url);
                                                $url = str_replace("'", '', $url);
                                                $url = preg_replace('/[^A-Za-z0-9\-]/', '', $url);

                                                echo base_url(); ?>utility/details/<?php echo $utility->cu_id; ?>/<?php echo urlencode(strtolower($url)); ?>">
                              VIEW DETAILS
               </a></span>
                                        </ul>
                                    </li>
                                </ul>

                            </li>
                        <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <script type="text/javascript" charset="utf-8" async defer>
            google.load("visualization", "1", {packages: ["corechart"]});
            google.setOnLoadCallback(drawCharts);
            function drawCharts() {


                // actual bar chart data
                var barData = google.visualization.arrayToDataTable([
                    ['Commercial Utility', 'Over Due', 'Almost Due', 'Active'],
                    <?php
                    if (count($utilities) > 0)
                        ob_start();  foreach ($utilities as $utility) {
                    $name = explode(' ', trim($utility->utility));
                    $cu_id = $utility->cu_id;

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
                    echo "['" . $utility->abr_utility . "', " . $dquery0 . ", " . $dquery5 . ", " . $dquery6 . "],\n";
                    ?><?php } $output = ob_get_clean();

                    echo rtrim($output, ','); ?>]);
                // set bar chart options
                var barOptions = {
                    focusTarget: 'category',
                    backgroundColor: 'transparent',
                    colors: ['red', 'yellow', 'green'],
                    fontName: 'Open Sans',
                    chartArea: {
                        left: 50,
                        top: 0,
                        width: '100%',
                        height: '70%'
                    },
                    bar: {
                        groupWidth: '100%'
                    },
                    hAxis: {
                        textStyle: {
                            fontSize: 11
                        }
                    },
                    vAxis: {
                        minValue: 0,
                        maxValue: 20,
                        baselineColor: '#DDD',
                        gridlines: {
                            color: '#DDD',
                            count: 5
                        },
                        textStyle: {
                            fontSize: 11
                        }
                    },
                    legend: {
                        position: 'bottom',
                        textStyle: {
                            fontSize: 12
                        }
                    },
                    animation: {
                        duration: 1200,
                        easing: 'out',
                        startup: true
                    }
                };
                // draw bar chart twice so it animates
                var barChart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
                //barChart.draw(barZeroData, barOptions);
                barChart.draw(barData, barOptions);

                // BEGIN PIE CHART

                // BEGIN BAR CHART
                /*
                 // create zero data so the bars will 'grow'
                 var barZeroData = google.visualization.arrayToDataTable([
                 ['Day', 'Page Views', 'Unique Views'],
                 ['Sun',  0,      0],
                 ['Mon',  0,      0],
                 ['Tue',  0,      0],
                 ['Wed',  0,      0],
                 ['Thu',  0,      0],
                 ['Fri',  0,      0],
                 ['Sat',  0,      0]
                 ]);
                 */

                // actual bar chart data
                var barData = google.visualization.arrayToDataTable([
                    ['Commercial Utility', 'Over Due', 'Pending', 'In Progress'],
                    <?php
                    if (count($utilities) > 0)
                        ob_start();  foreach ($utilities as $utility) {
                    $name = explode(' ', trim($utility->utility));
                    $cu_id = $utility->cu_id;
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
                    echo "['" . $utility->abr_utility . "', " . $tquery0 . ", " . $tquery5 . ", " . $tquery6 . "],\n";
                    ?><?php } $output = ob_get_clean();

                    echo rtrim($output, ','); ?>]);
                // set bar chart options
                var barOptions = {
                    focusTarget: 'category',
                    backgroundColor: 'transparent',
                    colors: ['red', 'green', 'yellow'],
                    fontName: 'Open Sans',
                    chartArea: {
                        left: 50,
                        top: 0,
                        width: '100%',
                        height: '70%'
                    },
                    bar: {
                        groupWidth: '100%'
                    },
                    hAxis: {
                        textStyle: {
                            fontSize: 11
                        }
                    },
                    vAxis: {
                        minValue: 0,
                        maxValue: 20,
                        baselineColor: '#DDD',
                        gridlines: {
                            color: '#DDD',
                            count: 5
                        },
                        textStyle: {
                            fontSize: 11
                        }
                    },
                    legend: {
                        position: 'bottom',
                        textStyle: {
                            fontSize: 12
                        }
                    },
                    animation: {
                        duration: 1200,
                        easing: 'out',
                        startup: true
                    }
                };
                // draw bar chart twice so it animates
                var barChart = new google.visualization.ColumnChart(document.getElementById('bar-chart'));
                //barChart.draw(barZeroData, barOptions);
                barChart.draw(barData, barOptions);

                // BEGIN PIE CHART

                // pie chart data
                var pieData = google.visualization.arrayToDataTable([
                    ['Commecial Utility', 'Projects'],
                    <?php
                    if (count($utilities) > 0)
                        ob_start();  foreach ($utilities as $utility) {
                    $name = explode(' ', trim($utility->utility));
                    $cu_id = $utility->cu_id;

                    //PROJECTS SUMMARY PER CU
                    $this->db->where('projects.utility_id', $cu_id);
                    $this->db->from('projects');
                    $pquery = $this->db->count_all_results();
                    echo "['" . $utility->abr_utility . "', " . $pquery . "],\n";
                    ?><?php } $output = ob_get_clean();

                    echo rtrim($output, ','); ?>]);
                // pie chart options
                var pieOptions = {
                    is3D: true,
                    backgroundColor: 'transparent',
                    colors: ["cornflowerblue",
                        "olivedrab",
                        "orange",
                        "tomato",
                        "crimson",
                        "purple",
                        "turquoise",
                        "forestgreen",
                        "navy",
                        "gray"],
                    fontName: 'Open Sans',
                    chartArea: {
                        width: '100%',
                        height: '94%'
                    },
                    legend: {
                        textStyle: {
                            fontSize: 13
                        }
                    }
                };
                // draw pie chart
                var pieChart = new google.visualization.PieChart(document.getElementById('pie-chart'));
                pieChart.draw(pieData, pieOptions);
            }
        </script>
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-content">
                        <main>
                            <div class="my-slider">
                                <main>
                                    <ul>
                                        <li><h5>Directives</h5>
                                            <div id="chart_div"></div>
                                        </li>
                                        <li>
                                            <h5>Tariff Conditions</h5>
                                            <div id="bar-chart"></div>
                                        </li>
                                        <li><h5>Projects</h5>
                                            <div id="pie-chart"></div>
                                        </li>
                                        <script>
                                            $(function () {

                                                var lineData = {
                                                    labels: ["Chambeshi", "Luapula", "March", "April", "May", "June", "July"],
                                                    datasets: [
                                                        {
                                                            label: "Example dataset",
                                                            fillColor: "rgba(220,220,220,0.5)",
                                                            strokeColor: "rgba(220,220,220,1)",
                                                            pointColor: "rgba(220,220,220,1)",
                                                            pointStrokeColor: "#fff",
                                                            pointHighlightFill: "#fff",
                                                            pointHighlightStroke: "rgba(220,220,220,1)",
                                                            data: [65, 59, 80, 81, 56, 55, 40]
                                                        },
                                                        {
                                                            label: "Example dataset",
                                                            fillColor: "rgba(26,179,148,0.5)",
                                                            strokeColor: "rgba(26,179,148,0.7)",
                                                            pointColor: "rgba(26,179,148,1)",
                                                            pointStrokeColor: "#fff",
                                                            pointHighlightFill: "#fff",
                                                            pointHighlightStroke: "rgba(26,179,148,1)",
                                                            data: [28, 48, 40, 19, 86, 27, 90]
                                                        },
                                                        {
                                                            label: "Example dataset",
                                                            fillColor: "rgba(26,179,148,0.5)",
                                                            strokeColor: "rgba(26,179,148,0.7)",
                                                            pointColor: "rgba(26,179,148,1)",
                                                            pointStrokeColor: "#fff",
                                                            pointHighlightFill: "#fff",
                                                            pointHighlightStroke: "rgba(26,179,148,1)",
                                                            data: [18, 38, 20, 9, 80, 20, 70]
                                                        }
                                                    ]
                                                };
                                            }
                                        </script>
                                    </ul>
                                </main>
                            </div>
                        </main>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">

                <select class="select2_demo_1 form-control">
                    <option value="1">Tariff Conditions</option>
                    <option value="2">Directives</option>
                    <option value="3">Projects</option>
                    <option value="4">SLAs/SLGs</option>
                    <option value="5">RBIs</option>
                    <option value="5">SRS</option>
                </select>
            </div>
            <div class="col-lg-4">

                <select class="select2_demo_1 form-control">
                    <option value="1">Overdue</option>
                    <option value="2">Pending</option>
                    <option value="3">Completed</option>
                </select>
            </div>
            <div class="col-lg-4">

                <button class="btn btn-white btn-sm btn-success"><i class="fa fa-search"></i> Search</button>
            </div>
        </div>
    </div>
</div>

<script text="text/javascript">
    $(document).ready(function () {
        var notifications = <?php echo json_encode($notifications); ?>;
        console.log(notifications);
        for(var x=0; x<notifications.length; x++) {
            alertify.log(notifications[x], "", 0);
        }
    });
</script>