<?php 

namespace DxlProfile\Interfaces;

if ( ! defined('ABSPATH') ) exit;

if ( ! interface_exists('ActionHasRules') ) {
    interface ActionHasRules {
        public function rules();
    }
}

?>