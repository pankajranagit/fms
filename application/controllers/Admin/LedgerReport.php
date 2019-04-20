<?php

class LedgerReport extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if (empty($this->session->userdata('login_detail'))) {
            redirect(base_url());
        }
    }

    public function index() {
        $main_menu['active'] = 'LedgerReport';
        $this->session->set_userdata($main_menu);

        $data['controller'] = $this;
        $login_info = $this->customlib->userdetail();
        
        $this->Fund->get();
        $data['open_bal'] = 5200000;
        $data['login_info'] = $login_info;
        $data['topbar'] = "Ledger Report";

        $this->load->view('layout/Admin/header', $data);
        $this->load->view('layout/Admin/sidebar', $data);
        $this->load->view('Admin/ledger_index', $data);
        $this->load->view('layout/Admin/footer', $data);
    }

}
