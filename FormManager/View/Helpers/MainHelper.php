<?php
/**
 * (c) Hayk Grigoryan <hayk@safanlab.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace FormManager\View\Helpers;

use Safan\Safan;


trait MainHelper {

    //TODO::Implement row draw part dynamic for native attributes and for FormManager custom attributes
    public function getRow($row, $rowName) {
        $type  = (!is_null($row['type']) && strlen($row['type']) > 0) ? $row['type'] : static::DEFAULT_TYPE;

        if($type == static::FIELD_TEXTAREA) {
            return $this->getTextarea($row, $rowName);
        } elseif($type == static::FIELD_BUTTON) {
            return $this->getButton($row, $rowName);
        }

        $html     = "";
        $options  = isset($row['options']) ? $row['options'] : [];
        $attrs    = (!empty($options) && isset($options['attr'])) ? $options['attr'] : [];

        $id       = (!empty($attrs) && isset($attrs['id'])) ? $attrs['id'] : $this->getFormName() . '_' . $rowName;
        $name     = (!empty($attrs) && isset($attrs['name'])) ? $attrs['name'] : $this->getFormName() . '[' . $rowName . ']';
        $required = (!empty($attrs) && isset($attrs['required'])) ? $attrs['required'] : false;

        $label = isset($options['label']) ? $options['label'] : '';
        if(strlen($label) > 0) {
            $labelField = "<label for='".$id."' ";
            if($required != false) {
                $labelField .= "class='required'";
            }
            $labelField .= ">".$label."</label>";
            $html .= $labelField;
        }


        $html .= "<input type='". $type ."' ";
        foreach($attrs as $key => $attr) {
            $html .= $key . '="' . $attr . '" ';
        }

        if(!in_array(static::CRITERIA_ID, $attrs, true)) {
            $html .= "id='". $id ."' ";
        }
        if(!in_array(static::CRITERIA_NAME, $attrs, true)) {
            $html .= "name='". $name ."' ";
        }
        $html .= "/>";

        return $html;
    }

    private function getButton($row, $rowName) {
        $html     = "";

        $options  = isset($row['options']) ? $row['options'] : [];
        $attrs    = (!empty($options) && isset($options['attr'])) ? $options['attr'] : [];
        $id       = (!empty($attrs) && isset($attrs['id'])) ? $attrs['id'] : $this->getFormName() . '_' . $rowName;
        $name     = (!empty($attrs) && isset($attrs['name'])) ? $attrs['name'] : $this->getFormName() . '[' . $rowName . ']';
        $text     = (!empty($attrs) && isset($attrs['text'])) ? $attrs['text'] : '';
        $required = (!empty($attrs) && isset($attrs['required'])) ? $attrs['required'] : false;

        $label = isset($options['label']) ? $options['label'] : '';

        if(strlen($label) > 0) {
            $labelField = "<label for='".$id."' ";
            if($required != false) {
                $labelField .= "class='required'";
            }
            $labelField .= ">".$label."</label>";
            $html .= $labelField;
        }

        $html .= "<button ";
        foreach($attrs as $key => $attr) {
            $html .= $key . '="' . $attr . '" ';
        }

        // Settings Default id and name if not exists in Builder options
        if(!in_array(static::CRITERIA_ID, $attrs, true)) {
            $html .= "id='". $id ."' ";
        }
        if(!in_array(static::CRITERIA_NAME, $attrs, true)) {
            $html .= "name='". $name ."' ";
        }
        $html .= ">".$text."</button>";

        return $html;
    }

    private function getTextarea($row, $rowName) {
        $html = "";

        $options = isset($row['options']) ? $row['options'] : [];
        $attrs   = (!empty($options) && isset($options['attr'])) ? $options['attr'] : [];
        $id    = (!empty($attrs) && isset($attrs['id'])) ? $attrs['id'] : $this->getFormName() . '_' . $rowName;
        $name  = (!empty($attrs) && isset($attrs['name'])) ? $attrs['name'] : $this->getFormName() . '[' . $rowName . ']';
        $required = (!empty($attrs) && isset($attrs['required'])) ? $attrs['required'] : false;

        $label = isset($options['label']) ? $options['label'] : '';

        if(strlen($label) > 0) {
            $labelField = "<label for='".$id."' ";
            if($required != false) {
                $labelField .= "class='required'";
            }
            $labelField .= ">".$label."</label>";
            $html .= $labelField;
        }

        $html .= "<textarea ";
        foreach($attrs as $key => $attr) {
            $html .= $key . '="' . $attr . '" ';
        }

        // Settings Default id and name if not exists in Builder options
        if(!in_array(static::CRITERIA_ID, $attrs, true)) {
            $html .= "id='". $id ."' ";
        }
        if(!in_array(static::CRITERIA_NAME, $attrs, true)) {
            $html .= "name='". $name ."' ";
        }
        $html .= "></textarea>";

        return $html;
    }

    private function getRadio($attr) {

    }

    private function getCheckbox($attr) {

    }

    
}
