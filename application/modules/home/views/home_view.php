
<div class="content_wrapper">
    <?php echo modules::run('home/header') ?>
    <?php $global_user = get_loggedin_user(); ?>
           <?php if($global_user){
                redirect('cases');
            }
            ?>
	<div id="bodyContent">
                <div class="login_form_container">
                        <?php
			$attributes = array('name' => 'login_form', 'id' => 'login_form');
			echo form_open('signup/login', $attributes);
			?>
                            <div class="loogin_area">
                                <input type="text" name="login_name" class="textBox loginTextBox" id="login_name" placeholder="Enter your name"/>
                                <span class="error" id="login_name_error" for="login_name" generated="true"></span>
                            </div>
                            <div class="loogin_area">
                                <input type="text" name="login_email" class="textBox loginTextBox" id="login_email" placeholder="Enter email address"/>
                                <span class="error" id="login_email_error" for="login_email" generated="true" style="visibility: hidden;"></span>
                            </div>
                            <div class="loogin_area">
                               <select name="user_type" class="textBox selectBox">
                                    <option value="exicom">Exicom</option>
                                    <option value="vendor">Vendor</option>
                                </select>
                                <span class="error" id="login_user_type_error" for="user_type" generated="true"></span>
                            </div>
                            <div class="login_buttonContainer">
                                <div class="login_button">
                                    <p class="login_text">log in</p>
                                </div>
                            </div>
                    </form>
                </div>
	</div>	
</div>
<?php echo modules::run('home/footer') ?>

