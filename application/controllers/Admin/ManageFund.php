<?php

class ManageFund extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (empty($this->session->userdata('login_detail'))) {
            redirect(base_url());
        }
    }

    public function index() {
        $main_menu['active'] = 'ManageFund';
        $this->session->set_userdata($main_menu);

        $data['controller'] = $this;
        $login_info = $this->customlib->userdetail();

        $project_list = $this->Project->project_fund();
        $data['project_list'] = $project_list;
        
        $arrCol = array_column($project_list, 'Total_Fund_Allotted');
        //echo array_sum($arrCol);
        //echo "<pre>";
        //print_r($project_list);
        //echo "</pre>";
        //die;

        $data['total'] = array_sum($arrCol);
        $data['assigned'] = 0;
        $data['available'] = $total - $assigned;


        $hierarchy = $this->Hierarchy->getHierarchy();
        $data['hierarchy'] = $hierarchy;

        $data['login_info'] = $login_info;
        $data['topbar'] = "Manage Fund";

        $this->load->view('layout/Admin/header', $data);
        $this->load->view('layout/Admin/sidebar', $data);
        $this->load->view('Admin/fund_index', $data);
        $this->load->view('layout/Admin/footer', $data);
    }

    public function assign($proj_id = '') {
        $main_menu['active'] = 'ManageFund';
        $this->session->set_userdata($main_menu);

        $project_list = $this->Project->project_fund();
        $data['project_list'] = $project_list;
        //echo "<pre>";
        //print_r($project_list);
        //echo "</pre>";
        //die;
        if ($proj_id != '') {
            $data['curr_proj_id'] = $proj_id;
        } else {
            $data['curr_proj_id'] = $project_list[0]['id'];
        }

        $data['controller'] = $this;
        $login_info = $this->customlib->userdetail();

        $data['login_info'] = $login_info;
        $data['topbar'] = "Manage Fund";

        $hierarchy = $this->Hierarchy->getHierarchy();
        $data['hierarchy'] = $hierarchy;

        $this->load->view('layout/Admin/header', $data);
        $this->load->view('layout/Admin/sidebar', $data);
        $this->load->view('Admin/fund_assign', $data);
        $this->load->view('layout/Admin/footer', $data);
    }

    /* public function assign($hierarchy_id) {
      $main_menu['active'] = 'ManageFund';
      $this->session->set_userdata($main_menu);

      $hierarchy_info = $this->Hierarchy->get($hierarchy_id);
      $data['hierarchy_info'] = $hierarchy_info[0];

      $data['hierarchy_id'] = $hierarchy_id;

      $project_list = $this->Project->get();
      $data['project_list'] = $project_list;

      $assigned_fund = $this->Fund->get($hierarchy_id);
      $data['assigned_fund'] = $assigned_fund;

      $data['controller'] = $this;
      $login_info = $this->customlib->userdetail();

      $data['login_info'] = $login_info;
      $data['topbar'] = "Manage Fund";

      if (isset($_POST['assign_fund'])) {
      $this->form_validation->set_rules('project_id', 'Project', 'required');
      $this->form_validation->set_rules('amount', 'Fund Amount', 'required|decimal');
      $this->form_validation->set_rules('note', 'Comment', 'alpha_numeric_spaces');

      if ($this->form_validation->run() == FALSE) {

      } else {
      $data_post['project_id'] = $this->input->post('project_id');
      $data_post['amount'] = $this->input->post('amount');
      $data_post['note'] = $this->input->post('note');
      $data_post['hierarchy_id'] = $hierarchy_id;
      $data_post['create_on'] = date('Y-m-d H:i:s');

      $this->Fund->add($data_post);
      redirect(base_url('Admin/ManageFund/assign/') . $hierarchy_id);
      }
      }

      $this->load->view('layout/Admin/header', $data);
      $this->load->view('layout/Admin/sidebar', $data);
      $this->load->view('Admin/fund_assign', $data);
      $this->load->view('layout/Admin/footer', $data);
      } */

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
                if ($node['role']['parent_id'] != null) {
                    echo "<p><button class='btn btn-dropbox btn-sm'>" . htmlspecialchars($node['role']['lable']) . "</button> <a class='btn btn-danger btn-sm' href='" . base_url('Admin/ManageFund/assign/') . $node['role']['id'] . "'>Assign Fund</a></p>";
                }
                $this->print_tree($node['children']);
                print("</li>");
            }
            print("</ul>");
        }
    }

}
