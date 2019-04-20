<?php

class Userlog extends CI_Model{
    private $table_name = "userlog";
    public function __construct() {
        parent::__construct();
    }
    
    public function add($data){
        $this->db->insert($this->table_name, $data);
    }
}
