<?php

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Handle All Actions
 * @class rtcr_action_handler_admin
 * @since 1.0.0
 * @author Sarfaraj Kazi
 */
if (!class_exists('rtcr_action_handler_admin')):
    class rtcr_action_handler_admin
    {
        /**
         * Constructor.
         */
        public function __construct()
        {
            add_action('add_meta_boxes', array($this, "create_meta_box"));
             add_action('save_post', array($this, 'save_metabox'), 10, 1);
        }
       
        function create_meta_box() {
            $user = wp_get_current_user();
            if (count(array_intersect(array('author', 'administrator', 'editor'), (array) $user->roles)) > 0) {
                add_meta_box('rtcr_metabox', __(RTC_NAME, PLUGIN_DOMAIN), array($this, "display_meta_box"), array('post'), 'side', 'high');
            }
    }
    function display_meta_box(){
           global $post;
            $contributors = array();
            $all_users = get_users();
            foreach($all_users as $user){
               if ( in_array( 'author', (array) $user->roles ) ) {
                    $contributors[] = $user;
                }
            }
            $selected_contributors = get_post_meta($post->ID, 'post_contributors', true);
            $author_id = $post->post_author;
            include( RTCR_ADMIN_TEMPLATES . 'metabox_view.php' );
    }
     function save_metabox($id) {
            $post_type = get_post_type($id);
            if ("post" != $post_type) {
                return;
            }
            $prev_users = get_post_meta($id, 'post_contributors', true);
            if (isset($_POST['post_authors']) && !empty($_POST['post_authors'])) {
                update_post_meta($id, 'post_contributors', $_POST['post_authors']);
            }
            $deleted_users = array_diff($prev_users,  $_POST['post_authors']);
            foreach ($deleted_users as $k => $v){
                $postlist = get_user_meta($v,'post_contribute',true);
                $key = array_search($id, $postlist);
                unset($postlist[$key]);
                update_user_meta($v,'post_contribute' , $postlist);
            }
            foreach ($_POST['post_authors'] as $key => $value) {
                $postlist = get_user_meta($value,'post_contribute',true);
                if(!is_array($postlist)){
                    $postlist = array();
                }
                if(!in_array($id, $postlist)){
                    $postlist[] = $id;
                }
                update_user_meta($value,'post_contribute' , $postlist);
            }
        }
}
endif;
return new rtcr_action_handler_admin();
