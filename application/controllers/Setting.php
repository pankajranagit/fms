<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function logout() {
        /* if (empty($this->session->userdata('username'))) {
          redirect(base_url());
          } */

        session_start();
        $_SESSION['username'] = "";
        $_SESSION['login_detail'] = "";
        session_unset($_SESSION['username']);
        session_unset($_SESSION['login_detail']);

        redirect(base_url());
    }

    public function set_labeling() {
        $default_lable = $this->input->post('default_lable');
        $new_lable = $this->input->post('new_lable');
        $this->Login_user->setLabeling($default_lable, $new_lable);
    }

}
