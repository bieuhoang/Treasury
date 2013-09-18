<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['uri_segment'] = 3;
$config['num_links'] = 2;
$config['use_page_numbers'] = TRUE;
$config['page_query_string'] = FALSE;

$config['full_tag_open'] = '<div class="pagination pull-right"><ul>';
$config['full_tag_close'] = '</ul></div>';

$config['first_link'] = 'First';
$config['first_tag_open'] = '<li>';
$config['first_tag_close'] = '</li>';

$config['last_link'] = 'Last';
$config['last_tag_open'] = '<li>';
$config['last_tag_close'] = '</li>';

$config['next_link'] = '&raquo;';
$config['next_tag_open'] = '<li>';
$config['next_tag_close'] = '</li>';

$config['prev_link'] = '&laquo;';
$config['prev_tag_open'] = '<li>';
$config['prev_tag_close'] = '</li>';

$config['cur_tag_open'] = '<li class="active"><a>';
$config['cur_tag_close'] = '</a></li>';

$config['num_tag_open'] = '<li>';
$config['num_tag_close'] = '</li>';

/* End of file pagination.php */
/* Location: ./application/config/pagination.php */