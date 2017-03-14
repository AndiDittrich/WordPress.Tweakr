<?php

namespace Tweakr;

class PermalinkStructure{

    // settings manager instance
    private $_settingsManager;

    // set of filters used to alter the rewrites
    private $_filters = array(
        'page_rewrite_rules' => 'pageRewrites',
        'rewrite_rules_array' => 'filterRewrites'
    );


    public function __construct($settingsManager){
        global $wp_rewrite;

        // store settings manager instance
        $this->_settingsManager = $settingsManager;

        // initialize filters
        foreach ($this->_filters as $name => $cb){
            add_filter($name, array($this, $cb), 100);
        }
    }

    // flush rewrite rules
    public function clearRules(){
        // remove filters
        foreach ($this->_filters as $name => $cb){
            remove_filter($name, array($this, $cb), 100);
        }

        // regenrate rules
        flush_rewrite_rules();
    }

    // called e.g. on plugin activation + settings update
    public function reloadRules(){
        // regenrate rules
        flush_rewrite_rules();
    }

    public function pageRewrites($rules){
        return $rules;
    }

    // global rewrite rule filtering
    public function filterRewrites($rules){

        // extract some flags
        $embedsDisabled = $this->_settingsManager->getOption('disable-oembed');
        $feedsDisabled = $this->_settingsManager->getOption('rewrites-disable-feeds');

        // process rules
        foreach ($rules as $rule => $rewrite){

            // embed endpoint used and disabled ?
            if ($embedsDisabled && strpos($rewrite, 'embed=true') !== false){
                unset($rules[$rule]);
                continue;
            }

            // disable feed rewrites ?
            if ($feedsDisabled && strpos($rewrite, 'feed=') !== false){
                unset($rules[$rule]);
                continue;
            }
        }

        return $rules;
    }

    
}