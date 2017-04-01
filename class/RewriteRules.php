<?php

namespace Tweakr;

use Tweakr\skltn\RewriteRuleHelper;

class RewriteRules
    extends RewriteRuleHelper{

    // settings manager instance
    private $_settingsManager;

/*
    // set of filters used to alter the rewrites
    private $_filters = array(
        'page_rewrite_rules' => 'pageRewrites',
        'category_rewrite_rules' => 'categoryRewrites',
//        'post_tag_rewrite_rules' => 'tagRewrites',
        'rewrite_rules_array' => 'filterRewrites'
    );
*/
    public function __construct($settingsManager){
        parent::__construct();

        $this->_settingsManager = $settingsManager;
    }

    // executed on init hook
    public function init(){
        // initialize rewrite filters
        //foreach ($this->_filters as $name => $cb){
            //add_filter($name, array($this, $cb), 100);
        //}

        $this->addRuleFilter('page_rewrite_rules', array($this, 'pageRewrites'));
        $this->addRuleFilter('category_rewrite_rules', array($this, 'categoryRewrites'));
        $this->addRuleFilter('rewrite_rules_array', array($this, 'filterRewrites'));

        // fix trailing slashes
        add_filter('user_trailingslashit', array($this, 'fixTrailingslashes'), 100, 2);

        // filter term links (.html extension)
        add_filter('term_link', array($this, 'filterTermLinks'), 100, 3);

        // add .html to pages ? filter links
        if ($this->_settingsManager->getOption('rewrites-page-ext-html')){
            add_filter('_get_page_link', function($link){
                return $link . '.html';
            }, 100);
        }

        // additional rulesets
        do_action('tweakr_rewriterules_init');
    }

    // helper function
    public function filterTermLinks($link, $term, $taxonomy){
        // add .html to categories ? filter links
        if ($taxonomy == 'category' && $this->_settingsManager->getOption('rewrites-category-ext-html')){
            return $link . '.html';
        }
/*
        // add .html to tags ? filter links
        if ($taxonomy == 'post_tag' && $this->_settingsManager->getOption('rewrites-posttag-ext-html')){
            return $link . '.html';
        }
*/
        // no changes
        return $link;
    }

/*
    // flush rewrite rules
    public function cleanup(){
        // remove filters
        foreach ($this->_filters as $name => $cb){
            remove_filter($name, array($this, $cb), 100);
        }

        // regenrate rules
        parent::cleanup();
    }
*/
    // called e.g. on plugin activation + settings update
    public function reload(){
        // regenrate rules
        flush_rewrite_rules();
    }

    // removed trailing slashed from permalink structure
    public function fixTrailingslashes($url, $posttype){
        // add .html to pages ?
        if ($posttype == 'page' && $this->_settingsManager->getOption('rewrites-page-ext-html')){
            return untrailingslashit($url);

        // add .html to categories
        }else if ($posttype == 'category' && $this->_settingsManager->getOption('rewrites-category-ext-html')){
            return untrailingslashit($url);
/*
        // add .html to post_tag
        }else if ($posttype == 'post_tag' && $this->_settingsManager->getOption('rewrites-posttag-ext-html')){
            return untrailingslashit($url);
*/
        }else{
            return $url;
        }
    }

    // filters all page rewrite rules
    public function pageRewrites($rules){

         // filtering
        return $this->applyRewriteFilter(function($rule){

            // add .html extension to pages ?
            if ($this->_settingsManager->getOption('rewrites-page-ext-html')){
                // page link - match WordPress Regex and append html to the regex rule
                // scheme: (.?.+?)/
                $rule[0] = preg_replace('/^(\(\.\?\.\+\?\))/', '$1.html', $rule[0]);
            }

            // ok
            return $rule;
        }, $rules);

        return $rules;
    }

    // filters all category rewrite rules
    public function categoryRewrites($rules){

         // filtering
        return $this->applyRewriteFilter(function($rule){

            // add .html extension to pages ?
            if ($this->_settingsManager->getOption('rewrites-category-ext-html')){
                // category link - match WordPress Regex and append html to the regex rule
                // scheme: <category-rewrite-base>/(.+?)/...
                $rule[0] = preg_replace('/(\/\(\.\+\?\))\//', '$1.html/', $rule[0]);
            }

            // ok
            return $rule;
        }, $rules);

        return $rules;
    }
/*
    // filters all post-tag rewrite rules
    public function tagRewrites($rules){

         // filtering
        return $this->applyRewriteFilter(function($rule){

            // add .html extension to tags ?
            if ($this->_settingsManager->getOption('rewrites-posttag-ext-html')){
                // tag link - match WordPress Regex and append html to the regex rule
                // scheme: <tag-rewrite-base>/([^/]+)/...
                $rule[0] = preg_replace('/(\/\(\[\^\/\]\+\))\//', '$1.html/', $rule[0]);
            }

            // ok
            return $rule;
        }, $rules);

        return $rules;
    }
*/
    // global rewrite rule filtering
    public function filterRewrites($rules){

        // filtering
        return $this->applyRewriteFilter(function($rule){

            // embed endpoint used and disabled ?
            if ($this->_settingsManager->getOption('disable-oembed') && strpos($rule[1], 'embed=true') !== false){
                // remove rule
                return null;
            }

            // disable feed rewrites ?
            if ($this->_settingsManager->getOption('rewrites-disable-feeds') && strpos($rule[1], 'feed=') !== false){
                // remove rule
                return null;
            }

            // ok
            return $rule;
        }, $rules);

        return $rules;
    }

/*
    // allow much easier rule filtering by converting the assoc style original rules
    // to a multidimension array: entry[] = array(regex, rewrite)
    // each of the rewrite rules is passed to the callback function
    private function applyRewriteFilter($cb, $originRules){
        // temporary rules
        $alteredRules = array();

        // convert origin rules to temporary structure
        foreach ($originRules as $regex => $rewrite){
            $alteredRules[] = array($regex, $rewrite);
        }

        // apply filter callback
        $alteredRules = array_map($cb, $alteredRules);

        // convert back
        $output = array();

        // convert to assoc array
        foreach ($alteredRules as $rule){
            if ($rule != null){
                $output[$rule[0]] = $rule[1];
            }
        }

        return $output;
    }
*/
    
}