<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * pagination setting
 */

$config['first_link'] = '首页';
$config['first_tag_open'] = '<li>';
$config['first_tag_close'] = '</li>';
$config['last_link'] = '尾页';
$config['last_tag_open'] = '<li>';
$config['last_tag_close'] = '</li>';

$config['full_tag_open'] = '<nav><ul class="pagination">';
$config['full_tag_close'] = '</ul></nav>';
$config['cur_tag_open'] = '<li class="active"><a href="#">';
$config['cur_tag_close'] = '</a></li>';

$config['num_tag_open'] = '<li>';
$config['num_tag_close'] = '</li>';

$config['prev_link'] = '上一页';
$config['prev_tag_open'] = '<li>';
$config['prev_tag_close'] = '</li>';

$config['next_link'] = '下一页';
$config['next_tag_open'] = '<li>';
$config['next_tag_close'] = '</li>';

$config['num_links'] = 5;
$config['use_page_numbers'] = TRUE;
$config['page_query_string'] = TRUE;


// End file