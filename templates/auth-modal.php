<?php if ( is_user_logged_in() ): ?>
<?php else: ?>
<div class="AuthModal ui modal">
  <i class="close icon"></i>
  <div class="content">
    <form id="LoginForm" action="" class="LoginForm ui form show">
        <h3 class="AuthModal__title">
          <?php _e('Connectez-vous pour continuer','wellwhere');?>
        </h3>
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
          value="<?php echo wp_create_nonce( "login_ajax_nonce" ) ?>" >
        <div class="ui small error message"></div>
        <div class="field">
          <button
            type="submit"
            class="ui button fluid LoginForm__button">
            <?php _e('Connexion','wellwhere');?>
          </button>
        </div>
        <div class="field">
          <a data-switch-modal href="#ForgotPassForm" class="AuthModal__forgot-link AuthModal__small-text">
            <?php _e('Mot de passe oublié?','wellwhere');?>
          </a>
        </div>
        <div class="field">
          <div class="AuthModal__social-title AuthModal__small-text AuthModal__text-line -after">
            <?php _e('ou continuez avec Facebook ou Google', 'wellwhere') ?>
          </div>
        </div>
        <div class="field AuthModal__social-buttons">
          <button
            class="LoginForm__facebook-login ui facebook fluid button"
            id="facebooklogin"
            data-login="facebook">
            <i class="facebook icon"></i>
            <?php echo __('Login with Facebook','wellwhere'); ?>
         </button>
          <button
            class="LoginForm__google-login ui fluid button google plus"
            id="googlelogin"
            data-login="google">
            <i class="google plus icon"></i>
            <?php echo __('Login with Google','wellwhere'); ?>
          </button>
        </div>
        <div class="field">
          <div class="AuthModal__register AuthModal__small-text AuthModal__text-line -before">
            <div>
              <span><?php _e('Vous n’avez pas de compte ?', 'wellwhere') ?></span>
              <a data-switch-modal href="#RegForm" class="AuthModal__register-link">
                <?php _e('Inscription', 'wellwehre') ?>
              </a>
            </div>
          </div>
        </div>
    </form>
    <form id="RegForm" action="" class="RegForm ui form hide">
      <h3 class="AuthModal__title">
        <?php _e('Register','wellwhere');?>
      </h3>
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

      <div class="field">
        <button type="submit" class="ui button fluid" ><?php _e('Inscription','wellwhere');?></button>
      </div>

      <div class="field">
        <a data-switch-modal href="#LoginForm" id="widget_login"><?php _e('Back to Login','wellwhere');?></a>
      </div>
    </form>
    <form id="ForgotPassForm" action="" class="ForgotPassForm ui form hide">
      <h3 class="AuthModal__title">
        <?php _e('Réinitialiser le mot de passe','wellwhere');?>
      </h3>
      <div class="field">
        <input
          type="text"
          name="forgot_email"
          id="forgot_email"
          placeholder="<?php _e('Enter your email address','wellwhere');?>" >
        <?php echo wp_nonce_field( 'forgot_ajax_nonce', 'security_forgot',true,false ); ?>
      </div>
      <div class="field">
        <button
          type="sybmit"
          class="ForgotPassForm__submit ui fluid button"
          name="forgot">
          <?php _e('Reset Password','wellwhere');?>
        </button>
      </div>
      <div class="ui small success message"></div>
      <div class="ui small error message"></div>
      <div class="field">
        <a data-switch-modal href="#LoginForm"><?php _e('Return to Login','wellwhere');?></a>
      </div>
    </form>
  </div>
</div>
<?php endif; ?>
