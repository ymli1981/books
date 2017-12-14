<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class M_money_form
 * 资金形态
 */
class M_money_form extends CI_Model {

    const MONEY_FORM = 'rbac_money_form';
    public function __construct() {
        parent::__construct();
    }
    public function update($conditions, $data) {
        $this->db->where($conditions);
        return $this->db->update(self::MONEY_FORM, $data);
    }

    public function insert($data) {
        $this->db->insert(self::MONEY_FORM, $data);
        return $this->db->insert_id();
    }
    public function delete($conditions){
        $this->db->where($conditions);
        return $this->db->delete(self::MONEY_FORM);
    }
    public function getAll($conditions=array()){
        $this->db->select('*');
        $this->db->from(self::MONEY_FORM);
        if (is_array($conditions) && count($conditions) > 0) {
            foreach ($conditions as $key => $value) {
                $this->db->where($key, $value);
            }
        }
        return $this->db->get()->result_array();
    }
}