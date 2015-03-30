<?php

class Usermodel extends CI_Model {

	// User photo - column profile_pic constants
	//TODO: Find elegant soln for codeigniter - use contants instead of variables
	var $user = "user";
	var $db;

	function __construct() {
		parent::__construct();
		$CI = & get_instance();
		$CI->load->library('user_agent');
		$CI->load->helper('url');
                $is_mobile_enabled = $CI->config->item('enable_mobile_view');
		if($is_mobile_enabled){
                    $agent_string = $CI->agent->agent_string();
                    //check for mobile in user agent and IPAD , if mobile then show mobile view otherwise normal view
                    if (!$CI->agent->is_tablet() && $CI->agent->is_mobile()) { // && !$CI->agent->is_browser
                            $CI->session->set_userdata('view', 'mobile');
                    }else {
                            $CI->session->set_userdata('view', 'koovs');
                    }
		}else {
			$CI->session->set_userdata('view', 'koovs');
		}

		//refer code
		if ($CI->session->userdata('user_refer') == null) {
			$CI->session->set_userdata('user_refer', $CI->input->server('HTTP_REFERER', true));
		}

	}

	function updatePojo($dbName, $entityid_ref, $table, $data, $sql = '') {

                  $db = $this->load->database('default', TRUE);
		if (!isset($data->dateupdated)) {
			if ($db->field_exists('dateupdated', $table)) {
				$data->dateupdated = date("Y-m-d H:i:s");
			}
		}

		if (!empty($data->id)) {
			$db->where('id', $data->id);
			if (!empty($sql))
				$db->where($sql, null, false);
			$db->update($table, $data);
			return $data->id;
		}
		elseif (!empty($data->orderid)) {
			$db->where('orderid', $data->orderid);
			$db->update($table, $data);
			return $data->orderid;
		} else {
			$data->datecreated = date("Y-m-d H:i:s");
			$db->insert($table, $data);
			return $db->insert_id();
		}
	}

	function updatePojoAndReturnCount($dbName, $entityid_ref, $table, $data) {

            $db = $this->load->database('default', TRUE);
		if (!empty($data->id)) {
			$db->where('id', $data->id);
			$db->update($table, $data);
			return $db->affected_rows();
		}
		return 0;
	}

	/* Update Pojo By Query */

	function updatePojoByQuery($dbName, $entityid_ref, $table, $where, $data) {

		$this->db = $this->load->database('default', TRUE);
		if (!empty($where)) {
			$this->addSqlToQuery($where);
			$this->db->update($table, $data);
			return $this->db->affected_rows();
		}
		return 0;
	}

	function insertPojos($dbName, $entityid_ref, $table, $data) {
		$db = $this->load->database($dbName, $active);
		$db->insert_batch($table, $data);
	}

	function executeSql($dbName, $entityid_ref, $sql) {
		$db = $this->load->database('default', TRUE);
		$sql = $this->replaceDbInTable($sql);
		//echo $sql . "<br>";
		return $db->simple_query($sql);
	}

	function executeSqlandReturnQuery($dbName, $entityid_ref, $sql, $show_query = false, $read_flag = false) {
		$db = $this->load->database('default', TRUE);
		$sql = $this->replaceDbInTable($sql);
		if ($show_query) {
			echo '<div>' . $sql . "</div>";
		}
		return $db->query($sql);
	}

	function getResultBySql($dbName, $entityid_ref, $select, $where, $table) {
		$db = $this->core->load->database();
		$query = $db->select($select, false);
		$query = $db->where($where, false, false);
		$query = $db->get($table, false);
		return $query->result();
	}

	function addSqlToQuery($sql) {
		if (is_array(($sql))) {
			foreach ($sql as $k => $v) {
				if (is_array($v)) {
					foreach ($v as $k1 => $v1) {
						switch ($k1) {
							case 'in' : $query = $this->db->where_in($k, $v1);
								break;
							case 'notin' : $query = $this->db->where_not_in($k, $v1);
								break;
							case 'like' : $query = $this->db->like($k, $v1);
								break;
						}
					}
				} else {
					if (is_string($k)) {
						$query = $this->db->where($k, $v);
					} else {
						$query = $this->db->where($v, null, false);
					}
				}
			}
		} else {
			$query = $this->db->where($sql, null, false);
		}
	}

	public function table_exists($dbName, $entityid_ref, $table) {
		$this->db = $this->load->database('default', TRUE);
		return $this->db->table_exists($table);
	}

	function getPojo($dbName, $entityid_ref, $table, $name, $value, $name1 = null, $value1 = null, $sql = null, $sort = null, $read_flag = false, $select = null) {

            
		$this->db = $this->load->database('default', TRUE);


		if ($select != null) {
			$query = $this->db->select($select, false);
		}

		if (!empty($sql)) {
			$this->addSqlToQuery($sql);
		}

		if (!empty($name) && !empty($value)) {
			$query = $this->db->where($name, $value);
		}
		if (!empty($name1) && $value1 != null) {
			$query = $this->db->where($name1, $value1);
		}

		if (!empty($sort)) {
			$query = $this->db->order_by($sort);
		}
		$query = $this->db->limit(1);

		$query = $this->db->get($table);
		//echo $this->db->last_query() . "<br>";;
		if ($query->num_rows() == 0) {
			return NULL;
		}
		return $query->row();
	}

