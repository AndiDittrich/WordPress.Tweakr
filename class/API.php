<?php

namespace Tweakr;

class API{

    // disable xmlrpc api
    public static function disableXmlRpc(){
        // disable processing
        add_filter('xmlrpc_enabled', function(){
            return false;
        });

        // remove xmlrpc links
        remove_action('wp_head', 'rsd_link');

        // remove pingback link
        add_filter('wp_headers', function($headers){
            unset($headers['X-Pingback']);
            return $headers;
        });
    }

    // disable rest api for unauthenticate users
    public static function restrictRestApiAccess(){
        // hide link
        remove_action('wp_head', 'rest_output_link_wp_head', 10);

        // throw an error for non editor users
        if (!current_user_can('publish_pages')){
            // hook into the rest auth errors
            add_filter('rest_authentication_errors', function ($errors){

                // throw error
                return new \WP_Error('rest_unavailable', '403 Forbidden - API Endpoint unavailable', array(
                    'status' => 403
                ));

            }, 9999, 1);
        }
    }
}