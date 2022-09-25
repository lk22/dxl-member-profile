<?php 

    namespace DxlProfile\Actions;

    use DxlProfile\Actions\AbstractAction as Action;
    use DxlProfile\Interfaces\ActionHasRules;
    use DxlProfile\Interfaces\ActionNeedValidation;


    if ( ! defined('ABSPATH') ) exit;

    if ( ! class_exists('CreateTrainingEvent') ) 
    {
        class CreateTrainingEvent extends Action implements ActionHasRules, ActionNeedsValidation {
            public function rules() {
                return [];
            }

            public function validate() {
                if ( count($this->rules) < 1) {
                    return false;
                }
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