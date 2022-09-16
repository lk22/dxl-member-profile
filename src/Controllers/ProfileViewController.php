<?php 
    namespace DxlProfile\Controllers;

    use Dxl\Classes\Abstracts\AbstractActionController;

    use DxlProfile\Views\ProfileMainView;
    use DxlProfile\Views\ProfileEventListView;

    if ( ! defined('ABSPATH') ) exit;

    if ( ! class_exists('ProfileViewController') )
    {
        class ProfileViewController extends AbstractActionController
        {
            /**
             * Profile view controller constructor
             */
            public function __construct()
            {
                $this->registerAdminActions();
            }

            /**
             * Managing profile view rendering
             *
             * @return void
             */
            public function manage()
            {
                return $this->constructProfileView();
            }

            /**
             * Registering admin actions
             *
             * @return void
             */
            public function registerAdminActions() {
                // add_action('wp_ajax_dxl_event_create', $this, 'createEvent');
                // add_action('wp_ajax_dxl_event_update', $this, 'updateEvent');
                // add_action('wp_ajax_dxl_event_delete', $this, 'deleteEvent');
                // add_action('wp_ajax_dxl_event_publish', $this, 'publisEvent');
                // add_action('wp_ajax_dxl_event_draft', $this, 'draftEvent');
                // add_action('wp_ajax_dxl_manager_training_create', $this, 'createTrainingEvent');
                // add_action('wp_ajax_dxl_manager_training_update', $this, 'updateTrainingEvent');
                // add_action('wp_ajax_dxl_manager_training_delete', $this, 'deleteTrainingEvent');
                // add_action('wp_ajax_dxl_manager_training_publish', $this, 'publishTraining');
                // add_action('wp_ajax_dxl_manager_unpublish_training', $this, 'unpublishTraining');
                // add_action('wp_ajax_dxl_create_profile_tournament', $this, 'createTournament');
                // add_action('wp_ajax_dxl_update_profile_tournament', $this, 'updateTournament');
                // add_action('wp_ajax_dxl_delete_profile_tournament', $this, 'deleteTournament');
                // add_action('wp_ajax_dxl_toggle_publish_tournament', $this, 'toggleTournamentDraft');
                // add_action('wp_ajax_dxl_preferences_update', $this, 'profilePreferencesUpdate');
                // add_action('wp_ajax_dxl_invite_member', $this, 'ajaxProfileSendInvitation');
                // add_action('wp_ajax_dxl_request_trainer_permissions', $this, 'ajaxRequestTrainerPermisions');
                // add_action('wp_ajax_dxl_request_tournament_permissions', $this, 'ajaxRequestTournamentPermisions');
                // add_action('wp_ajax_dxl_invite_member_to_tournament', $this, 'ajaxInviteToEvent');
                // add_action('wp_ajax_dxl_profile_add_game', $this, 'ajaxAddProfileGame');
                // add_action('wp_ajax_dxl_profile_delete_game', $this, 'ajaxDeleteProfileGame');
                // add_action('wp_ajax_dxl_profile_delete_send_invitation', new ProfileInvitation(), 'ajaxDeleteSendedInvitation');
                // add_action('wp_ajax_dxl_profile_resend_invitation', new ProfileInvitation(), 'ajaxResendInvitation');
            }

            public function registerGuestActions() {}

            /**
             * Constructing profile view
             *
             * @return void
             */
            public function constructProfileView()
            {
                if ( ! is_user_logged_in() ) {
                    // wp_redirect( home_url() );
                    exit;
                }
                if ( isset($_GET["module"])) {
                    switch($_GET["module"]) {
                        case 'events': 
                            $profile = (new ProfileEventListView())->render();
                            
                        case 'settings': 
                        //     return new ProfileSettingsView();
    
                        case 'tournaments': 
                        //     return new ProfileTournamentsView();
    
                        case 'update': 
                    }
                } else {
                    $profile = (new ProfileMainView())->render();

                }
                

                require_once DXL_PROFILE_VIEW_PATH . '/layout.php';
            }
        }
    }

?>

