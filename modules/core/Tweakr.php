<?php

class Tweakr extends \tweakr\skltn\Plugin{

    // resource loader instamce
    private $_resourceLoader;

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

        // Automatic Updates (WordPress Installation)
        // ------------------------------------------------------------------
        if ($this->_settingsManager->getOption('autoupdate-disable') === true){
            Tweakr\AutomaticUpdates::disableAll();
        }

        // control component updates
        Tweakr\AutomaticUpdates::coreUpdates($this->_settingsManager->getOption('autoupdate-core'));
        Tweakr\AutomaticUpdates::pluginUpdates($this->_settingsManager->getOption('autoupdate-plugins'));
        Tweakr\AutomaticUpdates::themeUpdates($this->_settingsManager->getOption('autoupdate-themes'));
        Tweakr\AutomaticUpdates::translationUpdates($this->_settingsManager->getOption('autoupdate-translations'));

         // set default settings page
         $this->_pluginMetaSettingsPage = 'tweaks';
         $this->_pluginMetaAboutPage = 'about';
 
         // plugin meta links
         $this->_pluginMetaLinks = array(
             'https://twitter.com/andidittrich' => __('News & Updates', 'tweakr'),
             'https://github.com/AndiDittrich/WordPress.Tweakr/issues' => __('Report Bugs', 'tweakr')
         );
    }

    public function _wp_init(){
        // execute extended functions
        parent::_wp_init();

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
            Tweakr\HttpHeader::disableXPingback();
        }

        // rest api restrictions
        if ($this->_settingsManager->getOption('restrict-rest-api')){
            Tweakr\API::restrictRestApiAccess();
        }

        // monitoring
        if ($this->_settingsManager->getOption('monitoring-enabled')){
            $monitoring = new Tweakr\Monitoring();
            $monitoring->registerRestEndpoint();
        }

        // User Notifications
        // ------------------------------------------------------------------
        Tweakr\UserNotification::processNewRegistrations($this->_settingsManager->getOption('user-registration-email-notification'));

        if ($this->_settingsManager->getOption('autoupdate-notifications') === false){
            Tweakr\UserNotification::suppressCoreUpdateNotifications();
        }

        // Mails
        // ------------------------------------------------------------------
        if ($this->_settingsManager->getOption('email-from-auto') || !empty($this->_settingsManager->getOption('email-from-address'))){
            Tweakr\EMail::setMailFromAddress($this->_settingsManager);
        }
        if ($this->_settingsManager->getOption('email-smtp-enabled')){
            Tweakr\EMail::smtpTransport($this->_settingsManager);
        }

        // Permalinks
        // ------------------------------------------------------------------
        if ($this->_settingsManager->getOption('permalinks-virtual')){
            Tweakr\LinkManager::useVirtualPermalinks();
        }

        // HTTP Header
        // ------------------------------------------------------------------
        if ($this->_settingsManager->getOption('httpheader-shortlink')){
            Tweakr\HttpHeader::disableShortlink();
        }
        if ($this->_settingsManager->getOption('httpheader-restlink')){
            Tweakr\HttpHeader::disableRestLink();
        }

        // frontend or admin area ?
        if (is_admin()){
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

            // Smileys
            if ($this->_settingsManager->getOption('disable-smileys')){
                Tweakr\Frontend::disableSmileys();
            }

            // Resource Hints
            if ($this->_settingsManager->getOption('hide-resource-hints')){
                Tweakr\Frontend::hideResourceHints();
            }

            // Pingbacks
            if ($this->_settingsManager->getOption('disable-pingbacks')){
                Tweakr\Frontend::disablePingbacks();
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

            // Matomo Analytics
            // ------------------------------------------------------------------

            // Piwik Analytics
            if ($this->_settingsManager->getOption('piwik-analytics-enabled')){

                // initialize
                $matomoAnalytics = new Tweakr\MatomoAnalytics($this->_settingsManager);
                
                // Piwik Analytics OptOut Button
                if ($this->_settingsManager->getOption('piwik-analytics-optout-shortcode')){
                    add_shortcode('piwikanalytics-optout', array($matomoAnalytics, 'optButtonShortcode'));
                }
            }

            // Robots.txt
            // ------------------------------------------------------------------

            // Alter robots.txt
            if ($this->_settingsManager->getOption('sitemap-xml-robotstxt')){
                // initialize
                $robotsTxt = new Tweakr\Robots($this->_settingsManager);
            }

            // Page Metadata processing
            // ------------------------------------------------------------------

            $metadataManager = new Tweakr\Metadata($this->_settingsManager);

            // Frontend Resources
            // ------------------------------------------------------------------

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
    
    public function ssssetupBackend(){
        if (current_user_can('manage_options')){
            // add options page
            $optionsPage = add_menu_page(TWEAKR_PLUGIN_TITLE, 'Tweakr', 'administrator', 'Tweakr', array($this, 'settingsPage'), 'dashicons-admin-generic');

            // add links
            add_filter('plugin_action_links', array($this, 'addPluginPageSettingsLink'), 10, 2);
            add_filter('plugin_row_meta', array($this, 'addPluginMetaLinks'), 10, 2);

            // load backend resources
            add_filter('load-'.$optionsPage, array($this->_resourceLoader, 'backendSettings'));

            // call register settings function
            add_action('admin_init', array($this->_settingsManager, 'registerSettings'));
            
            // contextual help
            //$ch = new Tweakr\ContextualHelp($this->_settingsManager);
            //add_filter('load-'.$optionsPage, array($ch, 'contextualHelp'));
        }
    }
    
    // backend menu structure
    protected function getBackendMenu(){
        // menu group + first entry
        return array(
            'pagetitle' => TWEAKR_PLUGIN_TITLE,
            'title' => 'Tweakr',
            'title2' => 'Tweaks',
            'slug' => 'tweakr-tweaks',
            'icon' => 'dashicons-admin-generic',
            'template' => 'tweaks/TweaksPage',
            'resources' => array($this->_resourceLoader, 'backendSettings'),
            'render' => array($this, 'settingsPage'),
            'items' => array(

                // analytics
                array(
                    'pagetitle' => TWEAKR_PLUGIN_TITLE,
                    'title' => 'Analytics',
                    'slug' => 'tweakr-analytics',
                    'template' => 'analytics/AnalyticsPage',
                    'resources' => array($this->_resourceLoader, 'backendSettings')
                ),

                // system
                array(
                    'pagetitle' => TWEAKR_PLUGIN_TITLE,
                    'title' => 'System',
                    'slug' => 'tweakr-system',
                    'template' => 'system/SystemPage',
                    'resources' => array($this->_resourceLoader, 'backendSettings')
                ),
 
                // about
                array(
                    'pagetitle' => TWEAKR_PLUGIN_TITLE,
                    'title' => 'About',
                    'slug' => 'tweakr-about',
                    'template' => 'about/AboutPage',
                    'resources' => array($this->_resourceLoader, 'backendSettings')
                )
            )
        );
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
        //include(TWEAKR_PLUGIN_PATH.'/views/admin/SettingsPage.phtml');

        return array();
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
}