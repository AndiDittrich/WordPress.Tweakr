<?php
/**
    Tweakr Class
    Version: 1.0
    Author: Andi Dittrich
    Author URI: https://andidittrich.de
    Plugin URI: https://andidittrich.de/go/tweakr
    License: MIT X11-License
    
    Copyright (c) 2016-2017, Andi Dittrich

    Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:
    
    The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
    
    THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
*/

class Tweakr{

    // resource loader instamce
    private $_resourceLoader;
    
    // settings manager instance
    private $_settingsManager;

    // settings view helper
    private $_settingsUtility; 

    // cache manager instance
    private $_cacheManager;

    // permalink management
    private $_rewriteRules;

    // virtual pages (sitemap)
    private $_virtualPageManager;

    public function __construct(){
        // Plugin PRE-INIT (CORE)
        // ------------------------------------------------------------------

        // fetch default config & validators
        $pluginConfig = new Tweakr\skltn\PluginConfig();

        // create new settings utility class
        $this->_settingsManager = new Tweakr\skltn\SettingsManager($pluginConfig);

        // create new cache manager instance
        $this->_cacheManager = new Tweakr\skltn\CacheManager();

        // permalink management - depends on activation hooks!
        $this->_rewriteRules = new Tweakr\RewriteRules($this->_settingsManager);

        // virtual pages (rewrite endpoints)
        $this->_virtualPageManager = new Tweakr\skltn\VirtualPageManager($this->_rewriteRules);

        // XML Sitemap
        // ------------------------------------------------------------------
        if ($this->_settingsManager->getOption('sitemap-xml-enabled')){
            $xmlSitemap = new Tweakr\XmlSitemap($this->_virtualPageManager);
        }
    }

