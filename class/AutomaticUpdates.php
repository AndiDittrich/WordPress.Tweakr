<?php

namespace Tweakr;

// @see https://codex.wordpress.org/Configuring_Automatic_Background_Updates
class AutomaticUpdates{

    // disable all
    public static function disableAll(){
        add_filter('automatic_updater_disabled', '__return_true', 100);
    }

    // utility
    public static function setUpdatePolicy($filter, $behaviour){
        
        switch ($behaviour){
            // force updates to be enabled
            case 'enabled':
                add_filter('auto_update_' . $filter, '__return_true');
                break;

            // force updates to be disables
            case 'disabled':
                add_filter('auto_update_' . $filter, '__return_false');
                break;

            // do nothing
            case 'default':
            default:
               return;
        }
    }

    // handle core updates
    public static function coreUpdates($behaviour){
        self::setUpdatePolicy('core', $behaviour);
    }

    // handle plugin updates
    public static function pluginUpdates($behaviour){
        self::setUpdatePolicy('plugin', $behaviour);
    }

    // handle theme updates
    public static function themeUpdates($behaviour){
        self::setUpdatePolicy('theme', $behaviour);
    }

    // handle translation updates
    public static function translationUpdates($behaviour){
        self::setUpdatePolicy('translation', $behaviour);
    }
}