<?php 

    namespace DxlProfile;

    use DxlProfile\Controllers\ProfileViewController;

    if ( ! defined('ABSPATH') ) exit;

    if ( ! class_exists('MemberProfile') ) 
    {
        class MemberProfile 
        {

            /**
             * Member profile constructor
             */
            public function __construct()
            {
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
                wp_enqueue_style('dxl-member-profile', plugins_url("dxl-member-profile/dist/assets/css/app.min.css"), __FILE__);
            }

            /**
             * Enqueueing scripts for member profile
             *
             * @return void
             */
            public function enqueueScripts()
            {
                wp_enqueue_script('dxl-member-profile', plugins_url('/assets/js/dxl-member-profile.js', __FILE__), ['jquery'], '1.0.0', true);
                wp_localize_script('dxl-member-profile', 'dxlMemberProfile', [
                    'ajax_url' => admin_url('admin-ajax.php'),
                    'nonce' => wp_create_nonce('dxl_member_profile_nonce')
                ]);
            }

            /**
             * Initalizing member profile shortcode frontend
             *
             * @return void
             */
            public function dxlMemberProfile()
            {
                if (is_page('manager-profile')) {
                    $profileViewController = (new ProfileViewController())->manage();
                }
            }
        }
    }

?>