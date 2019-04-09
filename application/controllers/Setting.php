<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function logout() {
        /*if (empty($this->session->userdata('username'))) {
            redirect(base_url());
        }*/
        
        session_start();
        $_SESSION['username'] = "";
        session_unset($_SESSION['username']);

        redirect(base_url());
    }

}
