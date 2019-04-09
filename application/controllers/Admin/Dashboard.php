<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    private $username;
    public function __construct() {
        parent::__construct();
        if(empty($this->session->userdata('username'))){
            redirect(base_url());
        }
        
        $this->username = $this->session->userdata('username');
    }
    
    public function index() {
        $main_menu['active'] = 'Dashboard';
        $this->session->set_userdata($main_menu);
        
        $login_info = $this->User_model->detailBy_EmailId($this->username);
        $data['login_info'] = $login_info;
        $data['topbar'] = "Dashboard";
        
        $this->load->view('layout/Admin/header', $data);
        $this->load->view('layout/Admin/sidebar', $data);
        $this->load->view('Admin/index', $data);
        $this->load->view('layout/Admin/footer', $data);
    }

}
