<?php

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Handle all Shortcrode Requests
 * @class rtcr_shortcrode_handler
 * @since 1.0.0
 * @author Sarfaraj Kazi
 */
class rtcr_shortcrode_handler
{
    /**
     * Constructor.
     */
    public function __construct()
    {
    	add_filter('the_content', array($this, 'display_contributors'),99);
    	add_action( 'wp', array($this,'change_author_data' ));
    	 add_filter( 'posts_where', array($this,'modifiy_author_archive_query' ));

    }
    function display_contributors($content) {
            global $post;
            $id = $post->ID;
            $contributors = get_post_meta($id, 'post_contributors', true);
            // rtcr_pr($contributors);
            if (!empty($contributors)) {
                $content .= sprintf("<div id='post_contributors'><p>%s</p><ul>", __("Contributors", PLUGIN_DOMAIN));
                foreach ($contributors as $value) {
                    $meta = get_userdata($value);
                    $display_name = $meta->display_name;
                    $avatar = get_avatar_url($value, array('size' => '55'));
                    $url = get_author_posts_url($value);
                    $content .= sprintf("<li><img src='%s'><a href='%s'>%s</a></li>", $avatar, $url, ucwords($display_name));
                }
                $content .= sprintf("</ul></div>", __("Contributors", PLUGIN_DOMAIN));
            }
            return $content;
        }
        function change_author_data(){
            if(!is_admin() && is_author()){
                global $authordata;
                $author = get_user_by( 'slug', get_query_var( 'author_name' ) );
                $authordata = $author;
            }
        }
    	function modifiy_author_archive_query($where){
            if(!is_admin() && is_author()){
                $author = get_user_by( 'slug', get_query_var( 'author_name' ) );
                $authorid = $author->ID;
                $postids = get_user_meta($authorid,'post_contribute',true);
                if($postids){
                    $postids = implode(",", $postids);
                    $where .= "OR ID IN ($postids)";
                }
            }
            return $where;
        }

}

return new rtcr_shortcrode_handler();