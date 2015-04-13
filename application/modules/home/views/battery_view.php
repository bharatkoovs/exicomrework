<?php echo modules::run('home/header') ?>
<div class="content_wrapper">
    
	<div id="bodyContent">
                <div class="save_loader">
                    <img src="<?=base_url()?>images/loader_blue.gif" width="70px"/>
                </div>
                <div class="form-bat-head" data-fault="Battery Fault Screen" data-rework="Battery Rework Screen">Battery Fault Screen</div>
                <div class="contentWrapper<?=($is_mobile) ? ' right_swipe' : '' ?>">
                     <?php
                            $attributes = array('name' => 'battery_data_form', 'id' => 'battery_data_form', 'class' => "battery_data_form", "enctype" => "multipart/form-data");
                            echo form_open('home/save_battery_data', $attributes);
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
                                <label class="label_text">Battery Serial no:</label>
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
                                <label class="label_text">Site Name:</label>
                                <input name="site_name" type="text" value="<?=$battery_saved_data->site_name?>" class="textBox req_field">
                            </div>
                            <div class="label_input_container">
                                <label class="label_text">City:</label>
                                <input name="city" type="text" value="<?=$battery_saved_data->city?>" id="suggest_city" class="textBox req_field" autocomplete="off">
                                <div id="suggestions"></div>
                            </div>
                            <div class="label_input_container">
                                <label class="label_text">BMS Current Software Version:</label>
                                <input name="current_software_version" type="text" class="textBox req_field" value="<?=$battery_saved_data->current_software_version?>">
                            </div>
                            <div class="label_input_container">
                                <label class="label_text">Module SoC</label>
                                <input name="module_soc" type="text" value="<?=$battery_saved_data->module_soc?>" class="textBox req_field">
                            </div>
                            <div class="label_input_container">
                                <label class="label_text">Module Voltage</label>
                                <input name="module_voltage" type="text" value="<?=$battery_saved_data->module_voltage ? $battery_saved_data->module_voltage."V" : ''?>" class="textBox voltage_data"  placeholder="XX.XV">
                            </div>
                            <div class="label_input_container">
                                <label class="label_text">Cell1 Voltage</label>
                                <input name="cell1" type="text" class="textBox voltage_data" value="<?=$battery_saved_data->cell1 ? $battery_saved_data->cell1."V" : ''?>" placeholder="XX.XV">
                            </div>
                            <div class="label_input_container">
                                <label class="label_text">Cell2 Voltage</label>
                                <input name="cell2" type="text" class="textBox voltage_data" value="<?=$battery_saved_data->cell2 ? $battery_saved_data->cell2."V" : ''?>" placeholder="XX.XV">
                            </div>
                            <div class="label_input_container">
                                <label class="label_text">Cell3 Voltage</label>
                                <input name="cell3" type="text" class="textBox voltage_data" value="<?=$battery_saved_data->cell3 ? $battery_saved_data->cell3."V" : ''?>" placeholder="XX.XV">
                            </div>
                            <div class="label_input_container">
                                <label class="label_text">Cell4 Voltage</label>
                                <input name="cell4" type="text" class="textBox voltage_data" value="<?=$battery_saved_data->cell4 ? $battery_saved_data->cell4."V" : ''?>" placeholder="XX.XV">
                            </div>
                            <div class="label_input_container">
                                <label class="label_text">Cell5 Voltage</label>
                                <input name="cell5" type="text" class="textBox voltage_data" value="<?=$battery_saved_data->cell5 ? $battery_saved_data->cell5."V" : ''?>" placeholder="XX.XV">
                            </div>
                            <div class="label_input_container">
                                <label class="label_text">Cell6 Voltage</label>
                                <input name="cell6" type="text" class="textBox voltage_data" value="<?=$battery_saved_data->cell6 ? $battery_saved_data->cell6."V" : ''?>" placeholder="XX.XV">
                            </div>
                            <div class="label_input_container">
                                <label class="label_text">Cell7 Voltage</label>
                                <input name="cell7" type="text" class="textBox voltage_data" value="<?=$battery_saved_data->cell7 ? $battery_saved_data->cell7."V" : ''?>" placeholder="XX.XV">
                            </div>
                            <div class="label_input_container">
                                <label class="label_text">Cell8 Voltage</label>
                                <input name="cell8" type="text" class="textBox voltage_data" value="<?=$battery_saved_data->cell8 ? $battery_saved_data->cell8."V" : ''?>" placeholder="XX.XV">
                            </div>
                            <div class="label_input_container">
                                <label class="label_text">Cell9 Voltage</label>
                                <input name="cell9" type="text" class="textBox voltage_data" value="<?=$battery_saved_data->cell9 ? $battery_saved_data->cell9."V" : ''?>" placeholder="XX.XV">
                            </div>
                            <div class="label_input_container">
                                <label class="label_text">Cell10 Voltage</label>
                                <input name="cell10" type="text" class="textBox voltage_data" value="<?=$battery_saved_data->cell10 ? $battery_saved_data->cell10."V" : ''?>" placeholder="XX.XV">
                            </div>
                            <div class="label_input_container">
                                <label class="label_text">Cell11 Voltage</label>
                                <input name="cell11" type="text" class="textBox voltage_data" value="<?=$battery_saved_data->cell11 ? $battery_saved_data->cell11."V" : ''?>" placeholder="XX.XV">
                            </div>
                            <div class="label_input_container">
                                <label class="label_text">Cell12 Voltage</label>
                                <input name="cell12" type="text" class="textBox voltage_data" value="<?=$battery_saved_data->cell12 ? $battery_saved_data->cell12."V" : ''?>" placeholder="XX.XV">
                            </div>
                            <div class="label_input_container">
                                <label class="label_text">Cell13 Voltage</label>
                                <input name="cell13" type="text" class="textBox voltage_data" value="<?=$battery_saved_data->cell13 ? $battery_saved_data->cell13."V" : ''?>" placeholder="XX.XV">
                            </div>
                            <div class="label_input_container">
                                <label class="label_text">Cell14 Voltage</label>
                                <input name="cell14" type="text" class="textBox voltage_data" value="<?=$battery_saved_data->cell14 ? $battery_saved_data->cell14."V" : ''?>" placeholder="XX.XV">
                            </div>
                            <div class="label_input_container">
                                <label class="label_text">Cell15 Voltage</label>
                                <input name="cell15" type="text" class="textBox voltage_data" value="<?=$battery_saved_data->cell15 ? $battery_saved_data->cell15."V" : ''?>" placeholder="XX.XV">
                            </div>
                            <div class="label_input_container">
                                <label class="label_text">Cell 1 Temp</label>
                                <input name="cell_temp_1" type="text" class="textBox temprature_data" value="<?=$battery_saved_data->cell_temp_1?>" placeholder="XX.X">
                            </div>
                            <div class="label_input_container">
                                <label class="label_text">Cell 2 Temp</label>
                                <input name="cell_temp_2" type="text" class="textBox temprature_data" value="<?=$battery_saved_data->cell_temp_2?>" placeholder="XX.X">
                            </div>
                            <div class="label_input_container">
                                <label class="label_text">Cell 3 Temp</label>
                                <input name="cell_temp_3" type="text" class="textBox temprature_data" value="<?=$battery_saved_data->cell_temp_3?>" placeholder="XX.X">
                            </div>
                            <div class="label_input_container">
                                <label class="label_text">Cell 4 Temp</label>
                                <input name="cell_temp_4" type="text" class="textBox temprature_data" value="<?=$battery_saved_data->cell_temp_4?>" placeholder="XX.X">
                            </div>
                            <div class="label_input_container">
                                <label class="label_text">Cell 5 Temp</label>
                                <input name="cell_temp_5" type="text" class="textBox temprature_data" value="<?=$battery_saved_data->cell_temp_5?>" placeholder="XX.X">
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
                            <div class="label_input_container label_height_cont">
                                <label class="label_text">Remark 1</label>
                                <textarea name="remarks_1" class="textBox check_remark" id="remarks1" placeholder="Enter your remarks"><?=$battery_saved_data->remarks_1?></textarea>
                            </div>
                            <div class="label_input_container label_image_cont">
                                <label class="label_text">Photo 1</label>
                                <div class="custom_file_upload">
                                    <input type="text" class="file file1" name="file_info">
                                    <div class="file_upload">
                                        <input name="image1" type="file" data-count="1" class="img_upload img_upload1">
                                    </div>
                                </div>
                                <output id="list1"></output>
                                <input type="hidden" id="existing_image1" name="existing_image1" value="<?=$battery_saved_data->photo_1?>">
                                <div class="image2_cont image_cont">
                                    <?php if(!empty($battery_saved_data->photo_1)){ ?>
                                        <img class="current_img1 thumb" src="<?=base_url().$battery_saved_data->photo_1?>"/>
                                        <span class="remove_img remove_img1" data-img="1">Remove</span>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="issue_2 moreIssues" style="<?=($battery_saved_data->issue_type_2 || $battery_saved_data->remarks_2 || $battery_saved_data->photo_2) ? 'display:block;' : 'display:none;'?>">
                                <div class="label_input_container">
                                    <label class="label_text">Issue Type 2</label>
                                    <select name="issue_type_2" class="textBox selectBox">
                                        <option value="0">Select</option>
                                        <option value="1" <?=($battery_saved_data->issue_type_2 == 1) ? 'selected' : ''?>>BMS Issue / Faulty</option>
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
                                <div class="label_input_container label_image_cont">
                                    <label class="label_text">Photo 2</label>
                                    <div class="custom_file_upload">
                                        <input type="text" class="file file2" name="file_info">
                                        <div class="file_upload">
                                            <input id="file_upload" name="image2" type="file" data-count="2" class="img_upload img_upload2">
                                        </div>
                                    </div>
                                    <output id="list2"></output>
                                    <input type="hidden" id="existing_image2" name="existing_image2" value="<?=$battery_saved_data->photo_2?>">
                                    <div class="image2_cont image_cont">
                                    <?php if(!empty($battery_saved_data->photo_2)){?>
                                        <img class="current_img2 thumb" src="<?=base_url().$battery_saved_data->photo_2?>"/>
                                        <span class="remove_img remove_img2" data-img="2">Remove</span>
                                    <?php }?>
                                    </div>
                                </div>
                            </div>
                            <div class="issue_3 moreIssues" style="<?=($battery_saved_data->issue_type_3 || $battery_saved_data->remarks_3 || $battery_saved_data->photo_3) ? 'display:block;' : 'display:none;'?>">
                                <div class="label_input_container">
                                    <label class="label_text">Issue Type 3</label>
                                    <select name="issue_type_3" class="textBox selectBox">
                                        <option value="0">Select</option>
                                        <option value="1" <?=($battery_saved_data->issue_type_3 == 1) ? 'selected' : ''?>>BMS Issue / Faulty</option>
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
                                <div class="label_input_container label_image_cont">
                                <label class="label_text">Remark 3</label>
                                <textarea name="remarks_3" class="textBox check_remark" id="remarks3" placeholder="Enter your remarks"><?=$battery_saved_data->remarks_3?></textarea>
                                </div>
                                <div class="label_input_container label_image_cont">
                                    <label class="label_text">Photo 3</label>
                                    <div class="custom_file_upload">
                                        <input type="text" class="file file3" name="file_info">
                                        <div class="file_upload">
                                                <input name="image3" type="file" data-count="3" class="img_upload img_upload3">
                                        </div>
                                    </div>
                                    <output id="list3"></output>
                                    <input type="hidden" id="existing_image3" name="existing_image3" value="<?=$battery_saved_data->photo_3?>">
                                    <div class="image3_cont image_cont">
                                    <?php if(!empty($battery_saved_data->photo_3)){?>
                                        <img class="current_img3 thumb" src="<?=base_url().$battery_saved_data->photo_3?>"/>
                                        <span class="remove_img remove_img3" data-img="3">Remove</span>
                                    <?php }?>
                                    </div>
                                </div>
                            </div>
                            <div class="issue_4 moreIssues" style="<?=($battery_saved_data->issue_type_4 || $battery_saved_data->remarks_4 || $battery_saved_data->photo_4) ? 'display:block;' : 'display:none;'?>">
                                <div class="label_input_container">
                                    <label class="label_text">Issue Type 4</label>
                                    <select name="issue_type_4" class="textBox selectBox">
                                        <option value="0">Select</option>
                                        <option value="1" <?=($battery_saved_data->issue_type_4 == 1) ? 'selected' : ''?>>BMS Issue / Faulty</option>
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
                                <div class="label_input_container label_image_cont">
                                    <label class="label_text">Photo 4</label>
                                    <div class="custom_file_upload">
                                        <input type="text" class="file file4" name="file_info">
                                        <div class="file_upload">
                                            <input name="image4" type="file" data-count="4" class="img_upload img_upload4">
                                        </div>
                                    </div>
                                    <output id="list4"></output>
                                    <input type="hidden" id="existing_image4" name="existing_image4" value="<?=$battery_saved_data->photo_4?>">
                                    <div class="image4_cont image_cont">
                                    <?php if(!empty($battery_saved_data->photo_4)){?>
                                        <img class="current_img4 thumb" src="<?=base_url().$battery_saved_data->photo_4?>"/>
                                        <span class="remove_img remove_img4" data-img="4">Remove</span>
                                    <?php }?>
                                    </div>
                                </div>
                            </div>
                            <div class="label_input_container label_height_cont add_more_issues">
                                <p class="add_more_issue">Add more issues</p>
                            </div>
                            <div class="label_input_container form_button_wrapper">
                                <div class="form_btn" id="save_form_battery_proceed">
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
                                <label class="label_text">Battery Serial no:</label>
                                <input name="serial_no_2" type="text" class="textBox" value="<?=$serial_no?>" disabled>
                            </div>
                            <div class="label_input_container">
                                <label class="label_text">New Battery Module Sl No:</label>
                                <input name="replaced_serial_no" type="text" class="textBox" value="<?=$battery_saved_data->replaced_serial_no?>">
                            </div>
                            <div class="label_input_container">
                                <label class="label_text">Module Repairable:</label>
                                <select name="module_repairable" class="textBox selectBox">
                                    <option value="0" <?=($battery_saved_data->module_repairable == 0) ? 'selected' : ''?>>No</option>
                                    <option value="1" <?=($battery_saved_data->module_repairable == 1) ? 'selected' : ''?>>Yes</option>
                                </select>
                            </div>
                            <div class="label_input_container">
                                <label class="label_text">Module Repaired in:</label>
                                <select name="module_repaired_in" class="textBox selectBox">
                                    <option value="0" <?=($battery_saved_data->module_repaired_in == 0) ? 'selected' : ''?>>Warehouse</option>
                                    <option value="1" <?=($battery_saved_data->module_repaired_in == 1) ? 'selected' : ''?>>Site</option>
                                    <option value="1" <?=($battery_saved_data->module_repaired_in == 2) ? 'selected' : ''?>>BRC</option>
                                </select>
                            </div>
                            <div class="label_input_container">
                                <label class="label_text">Cells Replaced:</label>
                                <select name="cell_replaced" class="textBox selectBox req_field">
                                    <option value="">Select</option>
                                    <option value="0" <?=($battery_saved_data->cell_replaced === '0') ? 'selected' : ''?>>0</option>
                                    <option value="1" <?=($battery_saved_data->cell_replaced == 1) ? 'selected' : ''?>>1</option>
                                    <option value="2" <?=($battery_saved_data->cell_replaced == 2) ? 'selected' : ''?>>2</option>
                                    <option value="3" <?=($battery_saved_data->cell_replaced == 3) ? 'selected' : ''?>>3</option>
                                    <option value="4" <?=($battery_saved_data->cell_replaced == 4) ? 'selected' : ''?>>4</option>
                                    <option value="5" <?=($battery_saved_data->cell_replaced == 5) ? 'selected' : ''?>>5</option>
                                    <option value="6" <?=($battery_saved_data->cell_replaced == 6) ? 'selected' : ''?>>6</option>
                                    <option value="7" <?=($battery_saved_data->cell_replaced == 7) ? 'selected' : ''?>>7</option>
                                    <option value="8" <?=($battery_saved_data->cell_replaced == 8) ? 'selected' : ''?>>8</option>
                                    <option value="9" <?=($battery_saved_data->cell_replaced == 9) ? 'selected' : ''?>>9</option>
                                    <option value="10" <?=($battery_saved_data->cell_replaced == 10) ? 'selected' : ''?>>10</option>
                                    <option value="11" <?=($battery_saved_data->cell_replaced == 11) ? 'selected' : ''?>>11</option>
                                    <option value="12" <?=($battery_saved_data->cell_replaced == 12) ? 'selected' : ''?>>12</option>
                                    <option value="13" <?=($battery_saved_data->cell_replaced == 13) ? 'selected' : ''?>>13</option>
                                    <option value="14" <?=($battery_saved_data->cell_replaced == 14) ? 'selected' : ''?>>14</option>
                                    <option value="15" <?=($battery_saved_data->cell_replaced == 15) ? 'selected' : ''?>>15</option>
                                </select>
                            </div>
                            <div class="label_input_container">
                                <label class="label_text">BMS Replaced:</label>
                                <select name="bms_replaced" class="textBox selectBox">
                                    <option value="0" <?=($battery_saved_data->bms_replaced == 0) ? 'selected' : ''?>>No</option>
                                    <option value="1" <?=($battery_saved_data->bms_replaced == 1) ? 'selected' : ''?>>Yes</option>
                                </select>
                            </div>
                            <div class="label_input_container">
                                <label class="label_text">BMS Software Updated:</label>
                                <select name="software_updated" class="textBox selectBox">
                                    <option value="0" <?=($battery_saved_data->software_updated == 0) ? 'selected' : ''?>>No</option>
                                    <option value="1" <?=($battery_saved_data->software_updated == 1) ? 'selected' : ''?>>Yes</option>
                                </select>
                            </div>
                            <div class="label_input_container">
                                <label class="label_text">BMS New Software Version:</label>
                                <input name="updated_software_version" type="text" class="textBox" value="<?=$battery_saved_data->updated_software_version?>">
                            </div>
                            <div class="label_input_container">
                                <label class="label_text">Cable Loom Replaced:</label>
                                <select name="cable_loom_replaced" class="textBox selectBox">
                                    <option value="0" <?=($battery_saved_data->cable_loom_replaced == 0) ? 'selected' : ''?>>No</option>
                                    <option value="1" <?=($battery_saved_data->cable_loom_replaced == 1) ? 'selected' : ''?>>Yes</option>
                                </select>
                            </div>
                            <div class="label_input_container">
                                <label class="label_text">Module Body Parts Replaced:</label>
                                <select name="module_body_parts_replaced" class="textBox selectBox">
                                    <option value="0" <?=($battery_saved_data->module_body_parts_replaced == 0) ? 'selected' : ''?>>No</option>
                                    <option value="1" <?=($battery_saved_data->module_body_parts_replaced == 1) ? 'selected' : ''?>>Yes</option>
                                </select>
                            </div>
                            <div class="label_input_container">
                                <label class="label_text">Module Charged Up:</label>
                                <select name="module_charged_up" class="textBox selectBox">
                                    <option value="0" <?=($battery_saved_data->module_charged_up == 0) ? 'selected' : ''?>>No</option>
                                    <option value="1" <?=($battery_saved_data->module_charged_up == 1) ? 'selected' : ''?>>Yes</option>
                                </select>
                            </div>
                            <div class="label_input_container">
                                <label class="label_text">Cell Level Charger Used:</label>
                                <select name="cell_level_charger_used" class="textBox selectBox">
                                    <option value="0" <?=($battery_saved_data->cell_level_charger_used == 0) ? 'selected' : ''?>>No</option>
                                    <option value="1" <?=($battery_saved_data->cell_level_charger_used == 1) ? 'selected' : ''?>>Yes</option>
                                </select>
                            </div>
                            <div class="label_input_container label_height_cont">
                                <label class="label_text">Rework Note:</label>
                                <textarea name="rework_note" id="rework_note" class="textBox remarks req_field check_remark" placeholder="Enter Remarks"><?=$battery_saved_data->rework_note?></textarea>
                            </div>
                            <div class="label_input_container">
                                <label class="label_text">Module SoC</label>
                                <input name="rework_module_soc" type="text" value="<?=$battery_saved_data->rework_module_soc?>" class="textBox req_field">
                            </div>
                            <div class="label_input_container">
                                <label class="label_text">Module Voltage</label>
                                <input name="rework_module_voltage" type="text" value="<?=$battery_saved_data->rework_module_voltage ? $battery_saved_data->rework_module_voltage."V" : ''?>" class="textBox voltage_data">
                            </div>
                            <div class="label_input_container">
                                <label class="label_text">Narada Rep Present:</label>
                                <select name="narada_rep_present" class="textBox selectBox">
                                    <option value="0" <?=($battery_saved_data->narada_rep_present == 0) ? 'selected' : ''?>>No</option>
                                    <option value="1" <?=($battery_saved_data->narada_rep_present == 1) ? 'selected' : ''?>>Yes</option>
                                </select>
                            </div>
                            <div class="label_input_container">
                                <label class="label_text">Cell Level Charger Used:</label>
                                <select name="cell_level_charger_used" class="textBox selectBox">
                                    <option value="0" <?=($battery_saved_data->cell_level_charger_used == 0) ? 'selected' : ''?>>No</option>
                                    <option value="1" <?=($battery_saved_data->cell_level_charger_used == 1) ? 'selected' : ''?>>Yes</option>
                                </select>
                            </div>
                            <div class="label_input_container">
                                <label class="label_text">Cell1 Voltage</label>
                                <input name="rework_cell1" type="text" class="textBox voltage_data" value="<?=$battery_saved_data->rework_cell1 ? $battery_saved_data->rework_cell1."V" : ''?>" placeholder="XX.XV">
                            </div>
                            <div class="label_input_container">
                                <label class="label_text">Cell2 Voltage</label>
                                <input name="rework_cell2" type="text" class="textBox voltage_data" value="<?=$battery_saved_data->rework_cell2 ? $battery_saved_data->rework_cell2."V" : ''?>" placeholder="XX.XV">
                            </div>
                            <div class="label_input_container">
                                <label class="label_text">Cell3 Voltage</label>
                                <input name="rework_cell3" type="text" class="textBox voltage_data" value="<?=$battery_saved_data->rework_cell3 ? $battery_saved_data->rework_cell3."V" : ''?>" placeholder="XX.XV">
                            </div>
                            <div class="label_input_container">
                                <label class="label_text">Cell4 Voltage</label>
                                <input name="rework_cell4" type="text" class="textBox voltage_data" value="<?=$battery_saved_data->rework_cell4 ? $battery_saved_data->rework_cell4."V" : ''?>" placeholder="XX.XV">
                            </div>
                            <div class="label_input_container">
                                <label class="label_text">Cell5 Voltage</label>
                                <input name="rework_cell5" type="text" class="textBox voltage_data" value="<?=$battery_saved_data->rework_cell5 ? $battery_saved_data->rework_cell5."V" : ''?>" placeholder="XX.XV">
                            </div>
                            <div class="label_input_container">
                                <label class="label_text">Cell6 Voltage</label>
                                <input name="rework_cell6" type="text" class="textBox voltage_data" value="<?=$battery_saved_data->rework_cell6 ? $battery_saved_data->rework_cell6."V" : ''?>" placeholder="XX.XV">
                            </div>
                            <div class="label_input_container">
                                <label class="label_text">Cell7 Voltage</label>
                                <input name="rework_cell7" type="text" class="textBox voltage_data" value="<?=$battery_saved_data->rework_cell7 ? $battery_saved_data->rework_cell7."V" : ''?>" placeholder="XX.XV">
                            </div>
                            <div class="label_input_container">
                                <label class="label_text">Cell8 Voltage</label>
                                <input name="rework_cell8" type="text" class="textBox voltage_data" value="<?=$battery_saved_data->rework_cell8 ? $battery_saved_data->rework_cell8."V" : ''?>" placeholder="XX.XV">
                            </div>
                            <div class="label_input_container">
                                <label class="label_text">Cell9 Voltage</label>
                                <input name="rework_cell9" type="text" class="textBox voltage_data" value="<?=$battery_saved_data->rework_cell9 ? $battery_saved_data->rework_cell9."V" : ''?>" placeholder="XX.XV">
                            </div>
                            <div class="label_input_container">
                                <label class="label_text">Cell10 Voltage</label>
                                <input name="rework_cell10" type="text" class="textBox voltage_data" value="<?=$battery_saved_data->rework_cell10 ? $battery_saved_data->rework_cell10."V" : ''?>" placeholder="XX.XV">
                            </div>
                            <div class="label_input_container">
                                <label class="label_text">Cell11 Voltage</label>
                                <input name="rework_cell11" type="text" class="textBox voltage_data" value="<?=$battery_saved_data->rework_cell11 ? $battery_saved_data->rework_cell11."V" : ''?>" placeholder="XX.XV">
                            </div>
                            <div class="label_input_container">
                                <label class="label_text">Cell12 Voltage</label>
                                <input name="rework_cell12" type="text" class="textBox voltage_data" value="<?=$battery_saved_data->rework_cell12 ? $battery_saved_data->rework_cell12."V" : ''?>" placeholder="XX.XV">
                            </div>
                            <div class="label_input_container">
                                <label class="label_text">Cell13 Voltage</label>
                                <input name="rework_cell13" type="text" class="textBox voltage_data" value="<?=$battery_saved_data->rework_cell14 ? $battery_saved_data->rework_cell13."V" : ''?>" placeholder="XX.XV">
                            </div>
                            <div class="label_input_container">
                                <label class="label_text">Cell14 Voltage</label>
                                <input name="rework_cell14" type="text" class="textBox voltage_data" value="<?=$battery_saved_data->rework_cell14 ? $battery_saved_data->rework_cell14."V" : ''?>" placeholder="XX.XV">
                            </div>
                            <div class="label_input_container">
                                <label class="label_text">Cell15 Voltage</label>
                                <input name="rework_cell15" type="text" class="textBox voltage_data" value="<?=$battery_saved_data->rework_cell15 ? $battery_saved_data->rework_cell15."V" : ''?>" placeholder="XX.XV">
                            </div> 
                            <div class="label_input_container form_button_wrapper">
                                <div class="form_btn right" id="save_rework_battery_proceed">
                                    <p>SAVE</p>
                                </div>
                                <div class="form_btn back">
                                    <p>BACK</p>
                                </div>
                            </div>
                            <div class="label_input_container">
                                <div class="battery_proceedWrapper battery_proceed" id="form_battery_proceed">
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

