<?php
/*  AUTO GENERATED FILE - DO NOT EDIT !!
    WP-SKELEKTON | MIT X11 License | https://github.com/AndiDittrich/WP-Skeleton
    ------------------------------------
    Renders the settings page input elements
*/
namespace Tweakr\skltn;

class SettingsViewHelper{
    
    // local config storage
    private $_config = array();

    // store global plugin config
    public function __construct($settingsManager){
        // load all options
        $this->_config = $settingsManager->getOptions();
    }
    
    // Generates a checkbox based on the settings-name
    public function displayCheckbox($title, $optionName, $options=array()){
        // open setting block
        $this->settingsHeader($optionName, $title);

        // dummy element attributes
        $attb = array(
            'name' => 'tweakr-options[' . $optionName . ']',
            'type' => 'hidden',
            'value' => '0'
        );
        
        // dummy checkbox (unchecked value)
        echo HtmlUtil::generateTag('input', $attb, true);

        // wrap into label
        echo HtmlUtil::generateTag('label', array(
            'for' => 'tweakr[' . $optionName . ']'
        ), false);

        // element attributes
        $attb = array(
            'name' => 'tweakr-options[' . $optionName . ']',
            'id'   => 'tweakr-' . $optionName,
            'type' => 'checkbox',
            'value' => '1'
        );

        // option selected ?
        if ($this->_config[$optionName]){ 
            $attb['checked'] = 'checked';
        }

        // generate tag, escape attributes
        echo HtmlUtil::generateTag('input', $attb, true);

        // add label text ?
        if (isset($options['label'])){
            echo esc_html($options['label']);
        }

        // close label
        echo '</label>';
        
        // close setting block
        $this->settingsFooter($options);
    }
        
    // Generates a selectform  based on settings-name
    public function displaySelect($title, $optionName, $values){
        
        // open setting block
        $this->settingsHeader($optionName, $title);

        // element attributes
        $attb = array(
            'name' => 'tweakr-options[' . $optionName . ']',
            'id'   => 'tweakr-' . $optionName
        );

        // generate tag, escape attributes
        echo HtmlUtil::generateTag('select', $attb, false);

        // generate option list
        foreach ($values as $key=>$value){
            $selected = ($this->_config[$optionName] == $value) ? 'selected="selected"' : '';
            echo '<option value="', esc_attr($value), '" '.$selected.'>', esc_html($key), '</option>';
        }
        
        echo '</select>';

        // close setting block
        $this->settingsFooter();
    }
        
        
    // Generates a input-form
    public function displayInput($title, $optionName, $label, $cssClass=''){

        // open setting block
        $this->settingsHeader($optionName, $title);

        // element attributes
        $attb = array(
            'name' => 'tweakr-options[' . $optionName . ']',
            'id'   => 'tweakr-' . $optionName,
            'type' => 'text',
            'title' => $title,
            'value' => $this->_config[$optionName],
            'class' => $cssClass
        );

        // option selected ?
        if ($this->_config[$optionName]){ 
            $attb['checked'] = 'checked';
        }

        // generate tag, escape attributes
        echo HtmlUtil::generateTag('input', $attb, true);

        // generate label
        echo HtmlUtil::generateTag('label', array(
            'for' => 'tweakr[' . $optionName . ']'  
        ), true, $label);

        // close setting block
        $this->settingsFooter();
    }

    private function settingsHeader($optionName, $title){
        echo '<!-- SETTING [', $optionName , '] -->';   
        echo '<div class="tweakr-setting"><div class="tweakr-setting-title">', esc_html($title), '</div><div class="tweakr-setting-input">';
    }

    private function settingsFooter($options = array()){

        // show description ?
        if (isset($options['description']) && !empty($options['description'])){
           echo HtmlUtil::generateTag('div', array(
                'class' => 'tweakr-setting-description'
            ), true, $options['description']);
        }

        // close setting block, close input block
        echo '</div></div>', "\n";
    }

}
