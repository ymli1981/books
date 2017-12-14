<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author lhf
 * @date 20161102
 * 仪表盘
 */
class Dashboard extends MY_Controller {
    function __construct(){
        parent::__construct();
        $this->load->helper(array('form'));
    }
    public function index(){
        $this->load->model('model/m_bank');
        $data = $this->m_bank->getAll(array('is_delete'=>1));

        $asset_name ='';
        $asset_data =array();
        foreach($data as $val){
            $asset_name .= "'".$val['asset_name']."',";
            $asset_data[]= array('value'=>$val['number'],'name'=>$val['asset_name']);
        }
        $data['asset_name_str'] = rtrim($asset_name,',');
        $data['asset_data_str'] = json_encode($asset_data);
        $this->load->view('dashboard/index',$data);
    }
}