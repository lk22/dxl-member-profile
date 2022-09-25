<?php 

    namespace DxlProfile\Validators;

    if ( ! defined('ABSPATH') ) exit;

    if ( ! class_exists('Validator') ) {
        class Validator 
        {
            /**
             * Validator constructor
             * 
             * @var mixed $request
             * @var array $rules
             */
            public function __construct(array $request, array $rules = []) {
                $this->request = $request;
                $this->rules = $rules;
            }

            /**
             * Validate request agains rules
             *
             * @return void
             */
            public function validate() {
                $validated = [];

                foreach ( $this->request as $key => $value ) {

                    // validate the request key is the same as the key in rules 
                    if ( in_array($this->request[$key], $this->rules) ) {

                        // validate key is required
                        if ( $this->rules[$key] == 'required' ) {
                            $this->validate_required($key);
                        }

                        // validate key is email
                        if( $this->rules[$key] == 'email' ) {
                            $this->validate_email($key);
                        }

                        // validate key is numeric
                        if( $this->rules[$key] == 'numeric' ) {
                            $this->validate_numeric($key);
                        }

                        // validate key is string
                        if( $this->rules[$key] == 'string' ) {
                            $this->validate_string($key);
                        }
                    }
                }
            }

            /**
             * validate key is required
             *
             * @param string $key
             * @return void
             */
            private function validate_required($key) {
                return isset($this->request[$key]);
            }

            /**
             * Validate key is email
             *
             * @param string $key
             * @return void
             */
            private function validate_email($key) {
                return filter_var($this->request[$key], FILTER_VALIDATE_EMAIL);
            }

            /**
             * Validate key is numeric
             *
             * @param int $key
             * @return void
             */
            private function validate_numeric($key) {
                return is_numeric($this->request[$key]);
            }

            /**
             * Validate key is string
             *
             * @param string $key
             * @return void
             */
            private function validate_string($key) {
                return is_string($this->request[$key]);
            }
        }
    }
?>