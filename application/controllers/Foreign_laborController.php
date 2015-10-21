<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Foreign_laborController extends CI_Controller {


    /**
     *Call before any function to:
     * 1. Load Models Needed
     */
    protected $layout;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Foreign_labor','foreign_labor');
        $this->load->model('Country','country');
        $this->load->model('User','user');
        $this->load->helper('url');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->layout='layout';

        if ( ! $this->session->userdata('logged_in'))
        {
            // Allow some methods?
            $allowed = array('');
            if ( ! in_array($this->router->fetch_method(), $allowed))
            {
                redirect('login');
            }
        }
        else{
            if ($this->session->userdata('logged_in')['type']=='admin')
            {
                $this->layout='admin_layout';
                // Allow some methods?
                $allowed = array('add','store','edit','update','index','delete','show');
                if (!in_array($this->router->fetch_method(), $allowed))
                {
                    redirect('/');
                }
            }
            else{
                $allowed = array('add','store','edit','update',
                    'delete','show');
                if ( ! in_array($this->router->fetch_method(), $allowed))
                {
                    redirect('/');
                }
            }
        }

        $this->load->model('Advertisement','advertisement');
        $this->countries=$this->country->get_all_countries();
        $this->left_adv=$this->advertisement->get_left();
        $this->right_adv=$this->advertisement->get_right();
    }

    /**
     *go to /q8soccer/application/config/route.php
     * you will found a line :
     *    $route['foreign_labor']='foreign_laborControl';
     * this means you can change how the foreign_labor see urls
     * but wont know the name of the real controller
     *or the method
     * same thing for the rest of function in here
     */
    public function index()
	{
        $this->load->library('pagination');
        $url='foreign_laborController/index';
        $total_rows=$this->db->count_all('foreign_labor');
        $config['base_url'] = site_url($url);
        $config['total_rows'] =$total_rows ;
        $config['per_page'] = "10";
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);

        //config for bootstrap pagination class integration
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        //call the model function to get the department data
        $data['foreign_labors'] = $this->foreign_labor->get_foreign_labor_list($config["per_page"], $data['page']);

        $data['pagination'] = $this->pagination->create_links();

        $view = array('content' => 'foreign_labor/all', 'data' => $data);
        $this->load->view($this->layout, $view);
	}

    /**
     * show the registration form
     * @Request GET
     * @return View
     *
     */
    public function add()
    {
        $user=$this->user->get_user($this->session->userdata('logged_in')['id']);
        $data['years_of_experience']='0';
        $data['salary_from']='';
        $data['salary_to']='';
        $data['nationality']='';
        $data['Number_needed']='';
        $data['contact_name']=$user[0]['name'];
        $data['contact_phone']=$user[0]['phone'];
        $data['contact_mobile']=$user[0]['mobile'];
        $data['contact_email']=$user[0]['email'];
        $data['contact_fax']=$user[0]['fax'];
        $data['countries']=$this->country->get_all_countries();
        $data['script']='foreign_labor-validation.js';
        $view = array('content' => 'foreign_labor/add', 'data' => $data);
        $this->load->view($this->layout, $view);

    }

    /**
     * 1.save the foreign_labor in db
     * @Request POST
     * @return redirect to index() here
     *
     */
    public function store()
    {


        $this->form_validation->set_rules('years_of_experience', 'years_of_experience', 'required');
//        $this->form_validation->set_rules('name_ar', 'Arabic_Name', 'required|is_unique[foreign_labor.name_ar]');
        $user=$this->user->get_user($this->session->userdata('logged_in')['id']);
        $data['years_of_experience']=isset($_POST['years_of_experience'])?$_POST['years_of_experience']:'';
        $data['salary_from']=isset($_POST['salary_from'])?$_POST['salary_from']:'';
        $data['salary_to']=isset($_POST['salary_to'])?$_POST['salary_to']:'';
        $data['nationality']=isset($_POST['nationality'])?$_POST['nationality']:'';
        $data['Number_needed']=isset($_POST['Number_needed'])?$_POST['Number_needed']:'';
        $data['contact_name']=isset($_POST['contact_name'])?$_POST['contact_name']:$user[0]['name'];
        $data['contact_phone']=isset($_POST['contact_phone'])?$_POST['contact_phone']:$user[0]['phone'];
        $data['contact_mobile']=isset($_POST['contact_mobile'])?$_POST['contact_mobile']:$user[0]['mobile'];
        $data['contact_email']=isset($_POST['contact_email'])?$_POST['contact_email']:$user[0]['email'];
        $data['contact_fax']=isset($_POST['contact_fax'])?$_POST['contact_fax']:$user[0]['fax'];
        $data['company_id']=$this->session->userdata('logged_in')['id'];
        $data['date']=date('Y-m-d H:i:s');
        if ($this->form_validation->run() == FALSE)
        {

            $data['countries']=$this->country->get_all_countries();
            $data['script']='foreign_labor-validation.js';
            $view = array('content' => 'foreign_labor/add', 'data' => $data);
            $this->load->view($this->layout, $view);
        }
        else
        {
            $id= $this->foreign_labor->get_new_id();
            $data['id']=$id;
            $this->foreign_labor->add($data);
            if($this->session->userdata('logged_in')['type']!=='admin')
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
                    ' New foreign labor added  '.'<br><br>'.

                    '</h3>'.
                    '<a href="'.$url.'foreign_labor/show'.'?id='.$id.'"> click here to see it</a>'.
                    '<div class="pad25"></div>'.
                    '</div>'.
                    '</div>';
                $email='marina_wagih_cs@yahoo.com';
                $sub='new foreign labor added from future jobs';
                $this->load->library('Mail','mail');
                $this->mail->send($email,$message,$sub);
            }

            if($this->session->userdata('logged_in')['type']=='admin')
            {
                redirect('foreign_labor');
            }
            else{
                redirect('/');
            }
        }

    }

    /**
     * show the edit form
     * @Request GET
     * @return View
     *
     */
    public function edit()
    {
        $id=$_GET['id'];

        $data=$this->foreign_labor->get_foreign_labor($id);
        $user_id=$this->session->userdata('logged_in')['id'];
        $user_type=$this->session->userdata('logged_in')['type'];
        if((isset($user_id)&&$id==$data[0]['company_id'])|
            (isset($user_id)&&$user_type=='admin'))
        {
            $data[0]['countries']=$this->country->get_all_countries();
            $view = array('content' => 'foreign_labor/edit', 'data' => $data[0]);
            $this->load->view($this->layout, $view);
        }
        else{
            redirect('/');
        }

    }

    /**
     * 1.save updated foreign_labor in db
     * 2.UploadImg if new one uploaded
     * @Request POST
     * @return redirect to index() here
     *
     */
    public function update()
    {
//        $this->form_validation->set_rules('name', 'Name', 'required');
//        $this->form_validation->set_rules('name_ar', 'Arabic_Name', 'required');
        $this->form_validation->set_rules('years_of_experience', 'years_of_experience', 'required');
        $user_id=$this->session->userdata('logged_in')['id'];
        $user_type=$this->session->userdata('logged_in')['type'];
        $id=$_POST['id'];
        $data = $this->foreign_labor->get_foreign_labor($id);
        if((isset($user_id)&&$id==$data[0]['company_id'])|
            (isset($user_id)&&$user_type=='admin'))
        {
            if ($this->form_validation->run() == FALSE) {

                $data[0]['countries'] = $this->country->get_all_countries();
                $view = array('content' => 'foreign_labor/edit', 'data' => $data[0]);
                $this->load->view($this->layout, $view);
            }
            else {
                $data = $this->foreign_labor->get_foreign_labor($id)[0];
                $user = $this->user->get_user($this->session->userdata('logged_in')['id']);
                $data['years_of_experience'] = isset($_POST['years_of_experience']) ? $_POST['years_of_experience'] : '';
                $data['salary_from'] = isset($_POST['salary_from']) ? $_POST['salary_from'] : '';
                $data['salary_to'] = isset($_POST['salary_to']) ? $_POST['salary_to'] : '';
                $data['nationality'] = isset($_POST['nationality']) ? $_POST['nationality'] : '';
                $data['Number_needed'] = isset($_POST['Number_needed']) ? $_POST['Number_needed'] : '';
                $data['contact_name'] = isset($_POST['contact_name']) ? $_POST['contact_name'] : $user[0]['name'];
                $data['contact_phone'] = isset($_POST['contact_phone']) ? $_POST['contact_phone'] : $user[0]['phone'];
                $data['contact_mobile'] = isset($_POST['contact_mobile']) ? $_POST['contact_mobile'] : $user[0]['mobile'];
                $data['contact_email'] = isset($_POST['contact_email']) ? $_POST['contact_email'] : $user[0]['email'];
                $data['contact_fax'] = isset($_POST['contact_fax']) ? $_POST['contact_fax'] : $user[0]['fax'];
                $data['company_id'] = $this->session->userdata('logged_in')['id'];
                /////////// Save in DB //////////
                $this->foreign_labor->update($data);
                redirect('foreign_labor', 'location');
//            $this->index();
            }
        }
        else
        {
            redirect('/');
        }

    }

    /**
     *Delete foreign_labor by id
     * @Request GET
     * @return redirect to index() here
     */
    public function delete()
    {
        $id= $_GET['id'];
        $data=$this->foreign_labor->get_foreign_labor($id);
        $user_type=$this->session->userdata('logged_in')['type'];

        if(!empty($data[0])&&$user_type=='admin')
        {
            if (!empty($data[0])) {
                $data = $this->foreign_labor->delete($id);
            }
            redirect('foreign_labor');
        }
        else
        {
            redirect('/');
        }
    }

    /**
     *profile
     * @Request GET
     * @return View
     */
    public function show()
    {
        $id= $_GET['id'];
        $data=$this->foreign_labor->get_foreign_labor($id);
        $data[0]['country_data']=$this->country->get_country_by_id($data[0]["nationality"]);
        $view = array('content' => 'foreign_labor/show', 'data' => $data[0]);
        $this->load->view($this->layout,$view);

    }


}
