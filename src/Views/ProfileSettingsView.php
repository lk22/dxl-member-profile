<?php 
    namespace DxlProfile\Views;

    // interfaces
    use Dxl\Interfaces\ViewInterface;

    // Repositories
    use DxlMembership\Classes\Repositories\MemberRepository;
    use DxlProfile\Repositories\ProfileMemberGamesRepository;

    if ( ! defined('ABSPATH') ) exit;

    if ( ! class_exists('ProfileSettingsView') )
    {
        class ProfileSettingsView implements ViewInterface {
            
            /**
             * Member repository
             *
             * @var DxlMembership\Classes\Repositories\MemberRepository;
             */
            public $memberRepository;

            /**
             * Games attached to profile
             *
             * @var DxlProfile\Repositories\ProfileMemberGamesRepository;
             */
            public $profileMemberGamesRepository;

            /**
             * Module view
             *
             * @var string
             */
            public $view;

            /**
             * Module name
             */
            public $module = "modules/settings";

            /**
             * Construct settings view object
             */
            public function __construct()
            {
                $this->memberRepository = new MemberRepository();
                $this->profileMemberGamesRepository = new ProfileMemberGamesRepository();
            }
            
            /**
             * render profile settings
             *
             * @return array
             */
            public function render()
            {
                
                $member = $this->memberRepository
                    ->select()
                    ->where('user_id', get_current_user_id() )
                    ->getRow();

                if ( isset( $_GET["type"] ) && $_GET["type"] == "games" ) {
                    $settings = $this->getGamesSettings($member);
                    $this->view = "game-settings";
                } else {
                    $settings = $this->getProfileSettings();
                    $this->view = "profile-settings";
                }


                return [
                    "member" => $member,
                    "view" => $this->module . "/" . $this->view,
                    "settings" => $settings
                ];
            }

            /**
             * Undocumented function
             *
             * @return Iterable
             */
            private function getProfileSettings(): Iterable 
            {

            }

            /**
             * Get profile games settings
             *
             * @return void
             */
            private function getGamesSettings($member): Iterable 
            {
                $games = $this->profileMemberGamesRepository
                    ->select()
                    ->where('member_id', $member->id)
                    ->get();

                    return ["games" => $games];
            }
        }
    }

?>