<?php
/**
    Plugin Name: Tweakr Toolkit
    Plugin URI: https://andidittrich.de/go/tweakr
    Description: Extends your WordPress Blog with a bunch of common Tweaks and Utilities
    Version: 1.2-BETA1
    Author: Andi Dittrich
    Author URI: https://andidittrich.de
    License: MIT X11 License

    ----
    The MIT License (X11 License)
    Copyright (c) 2016-2017 Andi Dittrich <https://andidittrich.de>
    Permission is hereby granted, free of charge, to any personobtaining a copy of this software and associated documentationfiles (the "Software"), to deal in the Software withoutrestriction, including without limitation the rights to use,copy, modify, merge, publish, distribute, sublicense, and/or sellcopies of the Software, and to permit persons to whom theSoftware is furnished to do so, subject to the followingconditions:
    The above copyright notice and this permission notice shall beincluded in all copies or substantial portions of the Software.
    THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIESOF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE ANDNONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHTHOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISINGFROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OROTHER DEALINGS IN THE SOFTWARE.
*/


/*  AUTO GENERATED FILE - DO NOT EDIT !!
    WP-SKELEKTON | MIT X11 License | https://github.com/AndiDittrich/WP-Skeleton
    ------------------------------------
    Plugin Bootstrap Operation
*/
define('TWEAKR_INIT', true);
define('TWEAKR_VERSION', '1.2-BETA1');
define('TWEAKR_PLUGIN_PATH', dirname(__FILE__));
define('TWEAKR_PLUGIN_URL', plugins_url('/tweakr/'));


// PHP Version Error Notice
function Tweakr_PhpEnvironmentError(){
    // error message
    $message = '<strong>Tweakr Plugin Error:</strong> Your PHP Version <strong style="color: #cc0a00">('. phpversion() .')</strong> is outdated! <strong>PHP 5.4 or greater</strong> is required to run this plugin!';

    // styling
    echo '<div class="notice notice-error is-dismissible"><p>', $message, '</p></div>';
}

// check php version
if (version_compare(phpversion(), '5.4', '>=')){
    // load classes
    require_once(TWEAKR_PLUGIN_PATH.'/skltn/HtmlUtil.php');
    require_once(TWEAKR_PLUGIN_PATH.'/skltn/SettingsManager.php');
    require_once(TWEAKR_PLUGIN_PATH.'/skltn/SettingsViewHelper.php');
    require_once(TWEAKR_PLUGIN_PATH.'/skltn/CacheManager.php');
    require_once(TWEAKR_PLUGIN_PATH.'/skltn/ResourceManager.php');
    require_once(TWEAKR_PLUGIN_PATH.'/skltn/PluginConfig.php');
    require_once(TWEAKR_PLUGIN_PATH.'/skltn/CssBuilder.php');
    require_once(TWEAKR_PLUGIN_PATH.'/skltn/Hash.php');
    require_once(TWEAKR_PLUGIN_PATH.'/class/API.php');
    require_once(TWEAKR_PLUGIN_PATH.'/class/EMail.php');
    require_once(TWEAKR_PLUGIN_PATH.'/class/Feeds.php');
    require_once(TWEAKR_PLUGIN_PATH.'/class/Frontend.php');
    require_once(TWEAKR_PLUGIN_PATH.'/class/GoogleAnalytics.php');
    require_once(TWEAKR_PLUGIN_PATH.'/class/PermalinkStructure.php');
    require_once(TWEAKR_PLUGIN_PATH.'/class/PiwikAnalytics.php');
    require_once(TWEAKR_PLUGIN_PATH.'/class/ResourceLoader.php');
    require_once(TWEAKR_PLUGIN_PATH.'/class/TinyMCE.php');
    require_once(TWEAKR_PLUGIN_PATH.'/class/Tweakr.php');
    require_once(TWEAKR_PLUGIN_PATH.'/class/UserNotification.php');

    
    // startup - NEVER CALL IT OUTSIDE THIS FILE !!
    Tweakr::run(__FILE__);
}else{
    // add admin message handler
    add_action('admin_notices', 'Tweakr_PhpEnvironmentError');
    add_action('network_admin_notices', 'Tweakr_PhpEnvironmentError');
}

