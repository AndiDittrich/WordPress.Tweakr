<?php

namespace Tweakr;

class EMail{

    // fix WordPress Mail-From Setting to avoud PHP Errors
    public static function fixMailFromAddress(){
        // set from to wordpress@yourdomain.tld
        // this is always a valid value!
        add_filter('wp_mail_from', function($originalFrom){
            return 'wordpress@' . $_SERVER['HTTP_HOST'];
        });

        // set the name to your blog name
        add_filter('wp_mail_from_name', function($originalName){
            return get_bloginfo('name');
        });
    }
    
}