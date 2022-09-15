<?php 

    namespace DxlProfile\Views;

    use Dxl\Interfaces\ViewInterface;

    if ( ! defined('ABSPATH') ) exit;

    if ( ! class_exists('ProfileEventsDetailsView') ) 
    {
        class ProfileEventsDetailsView implements ViewInterface 
        {
            /**
             * Module view
             *
             * @var string
             */
            protected $view = "module";

            /**
             * Module name
             *
             * @var string
             */
            protected $module = "events";

            /**
             * Construct events view
             */
            public function __construct() 
            {
                $this->render();
            }

            /**
             * render events view
             */
            public function render() 
            {
                return [
                    "view" => "module/events/" . $this->view . "",
                    "module" => $this->module
                ];
            }
        }
    }

?>