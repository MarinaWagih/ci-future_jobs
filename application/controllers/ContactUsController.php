<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ContactUsController extends CI_Controller {


    /**
     *Call before any function to:
     * 1. Load Models Needed
     */
    protected $layout;
    public function __construct()
    {
        parent::__construct();
//        $this->load->model('Mail','mail');
        $this->load->helper('url');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->layout='layout';

        $this->load->model('Advertisement','advertisement');
        $this->load->model('Country','country');
        $this->countries=$this->country->get_all_countries();
        $this->left_adv=$this->advertisement->get_left();
        $this->right_adv=$this->advertisement->get_right();
    }

    /**
     *go to /q8soccer/application/config/route.php
     * you will found a line :
     *    $route['contact_us']='ContactUsControl';
     * this means you can change how the contact_us see urls
     * but wont know the name of the real controller
     *or the method
     * same thing for the rest of function in here
     */
    public function index()
	{
        $data['script']='contact_us-validation.js';
       $view = array('content' => 'contact_us/add');
        $this->load->view($this->layout, $view);
	}


    public function add()
    {
        $protocol=isset($_SERVER['HTTPS'])?'https://':'http://';
        $domain=$_SERVER['HTTP_HOST'];
        $url=$protocol.''.$domain.base_url();
        $style='<link href="'.$url.'css/en/bootstrap.css" rel="stylesheet">'.
            '<link href="'.$url.'css/en/font-awesome.min.css" rel="stylesheet">'.
            '<link href="'.$url.'css/en/theme.css" rel="stylesheet">'.
            '<link href="'.$url.'css/en/prettyPhoto.css" rel="stylesheet" type="text/css"/>'.
            '<link href="'.$url.'css/en/zocial.css" rel="stylesheet" type="text/css"/>'.
            '<link href="'.$url.'css/en/nerveslider.css" rel="stylesheet">';
        $message =$style.
            '<div id="slider_header">
		        <!--logo-->
			    <div class="container">
			        <div class="row">
                        <div class="span12">
					        <div class="navbar">
					            <!--logo-->
					            <div class="logo">
						            <a href="index.html">
						                    <img src="'.$url.'css/img/logo.png" alt="" />
						            </a>
					            </div>

				            </div>
					    </div>
                    </div>
				</div>
			</div>
			<!--//header-->
     		<!--page-->
            <!--//info boxes-->
            <div class="row">
                <!--col 1-->
                <div class="span12">
                    <div class="row">
                        <div class="pad30 hidden-phone"></div>
                    </div>
                </div>
            </div>'.
            '<div class="strip">
				<h3 class="center about_strip">'.
            ' My Name is '.$_POST['name'].'<br><br>'.
            'mail : '.$_POST['email'].'<br><br>'.
            'mobile :'.$_POST['mobile'].'<br><br>'.
            'phone :'.$_POST['phone'].'<br><br>'.
            'fax :'.$_POST['fax'].'<br><br>'.
            '</h3>'.
            '<div class="pad25"></div>'.
            '</div>'.
            '
			<!-- footer -->
		    <div id="footer">
		        <div class="container">
			        <div class="row">
				        <div class="span12">
				            <div class="copyright">
						        <h3>
						            contact : '.$_POST['content'].'<br><br>
                                    Notes :'.$_POST['notes'].'
                                </h3>
						    </div>
						</div>
					</div>
				</div>
			</div>';
        $email='marina_wagih_cs@yahoo.com';
        $sub='new Contact us from future jobs';
        $this->load->library('Mail','mail');
        $this->mail->send($email,$message,$sub);
        redirect('/', 'location');

    }


    public function index_adv()
    {
//        $data['script']='adv_with_us-validation.js';
        $view = array('content' => 'contact_us/adv_with_us_add');
        $this->load->view($this->layout, $view);
    }

    public function add_adv()
    {
        $protocol=isset($_SERVER['HTTPS'])?'https://':'http://';
        $domain=$_SERVER['HTTP_HOST'];
        $url=$protocol.''.$domain.base_url();
        $style='<link href="'.$url.'css/en/bootstrap.css" rel="stylesheet">'.
               '<link href="'.$url.'css/en/font-awesome.min.css" rel="stylesheet">'.
               '<link href="'.$url.'css/en/theme.css" rel="stylesheet">'.
               '<link href="'.$url.'css/en/prettyPhoto.css" rel="stylesheet" type="text/css"/>'.
               '<link href="'.$url.'css/en/zocial.css" rel="stylesheet" type="text/css"/>'.
               '<link href="'.$url.'css/en/nerveslider.css" rel="stylesheet">';
        $message =$style.
            '<div id="slider_header">
		        <!--logo-->
			    <div class="container">
			        <div class="row">
                        <div class="span12">
					        <div class="navbar">
					            <!--logo-->
					            <div class="logo">
						            <a href="index.html">
						                    <img src="'.$url.'css/img/logo.png" alt="" />
						            </a>
					            </div>

				            </div>
					    </div>
                    </div>
				</div>
			</div>
			<!--//header-->
     		<!--page-->
            <!--//info boxes-->
            <div class="row">
                <!--col 1-->
                <div class="span12">
                    <div class="row">
                        <div class="pad30 hidden-phone"></div>
                    </div>
                </div>
            </div>'.
            '<div class="strip">
				<h3 class="center about_strip">'.
                    ' My Name is '.$_POST['name'].'<br><br>'.
                    'mail : '.$_POST['email'].'<br><br>'.
                    'mobile :'.$_POST['mobile'].'<br><br>'.
                    'phone :'.$_POST['phone'].'<br><br>'.
                    'fax :'.$_POST['fax'].'<br><br>'.
                '</h3>'.
                '<div class="pad25"></div>'.
            '</div>'.
            '
			<!-- footer -->
		    <div id="footer">
		        <div class="container">
			        <div class="row">
				        <div class="span12">
				            <div class="copyright">
						        <h3>
						            contact : '.$_POST['content'].'<br><br>
                                    Notes :'.$_POST['notes'].'
                                </h3>
						    </div>
						</div>
					</div>
				</div>
			</div>';
        $email='marina_wagih_cs@yahoo.com';
        $sub='new Advertise With us from future jobs';
        $this->load->library('Mail','mail');
        $this->mail->send($email,$message,$sub);
        redirect('/', 'location');

    }

    public function index_companies()
    {
//        $data['script']='adv_with_us-validation.js';
        $view = array('content' => 'contact_us/companies_contract_add');
        $this->load->view($this->layout, $view);
    }

    public function add_companies()
    {
        $protocol=isset($_SERVER['HTTPS'])?'https://':'http://';
        $domain=$_SERVER['HTTP_HOST'];
        $url=$protocol.''.$domain.base_url();
        $style='<link href="'.$url.'css/en/bootstrap.css" rel="stylesheet">'.
            '<link href="'.$url.'css/en/font-awesome.min.css" rel="stylesheet">'.
            '<link href="'.$url.'css/en/theme.css" rel="stylesheet">'.
            '<link href="'.$url.'css/en/prettyPhoto.css" rel="stylesheet" type="text/css"/>'.
            '<link href="'.$url.'css/en/zocial.css" rel="stylesheet" type="text/css"/>'.
            '<link href="'.$url.'css/en/nerveslider.css" rel="stylesheet">';
        $message =$style.
            '<div id="slider_header">
		        <!--logo-->
			    <div class="container">
			        <div class="row">
                        <div class="span12">
					        <div class="navbar">
					            <!--logo-->
					            <div class="logo">
						            <a href="index.html">
						                    <img src="'.$url.'css/img/logo.png" alt="" />
						            </a>
					            </div>

				            </div>
					    </div>
                    </div>
				</div>
			</div>
			<!--//header-->
     		<!--page-->
            <!--//info boxes-->
            <div class="row">
                <!--col 1-->
                <div class="span12">
                    <div class="row">
                        <div class="pad30 hidden-phone"></div>
                    </div>
                </div>
            </div>'.
            '<div class="strip">
				<h3 class="center about_strip">'.
            ' My Name is '.$_POST['name'].'<br><br>'.
            'mail : '.$_POST['email'].'<br><br>'.
            'mobile :'.$_POST['mobile'].'<br><br>'.
            'phone :'.$_POST['phone'].'<br><br>'.
            'fax :'.$_POST['fax'].'<br><br>'.
            '</h3>'.
            '<div class="pad25"></div>'.
            '</div>'.
            '
			<!-- footer -->
		    <div id="footer">
		        <div class="container">
			        <div class="row">
				        <div class="span12">
				            <div class="copyright">
						        <h3>
						            contact : '.$_POST['content'].'<br><br>
                                    Notes :'.$_POST['notes'].'
                                </h3>
						    </div>
						</div>
					</div>
				</div>
			</div>';
        $email='marina_wagih_cs@yahoo.com';
        $sub='new company contract from future jobs';
        $this->load->library('Mail','mail');
        $this->mail->send($email,$message,$sub);
        redirect('/', 'location');

    }

}
