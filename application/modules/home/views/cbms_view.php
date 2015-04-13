<?php echo modules::run('home/header') ?>
<div class="content_wrapper">
        
	<div id="bodyContent">
            <div class="save_loader">
                <img src="<?=base_url()?>images/loader_blue.gif" width="70px"/>
            </div>
            <div class="form-bat-head">CBMS Fault Screen</div>
                <div class="contentWrapper<?=($is_mobile) ? ' right_swipe' : '' ?>">
                <?php
                        $attributes = array('name' => 'cbms_data_form', 'id' => 'cbms_data_form');
                        echo form_open('home/save_cbms_data', $attributes);
                        ?>
                        <div id="summary" >&nbsp;</div>
                        <input type="hidden" name="id" value="<?=$battery_saved_data->id?>" />
                        <div class="faultScreen">
                            <input id="save_type" type="hidden" name="save_type" value="" />
                            <div class="label_input_container">
                                <label class="label_text">Date:</label>
                                <input name="my_date" val="" type="text" id="autodate" class="autodate textBox" >
                            </div>
                            <div class="label_input_container">
                                <label class="label_text">CBMS Serial no:</label>
                                <input type="text" class="textBox" name="serial_number" value="<?=$serial_no?>">
                            </div>
                            <div class="label_input_container">
                                <label class="label_text">Type Of Site:</label>
                                <select name="site_option" class="textBox selectBox req_field">
                                    <option value="">Select</option>
                                    <option value="1" <?=($battery_saved_data->site_option == 1) ? 'selected' : ''?>>ODC</option>
                                    <option value="2" <?=($battery_saved_data->site_option == 2) ? 'selected' : ''?>>GBM</option>
                                    <option value="3" <?=($battery_saved_data->site_option == 3) ? 'selected' : ''?>>Pre Fab Shelter</option>
                                    <option value="4" <?=($battery_saved_data->site_option == 4) ? 'selected' : ''?>>Warehouse</option>
                                </select>
                            </div>
                            <div class="label_input_container">
                                <label class="label_text">Site Name/Id:</label>
                                <input name="site_name" type="text" value="<?=$battery_saved_data->site_name?>" class="textBox req_field">
                            </div>
                            <div class="label_input_container">
                                <label class="label_text">City:</label>
                                <input name="city" type="text" value="<?=$battery_saved_data->city?>" id="suggest_city" class="textBox req_field" autocomplete="off">
                                <div id="suggestions"></div>
                            </div>
                            <div class="label_input_container">
                                <label class="label_text">Current Software Version:</label>
                                <input name="current_software_version" type="text" class="textBox req_field" value="<?=$battery_saved_data->current_software_version?>">
                            </div>
                            <div class="label_input_container">
                                <label class="label_text">Issue Type 1</label>                                
                                <select name="issue_type_1" class="textBox selectBox req_field">
                                    <option value="">Select</option>
                                    <option value="1" <?=($battery_saved_data->issue_type_1 == 1) ? 'selected' : ''?>>BMS Issue / Faulty</option>
                                    <option value="2" <?=($battery_saved_data->issue_type_1 == 2) ? 'selected' : ''?>>Cable Harness / Hardware Issue</option>
                                    <option value="3" <?=($battery_saved_data->issue_type_1 == 3) ? 'selected' : ''?>>Battery Terminals Loose/Broken/Corroded</option>
                                    <option value="4" <?=($battery_saved_data->issue_type_1 == 4) ? 'selected' : ''?>>Plastic Cap loose / missing</option>
                                    <option value="5" <?=($battery_saved_data->issue_type_1 == 5) ? 'selected' : ''?>>Battery Cell Swollen</option>
                                    <option value="6" <?=($battery_saved_data->issue_type_1 == 6) ? 'selected' : ''?>>Battery Cell Leakage</option>
                                    <option value="7" <?=($battery_saved_data->issue_type_1 == 7) ? 'selected' : ''?>>Cell Sleeve Damage</option>
                                    <option value="8" <?=($battery_saved_data->issue_type_1 == 8) ? 'selected' : ''?>>Unbalanced Cell voltage (>0.5V)</option>
                                    <option value="9" <?=($battery_saved_data->issue_type_1 == 9) ? 'selected' : ''?>>Cell Deep Discharge</option>
                                    <option value="10" <?=($battery_saved_data->issue_type_1 == 10) ? 'selected' : ''?>>PRV faulty</option>
                                    <option value="11" <?=($battery_saved_data->issue_type_1 == 11) ? 'selected' : ''?>>Grouping sticker missing</option>
                                    <option value="12" <?=($battery_saved_data->issue_type_1 == 12) ? 'selected' : ''?>>Module Deep Discharge</option>
                                    <option value="13" <?=($battery_saved_data->issue_type_1 == 13) ? 'selected' : ''?>>Module Body Rusted</option>
                                </select>
                            </div>
                            <div class="label_input_container label_height_cont ">                            
                                <label class="label_text">Remark 1</label>
                                <textarea name="remarks_1" class="textBox req_field check_remark" id="remarks1" placeholder="Enter your remarks"><?=$battery_saved_data->remarks_1?></textarea>
                            </div>
                            <div class="issue_2 moreIssues" style="<?=($battery_saved_data->issue_type_2 || $battery_saved_data->remarks_2) ? 'display:block;' : 'display:none;'?>">
                                <div class="label_input_container">
                                    <label class="label_text">Issue Type 2</label>
                                    <select name="issue_type_2" class="textBox selectBox">
                                        <option value="0">Select</option>
                                        <option value="1" <?=($battery_saved_data->iissue_type_2 == 1) ? 'selected' : ''?>>BMS Issue / Faulty</option>
                                        <option value="2" <?=($battery_saved_data->issue_type_2 == 2) ? 'selected' : ''?>>Cable Harness / Hardware Issue</option>
                                        <option value="3" <?=($battery_saved_data->issue_type_2 == 3) ? 'selected' : ''?>>Battery Terminals Loose/Broken/Corroded</option>
                                        <option value="4" <?=($battery_saved_data->issue_type_2 == 4) ? 'selected' : ''?>>Plastic Cap loose / missing</option>
                                        <option value="5" <?=($battery_saved_data->issue_type_2 == 5) ? 'selected' : ''?>>Battery Cell Swollen</option>
                                        <option value="6" <?=($battery_saved_data->issue_type_2 == 6) ? 'selected' : ''?>>Battery Cell Leakage</option>
                                        <option value="7" <?=($battery_saved_data->issue_type_2 == 7) ? 'selected' : ''?>>Cell Sleeve Damage</option>
                                        <option value="8" <?=($battery_saved_data->issue_type_2 == 8) ? 'selected' : ''?>>Unbalanced Cell voltage (>0.5V)</option>
                                        <option value="9" <?=($battery_saved_data->issue_type_2 == 9) ? 'selected' : ''?>>Cell Deep Discharge</option>
                                        <option value="10" <?=($battery_saved_data->issue_type_2 == 10) ? 'selected' : ''?>>PRV faulty</option>
                                        <option value="11" <?=($battery_saved_data->issue_type_2 == 11) ? 'selected' : ''?>>Grouping sticker missing</option>
                                        <option value="12" <?=($battery_saved_data->issue_type_2 == 12) ? 'selected' : ''?>>Module Deep Discharge</option>
                                        <option value="13" <?=($battery_saved_data->issue_type_2 == 13) ? 'selected' : ''?>>Module Body Rusted</option>
                                    </select>
                                </div>
                                <div class="label_input_container label_height_cont">
                                <label class="label_text">Remark 2</label>
                                <textarea name="remarks_2" class="textBox check_remark" id="remarks2" placeholder="Enter your remarks"><?=$battery_saved_data->remarks_2?></textarea>
                                </div>
                            </div>
                            <div class="issue_3 moreIssues" style="<?=($battery_saved_data->issue_type_2 || $battery_saved_data->remarks_2) ? 'display:block;' : 'display:none;'?>">
                                <div class="label_input_container">
                                    <label class="label_text">Issue Type 3</label>
                                    <select name="issue_type_3" class="textBox selectBox">
                                        <option value="0">Select</option>
                                        <option value="1" <?=($battery_saved_data->iissue_type_3 == 1) ? 'selected' : ''?>>BMS Issue / Faulty</option>
                                        <option value="2" <?=($battery_saved_data->issue_type_3 == 2) ? 'selected' : ''?>>Cable Harness / Hardware Issue</option>
                                        <option value="3" <?=($battery_saved_data->issue_type_3 == 3) ? 'selected' : ''?>>Battery Terminals Loose/Broken/Corroded</option>
                                        <option value="4" <?=($battery_saved_data->issue_type_3 == 4) ? 'selected' : ''?>>Plastic Cap loose / missing</option>
                                        <option value="5" <?=($battery_saved_data->issue_type_3 == 5) ? 'selected' : ''?>>Battery Cell Swollen</option>
                                        <option value="6" <?=($battery_saved_data->issue_type_3 == 6) ? 'selected' : ''?>>Battery Cell Leakage</option>
                                        <option value="7" <?=($battery_saved_data->issue_type_3 == 7) ? 'selected' : ''?>>Cell Sleeve Damage</option>
                                        <option value="8" <?=($battery_saved_data->issue_type_3 == 8) ? 'selected' : ''?>>Unbalanced Cell voltage (>0.5V)</option>
                                        <option value="9" <?=($battery_saved_data->issue_type_3 == 9) ? 'selected' : ''?>>Cell Deep Discharge</option>
                                        <option value="10" <?=($battery_saved_data->issue_type_3 == 10) ? 'selected' : ''?>>PRV faulty</option>
                                        <option value="11" <?=($battery_saved_data->issue_type_3 == 11) ? 'selected' : ''?>>Grouping sticker missing</option>
                                        <option value="12" <?=($battery_saved_data->issue_type_3 == 12) ? 'selected' : ''?>>Module Deep Discharge</option>
                                        <option value="13" <?=($battery_saved_data->issue_type_3 == 13) ? 'selected' : ''?>>Module Body Rusted</option>
                                    </select>
                                </div>
                                <div class="label_input_container label_height_cont">
                                <label class="label_text">Remark 3</label>
                                <textarea name="remarks_3" class="textBox check_remark" id="remarks3" placeholder="Enter your remarks"><?=$battery_saved_data->remarks_3?></textarea>
                                </div>
                            </div>
                            <div class="issue_4 moreIssues" style="<?=($battery_saved_data->issue_type_2 || $battery_saved_data->remarks_2) ? 'display:block;' : 'display:none;'?>">
                                <div class="label_input_container">
                                    <label class="label_text">Issue Type 4</label>
                                    <select name="issue_type_4" class="textBox selectBox">
                                        <option value="0">Select</option>
                                        <option value="1" <?=($battery_saved_data->iissue_type_4 == 1) ? 'selected' : ''?>>BMS Issue / Faulty</option>
                                        <option value="2" <?=($battery_saved_data->issue_type_4 == 2) ? 'selected' : ''?>>Cable Harness / Hardware Issue</option>
                                        <option value="3" <?=($battery_saved_data->issue_type_4 == 3) ? 'selected' : ''?>>Battery Terminals Loose/Broken/Corroded</option>
                                        <option value="4" <?=($battery_saved_data->issue_type_4 == 4) ? 'selected' : ''?>>Plastic Cap loose / missing</option>
                                        <option value="5" <?=($battery_saved_data->issue_type_4 == 5) ? 'selected' : ''?>>Battery Cell Swollen</option>
                                        <option value="6" <?=($battery_saved_data->issue_type_4 == 6) ? 'selected' : ''?>>Battery Cell Leakage</option>
                                        <option value="7" <?=($battery_saved_data->issue_type_4 == 7) ? 'selected' : ''?>>Cell Sleeve Damage</option>
                                        <option value="8" <?=($battery_saved_data->issue_type_4 == 8) ? 'selected' : ''?>>Unbalanced Cell voltage (>0.5V)</option>
                                        <option value="9" <?=($battery_saved_data->issue_type_4 == 9) ? 'selected' : ''?>>Cell Deep Discharge</option>
                                        <option value="10" <?=($battery_saved_data->issue_type_4 == 10) ? 'selected' : ''?>>PRV faulty</option>
                                        <option value="11" <?=($battery_saved_data->issue_type_4 == 11) ? 'selected' : ''?>>Grouping sticker missing</option>
                                        <option value="12" <?=($battery_saved_data->issue_type_4 == 12) ? 'selected' : ''?>>Module Deep Discharge</option>
                                        <option value="13" <?=($battery_saved_data->issue_type_4 == 13) ? 'selected' : ''?>>Module Body Rusted</option>
                                    </select>
                                </div>
                                <div class="label_input_container label_height_cont">
                                <label class="label_text">Remark 4</label>
                                <textarea name="remarks_4" class="textBox check_remark" id="remarks4" placeholder="Enter your remarks"><?=$battery_saved_data->remarks_4?></textarea>
                                </div>
                            </div>
                            
                            <div class="label_input_container label_height_cont add_more_issues">
                                <p class="add_more_issue">Add more issues</p>
                            </div>
                            <div class="label_input_container form_button_wrapper">
                                <div class="form_btn" id="save_form_cbms_proceed">
                                    <p>SAVE</p>
                                </div>
                                <div class="form_btn next">
                                    <p>NEXT</p>
                                </div>
                            </div>
                        </div>
                        <div class="reworkScreen" style="display: none;">
                            <div class="label_input_container">
                                <label class="label_text">Date:</label>
                                <input name="date_2" type="text" id="autodate" class="autodate textBox" disabled>
                            </div>
                            <div class="label_input_container">
                                <label class="label_text">CBMS Serial no:</label>
                                <input name="serial_no_2" type="text" class="textBox" value="<?=$serial_no?>" disabled>
                            </div>
                            <div class="label_input_container">
                                <label class="label_text">CBMS Repaired in:</label>
                                <select name="module_repaired_in" class="textBox selectBox">
                                    <option value="0" <?=($battery_saved_data->module_repaired_in == 0) ? 'selected' : ''?>>Warehouse</option>
                                    <option value="1" <?=($battery_saved_data->module_repaired_in == 1) ? 'selected' : ''?>>Site</option>
                                    <option value="1" <?=($battery_saved_data->module_repaired_in == 2) ? 'selected' : ''?>>BRC</option>
                                </select>
                            </div>
                            <div class="label_input_container">
                                <label class="label_text">Software Updated:</label>
                                <select name="software_updated" class="textBox selectBox">
                                    <option value="0" <?=($battery_saved_data->software_updated == 0) ? 'selected' : ''?>>No</option>
                                    <option value="1" <?=($battery_saved_data->software_updated == 1) ? 'selected' : ''?>>Yes</option>
                                </select>
                            </div>
                            <div class="label_input_container">
                                <label class="label_text">New Software Version:</label>
                                <input name="updated_software_version" type="text" class="textBox" value="<?=$battery_saved_data->updated_software_version?>">
                            </div>
                            <div class="label_input_container">
                                <label class="label_text">Control Card Replaced:</label>
                                <select name="control_card_replaced" class="textBox selectBox">
                                    <option value="0" <?=($battery_saved_data->control_card_replaced == 0) ? 'selected' : ''?>>No</option>
                                    <option value="1" <?=($battery_saved_data->control_card_replaced == 1) ? 'selected' : ''?>>Yes</option>
                                </select>
                            </div>
                            <div class="label_input_container">
                                <label class="label_text">Dis-Connector card Replaced:</label>
                                <select name="disconnector_card_replaced" class="textBox selectBox">
                                    <option value="0" <?=($battery_saved_data->disconnector_card_replaced == 0) ? 'selected' : ''?>>No</option>
                                    <option value="1" <?=($battery_saved_data->disconnector_card_replaced == 1) ? 'selected' : ''?>>Yes</option>
                                </select>
                            </div>
                            <div class="label_input_container">
                                <label class="label_text">Internal Cables Replaced:</label>
                                <select name="internal_cables_replaced" class="textBox selectBox">
                                    <option value="0" <?=($battery_saved_data->internal_cables_replaced == 0) ? 'selected' : ''?>>No</option>
                                    <option value="1" <?=($battery_saved_data->internal_cables_replaced == 1) ? 'selected' : ''?>>Yes</option>
                                </select>
                            </div>
                            <div class="label_input_container">
                                <label class="label_text">External Cables Replaced:</label>
                                <select name="external_cables_replaced" class="textBox selectBox">
                                    <option value="0" <?=($battery_saved_data->external_cables_replaced == 0) ? 'selected' : ''?>>No</option>
                                    <option value="1" <?=($battery_saved_data->external_cables_replaced == 1) ? 'selected' : ''?>>Yes</option>
                                </select>
                            </div>
                            <div class="label_input_container">
                                <label class="label_text">Communication OK:</label>
                                <select name="communication_status" class="textBox selectBox">
                                    <option value="0" <?=($battery_saved_data->communication_status == 0) ? 'selected' : ''?>>No</option>
                                    <option value="1" <?=($battery_saved_data->communication_status == 1) ? 'selected' : ''?>>Yes</option>
                                </select>
                            </div>
                            <div class="label_input_container">
                                <label class="label_text">PP Connector OK:</label>
                                <select name="pp_connector_status" class="textBox selectBox">
                                    <option value="0" <?=($battery_saved_data->pp_connector_status == 0) ? 'selected' : ''?>>No</option>
                                    <option value="1" <?=($battery_saved_data->pp_connector_status == 1) ? 'selected' : ''?>>Yes</option>
                                </select>
                            </div>
                            <div class="label_input_container">
                                <label class="label_text">Battery Connector OK:</label>
                                <select name="battery_connector_status" class="textBox selectBox">
                                    <option value="0" <?=($battery_saved_data->battery_connector_status == 0) ? 'selected' : ''?>>No</option>
                                    <option value="1" <?=($battery_saved_data->battery_connector_status == 1) ? 'selected' : ''?>>Yes</option>
                                </select>
                            </div>                        
                            <div class="label_input_container label_height_cont">                            
                                <label class="label_text">Rework Note</label>
                                <textarea name="rework_note" id="rework_note" class="textBox remarks req_field check_remark" placeholder="Enter Remarks"><?=$battery_saved_data->rework_note?></textarea>
                            </div>  
                            <div class="label_input_container form_button_wrapper">
                                <div class="form_btn right" id="save_rework_cbms_proceed">
                                    <p>SAVE</p>
                                </div>
                                <div class="form_btn back">
                                    <p>BACK</p>
                                </div>
                            </div>
                            <div class="label_input_container">
                                <div class="battery_proceedWrapper battery_proceed" id="form_cbms_proceed">
                                    <div class="battery_proceedButton">
                                        <p>SUBMIT</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                    </form>
                </div>
        </div>
</div>
<?php echo modules::run('home/footer') ?>