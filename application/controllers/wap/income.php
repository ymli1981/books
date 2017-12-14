<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author lhf
 * @date 20170512
 * 手机端记账本
 */
class Income extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->helper(array('form'));
        $this->load->library('form_validation');
		$this->view_override = FALSE;
    }
	public function index(){
		$this->load->model('model/m_balance_payments');
		$list = $this->m_balance_payments->month(6,2);
		$type1= $this->m_balance_payments->month(6,1);
		$type0= $this->m_balance_payments->month(6,0);
		$this->load->view('wap/income/index',['list'=>$list,'type0'=>$type0,'type1'=>$type1]);
	}
	public function stream_save(){
		$num     = trim($this->input->post('money'));
		$created = trim($this->input->post('date'));
		$desc    = trim($this->input->post('desc'));
		$type    = intval($this->input->post('type'));
		
		$data = array();
		$data['type']  = $type;
		$data['num']   = $num;
		$data['desc']  = $desc;
		$data['created']= $created?$created:date("Y-m-d");
		$this->load->model('model/m_balance_payments');
		if($id=$this->m_balance_payments->insert($data)){
			echo json_encode(array('rs'=>'ok','msg'=>'提交成功！'));
		}else{
			echo json_encode(array('rs'=>'error','msg'=>'提交失败！！'));
		}
	}
}