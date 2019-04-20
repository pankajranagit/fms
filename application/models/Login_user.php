<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login_user extends CI_Model {

    //put your code here
    private $table_name = 'login_user';

    public function check_login($username, $password) {
        $password = md5($password);
        $this->db->select('*');
        $this->db->from($this->table_name);
        $array = array('username' => $username, 'password' => $password);
        $this->db->where($array);
        $query = $this->db->get();

        if ($this->db->count_all_results() === 1):
            return $query->row_array();
        else:
            return 0;
        endif;
    }

    public function organisation_registration($data) {
        $temp['lable'] = $data['organisation_name'];
        $temp['description'] = $data['organisation_name'];
        $temp['isactive'] = 'yes';
        $temp['create_on'] = date('Y-m-d H:i:s');
        $this->db->insert('hierarchy', $temp);

        $data['hierarchy_id'] = $this->db->insert_id();

        $this->db->insert($this->table_name, $data);
    }

    public function organisation_info() {
        $this->db->select('organisation_name, head_name, head_email');
        $array = array('login_type' => 'ADMIN', 'email_verify' => 1);
        $this->db->where($array);
        $this->db->from($this->table_name);
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
        $this->db->from($this->table_name);
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
        $this->db->update($this->table_name);
    }

    public function labeling() {
        $this->db->select('*');
        $this->db->from('labeling');
        $query = $this->db->get();

        if ($this->db->count_all_results() === 1):
            return $query->result_array();
        else:
            return 0;
        endif;
    }

    public function setLabeling($default_lable, $new_lable) {
        $this->db->set('new_lable', $new_lable);
        $this->db->where('default_lable', $default_lable);
        $this->db->update('labeling');
    }

}
