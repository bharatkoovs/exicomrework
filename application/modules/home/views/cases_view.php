<?php echo modules::run('home/header') ?>
<div class="content_wrapper">
    
	<div id="bodyContent">
                <div class="contentWrapper">
                    <div class="innerContentWrapper">
                    <div class="log_case_button_container">
                        <div class="log_case_battery">
                            <div class="log_case_battery_text">
                                <p>Log Battery Case</p>
                            </div>
                        </div>
                        <div class="log_case_cbms">
                            <div class="log_case_cbms_text">
                                <p>Log CBMS Case</p>
                            </div>
                        </div>
                    </div>
                    <div class="inputBoxContainer">
                        <div class="log_battery_caseInput" id="battery_button">
                            <?php
                            $attributes = array('name' => 'battery_form', 'id' => 'battery_form');
                            echo form_open('cases/battery', $attributes);
                            ?>
                            <input type="text" class="textBox" id="log_batteryInput" name="battery_number" placeholder="Enter battery serial no">
                            <span for="log_batteryInput" generated="true" class="error" style="visibility: hidden;">&nbsp;</span>
                            <div class="battery_proceedWrapper" id="battery_proceed">
                                <div class="battery_proceedButton">
                                    <p>PROCEED</p>
                                </div>
                            </div>
                            </form>
                        </div>
                        <div class="log_battery_caseInput" id="cbms_button">
                            <?php
                            $attributes = array('name' => 'cbms_form', 'id' => 'cbms_form');
                            echo form_open('cases/cbms', $attributes);
                            ?>
                            <input type="text" class="textBox" id="log_cbmsInput" name="cbms_number" placeholder="Enter CBMS serial no">
                            <span for="log_cbmsInput" generated="true" class="error" style="visibility: hidden;">&nbsp;</span>
                            <div class="battery_proceedWrapper" id="cbms_proceed">
                                <div class="battery_proceedButton">
                                    <p>PROCEED</p>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                     <!-- SAVED ONES -->
                        <?php if(!empty($saved_battery)){?>
                        <div class="saved_case_battery">
                            <a href="<?=base_url()?>home/saved_cases/battery">
                                <div class="log_case_battery_text">
                                    <p>SAVED Battery Case</p>
                                </div>
                            </a>
                        </div>
                        <?php } ?>
                        <?php if(!empty($saved_cbms)){?>
                        <div class="saved_case_cbms<?=$saved_battery? ' right': ''?>">
                            <a href="<?=base_url()?>home/saved_cases/cbms">
                                <div class="log_case_cbms_text">
                                    <p>SAVED CBMS Case</p>
                                </div>
                            </a>
                        </div>
                        <?php } ?>
                     </div>
                </div>            
        </div>
</div>
<?php echo modules::run('home/footer') ?>