<?php

namespace Tweakr;

use Tweakr\skltn\HtmlUtil;

class Metadata{

    // plugin options
    private $_settingsManager;

    // list of pages to be excluded by robots
    private $_hidePages = array();

    public function __construct($settingsManager){
        // store settings manager instance
        $this->_settingsManager = $settingsManager;

        // get privacy policy page
        $privacyPage = intval(get_option('wp_page_for_privacy_policy', 0));

        // privacy page selected ? hide page ?
        if ($privacyPage > 0 && $settingsManager->getOption('privacy-hide-policypage')){
            $this->_hidePages[] = $privacyPage;
        }

        // add metadata to the page header
        add_action('wp_head', array($this, 'injectMetadata'), 1);
    }


    public function injectMetadata(){
        $post = get_post();

        // post/page in exclude list ?
        if (isset($post) && in_array($post->ID, $this->_hidePages)){
            echo Htmlutil::generateTag('meta', array(
                'name' => 'robots',
                'content' => 'noindex,nofollow'
            )), "\n";
        }
    }
}