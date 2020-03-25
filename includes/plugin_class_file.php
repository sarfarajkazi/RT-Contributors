<?php

/**
 * RTCR setup
 *
 * @package RTCR
 * @since    1.0.0
 */
defined('ABSPATH') || exit;

/**
 * Main RTCR Lite Class.
 *
 * @class RTCR
 * @author Sarfaraj Kazi
 */
final class RTCR
{

    /**
     * RTCR Lite version.
     *
     * @var string
     */
    public $version = '1.0.0';

    /**
     * The single instance of the class.
     *
     * @since 2.1
     */
    protected static $_instance = null;

    /**
     * Session instance.
     *
     * @var RTCR_Session|RTCR_Session_Handler
     */
    public $session = null;

    /**
     * Query instance.
     *
     * @var RTCR_Query
     */
    public $query = null;

    /**
     * Main RTCR Instance.
     *
     * Ensures only one instance of RTCR is loaded or can be loaded.
     *
     * @since 1.0.0
     * @static
     * @see rtcr_getInstance()
     * @return RTCR - Main instance.
     */
    public static function rtcr_instance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * rtcr Constructor.
     */
    public function __construct()
    {
        $this->rtcr_define_constants();
        $this->rtcr_includes();
    }

    /**
     * Define Constants
     */
    function rtcr_define_constants()
    {
        global $wpdb;
        $upload_dir = wp_upload_dir();
        $random_number = random_int(111111, 999999999);

        /*
         * plugin constants
         */
        $this->rtcr_define("RTCR_PLUGIN_URL", trailingslashit(plugin_dir_url(__DIR__)));

        $this->rtcr_define("RTCR_PLUGIN_PATH", trailingslashit(plugin_dir_path(__DIR__)));

        $this->rtcr_define("RTCR_ADMIN_TEMPLATES", trailingslashit(RTCR_PLUGIN_PATH.'includes/admin/templates/'));
        $this->rtcr_define("RTCR_FRONT_TEMPLATES", trailingslashit(RTCR_PLUGIN_PATH.'includes/frontend/templates/'));

        $this->rtcr_define('RTCR_VERSION', $this->version);
        $this->rtcr_define('RTCR_DATE_FORMAT', get_option('date_format', true));
        $this->rtcr_define('RTCR_TIME_FORMAT', get_option('time_format', true));
        $this->rtcr_define('RTCR_DB_DATE_FORMAT', "Y-m-d H:i:s");
        /*
         * urls and site info
         */
        $this->rtcr_define("RTCR_ADMIN_URL", admin_url());
        $this->rtcr_define("RTCR_ADMIN_AJAX_URL", admin_url('admin-ajax.php'));
        $this->rtcr_define("RTCR_SITE_URL", trailingslashit(site_url()));
        $this->rtcr_define("RTCR_SITE_NAME", get_bloginfo('name'));
        $this->rtcr_define("RTCR_RTCR_NAME", get_option('blogname'));
        $this->rtcr_define("RTCR_SITE_DESC", get_bloginfo('description'));
        $this->rtcr_define("RTCR_ADMIN_EMAIL", get_bloginfo('admin_email'));
        $this->rtcr_define('RTCR_ENABLE', 1);
        $this->rtcr_define('RTCR_DISABLE', 0);
        $this->rtcr_define('RTCR_RANDOM_NUMBER', $random_number); 
        $this->rtcr_define('PLUGIN_DOMAIN','rt-contributors');
        $this->rtcr_define('RTC_NAME', 'RT Contributors');
      
    }

    /**
     * Define constant if not already set.
     *
     * @param string $name Constant name.
     * @param string|bool $value Constant value.
     */
    private function rtcr_define($name, $value)
    {
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
    private function rtcr_is_request($type)
    {
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
    function rtcr_includes()
    {
        if ($this->rtcr_is_request('admin')) {
            include_once RTCR_PLUGIN_PATH . 'includes/admin/plugin_admin.php';
        }
        if ($this->rtcr_is_request('frontend')) {
            include_once RTCR_PLUGIN_PATH . 'includes/frontend/plugin_frontend.php';
        }
    }
    

}
