<?php 
    namespace DxlProfile\Controllers;
    
    use DXL\Classes\Repositories\MemberRepository;
    use DXL\Classes\Repositories\MemberProfileRepository;

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

            public function updateMembership() {
                $currentMember = new MemberRepository();
                $updated = $currentMember->update([
                    "membership" => $_REQUEST["values"]["membership"],
                    "auto_renew" => $_REQUEST["values"]["auto_renew"]
                ], $_REQUEST["member_id"]);

                if ( ! $updated ) {
                    echo wp_send_json_error([
                        "message" => "Something went wrong, please try again"
                    ]);
                    wp_die();
                } else {
                    echo wp_send_json_success([
                        "message" => "Membership updated successfully"
                    ]);
                }

                wp_die();
            }

            /**
             * Update member profile action
             *
             * @return void
             */
            public function update() 
            {
                global $wpdb;
                // echo json_encode($_REQUEST); wp_die();
                $data = [
                    "member" => [],
                    "profile" => []
                ];

                $currentMember = (new MemberRepository())->find($_REQUEST['id']);
                $current_user = new \WP_User($currentMember->user_id);

                // update user login
                if ($currentMember->gamertag !== $_REQUEST["gamertag"]) {
                    $wpdb->update(
                        $wpdb->users,
                        [
                            "user_login" => $_REQUEST["gamertag"]
                        ],
                        [
                            "ID" => $currentMember->user_id
                        ]
                    );
                    wp_set_password($_REQUEST["gamertag"], $currentMember->user_id);
                    wp_set_auth_cookie($currentMember->user_id, true, true);
                }

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