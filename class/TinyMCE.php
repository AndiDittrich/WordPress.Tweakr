<?php

namespace Tweakr;

use \Tweakr\skltn\ResourceManager as ResourceManager;
use \Tweakr\skltn\HtmlUtil as HtmlUtil;
use \Tweakr\skltn\CssBuilder as CssBuilder;

class TinyMCE{

    // settings manager instance
    private $_settingsManager;

    // cache manager instance
    private $_cacheManager;

    public function __construct($settingsManager, $cacheManager){

        // store instances
        $this->_settingsManager = $settingsManager;
        $this->_cacheManager = $cacheManager;

        // css cached ? otherwise regenerate it
        if (!$cacheManager->fileExists('TinyMCE.css')){
            $this->generateCSS();
        }

        // editor integration
        $this->integrate();
    }

    public function generateCSS(){
        // use css builder to generate dynamic styles
        $cssBuilder = new CssBuilder();

        // automatic width ?
        if ($this->_settingsManager->getOption('tinymce-autowidth')){
            $cssBuilder->add('body.mce-content-body', array(
                'width' => 'auto',
                'max-width' => '95%'
            ));
        }

        // append VisualComponents ?
        if ($this->_settingsManager->getOption('tinymce-visualcomponents')){
            $cssBuilder->addRaw(file_get_contents(TWEAKR_PLUGIN_PATH . '/resources/editor/VisualComponents.min.css'));
        }

        // store cache file
        $this->_cacheManager->writeFile('TinyMCE.css', $cssBuilder->render());
    }

     // run integration
    public function integrate(){
        // TinyMCE 4 required !
        if (!version_compare(get_bloginfo('version'), '3.9', '>=')) {
            return;
        }

        // load tinyMCE styles
        add_filter('mce_css', array($this, 'loadEditorCSS'));
    }

    public function loadEditorCSS($mce_css){
        // add hash from last settings update to force a cache update
        $url = ResourceManager::getResourceUrl('cache/TinyMCE.css', true);

        // other styles loaded ?
        if (empty($mce_css)){
            return $url;

            // append custom TinyMCE styles to editor stylelist
        }else{
            return $mce_css . ','.$url;
        }
    }
}

