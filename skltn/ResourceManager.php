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
        // regex will match URLs with protocol scheme like http:// ftp://
        // as well as protocol-less schemes like //fonts.example.org
        // and domain relative urls like /img/image1.png
        if ($filename == $url && preg_match('#^(?:/|[a-z]+:/).*$#i', $filename) === 0){
            // append version ?
            if (is_string($version)){
                $filename .= '?' . $version;
            }

            // cache file ?
            if (preg_match('#^cache/(.*)$#', $filename, $matches) === 1){
                // retrieve cache file url (add blog id)
                // add cache hash on request
                $url = CacheManager::getFileUrl($matches[1], ($version === true));

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

    // cache
    private static $__dynamicScriptBuffer = false;

    // enqueue dynamics scripts
    public static function enqueueDynamicScript($script){
        // initialized ?
        if (self::$__dynamicScriptBuffer === false){
            // hook into footer print script action
            add_action('wp_print_footer_scripts', function(){
                echo '<script type="text/javascript">/* <![CDATA[ */', self::$__dynamicScriptBuffer ,' /* ]]> */</script>';
            });

            // clear buffer
            self::$__dynamicScriptBuffer = '';
        }

        // append
        self::$__dynamicScriptBuffer .= $script;
    }
}