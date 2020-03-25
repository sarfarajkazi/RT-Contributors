<?php

if (!defined('ABSPATH')) {
    exit;
}
/**
 * Handle Front Scripts and StyleSheets
 * @class rtcr_front_assets
 * @since 1.0.0
 */
if (!class_exists('rtcr_frontend_assets', false)) :

    class rtcr_frontend_assets
    {
        /**
         * Hook in tabs.
         */
        public function __construct()
        {
            add_action('wp_enqueue_scripts', array($this, 'rtcr_frontend_styles'));
            //add_action('wp_enqueue_scripts', array($this, 'rtcr_frontend_scripts'));
        }
        /**
         * Enqueue styles.
         */
        public function rtcr_frontend_styles()
        {

            $cssVersion = filemtime(RTCR_PLUGIN_PATH . 'assets/css/plugin_front_custom_css.css');
            wp_enqueue_style('rtcr_custom-style', RTCR_PLUGIN_URL . 'assets/css/plugin_front_custom_css.css', array(), $cssVersion);
        }
        /**
         * Enqueue scripts.
         */
        public function rtcr_frontend_scripts()
        {

            $jsVersion = filemtime(RTCR_PLUGIN_PATH . 'assets/js/plugin_front_custom_js.js');
            wp_enqueue_script('rtcr_custom-js-file', RTCR_PLUGIN_URL . 'assets/js/plugin_front_custom_js.js', array('jquery'), $jsVersion, true);
            wp_localize_script('rtcr_custom-js-file', 'frontend_veriables', array('ajax_url' => RTCR_ADMIN_AJAX_URL, 'site_url' => RTCR_SITE_URL));
        }

    }
endif;
return new rtcr_frontend_assets();
