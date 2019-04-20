<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ManageChild extends CI_Controller {

    private $username;

    public function __construct() {
        parent::__construct();

        if (empty($this->session->userdata('login_detail'))) {
            redirect(base_url());
        }

        $this->username = $this->session->userdata('username');
    }

    public function index() {
        $main_menu['active'] = 'ManageChild';
        $this->session->set_userdata($main_menu);

        $parent = $this->Hierarchy->get_tree();
        $data['parent'] = $parent;
        $tree = $this->build_tree($parent);
        $data['tree'] = $tree;

        $hierarchy = $this->Hierarchy->getHierarchy();
        $data['hierarchy'] = $hierarchy;

        $data['controller'] = $this;
        $login_info = $this->customlib->userdetail();

        $data['login_info'] = $login_info;
        $data['topbar'] = "Manage Hierarchy";

        $this->load->view('layout/Admin/header', $data);
        $this->load->view('layout/Admin/sidebar', $data);
        $this->load->view('Admin/child_index', $data);
        $this->load->view('layout/Admin/footer', $data);
    }

    public function add() {

        $this->form_validation->set_rules('lable', 'Hierarchy Label', 'required|min_length[3]');
        $this->form_validation->set_rules('description', 'Hierarchy Description', 'min_length[3]|alpha_numeric_spaces');
        $this->form_validation->set_rules('parent_id', 'Parent Id', 'required|is_natural_no_zero');
        $this->form_validation->set_rules('report_type', 'Reporting Type', 'required');

        if ($this->form_validation->run() == FALSE) {
            $main_menu['active'] = 'ManageChild';
            $this->session->set_userdata($main_menu);
            $parent = $this->Hierarchy->get();

            $data['parent'] = $parent;
            $tree = $this->build_tree($parent);
            $data['tree'] = $tree;
            $data['controller'] = $this;
            $login_info = $this->customlib->userdetail();

            $hierarchy = $this->Hierarchy->getHierarchy();
            $data['hierarchy'] = $hierarchy;

            $data['login_info'] = $login_info;
            $data['topbar'] = "Manage Hierarchy";

            $this->load->view('layout/Admin/header', $data);
            $this->load->view('layout/Admin/sidebar', $data);
            $this->load->view('Admin/child_index', $data);
            $this->load->view('layout/Admin/footer', $data);
        } else {
            $data['lable'] = $this->input->post('lable');
            $data['description'] = $this->input->post('description');
            $data['parent_id'] = $this->input->post('parent_id');
            $data['report_type'] = $this->input->post('report_type');

            if ($this->Hierarchy->add($data)) {
                $this->session->set_flashdata('msg', "<span class='text-default'>Parent is Added Sucessfully</span>");
            } else {
                $this->session->set_flashdata('msg', "<span class='text-danger'>Adding Child Failed</span>");
            }

            redirect(base_url('Admin/ManageChild/'));
        }
    }

    public function KYC($hierarchy_id) {
        $main_menu['active'] = 'ManageChild';
        $this->session->set_userdata($main_menu);

        $data['controller'] = $this;
        $login_info = $this->customlib->userdetail();

        $data['login_info'] = $login_info;
        $data['topbar'] = "Add KYC Detail";

//        echo "<pre>";
//        print_r($this->Hierarchy->get($hierarchy_id));
//        echo "</pre>";
//        die;
        $data['hierarchy_id'] = $hierarchy_id;
        $data['unit_detail'] = $this->Hierarchy->get($hierarchy_id)[0];

        $this->load->view('layout/Admin/header', $data);
        $this->load->view('layout/Admin/sidebar', $data);
        $this->load->view('Admin/child_kyc', $data);
        $this->load->view('layout/Admin/footer', $data);
    }

    // Function that builds a tree
    public function build_tree($roles, $parent_id = 0) {
        $tree = array();
        foreach ($roles as $role) {
            if ($role['parent_id'] == $parent_id) {
                $tree[] = array(
                    'role' => $role,
                    'children' => $this->build_tree($roles, $role['id'])
                );
            }
        }

        return $tree;
    }

    // Function that walks and outputs the tree
    function print_tree($tree) {
        if (count($tree) > 0) {
            print("<ul class='hierarchy_list'>");
            foreach ($tree as $node) {
                print("<li>");
                echo "<p><button class='btn btn-dropbox btn-sm'>" . htmlspecialchars($node['role']['lable']) . "</button> <a class='btn btn-primary btn-sm' href=''><i class='fa fa-cog'></i></a></button> <a class='btn btn-danger btn-sm' href=''><i class='fa fa-remove'></i></a></p>";
                $this->print_tree($node['children']);
                print("</li>");
            }
            print("</ul>");
        }
    }

}
