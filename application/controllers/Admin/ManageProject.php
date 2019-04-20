<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ManageProject extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (empty($this->session->userdata('login_detail'))) {
            redirect(base_url());
        }
    }

    public function index() {
        $main_menu['active'] = 'ManageProject';
        $this->session->set_userdata($main_menu);

        $data['controller'] = $this;
        $login_info = $this->customlib->userdetail();

        $all_project = $this->Project->get();
        $data['all_project'] = $all_project;
        $proj_type = $this->customlib->getProjectType();
        //print_r($proj_type); die;
        $data['proj_type'] = $proj_type;

        $data['login_info'] = $login_info;
        $data['topbar'] = "Manage Projects";

        $this->load->view('layout/Admin/header', $data);
        $this->load->view('layout/Admin/sidebar', $data);
        $this->load->view('Admin/project_index', $data);
        $this->load->view('layout/Admin/footer', $data);
    }

    public function add() {
        $this->form_validation->set_rules('project_title', 'Project Title', 'trim|required');
        $this->form_validation->set_rules('project_type', 'Project Type', 'trim|required|alpha_numeric_spaces');
        $this->form_validation->set_rules('project_cost', 'Project Costing', 'trim|required|numeric');
        $this->form_validation->set_rules('project_description', 'Project Description', 'trim');

        if ($this->form_validation->run() == FALSE):
            $main_menu['active'] = 'ManageProject';
            $this->session->set_userdata($main_menu);

            $data['controller'] = $this;
            $login_info = $this->customlib->userdetail();
            $all_project = $this->Project->get();
            $data['all_project'] = $all_project;
            $proj_type = $this->customlib->getProjectType();
            //print_r($proj_type); die;
            $data['proj_type'] = $proj_type;

            $data['login_info'] = $login_info;
            $data['topbar'] = "Manage Projects";

            $this->load->view('layout/Admin/header', $data);
            $this->load->view('layout/Admin/sidebar', $data);
            $this->load->view('Admin/project_index', $data);
            $this->load->view('layout/Admin/footer', $data);
        else:
            $data['project_title'] = $this->input->post('project_title');
            $data['project_description'] = $this->input->post('project_description');
            $data['project_type'] = $this->input->post('project_type');
            $data['created_by'] = 'admin';
            $data['create_on'] = date('Y-m-d H:i:s');

            $insert_id = $this->Project->add($data);
            $data = array();

            $data['proj_id'] = $insert_id;
            $data['fund_allotted'] = $this->input->post('project_cost');
            $data['fund_status'] = 1;

            $this->Project->update_fund($data);

            redirect(base_url('Admin/ManageProject'));

        endif;
    }

    public function update($proj_id) {
        $main_menu['active'] = 'ManageProject';
        $this->session->set_userdata($main_menu);

        $data['controller'] = $this;
        $login_info = $this->customlib->userdetail();

        $all_project = $this->Project->get($proj_id);
        $data['all_project'] = $all_project;
        $proj_type = $this->customlib->getProjectType();
        //print_r($proj_type); die;
        $data['proj_type'] = $proj_type;
        $data['proj_id'] = $proj_id;

        $data['login_info'] = $login_info;
        $data['topbar'] = "Update Project";


        if (isset($_POST['add_fund'])) {
            $this->form_validation->set_rules('fund_allotted', 'Fund Amount', 'trim|required|decimal');

            if ($this->form_validation->run() == TRUE) {
                $data_up['fund_allotted'] = $this->input->post('fund_allotted');
                $data_up['proj_id'] = $proj_id;
                $data_up['fund_status'] = 1;
                $this->Project->update_fund($data_up);
                redirect(base_url('Admin/ManageProject/update/' . $proj_id));
            }
        }


        $this->load->view('layout/Admin/header', $data);
        $this->load->view('layout/Admin/sidebar', $data);
        $this->load->view('Admin/project_update', $data);
        $this->load->view('layout/Admin/footer', $data);
    }

}
