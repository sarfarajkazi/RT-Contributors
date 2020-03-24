<?php

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Handle all Front Requests
 *
 * @class rtc_frontend
 * @since 1.0.0
 * @author Sarfaraj Kazi
 */
if (!class_exists('rtc_frontend', false)) :
    class rtc_frontend
    {
        /**
         * Constructor.
         */
        public function __construct()
        {
            include_once RTC_PLUGIN_PATH . 'includes/frontend/plugin_front_action_handler.php';
            include_once RTC_PLUGIN_PATH . 'includes/frontend/plugin_front_assets.php';
        }

    }
endif;
return new rtc_frontend();
