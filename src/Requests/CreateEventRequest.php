<?php 
    namespace DxlProfile\Requests;

    use Dxl\Classes\Abstracts\AbstractRequest as Request;

    use Dxl\Interfaces\RequestNeedsValidating;
    use Dxl\Interfaces\RequestHasRules;
    use Dxl\Core\Validators\Validator;

    if ( ! defined('ABSPATH') ) exit;

    if ( ! class_exists('CreateEventRequest') ) 
    {
        class CreateEventRequest extends Request implements RequestHasRules
        {
            /**
             * Request Validator
             *
             * @var Dxl\Classes\Validators\Validator
             */
            protected $validator;

            /**
             * Apply rules to request
             */
            public function rules() {
                return [
                    'title' => 'required',
                    'description' => 'required',
                    'date' => 'required',
                    'starttime' => 'required',
                    'game' => 'required',
                    'profile' => 'required'
                ];
            }

            /**
             * Get field from request
             *
             * @param string $field
             * @return void
             */
            public function get($field = '') {
                return $this->request[$field];
            } 

            /**
             * Check if request has field
             *
             * @param [type] $field
             * @return boolean
             */
            public function has($field): bool {
                return isset($this->request[$field]);
            }
        }
    }

?>