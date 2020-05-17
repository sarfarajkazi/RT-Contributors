<?php

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Handle all Shortcode Requests
 * @class rtc_shortcode_handler
 * @since 1.0.0
 * @author Sarfaraj Kazi
 */
class rtc_shortcode_handler {

    /**
     * Constructor.
     */
    public function __construct() {
        add_filter('the_content', array($this, 'rtc_display_contributors'), 99);
        add_action('wp', array($this, 'rtc_change_author_data'));
        add_filter('posts_where', array($this, 'rtc_modifiy_author_archive_query'));
        add_action('wp_head', array($this, 'rtc_inject_css'));
    }

    /**
     * Inject Css into header.
     *
     *
     */
    function rtc_inject_css() {
        ?>
        <style type="text/css">
            #post_contributors li {
                display: inline-block;
                text-decoration: none;
                text-align: center;
            }
            #post_contributors li img {
                margin: auto;
            }
        </style>
        <?php

    }

    /**
     * Filters the_content hook to display contributors
     *
     * @param $content.
     *
     * @return string $content with contributors.
     */
    function rtc_display_contributors($content) {
        global $post;
        $id = $post->ID;
        $contributors = get_post_meta($id, 'post_contributors', true);
        // rtc_pr($contributors);
        if (!empty($contributors)) {
            $content .= sprintf("<div id='post_contributors'><p>%s</p><ul>", __("Contributors", 'rt-contributors'));
            foreach ($contributors as $value) {
                $meta = get_userdata($value);
                $display_name = $meta->display_name;
                $avatar = get_avatar_url($value, array('size' => '55'));
                $url = get_author_posts_url($value);
                $content .= sprintf("<li><img src='%s'><a href='%s'>%s</a></li>", $avatar, $url, ucwords($display_name));
            }
            $content .= sprintf("</ul></div>", __("Contributors", 'rt-contributors'));
        }
        return $content;
    }

    /**
     * Filters author name on archive page
     *
     */
    function rtc_change_author_data() {
        if (!is_admin() && is_author()) {
            global $authordata;
            $author = get_user_by('slug', get_query_var('author_name'));
            $authordata = $author;
        }
    }

    /**
     * Filters author archive query
     *
     *
     * @param string $where Query.
     *
     * @return string $where with modifided query.
     */
    function rtc_modifiy_author_archive_query($where) {
        if (!is_admin() && is_author()) {
            $author = get_user_by('slug', get_query_var('author_name'));
            $authorid = $author->ID;
            $postids = get_user_meta($authorid, 'post_contribute', true);
            if ($postids) {
                $postids = implode(",", $postids);
                $where .= "OR ID IN ($postids)";
            }
        }
        return $where;
    }

}

return new rtc_shortcode_handler();
