<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    //put your code here
    public $username;
    public $password;
    public $login_type;
    public $token;
    public $update_on;
    public $create_on;

    public function check_login($username, $password) {
        $password = md5($password);
        $this->db->select('username, login_type, token, update_on, create_on');
        $this->db->from('login_user');
        $array = array('username' => $username, 'password' => $password);
        $this->db->where($array);
        $query = $this->db->get();
        //echo $this->db->last_query();
        //echo $this->db->count_all_results();
        //die;
        if ($this->db->count_all_results() === 1):
            return $query->row();
        else:
            return 0;
        endif;
    }

    public function organisation_registration($data) {
        $this->db->insert('login_user', $data);
    }

    public function organisation_info() {
        $this->db->select('organisation_name, head_name, head_email');
        $array = array('login_type' => 'ADMIN', 'email_verify' => 1);
        $this->db->where($array);
        $this->db->from('login_user');
        $query = $this->db->get();
        if ($this->db->count_all_results() === 1):
            return $query->row_array();
        else:
            return 0;
        endif;
    }

    public function detailBy_EmailId($email) {
        $this->db->select('*');
        $array = array('login_type' => 'ADMIN', 'head_email' => $email);
        $this->db->where($array);
        $this->db->from('login_user');
        $query = $this->db->get();
        if ($this->db->count_all_results() === 1):
            return $query->row_array();
        else:
            return 0;
        endif;
    }

    public function verify_organisation($id, $new_password) {
        $this->db->set('email_verify', 1);
        $this->db->set('password', $new_password);
        $this->db->where('id', $id);
        $this->db->update('login_user');
    }

}
