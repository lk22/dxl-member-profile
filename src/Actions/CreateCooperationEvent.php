<?php 

    namespace DxlProfile\Actions;

    use DxlProfile\Actions\AbstractAction as Action;
    use DxlProfile\Interfaces\ActionHasRules;
    use DxlProfile\Interfaces\ActionNeedValidation;


    if ( ! defined('ABSPATH') ) exit;

    if ( ! class_exists('CreateCooperationEvent') ) 
    {
        class CreateCooperationEvent extends Action implements ActionHasRules, ActionNeedsValidation {
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

            public function validate() {
                $validator = new Validator($this->request, $this->rules());
                return $validator->validate();
            }

            public function handle() {

                if ( ! $this->nonce_validate() ) {
                    echo wp_json_encode([
                        "error" => "Invalid nonce",
                        "response" => "We could not verify your request"
                    ]);
                    wp_die();
                }

                echo json_encode(["data" => $_REQUEST]);
            }
        }
    }

?>