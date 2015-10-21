<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class JobController extends CI_Controller {


    /**
     *Call before any function to:
     * 1. Load Models Needed
     */
    protected $layout;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Job','job');
        $this->load->model('Category','category');
        $this->load->model('Country','country');
        $this->load->library('Upload_Img','upload_img');
        $this->load->helper('url');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->layout='layout';

        if ( ! $this->session->userdata('logged_in'))
        {
            // Allow some methods?
            $allowed = array('show','recent','by_country','search');
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
                $allowed = array('add','store','edit','update','search',
                    'index','delete','show','apply','recent','by_country');
                if (!in_array($this->router->fetch_method(), $allowed))
                {
                    redirect('/');
                }
            }
            else{
                $allowed = array('show','apply','recent','by_country','search');
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
     *    $route['job']='jobControl';
     * this means you can change how the job see urls
     * but wont know the name of the real controller
     *or the method
     * same thing for the rest of function in here
     */
    public function index()
	{
        $this->load->library('pagination');
        $url='JobController/index';
        $total_rows=$this->db->count_all('job');
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
        $data['jobs'] = $this->job->get_job_list($config["per_page"], $data['page']);

        $data['pagination'] = $this->pagination->create_links();

        $view = array('content' => 'job/all', 'data' => $data);
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

        //`id`, `description`, `category_id`,`title`,`image`
        // `country_id`, `company`, `requirements`, `date`
        $data['title']='';
        $data['description']='';
        $data['requirements']='';
        $data['category_id']='';
        $data['country_id']='';
        $data['company']='';
        $data['date']=date('Y-m-d H:i:s');
        $data['categories']=$this->category->get_all_categories();
        $data['countries']=$this->country->get_all_countries();
        $data['script']='job-validation.js';
        $view = array('content' => 'job/add', 'data' => $data);
        $this->load->view($this->layout, $view);

    }

    /**
     * 1.save the job in db
     * @Request POST
     * @return redirect to index() here
     *
     */
    public function store()
    {

//        var_dump($_FILES);
//        exit;
        $this->form_validation->set_rules('description', 'Description', 'required');
        $this->form_validation->set_rules('requirements', 'Requirements', 'required');
        $this->form_validation->set_rules('category_id', 'Category', 'required');
        $this->form_validation->set_rules('country_id', 'Country', 'required');

        $data['title']=isset($_POST['title'])?$_POST['title']:'';
        $data['description']=isset($_POST['description'])?$_POST['description']:'';
        $data['requirements']=isset($_POST['requirements'])?$_POST['requirements']:'';
        $data['category_id']=isset($_POST['category_id'])?$_POST['category_id']:'';
        $data['country_id']=isset($_POST['country_id'])?$_POST['country_id']:'';
        $data['company']=isset($_POST['company'])?$_POST['company']:'';
        $data['date']=isset($_POST['date'])?$_POST['date']:date('Y-m-d H:i:s');
        if ($this->form_validation->run() == FALSE)
        {
            $data['categories']=$this->category->get_all_categories();
            $data['countries']=$this->country->get_all_countries();
            $data['script']='job-validation.js';
            $view = array('content' => 'job/add', 'data' => $data);
            $this->load->view($this->layout, $view);
        }
        else
        {
            $id= $this->job->get_new_id();
            $data['id']=$id;
            $data['image'] =$this->upload_img->upload($data['id'],$_FILES,'images/job','image');
            $this->job->add($data);
           redirect('job');
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

        $data=$this->job->get_job($id);
//        var_dump($data);exit;
        $data[0]['categories']=$this->category->get_all_categories();
        $data[0]['countries']=$this->country->get_all_countries();
        $view = array('content' => 'job/edit', 'data' => $data[0]);
        $this->load->view($this->layout, $view);
    }

    /**
     * 1.save updated job in db
     * 2.UploadImg if new one uploaded
     * @Request POST
     * @return redirect to index() here
     *
     */
    public function update()
    {
        $this->form_validation->set_rules('description', 'Description', 'required');
        $this->form_validation->set_rules('requirements', 'Requirements', 'required');
        $this->form_validation->set_rules('category_id', 'Category', 'required');
        $this->form_validation->set_rules('country_id', 'Country', 'required');
        $id=$_POST['id'];
        if ($this->form_validation->run() == FALSE)
        {
            $data=$this->job->get_job($id);
            $view = array('content' => 'job/edit', 'data' => $data[0]);
            $this->load->view($this->layout, $view);
        }
        else
        {
            $data=$this->job->get_job($id)[0];
            $data['title']=isset($_POST['title'])?$_POST['title']:'';
            $data['description']=isset($_POST['description'])?$_POST['description']:'';
            $data['requirements']=isset($_POST['requirements'])?$_POST['requirements']:'';
            $data['category_id']=isset($_POST['category_id'])?$_POST['category_id']:'';
            $data['country_id']=isset($_POST['country_id'])?$_POST['country_id']:'';
            $data['company']=isset($_POST['company'])?$_POST['company']:'';
            $data['date']=isset($_POST['date'])?$_POST['date']:date('Y-m-d H:i:s');
            if (!empty($_FILES['image']['name'])) {
                unlink('images/job/' . $data['image']);
                $data['image'] = $this->upload_img->upload($data['id'],
                    $_FILES, 'images/job', 'image');

            }
            /////////// Save in DB //////////
            $this->job->update($data);
            redirect('job', 'location');
        }


    }

    /**
     *Delete job by id
     * @Request GET
     * @return redirect to index() here
     */
    public function delete()
    {
        $id= $_GET['id'];
        $data=$this->job->get_job($id);
        $user_type=$this->session->userdata('logged_in')['type'];
        if(!empty($data[0])&&$user_type=='admin')
        {
            if (file_exists(base_url() . '/images/job/' . $data[0]['image'])
                && $data[0]['image'] !== 'default.png')
            {
                unlink('images/job/' . $data[0]['image']);

            }
            $data = $this->job->delete($id);
        }

       redirect('job');
    }

    /**
     *profile
     * @Request GET
     * @return View
     */
    public function show()
    {
        $id= $_GET['id'];
        $data=$this->job->get_job($id);
        $data[0]['country_data']=$this->country->get_country_by_id($data[0]["country_id"]);
        $data[0]['category_data']=$this->category->get_category($data[0]["category_id"]);
        $data[0]['applied_users']=$this->job->get_applied_users($id);
        $view = array('content' => 'job/show', 'data' => $data[0]);
        $this->load->view($this->layout,$view);

    }

    public function apply()
    {
        $id= $_GET['id'];
        $user_id= $this->session->userdata('logged_in')['id'];
//        $user_id=$_SESSION['id'];
        $this->job->apply($id,$user_id);
        redirect('/');
    }

    public function recent()
    {
        $this->load->library('pagination');
        $url='JobController/recent';
        $total_rows=$this->db->count_all('job');
        $config['base_url'] = site_url($url);
        $config['total_rows'] =$total_rows ;
        $config['per_page'] = "3";
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
        $data['jobs'] = $this->job->get_job_recent_list($config["per_page"], $data['page']);

        $data['pagination'] = $this->pagination->create_links();

        $view = array('content' => 'job/list_for_users', 'data' => $data);
        $this->load->view('layout', $view);
    }

    public function by_country()
    {
        $id=$_GET['id'];
        $this->load->library('pagination');
        $url='JobController/by_country?id='.$id;
        $total_rows=$this->job->get_count_job_recent_list_by_country($id)[0]->count;
        $config['base_url'] = site_url($url);
        $config['total_rows'] =$total_rows ;
        $config['per_page'] = "3";
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
        $data['jobs'] = $this->job->get_job_recent_list_by_country($config["per_page"], $data['page'],$id);

        $data['pagination'] = $this->pagination->create_links();

        $view = array('content' => 'job/list_for_users', 'data' => $data);
        $this->load->view('layout', $view);
    }
    function search()
    {
        $country_id=isset($_GET['country_id'])?$_GET['country_id']:'0';
        $category_id=isset($_GET['category_id'])?$_GET['category_id']:'0';
        $this->load->library('pagination');
        $url='JobController/search?country_id='.
            $country_id.'&category_id='.$category_id;

        $config['base_url'] = site_url($url);

        $config['per_page'] = "3";
        $config["uri_segment"] = 3;
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['jobs'] = $this->job->get_job_recent_list_by_country_category(
            $config["per_page"], $data['page'],$country_id,$category_id);
        $total_rows=count($data['jobs']);
        $config['total_rows'] =$total_rows ;
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

        //call the model function to get the department data
        $data['categories']=$this->category->get_all_categories();
        $data['countries']=$this->country->get_all_countries();
        $data['pagination'] = $this->pagination->create_links();
        $view = array('content' => 'job/search', 'data' => $data);
        $this->load->view('layout', $view);


    }
}
