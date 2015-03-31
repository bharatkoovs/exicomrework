<?php
function get_loggedin_user() {
	$CI = & get_instance();
	$user = $CI->session->userdata('user');
	if (!isset($user))
		return false;
	else
		return $user;
}

function getSessionValue($item, $type = NULL) { 
	$CI = & get_instance();

	if ($type == 'flash') {
		return  $CI->session->flashdata($item);
	}
        
	return $CI->session->userdata($item);
}
