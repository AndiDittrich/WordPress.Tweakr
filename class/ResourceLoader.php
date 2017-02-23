<?php
/**
    Resource Utility Loader Class
    Version: 6.0
    Author: Andi Dittrich
    Author URI: http://andidittrich.de
    Plugin URI: http://andidittrich.de/go/tweakr
    License: MIT X11-License
    
    Copyright (c) 2013-2017, Andi Dittrich

    Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:
    
    The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
    
    THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
*/
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
        ResourceManager::enqueueStyle('tweakr-settings', 'admin/SettingsPage.css');

        // js-cookie
        ResourceManager::enqueueScript('tweakr-js-cookie', 'extern/js-cookie/js.cookie-2.1.3.min.js');

        // settings page
        ResourceManager::enqueueScript('tweakr-settings-init', 'admin/SettingsPage.js', array('tweakr-js-cookie', 'jquery'));
    }
}