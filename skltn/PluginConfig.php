<?php
/*  AUTO GENERATED FILE - DO NOT EDIT !!
    WP-SKELEKTON | MIT X11 License | https://github.com/AndiDittrich/WP-Skeleton
    ------------------------------------
    Plugin Config Defaults
*/
namespace Tweakr\skltn;

class PluginConfig{
    
    // config keys with default values
    private $_defaultConfig = array(
        'translation-enabled' => false,
        'salt' => '0A0B0C0DFF',
        'disable-xmlrpc-api' => false,
        'restrict-rest-api' => false,
        'hide-adminbar' => false,
        'hide-generator' => false,
        'hide-wlwmlink' => false,
        'hide-meta-pagination-link' => false,
        'disable-emojis' => false,
        'disable-oembed' => false,
        'hide-feed-link' => false,
        'hide-resource-hints' => false,
        'email-from-auto' => false,
        'email-from-address' => '',
        'email-from-name' => '',
        'email-smtp-enabled' => false,
        'email-smtp-host' => '',
        'email-smtp-port' => 587,
        'email-smtp-username' => '',
        'email-smtp-password' => '',
        'email-smtp-ssltls' => 'tls',
        'user-registration-email-notification' => 'default',
        'disable-rss' => false,
        'disable-atom' => false,
        'disable-rdf' => false,
        'google-analytics-enabled' => false,
        'google-analytics-trackingid' => '',
        'google-analytics-anonymizeip' => true,
        'google-analytics-optout-shortcode' => false,
        'piwik-analytics-enabled' => false,
        'piwik-analytics-host' => '',
        'piwik-analytics-siteid' => -1,
        'piwik-analytics-optout-shortcode' => false,
        'piwik-analytics-subdomain-tracking' => false,
        'piwik-analytics-prepend-domain' => false,
        'piwik-analytics-dnt' => true,
        'pwiki-analytics-simple-pagetitle' => false,
        'tinymce-autowidth' => false,
        'tinymce-visualcomponents' => false,
        'rewrites-disable-feeds' => false,
        'rewrites-page-ext-html' => false,
        'rewrites-category-ext-html' => false,
        'sitemap-xml-enabled' => false
    );

    // validation
    private $_validators = array(
        'translation-enabled' => 'boolean',
        'salt' => 'string',
        'disable-xmlrpc-api' => 'boolean',
        'restrict-rest-api' => 'boolean',
        'hide-adminbar' => 'boolean',
        'hide-generator' => 'boolean',
        'hide-wlwmlink' => 'boolean',
        'hide-meta-pagination-link' => 'boolean',
        'disable-emojis' => 'boolean',
        'disable-oembed' => 'boolean',
        'hide-feed-link' => 'boolean',
        'hide-resource-hints' => 'boolean',
        'email-from-auto' => 'boolean',
        'email-from-address' => 'string',
        'email-from-name' => 'string',
        'email-smtp-enabled' => 'boolean',
        'email-smtp-host' => 'string',
        'email-smtp-port' => 'int',
        'email-smtp-username' => 'string',
        'email-smtp-password' => 'string',
        'email-smtp-ssltls' => 'string',
        'user-registration-email-notification' => 'string',
        'disable-rss' => 'boolean',
        'disable-atom' => 'boolean',
        'disable-rdf' => 'boolean',
        'google-analytics-enabled' => 'boolean',
        'google-analytics-trackingid' => 'string',
        'google-analytics-anonymizeip' => 'boolean',
        'google-analytics-optout-shortcode' => 'boolean',
        'piwik-analytics-enabled' => 'boolean',
        'piwik-analytics-host' => 'string',
        'piwik-analytics-siteid' => 'int',
        'piwik-analytics-optout-shortcode' => 'boolean',
        'piwik-analytics-subdomain-tracking' => 'boolean',
        'piwik-analytics-prepend-domain' => 'boolean',
        'piwik-analytics-dnt' => 'boolean',
        'pwiki-analytics-simple-pagetitle' => 'boolean',
        'tinymce-autowidth' => 'boolean',
        'tinymce-visualcomponents' => 'boolean',
        'rewrites-disable-feeds' => 'boolean',
        'rewrites-page-ext-html' => 'boolean',
        'rewrites-category-ext-html' => 'boolean',
        'sitemap-xml-enabled' => 'boolean'
    );

    // get the default plugin config
    public function getDefaults(){
        return $this->_defaultConfig;
    }

    // get all validators
    public function getValidators(){
        return $this->_validators;
    }

    // get corresponding validator in case its available
    public function getValidator($key){
        if (isset($this->_validators[$key])){
            return $this->_validators[$key];
        }else{
            return null;
        }
    }

    // add dynamics key/value/validator pairs
    public function add($key, $value, $validator = null){
        // add key/value pair
        $this->_defaultConfig[$key] = $value;

        // validator given ?
        if ($validator){
            $this->_validators[$key] = $validator;
        }
    }
}