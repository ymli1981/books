<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CI RBAC
 * RBAC中默认网关页面
 * @author		toryzen
 * @link		http://www.toryzen.com
 */
class Index extends CI_Controller {
	
	function __construct(){
		parent::__construct();
	}
	/**
	 * 主页
	 */
	public function index()
	{
		//var_dump(phpinfo());exit;
		//验证是否登录
		if(!rbac_conf(array('INFO','id'))){
			error_redirct($this->config->item('rbac_auth_gateway'),"请先登录！");
		}else{
			success_redirct($this->config->item('rbac_default_index'),"您已成功登录,正在跳转请稍候！","1");
		}
		
	}
	/**
	 * 用户登录
	 */
	public function login(){
		
		$this->load->model("rbac_model");
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		if($username&&$password){
			$STATUS = $this->rbac_model->check_user($username,md5($password));
			if($STATUS===TRUE){
				success_redirct($this->config->item('rbac_default_index'),"登录成功！");
			}else{
				error_redirct($this->config->item('rbac_auth_gateway'),$STATUS);
				die();
			}
		}else{
			$this->load->view("login");
		}
		
	}
	/**
	 * 修改密码
	 */
	public function updatePass(){
		$this->load->model('rbac_model');
		$pass = $this->input->post('password');
		if($this->rbac_model->update_pass($pass)){
			session_destroy();
			echo json_encode(array('rs'=>'ok','msg'=>'更新成功,请重新登录！'));
		}else{
			echo json_encode(array('rs'=>'error','msg'=>'更新失败,请重试！'));
		}
	}
	/*
	 * 用户退出
	 */
	public function logout(){
		session_destroy();
		success_redirct($this->config->item('rbac_auth_gateway'),"登出成功！",2);
	}

}
