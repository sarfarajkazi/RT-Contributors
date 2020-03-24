<?php

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Handle All Actions
 * @class rtc_action_handler_admin
 * @since 1.0.0
 * @author Sarfaraj Kazi
 */
if (!class_exists('rtc_action_handler_admin')):
    class rtc_action_handler_admin
    {
        /**
         * Constructor.
         */
        public function __construct()
        {
          
        }
    }
endif;
return new rtc_action_handler_admin();
