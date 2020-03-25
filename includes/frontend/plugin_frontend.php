<?php

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Handle all Front Requests
 *
 * @class rtcr_frontend
 * @since 1.0.0
 * @author Sarfaraj Kazi
 */
if (!class_exists('rtcr_frontend', false)) :
    class rtcr_frontend
    {
        /**
         * Constructor.
         */
        public function __construct()
        {
            include_once RTCR_PLUGIN_PATH . 'includes/frontend/plugin_front_action_handler.php';
            include_once RTCR_PLUGIN_PATH . 'includes/frontend/plugin_front_assets.php';
        }

    }
endif;
return new rtcr_frontend();
