<?php
 class UserController extends CI_Controller{

    public function index(){
        // $name=$this->input->post("name");

        $data['name']="admin";
        $data['email']="admin@gmail.com";

        var_dump($data);


        // $data=array(
        //     'email'=>$this->input->post('email'),
        //     'password'=>md5($this->input->post("password")),
        //     'role'=>'admin'
        // );

        $this->db->select('id');
        $this->db->from('users');
        $this->db->where($data);

        $query = $this->db->get();
        var_dump($query->row());

        if ($query->num_rows() > 0) {
            $row = $query->row();
            $id = $row->id;
            var_dump($id);

            $this->db->select('*');
            $this->db->from('test_result');
            $this->db->where('user_id', '238');
            $query = $this->db->get();
            
            if ($query) {
                $result = $query->result_array();
                var_dump($result);
            }      
        } 
        $this->load->view("UserResultView");
    }
    public function getResultPerUser(){
        $data['email']="";
        $data['password']="";


        // $data=array(
        //     'email'=>$this->input->post('email'),
        //     'password'=>md5($this->input->post("password")),
        //     'role'=>'admin'
        // );

        $this->db->select('id');
        $this->db->from('users');
        $this->db->where($data);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $row = $query->row();
            $id = $row->id;
            var_dump($id);
        } 
    }
 }