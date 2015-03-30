<?php echo modules::run('home/header') ?>
<div class="content_wrapper">
    
	<div id="bodyContent">
                <div class="contentWrapper">
                   
                    <div class="inputBoxContainer" style="display: block;">
                        <div class="log_battery_caseInput">
                            <?php
                            $attributes = array('name' => 'download_form', 'id' => 'download_form');
                            echo form_open('home/download_report', $attributes);
                            ?>
                            <input type="text" class="textBox" id="cbms_batteryInput" name="serial_number" placeholder="Enter cbms/battery serial no">
                            <div class="battery_proceedWrapper" id="download_proceed">
                                <div class="battery_proceedButton">
                                    <p>DOWNLOAD</p>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>            
        </div>
</div>
<?php echo modules::run('home/footer') ?>