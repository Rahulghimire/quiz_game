<?php
class UserController extends CI_Controller{

    public function index(){
        if(!$this->session->has_userdata("auth_user")){

            redirect('Auth/RegisterController/');
        }
        else{
        var_dump($this->session->userdata("auth_user"));
        //echo "welcome to user dashboard";            
        }
    }

}