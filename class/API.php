<?php

namespace Tweakr;

class API{

    // disable xmlrpc api
    public static function disableXmlRpc(){

        // Hardcore Solution
        // it immediately stops the script execution of all requests to xmlrpc.php
        // the wp_xmlrpc_server instance is NEVER invoked!
        // XMLRPC_REQUEST constant is set on top of the xmlrpc.php file
        // @see https://core.trac.wordpress.org/browser/tags/4.7.3/src/xmlrpc.php
        if (defined('XMLRPC_REQUEST') && XMLRPC_REQUEST === true){
            http_response_code(403);
            die('XMLRPC Rejected!');
        }

        /*
        // disable XML-RPC methods that require a authentication
        // won't disable public methods!
        add_filter('xmlrpc_enabled', function(){
            return false;
        }, 9999);

        // disable all methods by removing them from list
        add_filter('xmlrpc_methods', function($methods){
            return array();
        }, 9999);
        */

        // RSD Content: /xmlrpc.php?rsd
        // the rsd content is directly generated within xmlrpc.php (WP v4.7.3)
        // it can only disabled by removing the xmlrpc.php file or interrupting its execution
        
        // remove xmlrpc links
        remove_action('wp_head', 'rsd_link');

        // remove pingback link
        add_filter('wp_headers', function($headers){
            unset($headers['X-Pingback']);
            return $headers;
        }, 9999);
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