<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author lhf
 * @date 20161102
 * 总金额
 */
class Money extends MY_Controller {
    function __construct(){
        parent::__construct();
        $this->load->helper(array('form'));
        $this->load->library('form_validation');
    }
    public function index(){
        $this->load->model('model/m_bank');
        $data['data'] = $this->m_bank->getAll(array('rbac_asset_allocation.status'=>1,'is_delete'=>1));
        $data['count']= $this->m_bank->count();

        $asset_name ='';
        $asset_data =array();
        foreach($data['data'] as $val){
            $asset_name .= "'".$val['asset_name']."',";
            $asset_data[]= array('value'=>$val['number'],'name'=>$val['asset_name']);
        }
        $data['asset_name_str'] = rtrim($asset_name,',');
        $data['asset_data_str'] = json_encode($asset_data);
        $data['money_form_count']=$this->m_bank->money_form_count();
        $this->load->view('money/index',$data);
    }
}