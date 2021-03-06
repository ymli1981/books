<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_bank extends CI_Model {

    const BANK = 'rbac_asset_allocation';
    public function __construct() {
        parent::__construct();
    }
    public function update($conditions, $data) {
        $this->db->where($conditions);
        return $this->db->update(self::BANK, $data);
    }

    public function insert($data) {
        $this->db->insert(self::BANK, $data);
        return $this->db->insert_id();
    }
    public function getAll($conditions=array()){
        $this->db->select('rbac_asset_allocation.*,rbac_money_form.name money_form');
        $this->db->from(self::BANK);
        $this->db->join('rbac_money_form',' rbac_asset_allocation.money_form_id = rbac_money_form.id','left' );
        $this->db->where('rbac_asset_allocation.status',1);
        if (is_array($conditions) && count($conditions) > 0) {
            foreach ($conditions as $key => $value) {
                $this->db->where($key, $value);
            }
        }
        return $this->db->get()->result_array();
    }

    /**
     * 类型资金汇总
     */
    public function money_form_count(){
        $this->db->select('rbac_money_form.name money_form_name,SUM(rbac_asset_allocation.number) money_form_count');
        $this->db->from(self::BANK);
        $this->db->join('rbac_money_form','rbac_asset_allocation.money_form_id= rbac_money_form.id');
        $this->db->group_by('rbac_asset_allocation.money_form_id');
        $this->db->where('rbac_asset_allocation.status',1);
        $this->db->where('rbac_asset_allocation.is_delete',1);
        return $this->db->get()->result_array();
    }
    //总资产
    public function count(){
        $this->db->select("sum(number) count");
        $this->db->from(self::BANK);
        $this->db->where(array('status'=>1,'is_delete'=>1));
        return $this->db->get()->row_array();
    }
}