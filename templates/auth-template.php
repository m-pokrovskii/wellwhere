<?php if ( is_user_logged_in() ): ?>
<?php else: ?>
<div class="ui modal">
  <i class="close icon"></i>
  <div class="content">
    <form action="" class="LoginForm ui form">
        <h3 id="login-div-title"><?php _e('Login','wellwhere');?></h3>
        <div class="field">
          <input
            type="text"
            name="login_email"
            id="login_email"
            placeholder="<?php _e('Email','wellwhere');?>">
        </div>
        <div class="field">
          <input
            type="password"
            name="login_password"
            id="login_password"
            placeholder="<?php _e('Password','wellwhere');?>"/>
        </div>
        <input
          type="hidden"
          id="security_login"
          name="security_login"
          value="<?php echo create_onetime_nonce( 'login_ajax_nonce' );?>" >

        <div class="ui small error message"></div>

        <button
          type="submit"
          class="wpresidence_button ui button"
          id="wp-login-but">
          <?php _e('Login','wellwhere');?>
        </button>

        <div class="login-links">
            <div class="field">
              <a href="#" id="widget_register"><?php _e('Need an account? Register here!','wellwhere');?></a>
              <a href="#" id="forgot_pass"><?php _e('Forgot Password?','wellwhere');?></a>
            </div>
            <div class="field">
              <button
                class="LoginForm__facebook-login ui facebook button"
                id="facebooklogin"
                data-login="facebook">
                <i class="facebook icon"></i>
                <?php echo __('Login with Facebook','wellwhere'); ?>
             </button>
              <button
                class="LoginForm__google-login ui button google plus"
                id="googlelogin"
                data-login="google">
                <i class="google plus icon"></i>
                <?php echo __('Login with Google','wellwhere'); ?>
              </button>
            </div>
        </div>
    </form>
    <form action="" class="RegForm ui form">
      <h3 id="register-div-title"><?php _e('Register','wellwhere');?></h3>
      <div class="field">
        <input
          type="text"
          name="user_first_name_register"
          id="user_first_name"
          placeholder="<?php _e('First Name','wellwhere');?>"/>
      </div>

      <div class="field">
        <input
          type="text"
          name="user_last_name_register"
          id="user_last_name"
          placeholder="<?php _e('Last Name','wellwhere');?>"/>
      </div>

      <div class="field">
        <input
          type="text"
          name="user_email_register"
          id="user_email_register"
          placeholder="<?php _e('Email','wellwhere');?>"  />
      </div>

      <input
        type="hidden"
        id="security_register"
        name="security_register"
        value=" <?php echo create_onetime_nonce( 'register_ajax_nonce' );?> ">

      <div class="ui small info message">
        <?php _e('A password will be e-mailed to you','wellwhere');?>
      </div>
      <div class="ui small success message"></div>
      <div class="ui small error message"></div>

      <button type="submit" class="regbutton ui button" ><?php _e('Register','wellwhere');?></button>

      <div class="login-links">
        <a href="#" id="widget_login"><?php _e('Back to Login','wellwhere');?></a>
      </div>
    </form>
    <form action="" class="ForgotPassForm ui form">
      <h3><?php _e('Reset Password','wellwhere');?></h3>
      <div class="field">
        <input
          type="text"
          name="forgot_email"
          id="forgot_email"
          placeholder="<?php _e('Enter your email address','wellwhere');?>" >
        <?php echo wp_nonce_field( 'forgot_ajax_nonce', 'security_forgot',true,false ); ?>
      </div>
      <button
        type="sybmit"
        class="ForgotPassForm__submit ui button"
        name="forgot">
        <?php _e('Reset Password','wellwhere');?>
      </button>
      <div class="ui small success message"></div>
      <div class="ui small error message"></div>
      <div class="login-links shortlog">
        <a href="#" id="return_login"><?php _e('Return to Login','wellwhere');?></a>
      </div>
    </form>
  </div>
  <div class="actions">
    <div class="ui button">Cancel</div>
    <div class="ui button">OK</div>
  </div>
</div>
<?php endif; ?>
