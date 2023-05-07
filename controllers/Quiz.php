<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Quiz extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model("Quiz_model");
    }

	public function index()
	{
		$this->session->sess_destroy();
		$this->load->view("template/Register");
	}

	public function login(){
		$this->session->sess_destroy();
		$this->load->view("template/Login");
	}

	public function adminDashboard(){
		if(!$this->session->has_userdata('auth_user')){
			redirect('Quiz/login');
		}

		$this->load->view("AdminDashboard");
	}

	public function userDashboard(){

		if(!$this->session->has_userdata('auth_user')){
			redirect('Quiz/index');
		}
		$this->load->view("UserDashboard");

	}

	public function loadQuiz(){

		if(!$this->session->has_userdata('auth_user')){
			redirect('Quiz/index');
		}

		$this->load->view("QuizView");

	}

	public function getData($id){

	$result = $this->Quiz_model->getQuestionOptions($id);

	//var_dump($result);

	echo json_encode($result);

	}

	public function logout(){
	$this->session->sess_destroy();
    $this->session->set_flashdata("success","You are logged out successfully!!");
    redirect('Quiz/index');

	}

}
