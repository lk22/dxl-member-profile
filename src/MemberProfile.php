<?php 

    namespace DxlProfile;

    use DxlProfile\Controllers\ProfileController;

    // use DxlMembership\Classes\Repositories\MemberRepository;
    // use DxlProfile\Repositories\ProfileMemberRepository;

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
                // add_action('wp_ajax_dxl_profile_create_event', [$this, 'createEvent']);
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
                if( is_page('manager-profile') ) {
                    wp_enqueue_style('dxl-member-profile', plugins_url('./../dist/assets/css/app.min.css', __FILE__));
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
                if( is_page('manager-profile') ) {

                    $member = $wpdb->get_row("SELECT * FROM dxl_members WHERE user_id = " . $current_user->ID);
                    $profile = $wpdb->get_row("SELECT * FROM dxl_member_profile_settings WHERE member_id = " . $member->id);
                    wp_enqueue_script('dxl-member-profile', plugins_url('../dist/main.js', __FILE__), ['jquery'], '1.0.0', true);
                    wp_localize_script('dxl-member-profile', 'dxlMemberProfile', [
                        'ajaxurl' => admin_url('admin-ajax.php'),
                        'nonce' => wp_create_nonce('dxl_member_profile_nonce'),
                        'profile' => $profile,
                        'member' => $member,
                        'prefix' => get_option('siteurl'),
                    ]);
                }
            }

            /**
             * Initalizing member profile shortcode frontend
             *
             * @return void
             */
            public function dxlMemberProfile()
            {
                if (is_page('manager-profile')) {
                    $this->profileController->manage();
                }
            }
        }
    }
?>