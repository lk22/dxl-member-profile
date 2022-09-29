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
                // echo json_encode($_REQUEST); wp_die();
                $data = [
                    "member" => [],
                    "profile" => []
                ];

                foreach($_REQUEST as $key => $value) {
                    if ( isset($_REQUEST[$key]) && !empty($_REQUEST[$key]) ) {
                        if( $key == "redirect_to_manager" ) $data["profile"][$key] = $value;
                        if( $key == 'action' || $key == "nonce" || $key == "redirect_to_manager" ){
                            continue;
                        }

                        if( $key == "birthyear" ) {
                            $data["member"]["birthyear"] = date('Y', strtotime($value));
                        }

                        $data["member"][$key] = $value;
                    }
                }

                // validate if request input values has been changed from last request
                $updated = (new MemberRepository())->update($data["member"], $_REQUEST["id"]);

                $updated = (new MemberProfileRepository())->update([
                    "redirect_to_manager" => $data["profile"]["redirect_to_manager"]
                ], $_REQUEST["id"]);

                // $this->memberRepository->update($data["member"]);
                echo json_encode([
                    "status" => "success",
                    "message" => "Member profile updated successfully"
                ]);
                wp_die();
            }
        }
    }

?>