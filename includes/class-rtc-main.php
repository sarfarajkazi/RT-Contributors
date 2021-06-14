<?php

/**
 * RTC setup
 *
 * @package RTC
 * @since    1.0.0
 */
defined('ABSPATH') || exit;

/**
 * Main RTC Lite Class.
 *
 * @class RTC
 * @author Sarfaraj Kazi
 */
final class RTC {

    /**
     * The single instance of the class.
     *
     * @since 2.1
     */
    protected static $_instance = null;

    /**
     * Main RTC Instance.
     *
     * Ensures only one instance of RTC is loaded or can be loaded.
     *
     * @since 1.0.0
     * @static
     * @see rtc_getInstance()
     * @return RTC - Main instance.
     */
    public static function rtc_instance() {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * rtc Constructor.
     */
    public function __construct() {
        $this->rtc_define_constants();
        $this->rtc_includes();
    }

    /**
     * Define Constants
     */
    function rtc_define_constants() {

        $this->rtc_define('RTC_PLUGIN_URL', trailingslashit(plugin_dir_url(__DIR__)));
        $this->rtc_define('RTC_PLUGIN_PATH', trailingslashit(plugin_dir_path(__DIR__)));
        $this->rtc_define('RTC_ADMIN_TEMPLATES', trailingslashit(RTC_PLUGIN_PATH . 'includes/admin/templates/'));
        $this->rtc_define('RTC_ADMIN_AJAX_URL', admin_url('admin-ajax.php'));
        $this->rtc_define("RTC_SITE_URL", trailingslashit(site_url()));
        $this->rtc_define('RTC_NAME', 'RT Contributors');
    }

    /**
     * Define constant if not already set.
     *
     * @param string $name Constant name.
     * @param string|bool $value Constant value.
     */
    private function rtc_define($name, $value) {
        if (!defined($name)) {
            define($name, $value);
        }
    }

    /**
     * What type of request is this?
     *
     * @param  string $type admin or frontend.
     * @return bool
     */
    private function rtc_is_request($type) {
        switch ($type) {
            case 'admin':
                return (is_admin() || defined('DOING_AJAX'));
            case 'frontend':
                return (!is_admin() || defined('DOING_AJAX'));
        }
    }

    /**
     * Include required core files used in admin and on the frontend.
     */
    function rtc_includes() {
        if ($this->rtc_is_request('admin')) {
            include_once RTC_PLUGIN_PATH . 'includes/admin/class-rtc-admin-actions.php';
        }
        if ($this->rtc_is_request('frontend')) {
            include_once RTC_PLUGIN_PATH . 'includes/frontend/class-rtc-front-actions.php';
        }
    }

}
