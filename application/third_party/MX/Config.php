<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Modular Extensions - HMVC
 *
 * Adapted from the CodeIgniter Core Classes
 * @link	http://codeigniter.com
 *
 * Description:
 * This library extends the CodeIgniter CI_Config class
 * and adds features allowing use of modules and the HMVC design pattern.
 *
 * Install this file as application/third_party/MX/Config.php
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
 * */
class MX_Config extends CI_Config {

	public function load($file = '', $use_sections = FALSE, $fail_gracefully = FALSE, $_module = NULL) {

		($file == '') AND $file = 'config';

		if (in_array($file, $this->is_loaded, TRUE))
			return $this->item($file);

		$_module OR $_module = CI::$APP->router->fetch_module();
		list($path, $file) = Modules::find($file, $_module, 'config/');

		if ($path === FALSE) {
			parent::load($file, $use_sections, $fail_gracefully);
			return $this->item($file);
		}

		if ($config = Modules::load_file($file, $path, 'config')) {

			/* reference to the config array */
			$current_config = & $this->config;

			if ($use_sections === TRUE) {
				if (isset($current_config[$file])) {
					$current_config[$file] = array_merge($current_config[$file], $config);
				} else {
					$current_config[$file] = $config;
				}
			} else {
				$current_config = array_merge($current_config, $config);
			}
			$this->is_loaded[] = $file;
			unset($config);
			return $this->item($file);
		}
	}

	// --------------------------------------------------------------------

	/**
	 * Site URL
	 *
	 * @access	public
	 * @param	string	the URI string
	 * @param	boolean secure
	 * @return	string
	 */
	function site_url($uri = '') {
		$base_url = ($this->site_secure_pages($uri)) ? $this->slash_item('secure_base_url') : $this->slash_item('base_url');
		if ($uri == '' || $uri == 'home' || $uri == 'secure_home') {
			return $base_url . $this->item('index_page');
		}

		if ($this->item('enable_query_strings') == FALSE) {
			if (is_array($uri)) {
				$uri = implode('/', $uri);
			}
			$index = $this->item('index_page') == '' ? '' : $this->slash_item('index_page');
			$suffix = ($this->item('url_suffix') == FALSE) ? '' : $this->item('url_suffix');
			return $base_url . $index . trim($uri, '/') . $suffix;
		} else {
			if (is_array($uri)) {
				$i = 0;
				$str = '';
				foreach ($uri as $key => $val) {
					$prefix = ($i == 0) ? '' : '&';
					$str .= $prefix . $key . '=' . $val;
					$i++;
				}

				$uri = '?' . $str;
			}

			return $base_url . $this->item('index_page') . trim($uri, '/');
		}
	}

	/**
	 * Site secure pages
	 *
	 * Array of the site pages that are secure
	 *
	 * @access	public
	 * @return	Array
	 */
	function site_secure_pages($uri = '') {
		if ($uri === true || $uri === false) {
			return $uri;
		}
		$pages = array();
		$pages['secure'] = $this->item('secure_pages');
		$pages['nonsecure'] = array('/^(checkout\/success).*/');
		$pages['both'] = array('/^(cart\/index\/popup)/','/^(deals\/search)/');

		$secure = false;
		if ($uri) {
			$myUri = preg_replace($pages['both'], '{both}', $uri);
			if ($myUri == '{both}' || $myUri == 'secure_home') {
				if (getServerPort() == 443) {
					$secure = true;
				}
			} else {
				$myUri = preg_replace($pages['nonsecure'], '{nosecure}', $uri);
				if ($myUri != '{nosecure}') {
					$myUri = preg_replace($pages['secure'], '{secure}', $uri);
					if ($myUri == '{secure}') {
						$secure = true;
					}
				}				
			}
		} elseif ((getServerPort() == 443) && ($uri != '')) {
			$secure = true;
		}
		return $secure;
	}

}