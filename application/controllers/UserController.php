<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserController extends CI_Controller {


    /**
     *Call before any function to:
     * 1. Load Models Needed
     */
    protected $layout;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User','user');
        $this->load->model('Job','job');
        $this->load->model('Country','country');
        $this->load->helper('url');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $this->layout='layout';

        if ( ! $this->session->userdata('logged_in'))
        {
            // Allow some methods?
            $allowed = array('add','store','is_userName_Valid',
                             'is_email_Valid');
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
                    'delete','show','is_userName_Valid',
                    'is_email_Valid');
                if (!in_array($this->router->fetch_method(), $allowed))
                {
                    redirect('/');
                }
            }
            else{
                $allowed = array('edit','update','show');
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
     *    $route['user']='UserControl';
     * this means you can change how the user see urls
     * but wont know the name of the real controller
     *or the method
     * same thing for the rest of function in here
     */
    public function index()
	{
        $this->load->library('pagination');
        $url='UserController/index';
        $total_rows=$this->db->count_all('user');
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
        $data['users'] = $this->user->get_user_list($config["per_page"], $data['page']);

        $data['pagination'] = $this->pagination->create_links();

        $view = array('content' => 'user/all', 'data' => $data);
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
        $data['email']='';
        $data['mobile']='';
        $data['phone']='';
        $data['specialty']='';
        $data['years_of_experience']='';
        $data['social_status']='';
        $data['nationality']='';
        $data['place_of_residence']='';
        $data['sex']='';
        $data['fax']='';
        $data['type']='employer';
        $data['countries']=$this->country->get_all_countries();

        $data['script']='user-validation.js';
        $view = array('content' => 'user/add', 'data' => $data);
        $this->load->view($this->layout, $view);

    }

    /**
     * 1.save the user in db
     * 2.UploadImg
     * 3.send Approval email
     * @Request POST
     * @return redirect to index() here
     *
     */
    public function store()
    {

//        var_dump($_FILES);
//        exit;
        $this->form_validation->set_rules('name', 'Name', 'required|is_unique[user.name]');
        $this->form_validation->set_rules('password', 'Password', 'required|is_unique[user.email]');
        $this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $data['name']=isset($_POST['name'])?$_POST['name']:'';
        $data['email']=isset($_POST['email'])?$_POST['email']:'';
        $data['password']=isset($_POST['password'])?$_POST['password']:'';
        $data['mobile']=isset($_POST['mobile'])?$_POST['mobile']:'';
        $data['phone']=isset($_POST['phone'])?$_POST['phone']:'';
        $data['specialty']=isset($_POST['specialty'])?$_POST['specialty']:'';
        $data['years_of_experience']=isset($_POST['years_of_experience'])?$_POST['years_of_experience']:'';
        $data['social_status']=isset($_POST['social_status'])?$_POST['social_status']:'';
        $data['nationality']=isset($_POST['nationality'])?$_POST['nationality']:'';
        $data['place_of_residence']=isset($_POST['place_of_residence'])?$_POST['place_of_residence']:'';
        $data['sex']=isset($_POST['sex'])?$_POST['sex']:'';
        $data['fax']=isset($_POST['fax'])?$_POST['fax']:'';
        $data['type']=isset($_POST['type'])?$_POST['type']:'employer';
        if ($this->form_validation->run() == FALSE)
        {

            $data['countries']=$this->country->get_all_countries();
            $data['script']='user-validation.js';
            $view = array('content' => 'user/add', 'data' => $data);
            $this->load->view($this->layout, $view);
        }
        else
        {

            $id= $this->user->get_new_id();
            //var_dump($id);
            $data['password']=isset($_POST['password'])?MD5($_POST['password']):'';
            $data['id']=$id;

            ////////// Upload cv////////////
            $this->load->library('Upload_Img','upload_img');
            $data['cv'] =$this->upload_img->upload($data['id'],$_FILES,'files/cv','cv');
            ////////// Upload image////////////
            //$this->load->library('Upload_Img','upload_img');
            $data['image'] =$this->upload_img->upload($data['id'],$_FILES,'images/profile','image');
            /////////// Save in DB //////////
//        $this->load->model('user');
            $this->user->add($data);
        if(isset($this->session->userdata('logged_in')['type'])
            &&$this->session->userdata('logged_in')['type']=='admin')
        {
            redirect('/user/');
        }
        else
        {

            $session_array = array(
                    'id' => $data['id'],
                    'email' => $data['email'],
                    'type' => $data['type']);
            $this->session->set_userdata('logged_in', $session_array);;
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
        $user_id=$this->session->userdata('logged_in')['id'];
        $user_type=$this->session->userdata('logged_in')['type'];
        if((isset($user_id)&&$id==$user_id)|(isset($user_id)&&$user_type=='admin'))
        {
            $data=$this->user->get_user($id);
            $data[0]['password']='';
            $data[0]['countries']=$this->country->get_all_countries();
            $view = array('content' => 'user/edit', 'data' => $data[0]);
            $this->load->view($this->layout, $view);
        }
        else{
            redirect('/');
        }

    }

    /**
     * 1.save updated user in db
     * 2.UploadImg if new one uploaded
     * @Request POST
     * @return redirect to index() here
     *
     */
    public function update()
    {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $id=$_POST['id'];
        $user_id=$this->session->userdata('logged_in')['id'];
        $user_type=$this->session->userdata('logged_in')['type'];
        if((isset($user_id)&&$id==$user_id)|(isset($user_id)
                &&$user_type=='admin'))
        {
            if ($this->form_validation->run() == FALSE) {
                $data = $this->user->get_user($id);
                $data[0]['password'] = '';
                $data[0]['countries'] = $this->country->get_all_countries();
                $view = array('content' => 'user/edit', 'data' => $data[0]);
                $this->load->view($this->layout, $view);
            }
            else {
                $data = $this->user->get_user($id)[0];
                $data['name'] = isset($_POST['name']) ? $_POST['name'] : '';
                $data['email'] = isset($_POST['email']) ? $_POST['email'] : '';
                $data['password'] = isset($_POST['password']) ? $_POST['password'] : '';
                $data['mobile'] = isset($_POST['mobile']) ? $_POST['mobile'] : '';
                $data['phone'] = isset($_POST['phone']) ? $_POST['phone'] : '';
                $data['specialty'] = isset($_POST['specialty']) ? $_POST['specialty'] : '';
                $data['years_of_experience'] = isset($_POST['years_of_experience']) ? $_POST['years_of_experience'] : '';
                $data['social_status'] = isset($_POST['social_status']) ? $_POST['social_status'] : '';
                $data['nationality'] = isset($_POST['nationality']) ? $_POST['nationality'] : '';
                $data['place_of_residence'] = isset($_POST['place_of_residence']) ? $_POST['place_of_residence'] : '';
                $data['sex'] = isset($_POST['sex']) ? $_POST['sex'] : 'male';
                $data['fax'] = isset($_POST['fax']) ? $_POST['fax'] : '';
                $data['type'] = isset($_POST['type']) ? $_POST['type'] : 'employer';
                ////////// Upload img////////////
                if (!empty($_FILES['image']['name'])) {
                    unlink('images/profile/' . $data[0]['image']);
                    $this->load->library('Upload_Img', 'upload_img');
                    $data['image'] = $this->upload_img->upload($data['id'], $_FILES, 'images/profile', 'image');

                }
                if (!empty($_FILES['cv']['name'])) {
                    unlink('files/cv/' . $data['cv']);
                    $this->load->library('Upload_Img', 'upload_img');
                    $data['cv'] = $this->upload_img->upload($data['id'], $_FILES, 'files/cv', 'cv');

                }
                /////////// Save in DB //////////
//        $this->load->model('user');
                $this->user->update($data);
                redirect('user', 'refresh');
                $this->index();
            }
        }
        else{
            redirect('/');
        }

    }

    /**
     *Delete user by id
     * @Request GET
     * @return redirect to index() here
     */
    public function delete()
    {
        $id= $_GET['id'];
        $user_type=$this->session->userdata('logged_in')['type'];
        $data=$this->user->get_user($id);
        if(!empty($data[0])&&$user_type=='admin')
        {
            if (file_exists(base_url() . '/images/profile/' . $data[0]['image'])
                && $data[0]['image'] !== 'default.png')
            {
                unlink('images/profile/' . $data[0]['image']);
                unlink('files/cv/' . $data[0]['cv']);
            }
            $data = $this->user->delete($id);
        }
       redirect('user');
    }

    /**
     *profile
     * @Request GET
     * @return View
     */
    public function show()
    {
        $id= $_GET['id'];
        $data=$this->user->get_user($id);
        $data[0]['jobs']=$this->job->get_applied_jobs($id);
        $data[0]['nationality_data']=$this->country->get_country_by_id($data[0]["nationality"]);
        $data[0]['place_of_residence_data']=$this->country->get_country_by_id($data[0]["place_of_residence"]);
        $view = array('content' => 'user/show', 'data' => $data[0]);
        $this->load->view($this->layout,$view);

    }

    /**
     * check if the name Unique
     * the sent name is NOT in the db
     *for user validation in UI
     *
     */
    public function is_userName_Valid()
    {
        $name=$_GET['name'];
        $data=$this->user->get_user_by_name($name);
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
     *for user validation in UI
     *
     */
    public function is_email_Valid()
    {
        $name=$_GET['email'];
        $data=$this->user->get_user_by_user_email($name);
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
