<?php 

namespace DxlProfile\Actions;

if ( ! defined('ABSPATH') ) exit;

if ( ! class_exists('AbstractAction') ) 
{
    abstract class AbstractAction {

        /**
         * incomming action request
         *
         * @var [type]
         */
        public $request = $_REQUEST;

        /**
         * Verify nonce from request
         *
         * @return void
         */
        public function verify_nonce()
        {
            if( ! isset($this->request->request["nonce"]) && !wp_verify_nonce($this->request->request["nonce"], 'nonce') )
            {
                return false;
            }

            return true;
        }

        /**
         * validate request has key 
         *
         * @param [type] $key
         * @return boolean
         */
        public function has($key) {
            return isset($this->request[$key]);
        }

        /**
         * get value from key in request bag
         *
         * @param [type] $key
         * @return void
         */
        public function get($key) {
            return $this->request[$key];
        }
    }
}

?>