<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Signup extends MX_Controller {
    var $data;
    var $referrer;

    function __construct() {
        parent::__construct();

        $this->load->helper(array('form', 'url'));
        $this->load->library('user_agent');
        $this->referrer = $this->agent->referrer();
    }
    
    public function index(){
            redirect('home');
    }
    
    function _check_username($name) {
        $this->load->model('lookupmodel');
        if (empty($name)) {
            $name = $this->input->post('name',true);
        }
        $user_lookup = $this->lookupmodel->get_by_name($name);
        if ($user_lookup)
            return FALSE;
        else
            return TRUE;
    }

    function get_loggedin_user() {
	$user = $this->session->userdata('user');
	if (!isset($user))
            return false;
	else
            return $user;
    }

    function _check_loggedin_user() {
        $user = $this->get_loggedin_user();
        if ($user) {
            if (empty($redirect)) {
                $redirect = $this->session->userdata('redirect');
            }
            if (!empty($redirect)) {
                $this->session->unset_userdata('redirect');
                redirect($redirect);
            } else {
                redirect('home');
            }
        }
    }

    function _set_user_session($user_data) {
        // login the user ..
        $u = new stdClass();
        $u->id = $user_data['user_id'];
        $u->name = $user_data['username'];
        $u->email = $user_data['email'];
        $this->session->set_userdata('user', $u);
        return $u;
    }

    function _redirect_url() {
        $redirect = $this->postProcess();
        if (empty($redirect)) {
            $redirect = $this->session->userdata('redirect');
        }
        if (!empty($redirect)) {
            $this->session->unset_userdata('redirect');
            $redirect_delay = $this->session->userdata('redirect_delay') ? $this->session->userdata('redirect_delay') : '1';
            sleep($redirect_delay);
            $this->session->unset_userdata('redirect_delay');
            redirect($redirect);
        } else {
            redirect('home');
        }
    }

    function _create_username($email, $username = null) {
        if (!$username)
            $username = substr($email, 0, strpos($email, '@'));
        $usernameFlag = false;
        $i = 1;
        $usernameFlag = $this->_check_username($username);
        $kk = $username;
        while (!$usernameFlag) {
            $kk = $username . $i;
            $usernameFlag = $this->_check_username($username . $i);
            $i++;
        }
        $username = $kk;
        return $username;
    }

    function _create_user($user_data) {
        $this->entitymodel->create_entity($user_data['user_id'], $user_data['username'], 'type');
        $data = array(
            'id' => $user_data['user_id'],
            'name' => $user_data['username'],
            'email' => $user_data['email'],
            'password' => $user_data['password'],
            'phone' => $user_data['phone'],
            'gender' => $user_data['gender'],
            'fname' => !empty($user_data['firstname'])?$user_data['firstname']:'',
            'lname'=>!empty($user_data['lastname'])?$user_data['lastname']:'',
        );
        $this->usermodel->create_user($user_data['user_id'], $data);
        $user_data['user_data'] = $data;
        return $user_data;
    }
    
    function _check_and_set_user($user, $name, $user_type) {
        $CI = & get_instance();
        if ($user) {
                $u = new stdClass();
                $u->email = $user;
                $u->name = $name;
                $u->user_type = $user_type;
                $CI->session->set_userdata('user', $u);
                return true;
        }
        return false;
    }
    
    function login() {	
            
        $redirect = false;

        $this->_check_loggedin_user();
        $this->load->library('form_validation');
        $this->load->helper('cookie');
        $this->form_validation->set_rules('login_email', 'Email', 'trim|email|required|xss_clean');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', 'Please provide correct credentials');
                $this->index();
        } else {
            $username = $this->input->post('login_email',true);
            $name = $this->input->post('login_name',true);
            $user_type = $this->input->post('user_type',true);
            $user = $this->validate_user($username);


            if ($this->_check_and_set_user($user, $name, $user_type)) {
      /*                   
                $lookupuser = new stdClass();
                $lookupuser->id = $user->id;
                $lookupuser->last_loggded_time = date('Y-m-d H:i:s');
                $this->usermodel->updatePojo('lookup', null, 'lookup', $lookupuser);*/

                $this->session->set_flashdata('message', 'You have successfully logged into your account');
                $this->session->set_userdata('logged_in', true);
                $this->index();

            } else {
                    $this->session->set_flashdata('message', 'Please provide credentials');
                    $this->index();
            }
        }
    }
        
    function validate_user($email){
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            list($user, $domain) = explode('@', $email);
            if ($domain == 'exicom.in') {
                return $email;
            }
        }
        return NULL;
				 	
    }
        
    function logout(){
        $this->session->sess_destroy();
        $this->session->sess_create();
        $this->session->set_userdata('logged_out', true);
        redirect('home');
    }
        
}
