<?php
 class AdminController extends CI_Controller{
    
    public function __construct(){
        parent::__construct();
        $this->load->model("Quiz_model");
    }

    public function index(){
		$this->load->view("template/Login");
    }

    public function login(){

        $this->form_validation->set_rules('email','Email','trim|required|valid_email');
        $this->form_validation->set_rules('password','Password','trim|required');

        if($this->form_validation->run()===false){
            $this->index();
        }

        else{
            $data=array(
                'email'=>$this->input->post('email'),
                'password'=>md5($this->input->post("password")),
                'role'=>'admin'
            );

            $result=$this->Quiz_model->getUsers($data);

            if($result){

                $auth_user=[
                    'id'=>$result->id,
                    'name'=>$result->name,
                    'email'=>$result->email,
                ];

                $this->session->set_userdata('auth_admin',$auth_user);
                $this->session->set_flashdata("success","Logged In Successfully");
              redirect('Admin');   
            }

            else{
            $this->session->set_flashdata("failed","Invalid Credentials");
            $this->index();
            }

        }

    }



}