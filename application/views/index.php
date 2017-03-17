<div class="wrapper wrapper-content">
    <div class="row wrapper border-bottom white-bg page-heading crumbs">Dashboard</div>
    <div id="mycontent">
        <div class="col-lg-12 jss">
        <div class="row utility">
            <div class="col-lg-12 no-gutter">
                <h3 class="head"> Commercial Utility Status </h3>
                <ul class="maj-sum" style="padding-left: 2px;">
                    <?php $indicator_instruction = new Indicator_instruction_model(); ?>
                    <?php if(count($utilities) > 0): ?>
                        <?php foreach ($utilities as $utility): ?>
                            <li class="col-lg-1 summary">
                                <div class="ibox-content">
                                    <h1 class="no-margins"><?= $utility->getAbbreviation(); ?></h1>
                                    <small style="font-size: 0.65em;"><?= $utility->getName();; ?></small>
                                </div>
                                <ul class="status-numbers">
                                    <?php
                                        $totals = Indicator_summary_model::getUtilitySummary($utility);
                                        $total_overdue = $totals['OVERDUE'];
                                        $total_almost = $totals['ALMOST'];
                                        $total_active = $totals['ACTIVE'];
                                    ?>
                                    <!--Overdue-->
                                    <li class="dropdown label-danger">
                                        <a class="dropdown-toggle" data-toggle="dropdown"><?= $total_overdue; ?></a>
                                        <ul class="dropdown-menu">
                                            <div>
                                                <?php
                                                $overdue_summaries = Indicator_summary_model::getSummaryByStatus($utility, 'OVERDUE');
                                                foreach ($overdue_summaries as $indicator_name => $overdue_value):
                                                ?>
                                                    <span><?= $indicator_name; ?>
                                                    <div class="stat-percent font-bold text-danger"><?= $overdue_value; ?></div>
                                                    <br/>
                                                <?php endforeach; ?>
                                            </div>
                                            <?php if($this->ion_auth->is_admin() || $utility->getInspectorId() == $this->session->userdata('user_id')): ?>
                                                <div>
                                                    <span class="pull-right label label-danger">
                                                      <a href="<?= base_url().'utility/show/'.$utility->getId(); ?>">
                                                          VIEW DETAILS
                                                      </a>
                                                    </span>
                                                </div>
                                            <?php endif; ?>
                                        </ul>
                                    </li>
                                    <!--End Overdue-->

                                    <!--Almost Due-->
                                    <li class="dropdown label-warning">
                                        <a class="dropdown-toggle" data-toggle="dropdown"><?= $total_almost; ?></a>
                                        <ul class="dropdown-menu">
                                            <div>
                                                <?php
                                                $almost_summaries = Indicator_summary_model::getSummaryByStatus($utility, 'ALMOST');
                                                foreach ($almost_summaries as $indicator_name => $almost_value): ?>
                                                    <span><?= $indicator_name; ?>
                                                    <div class="stat-percent font-bold text-warning"><?= $almost_value; ?></div>
                                                    <br/>
                                                <?php endforeach; ?>
                                            </div>
                                            <?php if($this->ion_auth->is_admin() || $utility->getInspectorId() == $this->session->userdata('user_id')): ?>
                                                <div>
                                                    <span class="pull-right label label-warning">
                                                      <a href="<?= base_url().'utility/show/'.$utility->getId(); ?>">
                                                          VIEW DETAILS
                                                      </a>
                                                    </span>
                                                </div>
                                            <?php endif; ?>
                                        </ul>
                                    </li>
                                    <!--End Almost Due-->

                                    <!--Active-->
                                    <li class="dropdown label-primary">
                                        <a class="dropdown-toggle" data-toggle="dropdown"><?= $total_active; ?></a>
                                        <ul class="dropdown-menu">
                                            <div>
                                                <?php
                                                $active_summaries = Indicator_summary_model::getSummaryByStatus($utility, 'ACTIVE');
                                                foreach ($active_summaries as $indicator_name => $active_value): ?>
                                                    <span><?= $indicator_name; ?>
                                                    <div class="stat-percent font-bold text-primary"><?= $active_value; ?></div>
                                                    <br/>
                                                <?php endforeach; ?>
                                            </div>
                                            <?php if($this->ion_auth->is_admin() || $utility->getInspectorId() == $this->session->userdata('user_id')): ?>
                                                <div>
                                                    <span class="pull-right label label-primary">
                                                      <a href="<?= base_url().'utility/show/'.$utility->getId(); ?>">
                                                          VIEW DETAILS
                                                      </a>
                                                    </span>
                                                </div>
                                            <?php endif; ?>
                                        </ul>
                                    </li>
                                    <!--End Active-->
                                </ul>
                            </li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </ul>
            </div>
        </div>

        <script type="text/javascript" charset="utf-8" async defer>
            google.load("visualization", "1", {packages: ["corechart"]});
            google.setOnLoadCallback(drawCharts);

            function drawCharts() {
                <?php foreach ($utility_indicators as $indicator): ?>
                    <?php if($indicator->getHaveChart()): ?>
                        // actual bar chart data
                        var barData = google.visualization.arrayToDataTable(<?= json_encode($indicator_instruction->getUtilityBarChartData($indicator))?>);

                        // set bar chart options
                        var barOptions = {
                            focusTarget: 'category',
                            backgroundColor: 'transparent',
                            colors: ['red', 'orange', '#1ab394'],
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
                        var barChart = new google.visualization.ColumnChart(document.getElementById('chart_div_<?= $indicator->getId();?>'));
                        barChart.draw(barData, barOptions);
                    <?php endif; ?>
                <?php endforeach; ?>
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
                                        <?php foreach ($utility_indicators as $indicator): ?>
                                            <?php if($indicator->getHaveChart()): ?>
                                                <li>
                                                    <h5><?= $indicator->getDescription(); ?></h5>
                                                    <div id="chart_div_<?= $indicator->getId(); ?>"></div>
                                                </li>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </ul>
                                </main>
                            </div>
                        </main>
                    </div>
                </div>
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