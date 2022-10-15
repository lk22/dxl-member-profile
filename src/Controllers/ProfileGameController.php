<?php 

namespace DxlProfile\Controllers;

use DxlProfile\Repositories\ProfileMemberGamesRepository;

if ( ! defined('ABSPATH') ) exit;

if ( ! class_exists('ProfileGameController') ) 
{
    class ProfileGameController 
    {
        /**
         * Profile game controller constructor
         * @var \DxlProfile\Repositories\ProfileMemberGamesRepository
         */
        public $profileGameController;

        /**
         * Profile game controller constructor
         */
        public function __construct()
        {
            $this->profileGameController = new ProfileMemberGamesRepository();
        }

        /**
         * Create new profile game
         * 
         * @return void
         */
        public function create(): void
        {
            $data = $_REQUEST;

            $created = $this->profileGameController->create([
                "member_id" => $data["member_id"],
                "name" => $data["game_name"],
                "gamemodes" => $data["game_mode_name"],
            ]);

            if ( $created ) {
                echo wp_send_json_success([
                    'message' => 'Game created successfully'
                ]);
            } else {
                echo wp_send_json_error([
                    'message' => 'something went wrong Game not created, please try again'
                ]);
            }

            wp_die();
        }

        /**
         * delete profile game
         *
         * @return void
         */
        public function delete(): void 
        {
            $deleted = $this->profileGameController->delete($_REQUEST["gameId"]);

            if ( ! $deleted ) {
                echo wp_send_json_error([
                    'message' => 'something went wrong Game not deleted, please try again'
                ]);
            } 
            
            echo wp_send_json_success([
                'message' => 'Game deleted successfully'
            ]);

            wp_die();
        }
    }
}

?>