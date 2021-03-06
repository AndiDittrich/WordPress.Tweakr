<?php

namespace Tweakr;

use Tweakr\skltn\RewriteRuleHelper;

class RewriteRules
    extends RewriteRuleHelper{

    // html rewrite rules
    const HTML_EXT_OPTIONAL = '$1(?:\.html)?';
    const HTML_EXT_ENFORCE = '$1\.html';

    // settings manager instance
    private $_settingsManager;

    // list of custom taxonomies
    private $_customTaxonomies = array();

    // selected html extension regex
    private $_htmlExtensionRegex = self::HTML_EXT_ENFORCE;

    public function __construct($settingsManager){
        parent::__construct();

        $this->_settingsManager = $settingsManager;
    }

    // executed on init hook
    public function init(){
        // option html extension or required ?
        if ($this->_settingsManager->getOption('rewrites-ext-html-optional')){
            $this->_htmlExtensionRegex = self::HTML_EXT_OPTIONAL;
        }

        $this->addRuleFilter('page_rewrite_rules', array($this, 'pageRewrites'));
        $this->addRuleFilter('rewrite_rules_array', array($this, 'filterRewrites'));

        // add .html extension to pages ?
        if ($this->_settingsManager->getOption('rewrites-category-ext-html')){
            $this->addRuleFilter('category_rewrite_rules', array($this, 'categoryRewrites'));
        }

        // get non-buildin (custom) taxonomies
        $this->_customTaxonomies = apply_filters('tweakr_rewrites_custom_taxonomies', get_taxonomies(array(
            'public'   => true,
            '_builtin' => false
        ), 'names', 'and'));

        // add .html extension to custom taxonomies ?
        if ($this->_settingsManager->getOption('rewrites-custom-taxonomy-ext-html')){

            // apply filter
            foreach ($this->_customTaxonomies as $slug){
                $this->addRuleFilter($slug . '_rewrite_rules', array($this, 'taxonomyRewrites'));
            }
        }

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

        // add .html to custom taxonomies ?
        if (in_array($taxonomy, $this->_customTaxonomies) && $this->_settingsManager->getOption('rewrites-custom-taxonomy-ext-html')){
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

    // called e.g. on plugin activation + settings update
    public function reload(){
        // regenrate rules
        flush_rewrite_rules();
    }

    // removed trailing slashed from permalink structure
    public function fixTrailingslashes($url, $posttype){
        // remove all trailingslashes ?
        if ($this->_settingsManager->getOption('rewrites-trailingslashes-remove')){
            return untrailingslashit($url);
        }

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
        // no action
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
                $rule[0] = preg_replace('/^(\(\.\?\.\+\?\))/', $this->_htmlExtensionRegex, $rule[0]);
            }

            // ok
            return $rule;
        }, $rules);
    }

    // filters custom taxonomy rewrite rules
    public function taxonomyRewrites($rules){

         // filtering
        return $this->applyRewriteFilter(function($rule){

            // alter rewrite rule
            // taxonomy link
            // scheme: <rewrite-base>/<slug>/([^/]+)
            $rule[0] = preg_replace('/^(.*\/\(\[\^\/\]\+\))\//U', $this->_htmlExtensionRegex . '/', $rule[0]);
            
            // ok
            return $rule;
        }, $rules);
    }

    // filters all category rewrite rules
    public function categoryRewrites($rules){

         // filtering
        return $this->applyRewriteFilter(function($rule){

            // alter rewrite rule
            // category link - match WordPress Regex and append html to the regex rule
            // scheme: <category-rewrite-base>/(.+?)/...
            $rule[0] = preg_replace('/(\/\(\.\+\?\))\//', $this->_htmlExtensionRegex . '/', $rule[0]);

            // ok
            return $rule;
        }, $rules);
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
    }
}