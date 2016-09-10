<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tariff extends CI_Controller {

	function Utilities() {

	// load controller parent

	parent::Controller();
	    $this->load->library('ion_auth');
    if (!$this->ion_auth->logged_in())
    {
      //redirect them to the login page
      redirect('auth/login', 'refresh');
    }
       
    }

	function index() {
	
	}

	 public function details($id)//single post page
    {
		 $this->layout->add_custom_meta('meta', array(
            'charset' => 'utf-8'
        ));

        $this->layout->add_custom_meta('meta', array(
            'http-equiv' => 'X-UA-Compatible',
            'content' => 'IE=edge'
        ));

$js_text = <<<EOF
 $(document).ready(function () {
                Tinycon.setOptions({
	            background: '#e0913b'
	            });
	            Tinycon.setBubble(8);

	            $('.autoplay').slick({
				  slidesToShow: 3,
				  slidesToScroll: 1,
				  autoplay: true,
				  autoplaySpeed: 2000,
				});
				$('.dataTables-example').DataTable({
                "dom": 'lTfigt',
                "tableTools": {
                    "sSwfPath": "js/plugins/dataTables/swf/copy_csv_xls_pdf.swf"
                }
            });
			    $('#compose-modal').modal({ show: false});

				function launch_comment_modal(id){
				   $.ajax({
					  type: "POST",
					  url: base_url + "tariff",
					  data: {theId:id},
					  success: function(data){

					  //"data" contains a json with your info in it, representing the array you created in PHP. Use $(".modal-content").html() or something like that to put the content into the modal dynamically using jquery.

					$('#compose-modal').show();// this triggers your modal to display
					   },

				});

			 }


            /* Init DataTables */
            var oTable = $('#editable').DataTable();

            /* Apply the jEditable handlers to the table */
            oTable.$('td').editable( '../example_ajax.php', {
                "callback": function( sValue, y ) {
                    var aPos = oTable.fnGetPosition( this );
                    oTable.fnUpdate( sValue, aPos[0], aPos[1] );
                },
                "submitdata": function ( value, settings ) {
                    return {
                        "row_id": this.parentNode.getAttribute('id'),
                        "column": oTable.fnGetPosition( this )[2]
                    };
                },

                "width": "90%",
                "height": "100%"
            } );

    });
EOF;

$this->layout->add_js_rawtext($js_text, 'footer');

        $this->layout->set_body_attr(array('id' => 'home', 'class' => 'fixed-sidebar no-skin-config full-height-layout'));

		$this->layout->add_css_file('https://fonts.googleapis.com/css?family=Open+Sans:400,600,700');
        $this->layout->add_css_files(array('bootstrap.min.css'), base_url().'assets/css/');
        $this->layout->add_css_files(array('font-awesome.css'), base_url().'assets/font-awesome/css/');
        $this->layout->add_css_files(array('dataTables.bootstrap.css','dataTables.responsive.css','dataTables.tableTools.min.css'), base_url().'assets/css/plugins/dataTables/');
        $this->layout->add_css_files(array('animate.css','style.css'), base_url().'assets/css/');
        //Main Scripts

        $this->layout->add_js_files(array('jquery-2.1.1.js','bootstrap.min.js','inspinia.js'), base_url('assets/js/'), 'footer', 'async');
        $this->layout->add_js_files(array('jquery.metisMenu.js'), base_url('assets/js/plugins/metisMenu/'), 'footer', 'async');
        $this->layout->add_js_files(array('jquery.slimscroll.min.js'), base_url('assets/js/plugins/slimscroll/'), 'footer', 'async');

        $this->layout->add_js_files(array('jquery.dataTables.js','dataTables.bootstrap.js','dataTables.responsive.js','dataTables.tableTools.min.js'), base_url('assets/js/plugins/dataTables/'), 'footer', 'async');
        // Pace
        $this->layout->add_js_files(array('pace.min.js'), base_url('assets/js/plugins/pace/'), 'footer', 'async');
        // JQuery
        $this->layout->add_js_files(array('jquery-ui.min.js'), base_url('assets/js/plugins/jquery-ui/'), 'footer', 'async');
        // GITTER
        $this->layout->add_js_files(array('jquery.gritter.min.js'), base_url('assets/js/plugins/gritter/'), 'footer', 'async');
        //Tinycon
        $this->layout->add_js_files(array('tinycon.min.js'), base_url('assets/js/plugins/tinycon/'), 'footer', 'async');
        //Slick
        $this->layout->add_js_files(array('slick.min.js'), base_url('assets/js/plugins/slick/'), 'footer', 'async');


		
    	$this->data['current_user_menu'] = '';
	    if($this->ion_auth->in_group('admin'))
	    {
         

        $this->layout->set_title('Welcome to :: Nwasco Dashboard');
        $this->layout->set_body_attr(array('id' => 'home', 'class' => 'test more_class'));
        $data['title'] = $this->lang->line('login_heading');
		$data['user'] = $this->ion_auth->user()->row();
        $data['utilities']  = $this->core->getAllUtilities();
		$data['schemes']  = $this->core->getSchemes();
		$data['tariffs']  = $this->core->tariffById($id);
		$data['similar']  = $this->core->getSimilar($id);
        // load views and send data
		$this->data['current_user_menu'] = $this->load->view('templates/view_tariff', $data);
       }
       else
       {
         //If no session, redirect to login page
         redirect('auth/login');
       }
    }

}