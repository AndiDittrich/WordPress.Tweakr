<?php

namespace Tweakr;

class HttpHeader{

    public static function disableRestLink(){
        remove_action( 'template_redirect', 'rest_output_link_header', 11, 0);
    }

    public static function disableShortlink(){
        remove_action('template_redirect', 'wp_shortlink_header', 11, 0);
    }


    // remove pinback xmlrpc url
    public static function disableXPingback(){
        add_filter('wp_headers', function($header){

            // X-Pingback header set ? 
            if (isset($header['X-Pingback'])){
                unset($header['X-Pingback']);
            }

            return $header;
        }, 9999);
    }

}