<?php 

namespace DxlProfile\Interfaces;

if ( ! defined('ABSPATH') ) exit;

if ( ! interface_exists('ActionNeedsValidation') ) {
    interface ActionNeedsValidation {
        public function validate();
    }
}

?>