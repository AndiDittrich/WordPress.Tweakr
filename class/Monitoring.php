<?php

namespace Tweakr;

class Monitoring{

    const API_VERSION = '1.0';

    public function registerRestEndpoint(){
        // scope
        add_action('rest_api_init', function(){

            // add new route
            register_rest_route('tweakr/v' . self::API_VERSION, '/monitoring', array(
                'methods' => 'GET',
                'callback' => array($this, 'show'),

                'permission_callback' => function(){
                    current_user_can('manage_options');
                }
            ));
        });
    }

    public function show(){
        // Check if get_plugins() function exists. This is required on the front end of the
        // site, since it is in a file that is normally only loaded in the admin.
        // @see https://codex.wordpress.org/Function_Reference/get_plugins
        if (!function_exists('get_plugins')){
            require_once ABSPATH.'wp-admin/includes/plugin.php';
        }

        // response object
        $response = array(
            'wp_version' => get_bloginfo('version'),
            'php_version' => phpversion(),
            'plugins' => array(),
            'themes' => array()
        );

        // generate plugin data
        foreach (get_plugins() as $file => $plugin){
            // extract keys
            $response['plugins'][] = array(
                'name' => $plugin['Name'],
                'version' => $plugin['Version'],
                'url' => $plugin['PluginURI'],
                'active' => is_plugin_active($file)
            );
        }

        // generate theme data
        foreach (wp_get_themes() as $theme){
            // extract properties
            $response['themes'][] = array(
                'name' => $theme->Name,
                'version' => $theme->Version
            );
        }

        return $response;
    }


}