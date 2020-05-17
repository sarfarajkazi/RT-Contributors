<?php

/*
  Plugin Name: RT Contributors
  Plugin URI: http://sarfarajkazi.com
  Description: A demo on WordPress shortcode which includes a slider plugin with jQuery slick slider.
  Version: 1.0.0
  Author: Sarfaraj Kazi
  Author URI: http://sarfarajkazi.com
  License: GPL2
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Define RTC_PLUGIN_FILE.
if (!defined('RTC_PLUGIN_FILE')) {
    define('RTC_PLUGIN_FILE', __FILE__);
}

// Include the main RTC class.
if (!class_exists('RTC')) {
    include_once dirname(__FILE__) . '/includes/class-rtc-main.php';
}

/**
 * Main instance of RTC .
 *
 * Returns main instance of RTC  to prevent the need to use globals.
 *
 * @return RTC
 * @since 1.0.0
 */
function RTC() {
    return RTC::rtc_instance();
}

$GLOBALS['RTC'] = RTC();
