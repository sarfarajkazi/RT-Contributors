<?php

if (!defined('ABSPATH')) {
    exit;
}
/**
 * Handle Front Scripts and StyleSheets
 * @class rtcr_admin_assets
 * @since 1.0.0
 */
if (!class_exists('rtcr_admin_assets', false)) :

    class rtcr_admin_assets
    {
        /**
         * Hook in tabs.
         */
        public function __construct()
        {
            add_action('admin_enqueue_scripts', array($this, 'rtcr_admin_styles'));
            add_action('admin_enqueue_scripts', array($this, 'rtcr_admin_scripts'));
        }

        /**
         * Enqueue styles.
         */
        public function rtcr_admin_styles()
        {
            $cssVersion = filemtime(RTCR_PLUGIN_PATH . 'assets/css/plugin_admin_custom_css.css');
            wp_enqueue_style('rtcr_custom-style', RTCR_PLUGIN_URL . 'assets/css/plugin_admin_custom_css.css', array(), $cssVersion);
        }

        /**
         * Enqueue scripts.
         */
        public function rtcr_admin_scripts()
        {
            
            $jsVersion = filemtime(RTCR_PLUGIN_PATH . 'assets/js/plugin_admin_custom_js.js');
            wp_enqueue_script('rtcr_custom-js-file', RTCR_PLUGIN_URL . 'assets/js/plugin_admin_custom_js.js', array('jquery'), $jsVersion, true);
            $localize_veriable = array('ajax_url' => RTCR_ADMIN_AJAX_URL, 'site_url' => RTCR_SITE_URL, 'select_authors' => __("Select Authors", PLUGIN_DOMAIN), 'add' => __('Add', PLUGIN_DOMAIN),
                'confirm' => __("Are you sure ?", PLUGIN_DOMAIN));
            wp_localize_script('rtcr_custom-js-file', 'admin_veriables', $localize_veriable);
        }
    }

endif;
return new rtcr_admin_assets();
