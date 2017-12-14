<?php

class MY_Controller extends CI_Controller {
    public function __construct() {
        parent::__construct();
        session_start();
        date_default_timezone_set("PRC");
        define("NOW_TIME",date("Y-m-d H:i:s",$_SERVER['REQUEST_TIME']));
    }
    public function is_method($m)
    {
        return $_SERVER['REQUEST_METHOD'] === strtoupper($m);
    }
    //行为记录
    public function add_actionlog($content=''){
        if(!$content){
            return false;
        }
        $this->load->model('model/m_actionlog');
        $data =array();
        $data['user_id'] =rbac_conf(array('INFO','id'));
        $data['data']    =$content;
        $data['modified']=time();
        $data['status']  =1;
        $data['source']  =0;
        return $this->m_actionlog->insert($data);
    }
    /**
     * 分页公共函数
     * @param int $total
     * @param int $per_page
     */
    public function pagination($total, $limit = 20)
    {
        $this->load->helper('url');
        $this->load->library('pagination');
        $get = $this->input->get() ? $this->input->get() : array();
        unset($get['per_page']);

        $config['base_url'] = base_url(uri_string()) ."?". http_build_query($get);
        $config['total_rows'] = intval($total);
        $config['per_page'] = $limit ;
        $this->config->load('pagination', TRUE);
        $pagecount = ceil($total/$config['per_page']);
        $pagination = $this->config->item('pagination');
        $this->pagination->initialize(array_merge($pagination, $config));
        $link = $this->pagination->create_links();

        return $link;
    }
}