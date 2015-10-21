<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdvertisementController extends CI_Controller {


    /**
     *Call before any function to:
     * 1. Load Models Needed
     */
    protected $layout;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Advertisement','advertisement');
        $this->load->library('Upload_Img','upload_img');
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
                                 'delete','show');
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
     *    $route['advertisement']='advertisementControl';
     * this means you can change how the advertisement see urls
     * but wont know the name of the real controller
     *or the method
     * same thing for the rest of function in here
     */
    public function index()
	{
        $this->load->library('pagination');
        $url='AdvertisementController/index';
        $total_rows=$this->db->count_all('advertisement');
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
        $data['advertisements'] = $this->advertisement->get_advertisement_list($config["per_page"], $data['page']);

        $data['pagination'] = $this->pagination->create_links();

        $view = array('content' => 'advertisement/all', 'data' => $data);
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
        $data['rank']='0';
        $data['direction']='left';
        $view = array('content' => 'advertisement/add', 'data' => $data);
        $this->load->view($this->layout, $view);

    }

    /**
     * 1.save the advertisement in db
     * @Request POST
     * @return redirect to index() here
     *
     */
    public function store()
    {
        if (empty($_FILES['image']['name']))
        {
            $this->form_validation->set_rules('image', 'Document', 'required');
        }
        $this->form_validation->set_rules('rank', 'Rank', 'required');
        $data['rank']=isset($_POST['rank'])?$_POST['rank']:'0';
        $data['direction']=isset($_POST['direction'])?$_POST['direction']:'left';
        if ($this->form_validation->run() == FALSE)
        {
            $view = array('content' => 'advertisement/add', 'data' => $data);
            $this->load->view($this->layout, $view);
        }
        else
        {

            $id= $this->advertisement->get_new_id();
            $data['id']=$id;
            $data['image'] =$this->upload_img->upload($data['id'],$_FILES,'images/adv','image');;
            $data['date']=date('Y-m-d H:i:s');
            $this->advertisement->add($data);
           redirect('advertisement');
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

        $data=$this->advertisement->get_advertisement($id);
        $view = array('content' => 'advertisement/edit', 'data' => $data[0]);
        $this->load->view($this->layout, $view);
    }

    /**
     * 1.save updated advertisement in db
     * 2.UploadImg if new one uploaded
     * @Request POST
     * @return redirect to index() here
     *
     */
    public function update()
    {
        $id=$_POST['id'];

        $data=$this->advertisement->get_advertisement($id)[0];
        $data['rank']=isset($_POST['rank'])?$_POST['rank']:'0';
        $data['direction']=isset($_POST['direction'])?$_POST['direction']:'left';
        if(!empty($_FILES['image']['name']))
        {
            unlink('images/adv/'.$data[0]['image']);
            $this->load->library('Upload_Img', 'upload_img');
            $data['image'] = $this->upload_img->upload($data['id'], $_FILES, 'images/adv','image');
        }
        /////////// Save in DB //////////
        $this->advertisement->update($data);
        redirect('advertisement', 'location');
    }

    /**
     *Delete advertisement by id
     * @Request GET
     * @return redirect to index() here
     */
    public function delete()
    {
        $id= $_GET['id'];
        $data=$this->advertisement->get_advertisement($id);
        if(!empty($data[0])) {
            unlink('images/adv/'.$data[0]['image']);
            $data = $this->advertisement->delete($id);
        }
       redirect('advertisement');
    }


    /**
     *profile
     * @Request GET
     * @return View
     */
    public function show()
    {
        $id= $_GET['id'];
        $data=$this->advertisement->get_advertisement($id);
        $view = array('content' => 'advertisement/show', 'data' => $data[0]);
        $this->load->view($this->layout,$view);

    }

}
