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
      $data['rows']=$rows;
		  $this->load->view("AdminDashboard",$data);
	}

  public function getPreviewResult($test_id){
    $data=$this->Quiz_model->getPreviewData($test_id);
    echo json_encode($data);
  }

  public function showUserDashboard(){
    $this->load->view("UserResultView");
  }

  public function showUserResult(){
    $email=$this->input->post('email');
    $data=$this->Quiz_model->getResultForAUser($email);
    echo json_encode($data);
  }

    public function logout(){
        $this->session->sess_destroy();
        $this->session->unset_userdata('auth_admin');
        $this->session->set_flashdata("success","You are logged out successfully!!");
        redirect('AdminController');
        }
}