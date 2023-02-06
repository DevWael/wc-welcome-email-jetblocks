<?php
/**
 * Plugin Name: WC Welcome Emails For JetBlocks
 * Plugin URI:  https://github.com/DevWael/wc-welcome-email-jetblocks/
 * Description: Send WooCommerce welcome email after creating user using JetBlocks registration form.
 * Version:     1.0
 * Author:      Ahmad Wael
 * Author URI:  https://www.bbioon.com/
 */

 /**
  * Hook on user_register after finishing the process of wp_insert_user function
  * then check if the registration request is coming from the jetblocks form
  * if the woocommerce is active, go and trigger the welcome email using the given user id
  */
add_action( 'user_register', function( $user_id ) {
    if ( isset( $_POST['jet-register-nonce'] ) && class_exists( 'WC' ) ) {        
        $mailer = WC()->mailer();
        $mails = $mailer->get_emails();

        if ( ! empty( $mails ) ) {
            foreach ( $mails as $mail ) {
                if ( $mail->id == 'customer_new_account' ) {
                    $mail->trigger( $user_id );
                    break;
                }
            }
        }
    }
}, 15, 1 );
