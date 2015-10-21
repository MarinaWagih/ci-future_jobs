<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AboutController extends CI_Controller {


    /**
     *Call before any function to:
     * 1. Load Models Needed
     */
    protected $layout;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('About','about');
        $this->load->helper('url');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->layout='layout';

        if ( ! $this->session->userdata('logged_in'))
        {
            // Allow some methods?
            $allowed = array('index','professional_consulting_services');
            if ( ! in_array($this->router->fetch_method(), $allowed))
            {
                 redirect('login');
            }
        }
        else{
            if ($this->session->userdata('logged_in')['type']=='admin')
            {
                // Allow some methods?
                $this->layout='admin_layout';
                $allowed = array('index','edit','update',
                    'professional_consulting_services',
                    'edit_professional_consulting_services','update_professional_consulting_services');
                if (!in_array($this->router->fetch_method(), $allowed))
                {
                    redirect('/');
                }
            }
            else{
                $allowed = array('index','professional_consulting_services');
                if ( ! in_array($this->router->fetch_method(), $allowed))
                {
                    redirect('/');
                }
            }
        }

        $this->load->model('Advertisement','advertisement');
        $this->load->model('Country','country');
        $this->countries=$this->country->get_all_countries();
        $this->left_adv=$this->advertisement->get_left();
        $this->right_adv=$this->advertisement->get_right();
    }

    /**
     *go to /q8soccer/application/config/route.php
     * you will found a line :
     *    $route['about']='aboutControl';
     * this means you can change how the about see urls
     * but wont know the name of the real controller
     *or the method
     * same thing for the rest of function in here
     */
    public function index()
	{
        $data=$this->about->get();

        $view = array('content' => 'about/show', 'data' => $data);
        $this->load->view($this->layout, $view);
	}
    public function professional_consulting_services()
	{
        $data=$this->about->get();

        $view = array('content' => 'about/show_professional_Consulting', 'data' => $data);
        $this->load->view($this->layout, $view);
	}

    /**
     * show the registration form
     * @Request GET
     * @return View
     *
     */
    public function edit()
    {

        $data=$this->about->get();

//        $data[0]['script']='about-validation.js';
        $view = array('content' => 'about/edit', 'data' => $data[0]);
        $this->load->view($this->layout, $view);
    }

    public function edit_professional_consulting_services()
    {

        $data=$this->about->get();

//        $data[0]['script']='about-validation.js';
        $view = array('content' => 'about/edit_professional_Consulting', 'data' => $data[0]);
        $this->load->view($this->layout, $view);
    }

    /**
     * 1.save updated about in db
     * 2.UploadImg if new one uploaded
     * @Request POST
     * @return redirect to index() here
     *
     */
    public function update()
    {

            $data=$this->about->get()[0];
            $data['data']=isset($_POST['data'])?$_POST['data']:'';
            $data['data_ar']=isset($_POST['data_ar'])?$_POST['data_ar']:'';
            /////////// Save in DB //////////
            $this->about->update($data);
            redirect('about', 'location');



    }
    public function update_professional_consulting_services()
    {

            $data=$this->about->get()[0];
            $data['professional_consulting_data']=isset($_POST['professional_consulting_data'])?$_POST['professional_consulting_data']:'';
            $data['professional_consulting_data_ar']=isset($_POST['professional_consulting_data_ar'])?$_POST['professional_consulting_data_ar']:'';
            /////////// Save in DB //////////
            $this->about->update($data);
            redirect('professional_consulting_services', 'location');

    }
}
