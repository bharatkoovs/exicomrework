<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width,initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
        <link href="<?=base_url()?>css/home.css" rel="stylesheet" type="text/css"> 
        <script type="text/javascript">var base_url = '<?=base_url()?>'</script>
    </head>
   <body>
<div class="header">
        <div class="login_cont">
            <?php $global_user = get_loggedin_user(); ?>
            <?php  
            if(!empty($global_user)){
                echo 'You are logged in as '.$global_user->email.'. <a href="'.  site_url('signup/logout').'">Click</a> to use another user.';
            }
            $message = getSessionValue('message', 'flash');
            $error = getSessionValue('error', 'flash');
            ?>
        </div>
        <div class="logo_container">
            <div class="eneryQB_logo">
                <a href="<?=base_url()?>">
               <img src="<?=base_url()?>images/logo.jpg" width="220px" title="ENERGY QB"/>
               </a>
            </div>
        </div>
        
        <?php  
        $message = getSessionValue('message', 'flash');
        $error = getSessionValue('error', 'flash');

        if (!empty($message)) {
         ?>
            <div id="message" class="success" >
                <b class="bgSprites">&nbsp;</b>
                <?php echo $message ?>
            </div>
        <?php } 

        if (!empty($error)) { ?>
            <div class="errorInfo" id="error">
                <b class="bgSprites">&nbsp;</b>
                <?php echo $error ?>
            </div>
        <?php } ?>
    </div>

