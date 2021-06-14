<?php

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Handle All Actions
 * @class rtc_action_handler_admin
 * @since 1.0.0
 * @author Sarfaraj Kazi
 */
if (!class_exists('rtc_action_handler_admin')):

    class rtc_action_handler_admin {

        /**
         * Constructor.
         */
        public function __construct() {
            add_action('add_meta_boxes', array($this, 'rtc_create_meta_box'));
            add_action('save_post', array($this, 'rtc_save_metabox'), 10, 1);
        }

        function rtc_create_meta_box() {
            $user = wp_get_current_user();
            if (count(array_intersect(array('author', 'administrator', 'editor'), (array) $user->roles)) > 0) {
                add_meta_box('rtc_metabox', __(RTC_NAME, 'rt-contributors'), array($this, 'rtc_display_meta_box'), array('post'), 'side', 'high');
            }
        }

        /**
         * Display Metabox on add/edit post screen.
         *
         */
        function rtc_display_meta_box() {
            global $post;
            $contributors = array();
            $all_users = get_users();
            foreach ($all_users as $user) {
                if (in_array('author', (array) $user->roles)) {
                    $contributors[] = $user;
                }
            }
            $selected_contributors = get_post_meta($post->ID, 'post_contributors', true);
            $author_id = $post->post_author;
            include( RTC_ADMIN_TEMPLATES . 'metabox_view.php' );
        }

        /**
         * Save meta box values hook.
         *
         *
         * @param int $id as post id.
         *
         */
        function rtc_save_metabox($id) {
            $post_type = get_post_type($id);
            if ('post' != $post_type) {
                return;
            }

            $rtc_author_options = filter_input(INPUT_POST, 'rtc_author_options');
            if (wp_verify_nonce($rtc_author_options, 'save_author_options')) {
                $post_authors = filter_input(INPUT_POST, 'post_authors', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
                $prev_users = get_post_meta($id, 'post_contributors', true);
                if (!empty($post_authors)) {
                    update_post_meta($id, 'post_contributors', $post_authors);
                }
                $deleted_users = array_diff($prev_users, $post_authors);
                foreach ($deleted_users as $k => $v) {
                    $postlist = get_user_meta($v, 'post_contribute', true);
                    $key = array_search($id, $postlist);
                    unset($postlist[$key]);
                    update_user_meta($v, 'post_contribute', $postlist);
                }
                foreach ($post_authors as $key => $value) {
                    $postlist = get_user_meta($value, 'post_contribute', true);
                    if (!is_array($postlist)) {
                        $postlist = array();
                    }
                    if (!in_array($id, $postlist)) {
                        $postlist[] = $id;
                    }
                    update_user_meta($value, 'post_contribute', $postlist);
                }
            }
        }

    }

    endif;
return new rtc_action_handler_admin();
