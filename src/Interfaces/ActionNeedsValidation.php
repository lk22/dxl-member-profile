<?php 

namespace DxlProfile\Interfaces;

if ( ! defined('ABSPATH') ) exit;

if ( ! interface_exists('ActionNeedsValidation') ) {
    interface ActionNeedsValidation {
        public function validate();
    }
}

function linearSearch($array, $value) {
    for($i = 0; $i < count($array); $i++) {
        if( $array[$i] === $value ) {
            return $array[$i];
        }
    }
}

function binarySearch($array, $val) {
    $low = 0;
    $high = count($array) - 1;

    while ( $low <= $high ) {
        $mid = ($low + $high) >> 1;
        if ( $array[$mid] == $val) {
            return $mid;
        } else if ( $array[$mid] > $val ) {
            return $mid -1;
        } else if ( $array[$mid] < $val ) {
            return $mid + 1;
        }
    } 

    return null;
}

























function binarySearch($array, $value) {
    $low = 0;
    $high = count($array) -1;

    while($low <= $high) {
        if( $array[$mid] == $value ) {
            return $mid;
        } else if ( $array[$mid] > $value ) {
            return $mid -1;
        } else if ( $array[$mid] < $value ) {
            return $mid +1;
        }
    }
    return null;
}

?>