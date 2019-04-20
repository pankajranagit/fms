<?php

class Fund extends CI_Model {

    private $table_name = "fund";

    public function __construct() {
        parent::__construct();
    }

    public function add($data) {
        return $this->db->insert($this->table_name, $data);
    }

    /* show inserted datas */

    public function get($hierarchy_id = null) {
        $this->db->select("fund.*, hierarchy.lable, hierarchy.description, project.project_title, project.project_description, project.project_type");
        $this->db->from($this->table_name);
        $this->db->join('hierarchy', 'hierarchy.id = fund.hierarchy_id');
        $this->db->join('project', 'project.id = fund.project_id');
        if ($hierarchy_id != null) {
            $this->db->where(array('hierarchy.id' => $hierarchy_id));
        }
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }

}
