<?php
 class Quiz_model extends CI_Model{
  
    public function insertUser($data){
     return $this->db->insert('users',$data);
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
        return $query->result_array();

		//var_dump($result);

    }


 }