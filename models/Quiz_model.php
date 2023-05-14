<?php
 class Quiz_model extends CI_Model{
  
    public function insertUser($data){
      $this->db->insert('users',$data);
     return $this->db->insert_id();

    }
    public function getUsers($data){
        $this->db->where('email',$data['email']);
        $this->db->where('password',$data['password']);
        $this->db->where('role','admin');
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
    public function userResultInsert($data){
        $this->db->insert('user_result', $data);
        return $this->db->insert_id();
    }

    //For Admindashboard Only
    public function getUserResult(){
        $this->db->select('user_result.test_id, user_result.total_questions,user_result.user_id,user_result.attempted_questions, user_result.correct_questions, user_result.begin_date_time, user_result.total_time_taken, users.name');
        $this->db->from('user_result');
        $this->db->join('users', 'user_result.user_id = users.id');
        $query = $this->db->get();    
        if($query){
            return $query->result_array();
        }
    }

 }