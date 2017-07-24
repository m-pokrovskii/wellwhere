<?php
  var_dump( is_user_logged_in() );
  dump( get_current_user() );
 ?>

<?php if ( is_user_logged_in() ): ?>

<?php else: ?>
  <?php
    $security_nonce=wp_nonce_field( 'forgot_ajax_nonce-topbar', 'security-forgot-topbar',true,false );
  ?>
  <form action="" class="LoginForm ui form">
      <h3 id="login-div-title-topbar"><?php _e('Login','wellwhere');?></h3>
      <div class="login_form" id="login-div">
          <div class="loginalert" id="login_message_area" ></div>
          <div class="field">
            <input type="text" class="form-control" name="log" id="login_user" placeholder="<?php _e('Username','wellwhere');?>">
          </div>

          <div class="field">
            <input type="password" class="form-control" name="pwd" id="login_pwd" placeholder="<?php _e('Password','wellwhere');?>"/>
          </div>

          <input type="hidden" name="loginpop" id="loginpop_wd" value="0">
          <input
            type="hidden"
            id="security-login-topbar"
            name="security-login-topb"
            value="<?php echo create_onetime_nonce( 'login_ajax_nonce' );?>" >

          <button type="submit" class="wpresidence_button ui button" id="wp-login-but-topbar">
            <?php _e('Login','wellwhere');?>
          </button>
          <div class="login-links">
              <div class="field">
                <a href="#" id="widget_register"><?php _e('Need an account? Register here!','wellwhere');?></a>
                <a href="#" id="forgot_pass"><?php _e('Forgot Password?','wellwhere');?></a>
              </div>
              <div class="field">
                <button class="ui facebook button" id="facebookloginsidebar" data-social="facebook">
                  <i class="facebook icon"></i>
                  <?php echo __('Login with Facebook','wellwhere'); ?>
               </button>
                <button class="ui button google plus" id="googleloginsidebar" data-social="google">
                  <i class="google plus icon"></i>
                  <?php echo __('Login with Google','wellwhere'); ?>
                </button>
              </div>
          </div>
      </div>
  </form>
  <form action="" class="RegForm ui form">
    <h3 id="register-div-title-topbar"><?php _e('Register','wellwhere');?></h3>
    <div class="login_form" id="register-div-topbar">
        <div class="loginalert" id="register_message_area" ></div>
        <div class="field">
          <input type="text" name="user_first_name" id="user_first_name" placeholder="<?php _e('First Name','wellwhere');?>"/>
        </div>

        <div class="field">
          <input type="text" name="user_last_name" id="user_last_name" placeholder="<?php _e('Last Name','wellwhere');?>"/>
        </div>

        <div class="field">
          <input type="text" name="user_login_register" id="user_login_register" class="form-control" placeholder="<?php _e('Username','wellwhere');?>"/>
        </div>

        <div class="field">
          <input type="text" name="user_email_register" id="user_email_register" class="form-control" placeholder="<?php _e('Email','wellwhere');?>"  />
        </div>

        <?php if($enable_user_pass_status != 'yes'){  ?>
            <p id="reg_passmail"><?php _e('A password will be e-mailed to you','wellwhere');?></p>
        <?php } ?>

        <input
          type="hidden"
          id="security-register-topbar"
          name="security-register-topbar"
          value=" <?php echo create_onetime_nonce( 'register_ajax_nonce' );?> ">

        <button type="submit" class="regbutton ui button" ><?php _e('Register','wellwhere');?></button>

        <div class="login-links">
            <a href="#" id="widget_login"><?php _e('Back to Login','wellwhere');?></a>
        </div>
      </div>
    </div>
  </form>
  <form action="" class="ForgotPassForm" action="" >
    <h3 id="forgot-div-title-topbar"><?php _e('Reset Password','wellwhere');?></h3>
    <div class="login_form" id="forgot-pass-div">
        <div class="loginalert" id="forgot_pass_area"></div>
        <div class="loginrow">
                <input type="text" class="form-control" name="forgot_email" id="forgot_email" placeholder="<?php _e('Enter Your Email Address','wellwhere');?>" size="20" />
        </div>
        <?php echo ($security_nonce);?>
        <input type="hidden" id="postid" value="'.$post_id.'">
        <button class="wpresidence_button ui button" id="wp-forgot-but-topbar" name="forgot" ><?php _e('Reset Password','wellwhere');?></button>
        <div class="login-links shortlog">
        <a href="#" id="return_login"><?php _e('Return to Login','wellwhere');?></a>
        </div>
    </div>
  </form>
<?php endif; ?>
