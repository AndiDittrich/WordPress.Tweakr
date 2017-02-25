<?php

namespace Tweakr;

use \Tweakr\skltn\ResourceManager as ResourceManager;

class GoogleAnalytics{

    // analytics tracking snippet
    // @see https://developers.google.com/analytics/devguides/collection/analyticsjs/
    const GA_TRACKING_CODE = "
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');";

    // add google analytics tracking code
    public static function init($trackingID, $anonymizeIP = false){
        // generate init code
        $analyticsInit = array(
            "ga('create', '". esc_js($trackingID) . "', 'auto');",
        );

        // use anonymize-ip option ?
        if ($anonymizeIP){
            array_push($analyticsInit, "ga('set', 'anonymizeIp', true);");
        }

        // send page view
        array_push($analyticsInit, "ga('send', 'pageview');");

        // enqueue code (printed within wp_footer)
        ResourceManager::enqueueDynamicScript(self::GA_TRACKING_CODE . implode("\n", $analyticsInit));
    }
}