<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Content extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if(empty($this->session->userdata('username'))){
            redirect(base_url());
        }
    }

    public function index() {
        
        $main_menu['active'] = 'Content';
        $this->session->set_userdata($main_menu);
        
        $data['topbar'] = "Manage Content";

        $this->load->view('layout/Admin/header', $data);
        $this->load->view('layout/Admin/sidebar', $data);
        $this->load->view('Admin/content', $data);
        $this->load->view('layout/Admin/footer', $data);
    }

}
