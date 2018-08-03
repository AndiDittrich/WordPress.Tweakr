<?php
/**
    Plugin Name: Tweakr - Utility Toolkit
    Plugin URI: https://github.com/AndiDittrich/WordPress.Tweakr
    Description: Supercharges your Blog with WP Core Tweaks, Advanced Features and Utilities
    Version: 2.0
    Author: Andi Dittrich, Aenon Dynamics
    Author URI: https://andidittrich.de
    License: GPL-2.0
    Text Domain: tweakr
    Domain Path: /lang
*/


// Plugin Bootstrap Operation
// AUTO GENERATED CODE - DO NOT EDIT !!!
define('TWEAKR_INIT', true);
define('TWEAKR_VERSION', '2.0');
define('TWEAKR_WPSKLTN_VERSION', '0.16.0');
define('TWEAKR_PLUGIN_TITLE', 'Tweakr - Utility Toolkit');
define('TWEAKR_PLUGIN_HEADLINE', 'Supercharges your Blog with WP Core Tweaks, Advanced Features and Utilities');
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
    require_once(TWEAKR_PLUGIN_PATH.'/skltn/VirtualPageManager.php');
    require_once(TWEAKR_PLUGIN_PATH.'/skltn/RewriteRuleHelper.php');
    require_once(TWEAKR_PLUGIN_PATH.'/skltn/Plugin.php');
    require_once(TWEAKR_PLUGIN_PATH.'/class/API.php');
    require_once(TWEAKR_PLUGIN_PATH.'/class/AutomaticUpdates.php');
    require_once(TWEAKR_PLUGIN_PATH.'/class/EMail.php');
    require_once(TWEAKR_PLUGIN_PATH.'/class/Feeds.php');
    require_once(TWEAKR_PLUGIN_PATH.'/class/Frontend.php');
    require_once(TWEAKR_PLUGIN_PATH.'/class/GoogleAnalytics.php');
    require_once(TWEAKR_PLUGIN_PATH.'/class/HttpHeader.php');
    require_once(TWEAKR_PLUGIN_PATH.'/class/LinkManager.php');
    require_once(TWEAKR_PLUGIN_PATH.'/class/MatomoAnalytics.php');
    require_once(TWEAKR_PLUGIN_PATH.'/class/Metadata.php');
    require_once(TWEAKR_PLUGIN_PATH.'/class/Monitoring.php');
    require_once(TWEAKR_PLUGIN_PATH.'/class/ResourceLoader.php');
    require_once(TWEAKR_PLUGIN_PATH.'/class/RewriteRules.php');
    require_once(TWEAKR_PLUGIN_PATH.'/class/Robots.php');
    require_once(TWEAKR_PLUGIN_PATH.'/class/TinyMCE.php');
    require_once(TWEAKR_PLUGIN_PATH.'/class/Tweakr.php');
    require_once(TWEAKR_PLUGIN_PATH.'/class/UserNotification.php');
    require_once(TWEAKR_PLUGIN_PATH.'/class/XmlSitemap.php');

    
    // startup - NEVER CALL IT OUTSIDE THIS FILE !!
    Tweakr::run(__FILE__);
}else{
    // add admin message handler
    add_action('admin_notices', 'Tweakr_PhpEnvironmentError');
    add_action('network_admin_notices', 'Tweakr_PhpEnvironmentError');
}

