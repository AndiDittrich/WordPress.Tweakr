<?php

namespace Tweakr;

class LinkManager{

    // use virtual links instaed of permalinks (doamin independent)
    public static function useVirtualPermalinks(){

        // called via wp-link-ajax action
        // modify link dialog inserts
        add_filter('wp_link_query', function($results){

            // filter permalinks
            $results = array_map(function($post){
                // tweakr internal links scheme
                $post['permalink'] = 'link://post.local/' . $post['ID'];

                return $post;
            }, $results);

            return $results;
        });

        // called via wp-link-ajax action
        // modify media urls
        // wp_ajax_query_attachments -> wp_prepare_attachment_for_js
        add_filter('wp_prepare_attachment_for_js', function($response){

            // tweakr internal links scheme
            $response['link'] = 'link://attachment.local/' . $response['id'];

            return $response;
        });

        // filter virtual permalinks via the_content
        // virtual link to permalink
        add_filter('the_content', function($content){

            // find internal links
            $content = preg_replace_callback('#link://(\w+)\.local/(\d+?)#Ui', function($match){
                // replace with real permalink
                return get_permalink(intval($match[2]));
            }, $content);

            return $content;
        });
    }

}