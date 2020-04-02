<?php
/**
    Plugin Name: Tweakr - Utility Toolkit
    Plugin URI: https://github.com/AndiDittrich/WordPress.Tweakr
    Description: Supercharges your Blog with WP Core Tweaks, Advanced Features and Utilities
    Version: 2.1
    Author: Andi Dittrich, Aenon Dynamics
    Author URI: https://andidittrich.de
    License: GPL-2.0
    Text Domain: tweakr
    Domain Path: /lang
    Requires PHP: 5.6
*/


// Plugin Bootstrap Operation
// AUTO GENERATED CODE - DO NOT EDIT !!!
define('TWEAKR_INIT', true);
define('TWEAKR_VERSION', '2.1');
define('TWEAKR_WPSKLTN_VERSION', '0.22.1');
define('TWEAKR_PHP_VERSION', '5.6');
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
if (version_compare(phpversion(), TWEAKR_PHP_VERSION, '>=')){
    // load classes
    require_once(TWEAKR_PLUGIN_PATH.'/modules/skltn/CacheManager.php');
    require_once(TWEAKR_PLUGIN_PATH.'/modules/skltn/CssBuilder.php');
    require_once(TWEAKR_PLUGIN_PATH.'/modules/skltn/EnvironmentCheck.php');
    require_once(TWEAKR_PLUGIN_PATH.'/modules/skltn/Hash.php');
    require_once(TWEAKR_PLUGIN_PATH.'/modules/skltn/HtmlUtil.php');
    require_once(TWEAKR_PLUGIN_PATH.'/modules/skltn/Plugin.php');
    require_once(TWEAKR_PLUGIN_PATH.'/modules/skltn/PluginConfig.php');
    require_once(TWEAKR_PLUGIN_PATH.'/modules/skltn/ResourceManager.php');
    require_once(TWEAKR_PLUGIN_PATH.'/modules/skltn/RewriteRuleHelper.php');
    require_once(TWEAKR_PLUGIN_PATH.'/modules/skltn/SettingsManager.php');
    require_once(TWEAKR_PLUGIN_PATH.'/modules/skltn/SettingsViewHelper.php');
    require_once(TWEAKR_PLUGIN_PATH.'/modules/skltn/VirtualPageManager.php');
    require_once(TWEAKR_PLUGIN_PATH.'/modules/core/API.php');
    require_once(TWEAKR_PLUGIN_PATH.'/modules/core/AutomaticUpdates.php');
    require_once(TWEAKR_PLUGIN_PATH.'/modules/core/EMail.php');
    require_once(TWEAKR_PLUGIN_PATH.'/modules/core/Feeds.php');
    require_once(TWEAKR_PLUGIN_PATH.'/modules/core/Frontend.php');
    require_once(TWEAKR_PLUGIN_PATH.'/modules/core/GoogleAnalytics.php');
    require_once(TWEAKR_PLUGIN_PATH.'/modules/core/HttpHeader.php');
    require_once(TWEAKR_PLUGIN_PATH.'/modules/core/LinkManager.php');
    require_once(TWEAKR_PLUGIN_PATH.'/modules/core/MatomoAnalytics.php');
    require_once(TWEAKR_PLUGIN_PATH.'/modules/core/Metadata.php');
    require_once(TWEAKR_PLUGIN_PATH.'/modules/core/Monitoring.php');
    require_once(TWEAKR_PLUGIN_PATH.'/modules/core/ResourceLoader.php');
    require_once(TWEAKR_PLUGIN_PATH.'/modules/core/RewriteRules.php');
    require_once(TWEAKR_PLUGIN_PATH.'/modules/core/Robots.php');
    require_once(TWEAKR_PLUGIN_PATH.'/modules/core/TinyMCE.php');
    require_once(TWEAKR_PLUGIN_PATH.'/modules/core/Tweakr.php');
    require_once(TWEAKR_PLUGIN_PATH.'/modules/core/UserNotification.php');
    require_once(TWEAKR_PLUGIN_PATH.'/modules/core/XmlSitemap.php');

    
    // startup - NEVER CALL IT OUTSIDE THIS FILE !!
    Tweakr::run(__FILE__);
}else{
    // add admin message handler
    add_action('admin_notices', 'Tweakr_PhpEnvironmentError');
    add_action('network_admin_notices', 'Tweakr_PhpEnvironmentError');
}