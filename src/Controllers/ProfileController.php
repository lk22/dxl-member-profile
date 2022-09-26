<?php 
    namespace DxlProfile\Controllers;

    use Dxl\Interfaces\RegistersAdminActionsInterface;

    use DxlProfile\Views\ProfileMainView;
    use DxlProfile\Views\ProfileEventListView;
    use DxlProfile\Views\ProfileEventDetailsView;
    use DxlProfile\Views\UpdateProfileView;
    use DxlProfile\Views\ProfileSettingsView;

    use DxlProfile\Controllers\ProfileEventController;
    use DxlProfile\Controllers\ProfileMemberController;

    if ( ! defined('ABSPATH') ) exit;

    if ( ! class_exists('ProfileController') )
    {
        class ProfileController implements RegistersAdminActionsInterface
        {
            /**
             * Profile view controller constructor
             */
            public function __construct()
            {
                // $this->registerAdminActions();
            }
            
            /**
             * Managing profile view rendering
             *
             * @return void
             */
            public function manage()
            {
                return $this->constructProfileView();
                add_action('wp_ajax_dxl_profile_event_create', [new ProfileEventController, 'create']);
            }

            /**
             * Registering admin actions
             *
             * @return void
             */
            public function registerAdminActions(): void 
            {
                add_action('wp_ajax_dxl_profile_create_event', [new ProfileEventController, 'create']);
                add_action('wp_ajax_dxl_profile_edit_event', [new ProfileEventController, 'update']);
                add_action("wp_ajax_dxl_profile_delete_event", [new ProfileEventController, 'delete']);
                add_action('wp_ajax_dxl_profile_publish_unpublish_event', [new ProfileEventController, 'publishUnpublishEvent']);
            }

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
                if ( isset( $_GET["module"] ) ) {
                    switch( $_GET["module"] ) {
                        case 'events': 
                            
                            if ( isset( $_GET["action"] ) && $_GET["action"] == 'details' ) {
                                $profile = (new ProfileEventDetailsView())->render();
                            } else {
                                $profile = (new ProfileEventListView())->render();
                            }

                            break;
                        case 'settings': 
                                $profile = (new ProfileSettingsView())->render();

                            break;
                            case 'update': 
                                $profile = (new UpdateProfileView())->render();
                                break;
                        }
                } else {
                    $profile = (new ProfileMainView())->render();
                }
                
                require_once DXL_PROFILE_VIEW_PATH . '/layout.php';
            }
        }
    }

?>

