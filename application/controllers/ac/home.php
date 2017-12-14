<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author lhf
 * @date 20161207
 * 前台单页
 */
 class Home extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->view_override = FALSE;
	}
	public function index(){
		phpinfo();
	}
 }