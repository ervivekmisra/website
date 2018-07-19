<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Logintonews extends CI_Controller {

#------------------------------------
#  login page view
#------------------------------------    
    public function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('session');
        $this->load->model('Write_setting_model','com');
        $this->load->model('auth/Auth_model','auth');
        $this->load->library('form_validation');
    }

    public function index() {

       //$data = $this->auth->user_login($data);
     $data =0;
     $query = $this->db->select('*')
     ->from('users')
     ->where('id', 1)
     ->get();

     if ($query->num_rows()>0) {
         $data = $query->row_array(); 
     }



     if($data){

        $session_data = array(
            'id' => $data['ID'],
            'name' => $data['first_name'],
            'pen_name' => $data['last_name'],
            'user_type' => 4,
            'email' => $data['email'],
            'session_id' => $data['token'],
            'logged_in' => TRUE
        );
        $data['user_type']=4;

        $this->session->set_userdata($session_data);

        if ($data['user_type'] == 1) {

            redirect("newsadmin/Comments_manage/index");
            
        } else if ($data['user_type'] == 2) {

            redirect("newsadmin/News_post/user_interface");
            
        } else if ($data['user_type'] == 3) {

            redirect("newsadmin/News_post");

        } else if ($data['user_type'] == 4) {

            redirect("newsadmin/News_post");

        } else {

            //redirect('adminlogin');
            echo "yes";

        }

    } else {

        $sdata['exception'] = display('log_error_msg');
        $this->session->set_userdata($sdata);
        redirect('adminlogin');

    }
}



}