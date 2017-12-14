<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author lhf
 * @date 20161031
 * 个人财务
 */
class Bank extends MY_Controller {

    function __construct(){
        parent::__construct();
        $this->load->helper(array('form'));
        $this->load->library('form_validation');
    }
    public function index(){
        $this->load->model('model/m_bank');
        $sqlwhere['is_delete'] =1;
        $data['data'] = $this->m_bank->getAll($sqlwhere);
        $this->load->view('bank/index',$data);
    }
    public function add(){
        if($this->is_method('post')){
            $this->form_validation->set_rules('asset_name','配置名称','trim|required');
            $this->form_validation->set_rules('number','资金','required');
            $this->form_validation->set_rules('earnings','资收益率','required');
//            $this->form_validation->set_rules('start_date','开始时间','trim|required');
//            $this->form_validation->set_rules('end_date','结束时间','trim|required');
            $this->form_validation->set_rules('remark','备注信息','trim');
            $this->form_validation->set_rules('money_form_id','资金形态','intval|required');
            if ($this->form_validation->run() == FALSE){
                $this->load->view('bank/add');
            }else {
                $data = array();
                $data['asset_name'] = $this->input->post('asset_name');
                $data['number']     = $this->input->post('number');
                $data['accounted_for']= $this->input->post('accounted_for');
                $data['earnings']   = $this->input->post('earnings');
                $data['start_date'] = $this->input->post('start_date');
                $data['end_date']   = $this->input->post('end_date');
                $data['remark']     = $this->input->post('remark');
                $data['money_form_id']= $this->input->post('money_form_id');
                $data['create_date']= NOW_TIME;
                $data['update_date']= NOW_TIME;

                $this->load->model('model/m_bank');
                if($id=$this->m_bank->insert($data)){
                    $this->add_actionlog('添加资金配置,自增id为'.$id);
                    success_redirct("bank/bank/index","配置资产成功！");
                }
            }
        }else{
            $this->load->model('model/m_money_form');
            $data['data'] = $this->m_money_form->getAll(array('status'=>1));
            $this->load->view('bank/add',$data);
        }
    }
    /**
     * 软删除
     */
    public function del(){
        $id = $this->input->post('id');
        $this->load->model('model/m_bank');
        $info = $this->m_bank->getAll(array('rbac_asset_allocation.id'=>$id));
        if(!empty($info) && is_array($info)){
            try{
                $this->m_bank->update(array('id'=>$info['0']['id']),array('is_delete'=>0));
                $rs = array('result'=>1,'msg'=>'删除成功');
            }catch (Exception $e){
                $rs = array('result'=>'0','msg'=>$e->getMessage());
            }
        }else{
            $rs = array('result'=>'0','msg'=>'数据异常,请稍后重试！');
        }
        echo json_encode($rs);die();
    }
    /**
     * 确认收益
     */
    public function confirm_earnings(){
        $this->load->model('model/m_bank');
        if($this->is_method('post')){
            $id = $this->input->post('id');
            $earnings_number = $this->input->post('earnings_number');
            $this->m_bank->update(array('id'=>$id),array('earnings_number'=>$earnings_number,'update_date'=>NOW_TIME,'status'=>0));
            success_redirct('bank/bank/index','数据更新成功!');
        }else{
            $id = $this->input->get('id');
            $info = $this->m_bank->getAll(array('rbac_asset_allocation.id'=>$id));
            $this->view_override = FALSE;
            $this->load->view('bank/confirm_earnings',$info['0']);
        }
    }
    /**
     * 查看详细
     */
    public function detail(){
        echo '待开发！';exit;
    }}