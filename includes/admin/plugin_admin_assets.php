<?php

if (!defined('ABSPATH')) {
    exit;
}
/**
 * Handle Front Scripts and StyleSheets
 * @class rtc_admin_assets
 * @since 1.0.0
 */
if (!class_exists('rtc_admin_assets', false)) :

    class rtc_admin_assets
    {
        /**
         * Hook in tabs.
         */
        public function __construct()
        {
            add_action('admin_enqueue_scripts', array($this, 'rtc_admin_styles'));
            add_action('admin_enqueue_scripts', array($this, 'rtc_admin_scripts'));
        }

        /**
         * Enqueue styles.
         */
        public function rtc_admin_styles()
        {
            $cssVersion = filemtime(RTC_PLUGIN_PATH . 'assets/css/plugin_admin_custom_css.css');
            wp_enqueue_style('rtc_custom-style', RTC_PLUGIN_URL . 'assets/css/plugin_admin_custom_css.css', array(), $cssVersion);
        }

        /**
         * Enqueue scripts.
         */
        public function rtc_admin_scripts()
        {
            if( get_post_type()=='rtc'){
                wp_enqueue_script("jquery-ui-sortable");
            }
            $jsVersion = filemtime(RTC_PLUGIN_PATH . 'assets/js/plugin_admin_custom_js.js');
            wp_enqueue_script('rtc_custom-js-file', RTC_PLUGIN_URL . 'assets/js/plugin_admin_custom_js.js', array('jquery'), $jsVersion, true);
            $localize_veriable = array('ajax_url' => RTC_ADMIN_AJAX_URL, 'site_url' => RTC_SITE_URL, 'select_authors' => __("Select Authors", PLUGIN_DOMAIN), 'add' => __('Add', PLUGIN_DOMAIN),
                'confirm' => __("Are you sure ?", PLUGIN_DOMAIN));
            wp_localize_script('rtc_custom-js-file', 'admin_veriables', $localize_veriable);
        }
    }

endif;
return new rtc_admin_assets();
