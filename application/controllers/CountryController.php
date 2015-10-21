<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CountryController extends CI_Controller {


    /**
     *Call before any function to:
     * 1. Load Models Needed
     */
    protected $layout;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Country','country');
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
                $allowed = array('index','add','store','edit','update',
                    'delete','show','is_countryName_Valid',
                    'is_countryName_ar_Valid');
                if (!in_array($this->router->fetch_method(), $allowed))
                {
                    redirect('/');
                }
            }
            else{
                $allowed = array('');
                if ( ! in_array($this->router->fetch_method(), $allowed))
                {
                    redirect('/');
                }
            }
        }
    }

    /**
     *go to /q8soccer/application/config/route.php
     * you will found a line :
     *    $route['country']='countryControl';
     * this means you can change how the country see urls
     * but wont know the name of the real controller
     *or the method
     * same thing for the rest of function in here
     */
    public function index()
	{
        $this->load->library('pagination');
        $url='countryController/index';
        $total_rows=$this->db->count_all('country');
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
        $data['countries'] = $this->country->get_country_list($config["per_page"], $data['page']);

        $data['pagination'] = $this->pagination->create_links();

        $view = array('content' => 'country/all', 'data' => $data);
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

        $data['name']='';
        $data['name_ar']='';
        $data['script']='country-validation.js';
        $view = array('content' => 'country/add', 'data' => $data);
        $this->load->view($this->layout, $view);

    }

    /**
     * 1.save the country in db
     * @Request POST
     * @return redirect to index() here
     *
     */
    public function store()
    {

//        var_dump($_FILES);
//        exit;
        $this->form_validation->set_rules('name', 'Name', 'required|is_unique[country.name]');
        $this->form_validation->set_rules('name_ar', 'Arabic_Name', 'required|is_unique[country.name_ar]');
        $data['name']=isset($_POST['name'])?$_POST['name']:'';
        $data['name_ar']=isset($_POST['name_ar'])?$_POST['name_ar']:'';
        if ($this->form_validation->run() == FALSE)
        {

            $data['script']='country-validation.js';
            $view = array('content' => 'country/add', 'data' => $data);
            $this->load->view($this->layout, $view);
        }
        else
        {

            $id= $this->country->get_new_id();
            $data['id']=$id;
            $this->country->add($data);
           redirect('country');
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

        $data=$this->country->get_country($id);
        $view = array('content' => 'country/edit', 'data' => $data[0]);
        $this->load->view($this->layout, $view);
    }

    /**
     * 1.save updated country in db
     * 2.UploadImg if new one uploaded
     * @Request POST
     * @return redirect to index() here
     *
     */
    public function update()
    {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('name_ar', 'Arabic_Name', 'required');
        $id=$_POST['id'];
        if ($this->form_validation->run() == FALSE)
        {
            $data=$this->country->get_country($id);
            $view = array('content' => 'country/edit', 'data' => $data[0]);
            $this->load->view($this->layout, $view);
        }
        else
        {
            $data=$this->country->get_country($id)[0];
            $data['name']=isset($_POST['name'])?$_POST['name']:'';
            $data['name_ar']=isset($_POST['name_ar'])?$_POST['name_ar']:'';
            /////////// Save in DB //////////
            $this->country->update($data);
            redirect('country', 'location');
//            $this->index();
        }


    }

    /**
     *Delete country by id
     * @Request GET
     * @return redirect to index() here
     */
    public function delete()
    {
        $id= $_GET['id'];
        $data=$this->country->get_country($id);
        if(!empty($data[0])) {
            $data = $this->country->delete($id);
        }
       redirect('country');
    }


    /**
     *profile
     * @Request GET
     * @return View
     */
    public function show()
    {
        $id= $_GET['id'];
        $data=$this->country->get_country($id);
        $view = array('content' => 'country/show', 'data' => $data[0]);
        $this->load->view($this->layout,$view);

    }

    /**
     * check if the name Unique
     * the sent name is NOT in the db
     *for country validation in UI
     *
     */
    public function is_countryName_Valid()
    {
        $name=$_GET['name'];
        $data=$this->country->get_country_by_name($name);
        if(empty($data))
        {
         echo json_encode('true');
        }
        else
        {
            echo json_encode('false');
        }
    }

    /**
     * check if the E-mail Unique
     * the sent mail is NOT in the db
     *for country validation in UI
     *
     */
    public function is_countryName_ar_Valid()
    {
        $name=$_GET['email'];
        $data=$this->country->get_country_by_name_ar($name);
        if(empty($data))
        {
            echo json_encode('true');
        }
        else
        {
            echo json_encode('false');
        }
    }

}
