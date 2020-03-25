<?php
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Handle all Admin Requests
 *
 * @class rtcr_admin
 * @since 1.0.0
 * @author Sarfaraj Kazi
 */
class rtcr_admin
{

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->rtcr_admin_includes();
    }

    /**
     * include admin assests file
     */
    public function rtcr_admin_includes()
    {
        //include_once RTCR_PLUGIN_PATH . 'includes/admin/plugin_admin_assets.php';
        include_once RTCR_PLUGIN_PATH . 'includes/admin/plugin_admin_action_handler.php';
    }
}

return new rtcr_admin();