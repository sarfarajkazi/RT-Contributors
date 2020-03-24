<?php

if (!defined('ABSPATH')) {
    exit;
}
/**
 * Handle Front Scripts and StyleSheets
 * @class rtc_front_assets
 * @since 1.0.0
 */
if (!class_exists('rtc_frontend_assets', false)) :

    class rtc_frontend_assets
    {
        /**
         * Hook in tabs.
         */
        public function __construct()
        {
            add_action('wp_enqueue_scripts', array($this, 'rtc_frontend_styles'));
            add_action('wp_enqueue_scripts', array($this, 'rtc_frontend_scripts'));
        }
        /**
         * Enqueue styles.
         */
        public function rtc_frontend_styles()
        {

            $cssVersion = filemtime(RTC_PLUGIN_PATH . 'assets/css/plugin_front_custom_css.css');
            wp_enqueue_style('rtc_custom-style', RTC_PLUGIN_URL . 'assets/css/plugin_front_custom_css.css', array(), $cssVersion);
        }
        /**
         * Enqueue scripts.
         */
        public function rtc_frontend_scripts()
        {

            $jsVersion = filemtime(RTC_PLUGIN_PATH . 'assets/js/plugin_front_custom_js.js');
            wp_enqueue_script('rtc_custom-js-file', RTC_PLUGIN_URL . 'assets/js/plugin_front_custom_js.js', array('jquery'), $jsVersion, true);
            wp_localize_script('rtc_custom-js-file', 'frontend_veriables', array('ajax_url' => RTC_ADMIN_AJAX_URL, 'site_url' => RTC_SITE_URL));
        }

    }
endif;
return new rtc_frontend_assets();
