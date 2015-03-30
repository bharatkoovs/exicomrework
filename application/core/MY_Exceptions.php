<?php
/**
 * @package		Exception
 * @author		Binu
 * @date 11-02-2012
 */

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class MY_Exceptions extends CI_Exceptions {

	public function __construct() {
		parent::__construct();		
	}

	function show_error($heading, $message, $template = 'error_general', $status_code = 500) {

		set_status_header($status_code);

		$message = '<p>' . implode('</p><p>', (!is_array($message)) ? array($message) : $message) . '</p>';

		if (ob_get_level() > $this->ob_level + 1) {
			ob_end_flush();
		}
		ob_start();
		$this->update_log_exception_handler($heading, $message, $template);
		include(APPPATH . 'errors/' . $template . EXT);
		$buffer = ob_get_contents();
		ob_end_clean();
		return $buffer;
	}

	function show_php_error($severity, $message, $filepath, $line) {
		$complete_file_path = $filepath;
		$severity = (!isset($this->levels[$severity])) ? $severity : $this->levels[$severity];

		$filepath = str_replace("\\", "/", $filepath);

		// For safety reasons we do not show the full file path
		if (FALSE !== strpos($filepath, '/')) {
			$x = explode('/', $filepath);
			$filepath = $x[count($x) - 2] . '/' . end($x);
		}

		if (ob_get_level() > $this->ob_level + 1) {
			ob_end_flush();
		}
		ob_start();		
		$this->update_log_error_handler($severity, $message, $complete_file_path, $line);
		include(APPPATH . 'errors/error_php' . EXT);
		$buffer = ob_get_contents();
		ob_end_clean();
		echo $buffer;
	}

	/**
	 * PHP Error Handler
	 * 
	 */
	public function update_log_error_handler($severity, $message, $filepath, $line) {
		return;
		$CI = & get_instance();
		$CI->load->model("usermodel");
		$data = new stdClass();
		$user = get_loggedin_user();
		if (!empty($user)) {
			$lookupuser = $CI->usermodel->getPojo('lookup', null, 'lookup', 'id', $user->id, null, null, null, null, false, 'id,username');
			$data->user_id = $lookupuser->id;
			$data->user_name = $lookupuser->username;
		}
		$data->errtype = 'error_php';
		$data->errmessage = $severity;
		$data->errdescription = $message;		
		$data->errfile = $filepath;
		$data->errline = $line;
		$data->url = $CI->config->site_url().$CI->uri->uri_string();
		$data->datecreated = date("Y-m-d H:i:s", time());
		$CI->usermodel->updatePojo("data", '', 'logs', $data);	
	}

	/**
	 * PHP Error Handler	
	 */
	public function update_log_exception_handler($heading, $message, $template) {	
		return;
		$CI = & get_instance();
		$CI->load->model("usermodel");
		$data = new stdClass();
		$user = get_loggedin_user();
		if (!empty($user)) {
			$lookupuser = $CI->usermodel->getPojo('lookup', null, 'lookup', 'id', $user->id, null, null, null, null, false, 'id,username');
			$data->user_id = $lookupuser->id;
			$data->user_name = $lookupuser->username;
		}
		$exception_details = new Exception();		
		if($exception_details){
			if($exception_details->getFile()){
				$data->errfile = $exception_details->getFile();
			}
			if($exception_details->getFile()){
				$data->errline = $exception_details->getFile();
			}
		}
		$data->errtype = $template;
		$data->errmessage = $heading;
		$data->errdescription = $message;
		$data->url = $CI->config->site_url().$CI->uri->uri_string();
		$data->datecreated = date("Y-m-d H:i:s", time());
		$CI->usermodel->updatePojo("data", '', 'logs', $data);
	}

}

// END Exceptions Class

/* End of file Exceptions.php */
/* Location: ./system/application/core/MY_Exceptions.php */