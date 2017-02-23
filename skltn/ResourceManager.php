<?php
/*  AUTO GENERATED FILE - DO NOT EDIT !!
    WP-SKELEKTON | MIT X11 License | https://github.com/AndiDittrich/WP-Skeleton
    ------------------------------------
    Manages plugin related static resources
*/
namespace Tweakr\skltn;

class ResourceManager{

    // generate the resource url for ALL plugin related public files
    public static function getResourceUrl($filename, $version=null){
        // strip whitespaces
        $filename = trim($filename);

        // apply resource filter
        $url = apply_filters('tweakr_resource_url', $filename, TWEAKR_PLUGIN_URL, $version);

        // filename not changed and relative url ? prepend plugin url, keep absolute path
        if ($filename == $url && preg_match('#^(?:/|[a-z]:/).*$#i', $filename) === 0){
            // append version ?
            if ($version){
                $filename .= '?' . $version;
            }

            // cache file ?
            if (preg_match('#^cache/(.*)$#', $filename, $matches) === 1){
                // retrieve cache file url (add blog id)
                $url = CacheManager::getFileUrl($matches[1]);

                // default: resource file
            }else{
                $url = TWEAKR_PLUGIN_URL . 'resources/' . $filename;
            }
        }

        return $url;
    }

    // highlevel enqueue wrapper
    public static function enqueueStyle($name, $filename, $dependencies = array(), $version = TWEAKR_VERSION){
        // get the resource url
        $url = self::getResourceUrl($filename);

        // trigger wordpress script loader
        if ($url) {
            wp_enqueue_style($name, $url, $dependencies, $version);
        }
    }

    // highlevel enqueue wrapper
    public static function enqueueScript($name, $filename, $dependencies = array(), $version = TWEAKR_VERSION, $inFooter = true){
        // get the resource url
        $url = self::getResourceUrl($filename);

        // trigger wordpress script loader
        if ($url){
            wp_enqueue_script($name, $url, $dependencies, $version, $inFooter);
        }
    }

}