<?php

class Project extends CI_Model {

    private $table_name = "project";

    public function __construct() {
        parent::__construct();
    }

    public function add($data) {
        $query = $this->db->insert($this->table_name, $data);
        return $this->db->insert_id();
    }

    public function update_fund($data) {
        $query = $this->db->insert('fund_allotment', $data);
        return $this->db->insert_id();
    }

    /* show inserted datas */

    public function get($id = '') {
        $this->db->select("project.*, fund_allotment.fund_allotted, fund_allotment.fund_status, fund_allotment.allotment_date, fund_allotment.proj_id");
        $this->db->from($this->table_name);
        $this->db->join('fund_allotment', 'fund_allotment.proj_id = project.id');
        if ($id != '') {
            $this->db->where(array('project.id' => $id));
        }

        $this->db->order_by('project.id', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function project_fund($proj_id = '') {
        if ($proj_id == ''):
            $query = $this->db->query("SELECT t1.id, t1.project_title, t1.project_description, t1.project_type, t1.created_by, t2.Total_Fund_Allotted, t2.allotment_date, t1.create_on FROM project t1 INNER JOIN(SELECT allotment_date,proj_id, SUM(fund_allotted) AS Total_Fund_Allotted FROM fund_allotment GROUP BY proj_id) t2 ON t1.id = t2.proj_id");
            return $query->result_array();
        else:
            $query = $this->db->query("SELECT t1.id, t1.project_title, t1.project_description, t1.project_type, t1.created_by, t2.Total_Fund_Allotted, t2.allotment_date, t1.create_on FROM project t1 INNER JOIN(SELECT allotment_date,proj_id, SUM(fund_allotted) AS Total_Fund_Allotted FROM fund_allotment GROUP BY proj_id) t2 ON t1.id = t2.proj_id WHERE t1.id = " . $proj_id);
            return $query->row_array();
        endif;
    }

    /* Create View
     * SELECT t1.id, t1.project_title, t1.project_description, t1.project_type, t1.created_by, t2.Total_Fund_Allotted, t2.allotment_date, t1.create_on
      FROM project t1
      INNER JOIN
      (
      SELECT allotment_date,proj_id,
      SUM(fund_allotted) AS Total_Fund_Allotted
      FROM fund_allotment
      GROUP BY proj_id
      ) t2
      ON t1.id = t2.proj_id */
}