	function getPojos($dbName, $sql, $entityid_ref, $table, $name = null, $value = null, $name1 = null, $value1 = null, $sort = null, $offset = 0, $limit = 0, $read_flag = false, $select = null, $group_by = null) {

                $this->db = $this->load->database('default', TRUE);

		if ($select != null) {
			$query = $this->db->select($select, false);
		}
		if (!empty($sql)) {
			$this->addSqlToQuery($sql);
		}

		if ($name != null && $value != null) {
			$query = $this->db->where($name, $value);
		}
		if (!empty($name1)) {
			$query = $this->db->where($name1, $value1);
		}
		if (!empty($sort)) {
			$query = $this->db->order_by($sort);
		}
		if (!empty($group_by)) {
			$query = $this->db->group_by($group_by);
		}
		if ($limit > 0) {
			$query = $this->db->limit($limit, $offset);
		}

		$query = $this->db->get($table);
		//echo $this->db->last_query() . "<br>";;
		if ($query->num_rows() == 0) {
			return false;
		}
		return $query->result();
	}

	function getPojosCount($dbName, $sql, $entityid_ref, $table, $name = null, $value = null, $name1 = null, $value1 = null, $read_flag = false, $group_by = null, $count_field = null) {

		$this->db = $this->load->database('default', TRUE);
		if (!empty($name) && !empty($value)) {
			$query = $this->db->where($name, $value);
		}
		if (!empty($sql)) {
			$this->addSqlToQuery($sql);
		}
		if (!empty($name1) && !empty($value1)) {
			$query = $this->db->where($name1, $value1);
		}
		if (!empty($group_by)) {
			$query = $this->db->group_by($group_by);
		}
		if (!empty($count_field)) {
			$this->db->_count_string = "SELECT COUNT(" . $count_field . ") AS ";
		}
		$query = $this->db->from($table);
		$num = $this->db->count_all_results();
		//echo $this->db->last_query() . "<br>";;
		return $num;

		/*        $query = $db->get($table);
		  if ($query->num_rows() == 0) {
		  return 0;
		  }
		  return $query->num_rows(); */
	}

	function delete($dbName, $sql, $entityid_ref, $table, $name = null, $value = null, $name1 = null, $value1 = null) {

		$this->db = $this->load->database('default', TRUE);

		if (!empty($name) && !empty($value)) {
			$query = $this->db->where($name, $value);
		}
		if (!empty($sql)) {
			if(is_array($sql)){
				$query = $this->addSqlToQuery($sql);
			}else{
				$query = $this->db->where($sql, null, false);
			}
		}
		if (!empty($name1) && !empty($value1)) {
			$query = $this->db->where($name1, $value1);
		}
		$this->db->delete($table);
	}

	function get_last_query() {
		return $this->db->last_query();
	}

	function getMaxId($dbName, $entityid_ref, $colName, $table) {
		$db = $this->load->database('default', TRUE);
		$db->select_max($colName);
		$query = $db->get($table);
		return $query->result();
	}


	function getResultSetInCSV($dbName, $entityid_ref, $sql, $headerFlag = false, $pattern = null, $replace = null) {
		$CI = & get_instance();
		$this->db = $this->load->database('default', TRUE);
		$sql = $this->replaceDbInTable($sql);
		$offset = 0;
		$limit = 500;
		$out = '';
		while (true) {
			$query = $db->query($sql . ' limit ' . $offset . ',' . $limit);
			$offset = $offset + $limit;
			$delim = ",";
			$newline = "\n";
			$enclosure = '"';
			if (!is_object($query) OR !method_exists($query, 'list_fields')) {
				show_error('You must submit a valid result object');
			}



			// First generate the headings from the table column names

			if (!$headerFlag) {
				foreach ($query->list_fields() as $name) {
					$out .= $enclosure . str_replace($enclosure, $enclosure . $enclosure, $name) . $enclosure . $delim;
				}
				$headerFlag = true;
				$out = rtrim($out);
				$out .= $newline;
			}


			// Next blast through the result array and build out the rows
			if ($query->num_rows() > 0) {
				foreach ($query->result_array() as $row) {
					foreach ($row as $item) {
						if (!empty($pattern) && !empty($replace))
							$item = preg_replace($pattern, $replace, $item);
						$out .= $enclosure . str_replace($enclosure, $enclosure . $enclosure, $item) . $enclosure . $delim;
					}
					$out = rtrim($out);
					$out .= $newline;
				}
			}else {
				return $out;
			}
		}
		return $out;
	}


}

/*End of usermodel */



