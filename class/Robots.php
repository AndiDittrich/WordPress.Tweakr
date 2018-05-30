<?php

namespace Tweakr;

class Robots{

    // plugin options
    private $_settingsManager;

    public function __construct($settingsManager){
        // store settings manager instance
        $this->_settingsManager = $settingsManager;

        // sitemap + linking enabled ?
        if ($this->_settingsManager->getOption('sitemap-xml-enabled') && $this->_settingsManager->getOption('sitemap-xml-robotstxt')){
            add_filter('robots_txt', array($this, 'robots'), 9999, 2);
        }
    }

    // filter robots.txt content
    public function robots($output, $public){

        // public site ?
        if ($public){
            // prepend sitemal.xml url
            $sitemapUrl = get_site_url(null, '/sitemap.xml');
            $output = "Sitemap: $sitemapUrl\n" . $output;
        }

        return $output;
    }

}