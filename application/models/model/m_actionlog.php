<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_actionlog extends CI_Model {

    const ACTIONLOG = 'rbac_actionlog';
    public function __construct() {
        parent::__construct();
    }
    public function insert($data) {
        $this->db->insert(self::ACTIONLOG, $data);
        return $this->db->insert_id();
    }
    public function getAll($conditions =array()){
        $this->db->select('*');
        $this->db->from(self::ACTIONLOG);
        if (is_array($conditions) && count($conditions) > 0) {
            foreach ($conditions as $key => $value) {
                $this->db->where($key, $value);
            }
        }
        return $this->db->get()->result_array();
    }
}