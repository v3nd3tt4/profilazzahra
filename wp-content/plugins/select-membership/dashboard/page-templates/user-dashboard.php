<?php
get_header();
if ( ! stockholm_qode_membership_theme_installed() ) { ?>
	<div class="qode-membership-title">
		<?php the_title( '<h1>', '</h1>' ); ?>
	</div>
<?php }
?>
	<div class="container">
		<?php do_action( 'stockholm_qode_action_after_membership_container_open' ); ?>
		<div class="container_inner default_template_holder clearfix">
            <div class="qode-membership-main-wrapper clearfix">
                <?php if ( is_user_logged_in() ) { ?>
                    <div class="qode-membership-dashboard-nav-holder clearfix">
                        <?php
                        //Include dashboard navigation
                        echo stockholm_qode_membership_get_dashboard_template_part( 'navigation' );
                        ?>
                    </div>
                    <div class="qode-membership-dashboard-content-holder">
                        <?php echo stockholm_qode_membership_get_dashboard_pages(); ?>
                    </div>
                <?php } else { ?>
                    <div class="qode-login-register-content qode-user-not-logged-in">
                        <ul>
                            <li>
                                <a href="#qode-login-content"><?php esc_html_e( 'Login', 'select-membership' ); ?></a>
                            </li>
                            <li>
                                <a href="#qode-register-content"><?php esc_html_e( 'Register', 'select-membership' ); ?></a>
                            </li>
                            <li>
                                <a href="#qode-reset-pass-content"><?php esc_html_e( 'Reset Password', 'select-membership' ); ?></a>
                            </li>
                        </ul>
                        <div class="qode-login-content-inner" id="qode-login-content">
                            <div
                                class="qode-wp-login-holder"><?php echo stockholm_qode_membership_execute_shortcode( 'qode_user_login', array() ); ?>
                            </div>
                        </div>
                        <div class="qode-register-content-inner" id="qode-register-content">
                            <div
                                class="qode-wp-register-holder"><?php echo stockholm_qode_membership_execute_shortcode( 'qode_user_register', array() ) ?>
                            </div>
                        </div>
                        <div class="qode-reset-pass-content-inner" id="qode-reset-pass-content">
                            <div
                                class="qode-wp-reset-pass-holder"><?php echo stockholm_qode_membership_execute_shortcode( 'qode_user_reset_password', array() ) ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
		</div>
		<?php do_action( 'stockholm_qode_action_before_membership_container_close' ); ?>
	</div>
<?php get_footer(); ?>