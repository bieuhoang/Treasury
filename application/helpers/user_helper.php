<?php

defined('BASEPATH') or exit('No direct script access allowed.');

if ( !function_exists('user_avatar') ) {

	function user_avatar($src = '', $width = null, $height = null) {
		ci()->load->helper('html');
		$src		 = $src != '' ? base_url($src) : base_url('public/img/avatar.png');
		$width_str	 = is_null($width) ? '&w=150' : '&w=' . $width;
		$height_str	 = is_null($height) ? '' : '&h=' . $height;
		return img(array (
			'class' => 'avatar',
			'src' => base_url('public/thumb.php?src=' . $src . $width_str . $height_str),
			'width' => $width,
			'height' => $height,
			'alt' => ''
		));
	}

}

if ( !function_exists('qr_code') ) {
	function qr_code($text = '', $width = null, $height = null) {
		if($text === '') return '';
		
		$width = is_null($width) ? 100 : (int) $width;
		$height = is_null($height) ? $width : (int) $height;
		return '<img src="http://chart.apis.google.com/chart?cht=qr&amp;chs='.$width.'x'.$height.'&amp;chl='.$text.'&amp;chld=H|0" alt="'.$text.'">';
	}
}