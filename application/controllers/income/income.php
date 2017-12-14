<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author lhf
 * @date 20161111
 * 收支管理
 */
class Income extends MY_Controller {

    function __construct(){
        parent::__construct();
        $this->load->helper(array('form'));
        $this->load->library('form_validation');
    }
    public function index(){
        $month = $this->input->get('month');
        if($month){
            $baseTime = strtotime($month);
        }else{
            $baseTime = strtotime(date("Y-m-d"));
        }
        $data = array();
		$data['month'] = $baseTime;

        $this->load->model('model/m_balance_payments');
        $data['income'] = $this->m_balance_payments->get_month_balance_payments(array('start_time'=>date('Y-m-01 00:00:00', $baseTime),'end_time'=>date('Y-m-31 00:00:00',$baseTime),'type'=>1),5);
        $data['expend'] = $this->m_balance_payments->get_month_balance_payments(array('start_time'=>date('Y-m-01 00:00:00', $baseTime),'end_time'=>date('Y-m-31 00:00:00',$baseTime),'type'=>0),5);
        $data['lately'] = $this->m_balance_payments->get_month_balance_payments(array('start_time'=>date('Y-m-01 00:00:00', $baseTime),'end_time'=>date('Y-m-31 00:00:00',$baseTime)),5);
        //$data['pre_month']     = $this->m_balance_payments->get_month_balance_payments(array('start_time'=>date('Y-m-01 00:00:00', strtotime('-1 month')),'end_time'=>date('Y-m-t 23:59:59', strtotime('-1 month'))),5);
        $pre_data_z=$this->m_balance_payments->pre_data(array('type'=>0),$baseTime);
        $data['pre_data_z']=$this->assembly($pre_data_z,$baseTime);
        $pre_data_s=$this->m_balance_payments->pre_data(array('type'=>1),$baseTime);
        $data['pre_data_s']=$this->assembly($pre_data_s,$baseTime);
		//echo '<pre>';print_r($pre_data_s);exit;
        $this->load->view('income/index',$data);
    }
    public function account_checking(){
        $this->load->model('model/m_balance_payments');
        if($this->is_method('post')){
            $this->form_validation->set_rules('num','金额','required');
            $this->form_validation->set_rules('desc','描述','trim');
            $this->form_validation->set_rules('type','类型','intval|required');
            if ($this->form_validation->run() == FALSE){
                $this->load->view('income/account_checking');
            }else {
                $data = array();
                $data['type']  = $this->input->post('type');
                $data['num']   = $this->input->post('num');
                $data['desc']  = $this->input->post('desc');
                $data['created']= $this->input->post('create')?date("Y-m-d",strtotime($this->input->post('create'))):date("Y-m-d");
				if( $data['created']>date("Y-m-d") ){//不能添加超过今天的
					$data['created'] = date("Y-m-d");
				}
                if($id=$this->m_balance_payments->insert($data)){
                    $this->add_actionlog('月流水添加,自增id为'.$id);
                    success_redirct("income/income/account_checking","添加成功！");
                }else{
                    error_redirct('income/income/account_checking','添加失败！');
                }
            }
        }else{
            //分页设置
            $limit = 10;
            $page = $this->input->get_post('per_page') ? $this->input->get_post('per_page') : 1;
            $offset = ($page - 1) * $limit;
            $conditions = array();
            $fields = '*';
            $by = '';

            $type = $this->input->get_post('type1',true);
            $type && $conditions['type'] = $type;

            $data['data'] = $this->m_balance_payments->pageList($conditions, $fields, $limit, $offset, $by);
            $data['total'] = $this->m_balance_payments->count($conditions);
            $data['page_links'] = $this->pagination($data['total'],$limit);

            $this->load->view('income/account_checking',$data);
        }
    }
    public function del(){
        $id = $this->input->post('id');
        $this->load->model('model/m_balance_payments');
        $info = $this->m_balance_payments->getAll(array('id'=>$id));
        if(!empty($info) && is_array($info)){
            try{
                $this->m_balance_payments->delete(array('id'=>$info['0']['id']));
                $rs = array('result'=>1,'msg'=>'删除成功');
                $this->add_actionlog('月流水删除,自增id为'.$id);
            }catch (Exception $e){
                $rs = array('result'=>'0','msg'=>$e->getMessage());
            }
        }else{
            $rs = array('result'=>'0','msg'=>'数据异常,请稍后重试！');
        }
        echo json_encode($rs);die();
    }
    private function assembly($array,$baseTime){
        if(!is_array($array) && count($array) <1){
            return false;
        }
        $maxD = $this->get_days_by_year(date("Y",$baseTime),date("m",$baseTime));
        $str = '[';
        for($i=1;$i<=$maxD;$i++){
			$r   = false; 
            foreach($array as $val){
                if(date("Y-m-".($i>=10?$i:('0'.$i)),$baseTime) == $val['created']){
                    $str .= $val['count_data'].',';
					$r    =true;
                }
            }
            if(!$r){
				$str .= '0,';
			}
        }
        $str = trim($str,',').']';
        return $str;
    }
    //根据某年某月的天数
    function get_days_by_year($year='',$month=''){
        $year =$year?$year:date("Y");
        $month=$month?$month:date("m");
        //首先判断闰年
        if($year%400 == 0  || ($year%4 == 0 && $year%100 !== 0)){
            $rday = 29;
        }else{
            $rday = 28;
        }
        if($month ==2){
            return $rday;
        }else{
            return (($month - 1)%7%2) ? 30 : 31;
        }
    }
}