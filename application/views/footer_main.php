        <div class="footer fixed_full">
            <div class="pull-right">
                <?php echo lang('system_title');?> <strong> <?php echo lang('system_title_sht');?> </strong>
            </div>
            <div>
               <a class="navbar-minimalize minimalize-styl-2 btn btn-success " href="#"><i class="fa fa-bars"></i> </a> <strong>Copyright</strong>&copy; <?php echo date('Y');?>
            </div>
        </div>

        </div>
        </div>
        <?php
                    $editing = 'edit';
                    $archiving = 'archive';
                    $pending = 'pending';
                    $accepted = 'accepted';

                    $this->db->where('requests.type', $editing);
                    $equery = $this->db->count_all_results('requests');

                    $this->db->where('requests.type', $archiving);
                    $aquery = $this->db->count_all_results('requests');

                    $this->db->where('requests.type', $editing);
                    $this->db->where('requests.status', $pending);
                    $epquery = $this->db->count_all_results('requests');

                    $this->db->where('requests.type', $archiving);
                    $this->db->where('requests.status', $pending);
                    $apquery = $this->db->count_all_results('requests');

                    $this->db->where('requests.type', $editing);
                    $this->db->where('requests.status', $accepted);
                    $eaquery = $this->db->count_all_results('requests');

                    $this->db->where('requests.type', $archiving);
                    $this->db->where('requests.status', $accepted);
                    $aaquery = $this->db->count_all_results('requests');
                    $nots = $equery + $aquery;
                ?>

        <?= CI_footer() ?>

        <script>

               jQuery(document).ready(function($) {

                Tinycon.setBubble(<?php echo $nots;?>);

                Tinycon.setOptions({
                        width: 7,
                        height: 9,
                        font: '10px sans-serif',
                        colour: '#ffffff',
                        background: '#ec5645',
                        fallback: true
                    });
          });
        </script>
</body>
</html>
