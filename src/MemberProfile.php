<?php 

    namespace DxlProfile;

    use DxlProfile\Controllers\ProfileController;

    if ( ! defined('ABSPATH') ) exit;

    if ( ! class_exists('MemberProfile') ) 
    {
        class MemberProfile 
        {

            public $profileController;

            /**
             * Member profile constructor
             */
            public function __construct()
            {
                $this->profileController = new ProfileController();
                $this->profileController->registerAdminActions();
                $this->constructProfileShortcode();
                $this->enqueueProfileScripts();
            }

            /**
             * Constructing shortcode to display member profile
             *
             * @return void
             */
            public function constructProfileShortcode()
            {
                add_shortcode('dxl_member_profile', [$this, 'dxlMemberProfile']);
            }

            /**
             * Enqueueing scripts and styles for member profile
             *
             * @return void
             */
            public function enqueueProfileScripts()
            {
                add_action('wp_enqueue_scripts', [$this, 'enqueueProfileStyles']);
                add_action('wp_enqueue_scripts', [$this, 'enqueueScripts']);
            }

            /**
             * Enqueueing styles for member profile
             *
             * @return void
             */
            public function enqueueProfileStyles()
            {
                if( is_page('manager-profile') || is_page('profile')) {
                    wp_enqueue_style('dxl-member-profile', plugins_url('./../assets/css/app.css', __FILE__));
                }
            }

            /**
             * Enqueueing scripts for member profile
             *
             * @return void
             */
            public function enqueueScripts()
            {
                global $wpdb, $current_user;
                if( is_page('manager-profile') || is_page('profile') ) {
                    show_admin_bar(false);
                    $member = $wpdb->get_row("SELECT * FROM dxl_members WHERE user_id = " . $current_user->ID);
                    if( $member ) {
                        $profile = $wpdb->get_row("SELECT * FROM dxl_member_profile_settings WHERE member_id = " . $member->id);
                    }

                    $localizedData = [
                        "ajaxurl" => admin_url('admin-ajax.php'),
                        'nonce' => wp_create_nonce('dxl_member_profile_nonce'),
                        'profile' => (isset($profile)) ? $profile : [],
                        'member' => $member,
                        'prefix' => get_option('siteurl'),
                    ];

                    // enqueueing dependency scripts
                    wp_enqueue_script('dxl-member-profile-sweetalert', plugins_url('../assets/js/dependencies/sweetalert.js', __FILE__), ['jquery'], '1.0.0', true);

                    wp_enqueue_script('dxl-member-profile', plugins_url('../assets/js/app.js', __FILE__), ['jquery'], '1.0.0', true);
                    wp_enqueue_script('dxl-member-profile-user', plugins_url('../assets/js/modules/User.js', __FILE__), ['jquery'], '1.0.0', true);
                    wp_enqueue_script('dxl-member-profile-event', plugins_url('../assets/js/modules/Event.js', __FILE__), ['jquery'], '1.0.0', true);
                    wp_enqueue_script('dxl-member-profile-game', plugins_url('../assets/js/modules/Game.js', __FILE__), ['jquery'], '1.0.0', true);
                    
                    wp_localize_script('dxl-member-profile', 'MemberProfileApp', $localizedData);
                    wp_localize_script('dxl-member-profile-user', 'MemberProfileUser', $localizedData);
                    wp_localize_script('dxl-member-profile-event', 'MemberProfileEvent', $localizedData);
                    wp_localize_script('dxl-member-profile-game', 'MemberProfileGame', $localizedData);
                }
            }

            /**
             * Initalizing member profile shortcode frontend
             *
             * @return void
             */
            public function dxlMemberProfile()
            {
                if (is_page('manager-profile') || is_page('profile')) {
                    $this->profileController->manage();
                }
            }
        }
    }
?>