    public function _wp_init(){

        // load language files
        if ($this->_settingsManager->getOption('translation-enabled')){
            load_plugin_textdomain('tweakr', null, 'tweakr/lang/');
        }

        // create new resource loader
        $this->_resourceLoader = new Tweakr\ResourceLoader($this->_settingsManager, $this->_cacheManager);

        // innitialize rewrite rules
        $this->_rewriteRules->init();
      
        // TinyMCE Tweaks
        // ------------------------------------------------------------------
        $tinymceTweaks = new Tweakr\TinyMCE($this->_settingsManager, $this->_cacheManager);

        // API
        // ------------------------------------------------------------------
        // xmlrpc
        if ($this->_settingsManager->getOption('disable-xmlrpc-api')){
            Tweakr\API::disableXmlRpc();
        }

        // rest api restrictions
        if ($this->_settingsManager->getOption('restrict-rest-api')){
            Tweakr\API::restrictRestApiAccess();
        }

        // New User Notifications
        // ------------------------------------------------------------------
        Tweakr\UserNotification::processNewRegistrations($this->_settingsManager->getOption('user-registration-email-notification'));

        // Mails
        // ------------------------------------------------------------------
        if ($this->_settingsManager->getOption('email-from-auto') || !empty($this->_settingsManager->getOption('email-from-address'))){
            Tweakr\EMail::setMailFromAddress($this->_settingsManager);
        }
        if ($this->_settingsManager->getOption('email-smtp-enabled')){
            Tweakr\EMail::smtpTransport($this->_settingsManager);
        }

        // frontend or admin area ?
        if (is_admin()){
            // add admin menu handler
            add_action('admin_menu', array($this, 'setupBackend'));

            // add plugin upgrade notification
            add_action('in_plugin_update_message-tweakr/Tweakr.php', array($this, 'showUpgradeAvailabilityNotification'), 10, 2);

            // plugin upgraded ?
            if (get_option('tweakr-upgrade', '-') === 'true'){
                // add admin message handler
                add_action('admin_notices', array($this, 'showUpgradeMessage'));
                add_action('network_admin_notices', array($this, 'showUpgradeMessage'));

                // clear flag - avoid issues with caching plugin - override AND delete the flag
                update_option('tweakr-upgrade', '-');
                delete_option('tweakr-upgrade');
            }

            // initialize settings view helper
            $this->_settingsUtility = new Tweakr\skltn\SettingsViewHelper($this->_settingsManager);
        }else{

            // Frontend
            // ------------------------------------------------------------------

            // admin-bar
            if ($this->_settingsManager->getOption('hide-adminbar')){
                Tweakr\Frontend::hideAdminBar();
            }

            // generator tag
            if ($this->_settingsManager->getOption('hide-generator')){
                Tweakr\Frontend::hideGeneratorTag();
            }

            // Windows Live Writer manifest
            if ($this->_settingsManager->getOption('hide-wlwmlink')){
                Tweakr\Frontend::hideWLWMLink();
            }

            // Pagination Links/Preloading
            if ($this->_settingsManager->getOption('hide-meta-pagination-link')){
                Tweakr\Frontend::hideMetaPaginationLinks();
            }

            // Emojis
            if ($this->_settingsManager->getOption('disable-emojis')){
                Tweakr\Frontend::disableEmojis();
            }

            // Resource Hints
            if ($this->_settingsManager->getOption('hide-resource-hints')){
                Tweakr\Frontend::hideResourceHints();
            }

            // Feeds
            // ------------------------------------------------------------------

            // Feed Links
            if ($this->_settingsManager->getOption('hide-feed-link')){
                Tweakr\Feeds::hideFeedLinks();
            }

            // rss
            if ($this->_settingsManager->getOption('disable-rss')){
                Tweakr\Feeds::disableRSS();
            }

            // rdf
            if ($this->_settingsManager->getOption('disable-rdf')){
                Tweakr\Feeds::disableRDF();
            }

            // atom
            if ($this->_settingsManager->getOption('disable-atom')){
                Tweakr\Feeds::disableAtom();
            }

            // Google Analytics
            // ------------------------------------------------------------------

            // Google Universal Analytics
            if ($this->_settingsManager->getOption('google-analytics-enabled')){
                
                // initialize
                $googleAnalytics = new Tweakr\GoogleAnalytics($this->_settingsManager);

                // Google Universal Analytics OptOut Button
                if ($this->_settingsManager->getOption('google-analytics-optout-shortcode')){
                    add_shortcode('googleanalytics-optout', array($googleAnalytics, 'optButtonShortcode'));
                }
            }

            // Piwik Analytics
            // ------------------------------------------------------------------

            // Piwik Analytics
            if ($this->_settingsManager->getOption('piwik-analytics-enabled')){

                // initialize
                $piwikAnalytics = new Tweakr\PiwikAnalytics($this->_settingsManager);
                
                // Piwik Analytics OptOut Button
                if ($this->_settingsManager->getOption('piwik-analytics-optout-shortcode')){
                    add_shortcode('piwikanalytics-optout', array($piwikAnalytics, 'optButtonShortcode'));
                }
            }

            // apply frontend resource loading hooks
            $this->_resourceLoader->frontend();
        }
    }

    // init hook executed with priority 9999
    public function _wp_lateinit(){
        // frontend or admin area ?
        if (is_admin()){
            return;
        }

        // oembeds
        if ($this->_settingsManager->getOption('disable-oembed')){
            Tweakr\Frontend::disableOEmbeds();
        }
    }
    
    public function setupBackend(){
        if (current_user_can('manage_options')){
            // add options page
            $optionsPage = add_menu_page(__('Tweakr Toolkit', 'tweakr'), 'Tweakr', 'administrator', 'Tweakr', array($this, 'settingsPage'), 'dashicons-admin-generic');

            // add links
            add_filter('plugin_row_meta', array($this, 'addPluginPageLinks'), 10, 2);

            // load backend resources
            add_filter('load-'.$optionsPage, array($this->_resourceLoader, 'backendSettings'));

            // call register settings function
            add_action('admin_init', array($this->_settingsManager, 'registerSettings'));
            
            // contextual help
            //$ch = new Tweakr\ContextualHelp($this->_settingsManager);
            //add_filter('load-'.$optionsPage, array($ch, 'contextualHelp'));
        }
    }
    

