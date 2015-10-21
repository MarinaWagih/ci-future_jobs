<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginController extends CI_Controller {


    /**
     *Call before any function to:
     * 1. Load Models Needed
     */
//    protected $layout;
    public function __construct()
    {
        parent::__construct();

        $this->load->model('User','user');
        $this->load->helper('url');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
//        $this->layout='admin_layout';

        if ($this->session->userdata('logged_in')&&
            ($this->router->fetch_method()=='index'))
        {
            redirect('/');
        }
        elseif(!$this->session->userdata('logged_in')&&
            ($this->router->fetch_method()=='logout'))
        {
            redirect('login');
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
     *    $route['contact_us']='ContactUsControl';
     * this means you can change how the contact_us see urls
     * but wont know the name of the real controller
     *or the method
     * same thing for the rest of function in here
     */
    public function index()
	{
        $data['script']='contact_us-validation.js';
        $view = array('content' => 'login/index',$data);
        $this->load->view('layout', $view);
//        $this->load->view('login/index',$data);
	}


    public function verify()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if($this->form_validation->run() == FALSE)
        {
            //Field validation failed.  User redirected to login page
            echo validation_errors();
            exit;
            redirect('login', 'refresh');
        }
        else
        {
            $result = $this->user->login($_POST['email'], $_POST['password']);
            if ($result) {
                $session_array = array(
                    'id' => $result[0]->id,
                    'email' => $result[0]->email,
                    'type' => $result[0]->type
                );
                $this->session->set_userdata('logged_in', $session_array);;
                if($result[0]->type=='admin')
                {
                    redirect('user');
                }
                else{
                    redirect('/');
                }
            } else {
                $data['error']='The Email or password is invalid';
                $data['script']='contact_us-validation.js';
//                var_dump($data);
//                exit;
//                $view = array('content' => 'login/index', 'data' =>$data);
//                $this->load->view($this->layout, $view);
                $this->load->view('login/index',$data);

            }

        }

    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('/', 'location');
    }



}
