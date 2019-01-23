<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrator extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
        function __construct() {
            parent::__construct();
            
            
            $this->load->model('Login_model');
        }


        public function index()
	{
            if($this->session->userdata('Is_login')==TRUE){
                                redirect('home');}
                                
		$this->load->view('login');
	}
        
        public function login(){
            if (isset($_POST['submit'])){
                $username = $this->input->post('username');
                $password = md5($this->input->post('password'));
                
                
                $check = $this->Login_model->checklogin($username, $password);
            
                if(!$check){
                    redirect('Administrator');
                }else{
                    $data = array(
                        'username'=> $username,
                        'password'=> $password,
                        'Is_login'=> TRUE,
                        'name'=> $check->name,
                    );
                    $this->session->set_userdata($data);
                    //echo json_encode($data);
                    redirect('home');
                    
                }
            }
        }
        
        public function logout(){
            $data = array('username','password','Is_login');
            $this->session->unset_userdata($data);
            
            redirect('administrator');
        }
}
