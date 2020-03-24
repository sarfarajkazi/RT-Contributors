<?php
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Handle all Admin Requests
 *
 * @class rtc_admin
 * @since 1.0.0
 * @author Sarfaraj Kazi
 */
class rtc_admin
{

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->rtc_admin_includes();
    }

    /**
     * include admin assests file
     */
    public function rtc_admin_includes()
    {
        include_once RTC_PLUGIN_PATH . 'includes/admin/plugin_admin_assets.php';
        include_once RTC_PLUGIN_PATH . 'includes/admin/plugin_admin_action_handler.php';
    }
}

return new rtc_admin();