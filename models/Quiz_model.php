<?php
 class Quiz_model extends CI_Model{
  
    public function insertUser($data){
      $this->db->insert('users',$data);
     return $this->db->insert_id();

    }
    public function getUsers($data){
        $this->db->where('email',$data['email']);
        $this->db->where('password',$data['password']);
        // $this->db->where('role','admin');
        $this->db->from('users');
        $this->db->limit(1);
        $query=$this->db->get();

        if($query->num_rows()>0){
            return $query->row();
        }
        else{
            return false;
        }
    }

    public function getQuestionOptions($id){

        $this->db->select('quiz_questions.q_id,quiz_questions.question_text,quiz_options.options,quiz_options.correct_answer');
        $this->db->from('quiz_questions');
        $this->db->join('quiz_options', 'quiz_questions.q_id = quiz_options.q_id');
        $this->db->where('quiz_questions.q_id', $id);
        $this->db->where('quiz_options.option_id', $id);
        $query = $this->db->get();
        if($query){
        return $query->result_array();
        }
    }

    //For Admindashboard Only
    public function getUserResult(){
        $this->db->select('test_result.test_id,test_result.total_questions,test_result.test_id,test_result.attempted_questions, test_result.correct_questions, test_result.begin_date_time, test_result.total_time_taken, users.name');
        $this->db->from('test_result');
        $this->db->join('users', 'test_result.user_id = users.id');
        $query = $this->db->get();    
        if($query){
            return $query->result_array();
        }
    }

    public function userTestResultInsert($data){
        $this->db->insert('test_result', $data);
        return $this->db->insert_id();
    }

    public function getPreviewData($id){
        $this->db->select('*');
        $this->db->from('test_result');
        $this->db->where('test_id',$id);
        $query = $this->db->get();
        if($query){
            return $query->result_array();
        }
    }

    //For User Dashboard Only
    public function getResultForAUser($id){
        $this->db->select('*');
        $this->db->from('test_result');
        $this->db->where('user_id',$id);
        $query = $this->db->get();
        if($query){
            return $result = $query->result_array();
            // var_dump($result);
        }
    }

 }