<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model("Quiz_model");
		    if(!$this->session->has_userdata('auth_admin')){
			  redirect('AdminController');
		    }  
      }

    public function index(){
      $rows=$this->Quiz_model->getUserResult();
      // var_dump($rows);
      $data['rows']=$rows;
		  $this->load->view("AdminDashboard",$data);
	}

    public function logout(){
        $this->session->sess_destroy();
        $this->session->unset_userdata('auth_admin');
        $this->session->set_flashdata("success","You are logged out successfully!!");
        redirect('AdminController');
        }

}