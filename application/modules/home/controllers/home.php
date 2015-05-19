<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MX_Controller {
        var $data;
        function __construct() {
		parent::__construct();
        }
        
	public function index(){
            $user = get_loggedin_user(); 
            if($user){
                 redirect('cases');
            }
            $this->load->view('home_view', $this->data);
	}
        
        public function header(){
            $this->load->view('header');
        }
        
        public function footer(){
            $this->load->view('footer');
        }
        
        public function cases($case = '', $serial_number = 0, $saved_id = 0){
            $user = get_loggedin_user(); 
            
            if(empty($user)){
                $this->session->set_flashdata('error', 'Please provide your email id to proceed');
                redirect('home');
            }
            
            $this->load->library('user_agent');
            $this->data['is_mobile'] = false;
           if ($this->agent->is_mobile()) {
                $this->data['is_mobile'] = true;
            } 
            $this->load->model('usermodel');
            if($case == 'battery'){
                if($serial_number){
                    if($saved_id){
                        $serial_no = $serial_number;
                        $this->data['battery_saved_data'] = $this->usermodel->getPojo('site_data', null, 'rework_data', 'id', $saved_id, 'serial_no', $serial_no, null);
                        if(empty($this->data['battery_saved_data']))
                            $serial_no = '';
                    }
                } else
                    $serial_no = $this->input->post("battery_number", true);
                
                $this->data['serial_no'] = $serial_no;
                if(empty($serial_no)){
                    $this->session->set_flashdata('message', 'Please enter the correct serial number');
                    redirect('cases');
                }
                $this->load->view('battery_view', $this->data);
                return;
            }
            if($case == 'cbms'){
                if($serial_number){
                    if($saved_id){
                        $serial_no = $serial_number;
                        $this->data['battery_saved_data'] = $this->usermodel->getPojo('site_data', null, 'rework_data', 'id', $saved_id, 'serial_no', $serial_no, null);
                        if(empty($this->data['battery_saved_data']))
                            $serial_no = '';
                    }
                } else
                    $serial_no = $this->input->post("cbms_number", true);
                $this->data['serial_no'] = $serial_no;
                if(empty($serial_no)){
                    $this->session->set_flashdata('message', 'Please enter the correct serial number');
                    redirect('cases');
                }
                $this->load->view('cbms_view', $this->data);
                return;
            }
            $this->data['saved_battery'] = $this->usermodel->getPojo('site_data', null, 'rework_data', 'save_type', 1, 'rework_type', 1, null);
            $this->data['saved_cbms'] = $this->usermodel->getPojo('site_data', null, 'rework_data', 'save_type', 1, 'rework_type', 2, null);
            $this->load->view('cases_view', $this->data);
	}
        
        public function save_battery_data(){
            $user = get_loggedin_user(); 
            if(empty($user)){
                $this->session->set_flashdata('error', 'Please provide your email id to proceed');
                redirect('home');
            }
            
            $date = $this->input->post("my_date", true);
            $time = $this->input->post("my_time", true);
            $serial_no = $this->input->post("serial_number", true);
            if(empty($serial_no) || empty($date)){
                $this->session->set_flashdata('error', 'Please enter all data carefully');
                redirect('cases');
            }
            $id = $this->input->post("id", true);
            $save_type = $this->input->post("save_type", true);
            $site_option = $this->input->post("site_option", true);
            $site_id = $this->input->post("site_id", true);
            $site_name = $this->input->post("site_name", true);
            $city = $this->input->post("city", true);
            $circle = $this->input->post("circle", true);
            $current_software_version = $this->input->post("current_software_version", true);
            $module_soc = $this->input->post("module_soc", true);
            $module_voltage = str_replace('v', '', strtolower($this->input->post("module_voltage", true)));
            $cell = array();
            for($i = 1; $i <= 15; $i++){
                $cell[$i] = str_replace('v', '', strtolower($this->input->post("cell".$i, true)));
            }
            $cell_temp = array();
            for($i = 1; $i <= 5; $i++){
                $cell_temp[$i] = $this->input->post("cell_temp_".$i, true);
            }
            $issue_type_1 = $this->input->post("issue_type_1", true);
            $remarks_1 = $this->input->post("remarks_1", true);
            $issue_type_2 = $this->input->post("issue_type_2", true);
            $remarks_2 = $this->input->post("remarks_2", true);
            $issue_type_3 = $this->input->post("issue_type_3", true);
            $remarks_3 = $this->input->post("remarks_3", true);
            $issue_type_4 = $this->input->post("issue_type_4", true);
            $remarks_4 = $this->input->post("remarks_4", true);
            
            $existing_img1 = $this->input->post("existing_image1", true);
            $existing_img2 = $this->input->post("existing_image2", true);
            $existing_img3 = $this->input->post("existing_image3", true);
            $existing_img4 = $this->input->post("existing_image4", true);
            
            $replaced_serial_no = $this->input->post("replaced_serial_no", true);
            $module_repairable = $this->input->post("module_repairable", true);
            $module_repaired_in = $this->input->post("module_repaired_in", true);
            $cell_replaced = $this->input->post("cell_replaced", true);
            $bms_replaced = $this->input->post("bms_replaced", true);
            $software_updated = $this->input->post("software_updated", true);
            $updated_software_version = $this->input->post("updated_software_version", true);
            $cable_loom_replaced = $this->input->post("cable_loom_replaced", true);
            $module_body_parts_replaced = $this->input->post("module_body_parts_replaced", true);
            $module_charged_up = $this->input->post("module_charged_up", true);
            $cell_level_charger_used = $this->input->post("cell_level_charger_used", true);
            $rework_note = $this->input->post("rework_note", true);
            $rework_module_soc = $this->input->post("rework_module_soc", true);
            $rework_module_voltage = str_replace('v', '', strtolower($this->input->post("rework_module_voltage", true)));
            $narada_rep_present = $this->input->post("narada_rep_present", true);
            $cell_level_charger_used = $this->input->post("cell_level_charger_used", true);
            
            $rework_cell = array();
            for($i = 1; $i <= 15; $i++){
                $rework_cell[$i] = $this->input->post("rework_cell".$i, true);
            }
            
            $battery_details = new stdClass();
            if($id){
                $battery_details->id = $id;
                $battery_details->updated_by = $user->email;
            } else
                $battery_details->created_by = $user->email;
            $battery_details->datecreated = $date." ".$time;
            $battery_details->save_type = $save_type;
            $battery_details->serial_no = $serial_no;
            $battery_details->rework_type = 1;
            $battery_details->site_option = $site_option;
            $battery_details->site_id = $site_id;
            $battery_details->site_name = $site_name;
            $battery_details->city = $city;
            $battery_details->circle = $circle;
            $battery_details->current_software_version = $current_software_version;
            $battery_details->module_soc = $module_soc;
            if(!empty($module_voltage))
                $battery_details->module_voltage = $module_voltage;
            
            for($i = 1; $i <= 15; $i++){
                $cell_name = 'cell'.$i;
                if(!empty($cell[$i]))
                    $battery_details->$cell_name = $cell[$i];
            }
            for($i = 1; $i <= 5; $i++){
                $cell_temp_name = 'cell_temp_'.$i;
                if(!empty($cell_temp[$i]))
                    $battery_details->$cell_temp_name = $cell_temp[$i];
            }
            
            $battery_details->issue_type_1 = $issue_type_1;
            $battery_details->remarks_1 = $remarks_1;

            $this->load->helper('photo_helper');
            
            $path1 = upload_image_to_dir('uploads/', 'image1'); 
            $img1 = $path1['path'];
            if(empty($path1['path']))
                $img1 = $existing_img1;
            $battery_details->photo_1 = $img1;
            
            $battery_details->issue_type_2 = $issue_type_2;
            $battery_details->remarks_2 = $remarks_2;
            $path2 = upload_image_to_dir('uploads/', 'image2');
            $img2 = $path2['path'];
            if(empty($path2['path']))
                $img2 = $existing_img2;
            $battery_details->photo_2 = $img2;
            
            $battery_details->issue_type_3 = $issue_type_3;
            $battery_details->remarks_3 = $remarks_3;
            $path3 = upload_image_to_dir('uploads/', 'image3'); 
            $img3 = $path3['path'];
            if(empty($path3['path']))
                $img3 = $existing_img3;
            $battery_details->photo_3 = $img3;
            
            $battery_details->issue_type_4 = $issue_type_4;
            $battery_details->remarks_4 = $remarks_4;
            $path4 = upload_image_to_dir('uploads/', 'image4'); 
            $img4 = $path4['path'];
            if(empty($path4['path']))
                $img4 = $existing_img4;
            $battery_details->photo_4 = $img4;
            
            $battery_details->replaced_serial_no = $replaced_serial_no;
            $battery_details->module_repairable = $module_repairable;
            $battery_details->module_repaired_in = $module_repaired_in;
            $battery_details->cell_replaced = $cell_replaced;
            $battery_details->bms_replaced = $bms_replaced;
            $battery_details->software_updated = $software_updated;
            $battery_details->updated_software_version = $updated_software_version;
            $battery_details->cable_loom_replaced = $cable_loom_replaced;
            $battery_details->module_body_parts_replaced = $module_body_parts_replaced;
            $battery_details->module_charged_up = $module_charged_up;
            $battery_details->cell_level_charger_used = $cell_level_charger_used;
            $battery_details->rework_note = $rework_note;
            $battery_details->rework_module_soc = $rework_module_soc;
            $battery_details->rework_module_voltage = $rework_module_voltage;
            $battery_details->narada_rep_present = $narada_rep_present;
            $battery_details->cell_level_charger_used = $cell_level_charger_used;
            
            for($i = 1; $i <= 15; $i++){
                $rework_cell_name = 'rework_cell'.$i;
                if(!empty($rework_cell[$i]))
                    $battery_details->$rework_cell_name = $rework_cell[$i];
            }

           // echo "<pre>"; print_r($battery_details); die;
            $this->load->model('usermodel');
            
            $upd_id = $this->usermodel->updatePojo('', '', 'rework_data', $battery_details);
            if($save_type == '1'){
               $arr = array();
               $arr['status'] = 'success';
               $arr['serial_number'] = $serial_no;
               echo json_encode($arr);
               return;
            }
            //$upd_id = 0;
            if($upd_id){
                $this->session->set_flashdata('message', 'Succesfully added battery rework data for serial no '.$serial_no);
                redirect('cases'); 
            }
        }
        
        public function save_cbms_data(){
            
            $user = get_loggedin_user(); 
            if(empty($user)){
                $this->session->set_flashdata('error', 'Please provide your email id to proceed');
                redirect('home');
            }
            
            $date = $this->input->post("my_date", true);
            $time = $this->input->post("my_time", true);
            $serial_no = $this->input->post("serial_number", true);
            if(empty($serial_no) || empty($date)){
                $this->session->set_flashdata('error', 'Please enter all data carefully');
                redirect('cases');
            }
            $id = $this->input->post("id", true);
            $save_type = $this->input->post("save_type", true);
            $form_type = $this->input->post("form_type", true);
            $site_option = $this->input->post("site_option", true);
            $site_id = $this->input->post("site_id", true);
            $site_name = $this->input->post("site_name", true);
            $city = $this->input->post("city", true);
            $circle = $this->input->post("circle", true);
            $current_software_version = $this->input->post("current_software_version", true);
           
            $issue_type_1 = $this->input->post("issue_type_1", true);
            $remarks_1 = $this->input->post("remarks_1", true);
            
            $issue_type_2 = $this->input->post("issue_type_2", true);
            $remarks_2 = $this->input->post("remarks_2", true);
            
            $issue_type_3 = $this->input->post("issue_type_3", true);
            $remarks_3 = $this->input->post("remarks_3", true);
            
            $issue_type_4 = $this->input->post("issue_type_4", true);
            $remarks_4 = $this->input->post("remarks_4", true);
            
            $module_repaired_in = $this->input->post("module_repaired_in", true);
            $software_updated = $this->input->post("software_updated", true);
            $updated_software_version = $this->input->post("updated_software_version", true);
            $control_card_replaced = $this->input->post("control_card_replaced", true);
            $disconnector_card_replaced = $this->input->post("disconnector_card_replaced", true);
            $internal_cables_replaced = $this->input->post("internal_cables_replaced", true);
            $external_cables_replaced = $this->input->post("external_cables_replaced", true);
            $communication_status = $this->input->post("communication_status", true);
            $pp_connector_status = $this->input->post("pp_connector_status", true);
            $battery_connector_status = $this->input->post("battery_connector_status", true);
           
            $rework_note = $this->input->post("rework_note", true);
            
           
            $battery_details = new stdClass();
            if($id){
                $battery_details->id = $id;
                $battery_details->updated_by = $user->email;
            } else
                $battery_details->created_by = $user->email;
            $battery_details->save_type = $save_type;
            $battery_details->rework_type = 2;
            $battery_details->datecreated = $date." ".$time;
            $battery_details->serial_no = $serial_no;
            $battery_details->site_option = $site_option;
            $battery_details->site_id = $site_id;
            $battery_details->site_name = $site_name;
            $battery_details->city = $city;
            $battery_details->circle = $circle;
            $battery_details->current_software_version = $current_software_version;
            
            $battery_details->issue_type_1 = $issue_type_1;
            $battery_details->remarks_1 = $remarks_1;

            $battery_details->issue_type_2 = $issue_type_2;
            $battery_details->remarks_2 = $remarks_2;
            
            $battery_details->issue_type_3 = $issue_type_3;
            $battery_details->remarks_3 = $remarks_3;
            
            $battery_details->issue_type_4 = $issue_type_4;
            $battery_details->remarks_4 = $remarks_4;
            
            $battery_details->module_repaired_in = $module_repaired_in;
            $battery_details->software_updated = $software_updated;
            $battery_details->updated_software_version = $updated_software_version;
            $battery_details->control_card_replaced = $control_card_replaced;
            $battery_details->disconnector_card_replaced = $disconnector_card_replaced;
            $battery_details->internal_cables_replaced = $internal_cables_replaced;
            $battery_details->external_cables_replaced = $external_cables_replaced;
            $battery_details->communication_status = $communication_status;
            $battery_details->pp_connector_status = $pp_connector_status;
            $battery_details->rework_note = $rework_note;
            $battery_details->battery_connector_status = $battery_connector_status;

            
            $this->load->model('usermodel');
            //echo "<pre>"; print_r($battery_details); die;
            $upd_id = $this->usermodel->updatePojo('', '', 'rework_data', $battery_details);
            if($save_type == '1'){
               $arr = array();
               $arr['status'] = 'success';
               $arr['serial_number'] = $serial_no;
               echo json_encode($arr);
               return;
            }
            if($upd_id){
                $this->session->set_flashdata('message', 'Succesfully added CBMS rework data for serial no '.$serial_no);
                redirect('cases'); 
            }
            //$chk_lookup = $this->usermodel->getPojo('site_data', null, 'battery_data', 'id', 1, null, null, null);

        }
        
        public function download_report(){
            $serial_no = $this->input->post('serial_number', true);
            if(!empty($serial_no)){
                $this->load->model('usermodel');
                //$chk_lookup = $this->usermodel->getPojo('site_data', null, 'rework_data', 'serial_no', $serial_no, null, null, null);
                
                
                $chk_lookups = $this->usermodel->getPojos('site_data', $sql, null, 'rework_data', 'serial_no', $serial_no, null, null, 'id asc');
                
                if(!empty($chk_lookups)){
                    $i = 0;
                    $type = '';
                    $arr_title = array();$arr_vals = array();
                    $battery_fields = array("id","rework_type","created_by","updated_by","serial_no","site_id","site_option","site_name","city","circle","current_software_version","module_soc","module_voltage","cell1","cell2","cell3","cell4","cell5","cell6","cell7","cell8","cell9","cell10","cell11","cell12","cell13","cell14","cell15","cell_temp_1","cell_temp_2","cell_temp_3","cell_temp_4","cell_temp_5","issue_type_1","remarks_1","photo_1","issue_type_2","remarks_2","photo_2","issue_type_3","remarks_3","photo_3","issue_type_4","remarks_4","photo_4","replaced_serial_no","module_repairable","module_repaired_in","cell_replaced","bms_replaced","software_updated","updated_software_version","cable_loom_replaced","module_body_parts_replaced","module_charged_up","cell_level_charger_used","rework_note","rework_module_soc","rework_module_voltage","narada_rep_present","rework_cell1","rework_cell2","rework_cell3","rework_cell4","rework_cell5","rework_cell6","rework_cell7","rework_cell8","rework_cell9","rework_cell10","rework_cell11","rework_cell12","rework_cell13","rework_cell14","rework_cell15","datecreated","dateupdated");
                    $cbms_fields = array("id","rework_type","created_by","updated_by","serial_no","site_id","site_option","site_name","city","circle","current_software_version","issue_type_1","remarks_1","issue_type_2","remarks_2","issue_type_3","remarks_3","issue_type_4","remarks_4","module_repaired_in","software_updated","updated_software_version","control_card_replaced","disconnector_card_replaced","internal_cables_replaced","external_cables_replaced","pp_connector_status","communication_status","battery_connector_status","rework_note");
                    $site_option = array("ODC","GBM","Pre Fab Shelter","Warehouse");
                    $issue_type_1 = array("","BMS Issue / Faulty","Cable Harness / Hardware Issue","Battery Terminals Loose/Broken/Corroded","Plastic Cap loose / missing","Battery Cell Swollen","Battery Cell Leakage","Cell Sleeve Damage","Unbalanced Cell voltage (>0.5V)","Cell Deep Discharge","PRV faulty","Grouping sticker missing","Module Deep Discharge","Module Body Rusted");
                    $issue_type_2 = array("","Comm. Cross Connection","PP Anderson Cntr. Crimping/Loose","Battery Anderson Cntr. Crimping/Loose","SMPS to CBMS Comm Fail","Battery to CBMS Comm Fail","CBMS Control Card Faulty","Disconnector Card Faulty","Web Page not Working","Ethernet Cable Faulty","Ribbon Cable Faulty","CBMS Loom Cable Faulty","Module Idle due to CBMS","Memory Card Issue","CBMS Fan Fail","CBMS Power Resitor Burnt","Old Software Version Present");
                    $module_repaired_in = array("Warehouse","Site","BRC");
                    $circle = array("", "Mumbai", "Gujarat", "Kolkata", "Kerala", "Bihar & Assam", "NCR");
                    foreach($chk_lookups as $chk_lookup){
                        if($i == 0)
                            $type = $chk_lookup->rework_type;
                        
                        if($type == 1){
                            $fields_array = $battery_fields;
                            $issue_type = $issue_type_1;
                        }else{
                            $fields_array = $cbms_fields;
                            $issue_type = $issue_type_2;
                        }

                        
                        foreach ($chk_lookup as $key=>$value){
                            if(in_array($key, $fields_array)){
                                if($i == 0)
                                    $arr_title[] = ucwords(str_replace('_', ' ', $key));
                                if($key == 'site_option')
                                    $value = $site_option[$value];
                                if (strpos($key, 'issue_type') === 0)
                                    $value = $issue_type[$value];
                                if($key == 'module_repaired_in')
                                    $value = $module_repaired_in[$value];
                                if($key == 'serial_no')
                                    $value = "'".$value."'";
                                if($key == 'circle')
                                    $value = $circle[$value];
                                if ((strpos($key,'photo') !== false) && !empty($value)) {
                                    $value = base_url().$value;
}
                                $arr_vals[$i][] = $value;
                            }
                        }
                        $i++;
                    }
                    
                    $rework_type = ($type == 1) ? 'battery' : 'cbms';
                    $filename = $rework_type."_data_" . date('d-M-y-h:i:A') . ".xls";
                    header("Content-Disposition: attachment; filename=\"$filename\"");
                    header("Content-Type: application/vnd.ms-excel");

                    echo implode("\t", $arr_title) . "\r\n";
                    foreach($arr_vals as $arr_val){
                        echo implode("\t", $arr_val) . "\r\n";
                    }
                    
                } else{
                    $this->session->set_flashdata('error', 'Either serial number is wrong or data not present');
                    redirect('home/download_report');
                }
                exit;
            }
            $this->load->view('download_view', $this->data);
        }
        public function saved_cases($type = ''){
            $this->data['type'] = $type;
            error_reporting(E_ALL);
            if(empty($type))
                redirect('cases');
            if($type == 'battery'){
                $type = 1;
            } else if($type == 'cbms'){
                $type = 2;
            } else{
                $this->session->set_flashdata('error', 'Case type is incorrect');
                redirect('cases');
            }
            $this->load->model('usermodel');
            
            $this->data['saved_cases'] = $this->usermodel->getPojos('', null, null, 'rework_data', 'save_type', 1, 'rework_type', $type, null);
            $this->load->view('saved_cases', $this->data);
        }
}