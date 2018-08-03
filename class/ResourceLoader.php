<?php

namespace Tweakr;

use \Tweakr\skltn\ResourceManager as ResourceManager;

class ResourceLoader{
    
    // cache manager instance
    private $_cacheManager;

    // settins manager instance
    private $_settingsManager;

    public function __construct($settingsManager, $cacheManager){
        // store local plugin config
        $this->_settingsManager = $settingsManager;
        $this->_cacheManager = $cacheManager;
    }

    // frontend scripts/styles
    public function frontend(){

    }

    // Load the Backend Settings Resources
    public function backendSettings(){
        add_action('admin_enqueue_scripts', array($this, 'appendAdminResources'));
    }
      
    // settings page resources
    public function appendAdminResources(){
        // UI Styles
        ResourceManager::enqueueStyle('tweakr-settings', 'admin/settings.css');

        // settings page
        ResourceManager::enqueueScript('tweakr-settings-init', 'admin/settings.js', array('jquery'));
    }
}