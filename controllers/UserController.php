<?php
 class UserController extends CI_Controller{

    public function index(){
        $data['name']="admin";
        $data['email']="admin@gmail.com";

        var_dump($data);


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

 $email = "hari@gmail.com";
$this->db->select('id');
$this->db->from('users');
$this->db->where('email', $email);
$query = $this->db->get();


if ($query->num_rows() > 0) {
    $user_ids = $query->result_array();
    $user_ids = array_column($user_ids, 'id');
} else {
}

$this->db->select('*');
$this->db->from('test_result');
$this->db->where_in('user_id', $user_ids);
$query = $this->db->get();

if ($query->num_rows() > 0) {
    $test_results = $query->result_array();
} else {
}


