<?php
/**
 * Plugin Name: Pizza Pledge
 * Description: Adds a required checkbox to the WordPress login screen.
 * Version: 1.0
 * Author: Your Name
 * License: GPL2
 */

// Security check to prevent direct access
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

/**
 * Enqueue the necessary scripts and styles for the login page.
 */
function pizza_pledge_enqueue_scripts() {
    ?>
    <style>
        #pizza-pledge {
            margin-top: 10px;
            font-size: 14px;
        }
        @media (max-width: 600px) {
            #pizza-pledge {
                font-size: 12px;
            }
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var loginForm = document.getElementById('loginform');
            if (loginForm) {
                loginForm.addEventListener('submit', function (e) {
                    var pizzaCheckbox = document.getElementById('pizza_pledge_checkbox');
                    if (!pizzaCheckbox.checked) {
                        e.preventDefault();
                        alert('<?php echo esc_js( __( 'You must agree that you like pineapple on your pizza to log in.', 'pizza-pledge' ) ); ?>');
                    }
                });
            }
        });
    </script>
    <?php
}
add_action( 'login_enqueue_scripts', 'pizza_pledge_enqueue_scripts' );

/**
 * Add the checkbox to the login form.
 */
function pizza_pledge_checkbox() {
    ?>
    <p id="pizza-pledge">
        <label>
            <input type="checkbox" name="pizza_pledge_checkbox" id="pizza_pledge_checkbox" value="1" /> 
            <?php esc_html_e( 'I like pineapple on my pizza', 'pizza-pledge' ); ?>
        </label>
    </p>
    <?php
}
add_action( 'login_form', 'pizza_pledge_checkbox' );
