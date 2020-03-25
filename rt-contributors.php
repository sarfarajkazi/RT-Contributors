<?php
/*
Plugin Name: RT Contributors
Plugin URI: http://sarfarajkazi.com
Description: A demo on WordPress shortcrode which includes a slider plugin with jQuery slick slider.
Version: 1.0.0
Author: Sarfaraj Kazi
Author URI: http://sarfarajkazi.com
License: GPL2
*/

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Define RTCR_PLUGIN_FILE.
if (!defined('RTCR_PLUGIN_FILE')) {
    define('RTCR_PLUGIN_FILE', __FILE__);
}

// Include the main RTCR class.
if (!class_exists('RTCR')) {
    include_once dirname(__FILE__) . '/includes/plugin_class_file.php';
}

/**
 * Main instance of RTCR .
 *
 * Returns main instance of RTCR  to prevent the need to use globals.
 *
 * @return RTCR
 * @since 1.0.0
 */
function RTCR()
{
    return RTCR::rtcr_instance();
}
$GLOBALS['RTCR'] = RTCR();

function rtcr_pr($data = false, $flag = false, $display = false)
{
    if (empty($display)) {
        echo "<pre class='direct_display'>";
        if ($flag == 1) {
            print_r($data);
            die;
        } else {
            print_r($data);
        }
        echo "</pre>";
    } else {
        echo "<div style='display:none' class='direct_display'><pre>";
        print_r($data);
        echo "</pre></div>";
    }
}
