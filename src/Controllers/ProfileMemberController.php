<?php 
    namespace DxlProfile\Controllers;
    
    use DxlMembership\Classes\Repositories\MemberRepository;
    use DxlMembership\Classes\Repositories\MemberProfileRepository;

    if ( ! defined('ABSPATH') ) exit;

    if ( ! class_exists('ProfileMemberController') ) 
    {
        class ProfileMemberController 
        {
            /**
             * Member repository
             *
             * @var DxlMembership\Classes\Repositories\MemberRepository;
             */
            public $memberRepository;

            /**
             * Member profile repository
             *
             * @var DxlMembership\Classes\Repositories\MemberProfileRepository;
             */
            public $memberProfileRepository;

            /**
             * Controller constructor
             */
            public function __construct()
            {
                // $this->memberRepository = new MemberRepository();
                // $this->memberProfileRepository = new MemberProfileRepository();
            }

            /**
             * Update member profile action
             *
             * @return void
             */
            public function update() 
            {
                echo wp_json_eocode($_REQUEST);
                wp_die();
            }
        }
    }

?>