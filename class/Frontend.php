<?php

namespace Tweakr;

class Frontend{

    // hide admin bar on frontend
    public static function hideAdminBar(){
        add_filter('show_admin_bar', function(){
            return false;
        });
    }

    // hide generator tag
    public static function hideGeneratorTag(){
        add_filter('the_generator', function(){
            return '';
        });
    }

    // hide Windows Live Writer manifest file link
    public static function hideWLWMLink(){
        remove_action('wp_head', 'wlwmanifest_link');
    }

    // hide pagination links
    public static function hideMetaPaginationLinks(){
        remove_action('wp_head', 'start_post_rel_link', 10, 0);
        remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);
    }

    // hide emojis
    public static function disableEmojis(){
        remove_action('wp_head', 'print_emoji_detection_script', 7);
        remove_action('admin_print_scripts', 'print_emoji_detection_script');
        remove_action('wp_print_styles', 'print_emoji_styles');
        remove_action('admin_print_styles', 'print_emoji_styles');
        remove_filter('the_content_feed', 'wp_staticize_emoji');
        remove_filter('comment_text_rss', 'wp_staticize_emoji');
        remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
    }

    // disable oembeds
    // @see https://codex.wordpress.org/Embeds
    public static function disableOEmbeds(){
        remove_action('rest_api_init', 'wp_oembed_register_route');
        remove_action('wp_head', 'wp_oembed_add_discovery_links');
        remove_action('wp_head', 'wp_oembed_add_host_js');
        remove_filter('oembed_dataparse', 'wp_filter_oembed_result');
        remove_filter('pre_oembed_result', 'wp_filter_pre_oembed_result');
        add_filter('embed_oembed_discover', function(){
            return false;
        }, 9999);

        // disable embed template files - page template is used as fallback
        add_filter('embed_template_hierarchy', function($templates){
            return array();
        }, 9999);
    }

    // hide resource hints (dnsprefetch..)
    public static function hideResourceHints(){
        add_filter('wp_resource_hints', function($hints){
            return array();
        }, 9999);
    }

}