    // options page
    public function settingsPage(){
        // well...is there no action hook for updating settings in wp ?
        if (isset($_GET['settings-updated'])){
            // generate new salt - don't have to be a cryptographically secure value
            $this->_settingsManager->setOption('salt', Tweakr\skltn\Hash::base64(mt_rand().mt_rand().time(), 20));
            
            // clear cache
            $this->_cacheManager->clearCache();

            // regenerate rewrite rules
            $this->_rewriteRules->reload();
        }
               
        // render settings view
        include(TWEAKR_PLUGIN_PATH.'/views/admin/SettingsPage.phtml');
    }

    // links on the plugin page
    public function addPluginPageLinks($links, $file){
        // current plugin ?
        if ($file == 'tweakr/Tweakr.php'){
            $links[] = '<a href="'.admin_url('admin.php?page=Tweakr'). '">'.__('Settings', 'tweakr').'</a>';
            $links[] = '<a href="https://twitter.com/andidittrich" target="_blank">'.__('News & Updates', 'tweakr').'</a>';
        }

        return $links;
    }
   
    // plugin activation action
    public function _wp_plugin_activate(){
        // initialize rewrite rules
        $this->_rewriteRules->init();

        // clear the cache
        $this->_cacheManager->clearCache();

        // regenerate rewrite rules
        $this->_rewriteRules->reload();
    }

    public function _wp_plugin_deactivate(){
        // remove all rewrite rules
        $this->_rewriteRules->cleanup();
    }

    public function _wp_plugin_upgrade($currentVersion){
        // upgrade successfull
        return true;
    }

    // Show Upgrade Notification in Plugin List for an available new Version
    public function showUpgradeAvailabilityNotification($currentPluginMetadata, $newPluginMetadata){
        // check "upgrade_notice"
        if (isset($newPluginMetadata->upgrade_notice) && strlen(trim($newPluginMetadata->upgrade_notice)) > 0){
            echo '<p style="background-color: #d54e21; padding: 10px; color: #f9f9f9; margin-top: 10px"><strong>Important Upgrade Notice:</strong> ';
            echo esc_html($newPluginMetadata->upgrade_notice), '</p>';
        }
    }

    // Show Admin Notice for Successfull Plugin Upgrade
    public function showUpgradeMessage(){
        // styling
        echo '<div class="notice notice-success is-dismissible"><p>';
        echo '<strong>Tweakr Plugin Upgrade:</strong> The Plugin has been upgraded to <strong>', TWEAKR_VERSION, '</strong>';
        echo '</p></div>';
    }


//!WP::SKELETON

    // static entry/initialize singleton instance
    public static function run($pluginName){
        // check if singleton instance is available
        if (self::$__instance==null){
            // create new instance if not
            $i = self::$__instance = new self();

            // register plugin related hooks
            register_activation_hook($pluginName, array($i, '_wp_plugin_activate'));
            register_deactivation_hook($pluginName, array($i, '_wp_plugin_deactivate'));
            add_action('init', array($i, '_wp_init'));
            add_action('init', array($i, '_wp_lateinit'), 9999);

            // fetch plugin version
            $version = get_option('tweakr-version', '0.0.0');

            // plugin installed ?
            if ($version == '0.0.0'){
                // store new version
                update_option('tweakr-version', '1.3');

            // plugin upgraded ?
            }else if (version_compare('1.3', $version, '>')){
                // run upgrade hook
                if ($i->_wp_plugin_upgrade($version)){
                    // store new version
                    update_option('tweakr-version', '1.3');

                    // set flag (string!)
                    update_option('tweakr-upgrade', 'true');
                }
            }
        }
    }

    // singleton instance
    private static $__instance;
    public static function getInstance(){
        return self::$__instance;
    }
//!!WP::SKELETON
}