<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/** load the CI class for Modular Extensions **/
require dirname(__FILE__).'/Base.php';

/**
 * Modular Extensions - HMVC
 *
 * Adapted from the CodeIgniter Core Classes
 * @link	http://codeigniter.com
 *
 * Description:
 * This library replaces the CodeIgniter Controller class
 * and adds features allowing use of modules and the HMVC design pattern.
 *
 * Install this file as application/third_party/MX/Controller.php
 *
 * @copyright	Copyright (c) 2011 Wiredesignz
 * @version 	5.4
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 **/
class MX_Controller 
{
	public $autoload = array();
	
	public function __construct() 
	{
		$class = str_replace(CI::$APP->config->item('controller_suffix'), '', get_class($this));
		log_message('debug', $class." MX_Controller Initialized");	
		
		/* copy a loader instance and initialize */
		$this->load = clone load_class('Loader');
		$this->load->_init();	
		
		/* autoload module items */
		$this->load->_autoloader($this->autoload);
	}
	
	public function __get($class) {
		return CI::$APP->$class;
	}
	
	protected function _check_permission($role, $redirect = 'home') {
		$res_array = array();
		$res_array['status'] = "error";
		$user = get_loggedin_user();
		if (empty($user)) {
			$msg = "Please login to perform this action";
			if ($redirect == false) {
				$res_array['msg'] = $msg;
				echo json_encode($res_array);
				exit;
			} else {
				$this->session->set_flashdata('error', $msg);
				redirect("signup/login");
			}
		}
		
		$isadmin = $this->usermodel->hasRole($user->id, $role);
		if (!$isadmin) {
			$msg = "Sorry, you don't have permission to perform this action";
			if ($redirect == false) {
				$res_array['msg'] = $msg;
				echo json_encode($res_array);
				exit;
			} else {
				$this->session->set_flashdata('error', $msg);
				redirect($redirect);
			}
		}
	}
	
	protected function _check_lock($screen, $create=false, $redirect = 'home', $type = '', $is_ajax = false) {
		$user = get_loggedin_user();
		if (empty($user)) {
			$this->session->set_flashdata('error', "Please login to perform this action");
			redirect("signup/login");
		}
		$this->load->library('LockScreen');
		if ($this->lockscreen->isLocked($screen, $user->id, $create, $type)) {
                        $msg = $this->lockscreen->getScreenAccessUserDetail($screen, $user->id);
                        if($is_ajax){
                            return array('status' => 'error', 'message' => $msg);
                        } else {
                            $this->session->set_flashdata('error', $msg);
                            redirect($redirect);
                        }
		}
	}

    protected function _get_list_page_banner_data() {
        if($this->input->is_ajax_request())
            return;
        $this->load->library('Product_lib');
        $path = null;
        if(current_url() === site_url('home') || current_url() === site_url('?shp=1'))
            $path = '/';

        $list_banner_url = $this->product_lib->banner_url($path);
        $this->data['list_banner_url'] = $list_banner_url;

        if($list_banner_url->redirect_url)
            redirect($list_banner_url->redirect_url, null, 301);

        if($list_banner_url->canonical_url)
            $this->data['canonical_url'] = site_url($list_banner_url->canonical_url);

        if($list_banner_url->is_noindex)
            $this->data['is_noindex'] = $list_banner_url->is_noindex;

        $this->data['banner_url_exists'] = false;
        if(!empty($list_banner_url))
            $this->data['banner_url_exists'] = true;

            $this->data['metaHome'] = !empty($list_banner_url->meta_title) ? $list_banner_url->meta_title : '';
        $this->data['metaDescription'] = !empty($list_banner_url->meta_description) ? $list_banner_url->meta_description : '';
        $this->data['metaKeywords'] = !empty($list_banner_url->meta_keywords) ? $list_banner_url->meta_keywords : '';
    }

    protected function _get_uri_parameters($segment_stop = 0) {
        $total_uri_segment = $this->uri->total_segments();
        $canonical_segment = '';
        $main_category_segment = ''; $category_segment = ''; $brand_segment = ''; $color_segment = '';
        if(($total_uri_segment > $segment_stop) && is_numeric($this->uri->segment($total_uri_segment))){
            $offset = (int) $this->uri->segment($total_uri_segment);
            $total_uri_segment = ($total_uri_segment - 1);
        } else {
            $offset = null;
        }
        $this->data['offset'] = $offset;
        for($i = $total_uri_segment; $i > $segment_stop ; $i--) {      
            $uri_segment = $this->security->xss_clean(str_replace('--', '|', $this->uri->segment($i)));
            $uri_segment = str_replace(config_item('bad_query_string_chars'), config_item('bad_query_string_chars_replacement'), $uri_segment);
            $uri_segment_val = explode('-', $uri_segment);
            $first_uri_data = explode('--', $this->uri->segment($i));
            
            switch($uri_segment_val[0]) {
                case 'shop'         : $this->data['main_categories'] = str_replace('|', '-', str_replace('_', ' & ', str_replace('-',' ',str_replace('--', '|', str_replace('shop-', '', $uri_segment)))));
                                      $this->data['main_category_segment'] = $main_category_segment = $first_uri_data[0];
                                      break;
                
                case 'style'     : $this->data['subcategories'] = str_replace('|', '-', str_replace('_', ' & ', str_replace('-',' ',str_replace('--', '|', str_replace('style-', '', $uri_segment)))));
                                      $this->data['category_segment'] = $category_segment = $first_uri_data[0];
                                      break;
                
                case 'brand'        : $this->data['brands'] = str_replace('|', '-', str_replace('_', ' & ', str_replace('-',' ',str_replace('--', '|', str_replace('brand-', '', $uri_segment)))));
                                      $this->data['brand_segment'] = $brand_segment = $first_uri_data[0];
                                      break;
                
                case 'color'        : $this->data['colors'] = str_replace('|', '-', str_replace('_', ' & ', str_replace('-',' ',str_replace('--', '|', str_replace('color-', '', $uri_segment)))));
                                      $this->data['color_segment'] = $color_segment = $first_uri_data[0];
                                      break;
                
                default             : break;
            }
        }
        $canonical_segment .= $main_category_segment ? '/' . trim($main_category_segment, '-') : '';
        $canonical_segment .= $category_segment ? '/' . trim($category_segment, '-') : '';
        $canonical_segment .= $brand_segment ? '/' . trim($brand_segment, '-') : '';
        $canonical_segment .= $color_segment ? '/' . trim($color_segment, '-') : '';
        if($canonical_segment){
            $canonical_segment = str_replace(config_item('bad_query_string_chars'), config_item('bad_query_string_chars_replacement'), $canonical_segment);
            $this->data['canonical_segment_uri'] = rawurldecode($canonical_segment);            
        }
        $forder_val = trim($this->input->get('fo', true), '--');
        $forder_val = search_xss_clean('','-',$forder_val);
        $this->data['forder'] = array();
        if(!empty($forder_val))
            $this->data['forder'] = explode("--", $forder_val);

        return $offset;
    }
}
