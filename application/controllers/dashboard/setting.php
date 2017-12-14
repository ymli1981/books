<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author lhf
 * @date 20161102
 * 系统设置
 */
class Setting extends MY_Controller {
    function __construct(){
        parent::__construct();
        $this->load->helper(array('form'));
        $this->load->library('form_validation');
    }
    public function index(){
        $this->load->model('model/m_money_form');
        $data['data'] = $this->m_money_form->getAll();
        $this->load->view('dashboard/setting/index',$data);
    }
    public function add(){
        if($this->is_method('post')){
            $this->form_validation->set_rules('name','形态名称','trim|required');
            $this->form_validation->set_rules('info','说明','trim');
            if ($this->form_validation->run() == FALSE){
                $this->load->view('dashboard/setting/add');
            }else {
                $data = array();
                $data['name']  = $this->input->post('name');
                $data['status']= $this->input->post('status');
                $data['info']  = $this->input->post('info');
                $data['create']= NOW_TIME;

                $this->load->model('model/m_money_form');
                if($id=$this->m_money_form->insert($data)){
                    $this->add_actionlog('添加资金形态,自增id为'.$id);
                    success_redirct("dashboard/setting/index","添加成功！");
                }
            }
        }else{
            $this->load->view('dashboard/setting/add');
        }
    }

    /**
     * 更新状态
     */
    public function status(){
        $id = $this->input->post('id');
        $this->load->model('model/m_money_form');
        $info = $this->m_money_form->getAll(array('id'=>$id));
        if(!empty($info) && is_array($info)){
            try{
                $this->m_money_form->update(array('id'=>$info['0']['id']),array('status'=>abs($info['0']['status']-1)));
                $rs = array('result'=>1,'msg'=>'更新成功');
            }catch (Exception $e){
                $rs = array('result'=>'0','msg'=>$e->getMessage());
            }
        }else{
            $rs = array('result'=>'0','msg'=>'数据异常,请稍后重试！');
        }
        echo json_encode($rs);die();
    }
    /**
     * 删除
     */
    public function del(){
        $id = $this->input->post('id');
        $this->load->model('model/m_money_form');
        $info = $this->m_money_form->getAll(array('id'=>$id));
        if(!empty($info) && is_array($info)){
            try{
                $this->m_money_form->delete(array('id'=>$info['0']['id']));
                $rs = array('result'=>1,'msg'=>'删除成功');
            }catch (Exception $e){
                $rs = array('result'=>'0','msg'=>$e->getMessage());
            }
        }else{
            $rs = array('result'=>'0','msg'=>'数据异常,请稍后重试！');
        }
        echo json_encode($rs);die();
    }
}