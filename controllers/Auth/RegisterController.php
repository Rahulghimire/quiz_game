<?php
class RegisterController extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model("Quiz_model");
    }

    public function register(){

        $this->form_validation->set_rules('name','Name','required|min_length[5]|max_length[20]|trim');
        $this->form_validation->set_rules('email','Email','trim|required|valid_email');
        $this->form_validation->set_rules('password','Password','trim|required');
        //$this->form_validation->set_rules('passconf', 'Password Confirmation', 'required');

        if($this->form_validation->run()==false){
            $this->index();
        }

        else{
            $data=array(
                'name'=>$this->input->post('name'),
                'email'=>$this->input->post('email'),
                'password'=>md5($this->input->post("password"))
            );

            $user=$this->Quiz_model->insertUser($data);

            if(!$user){
                $this->session->set_flashdata("failed","Invalid Credentials");
                $this->index();
            }

            else{

                $this->session->set_userdata("auth_user",$data);
                $this->session->set_flashdata("success","Records Inserted Successfully");
                redirect('Quiz/userDashboard');
                
            }

        }

    }
}
?>