<?php 
    namespace DxlProfile\Views;

    use Dxl\Interfaces\ViewInterface;

    use DxlMembership\Classes\Repositories\MemberRepository;
    use DxlMembership\Classes\Repositories\MemberProfileRepository;
    use DxlMembership\Classes\Repositories\MembershipRepository;
    use DxlProfile\Repositories\ProfileMemberGamesRepository;


    if( ! defined('ABSPATH') ) exit;

    if ( ! class_exists('UpdateProfileView')  )
    {
        class UpdateProfileView implements ViewInterface
        {
            /**
             * Member Repository
             *
             * @var DxlMemberships\Classes\Repositories\MemberRepository
             */
            public $memberRepository;

            /**
             * Member Profile Repository
             *
             * @var DxlMemberships\Classes\Repositories\MemberProfileRepository
             */
            public $memberProfileRepository;

            /**
             * Membership Repository
             *
             * @var DxlMemberships\Classes\Repositories\MembershipRepository
             */
            public $membershipRepository;

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
            public $view = "update";
            
            /**
             * Module name
             *
             * @var string
             */
            public $module = "modules/profile";

            /**
             * Constructor
             * 
             * @return void
             */
            public function __construct()
            {
                $this->memberRepository = new MemberRepository();
                $this->memberProfileRepository = new MemberProfileRepository();
                $this->membershipRepository = new MembershipRepository();
                $this->profileMemberGamesRepository = new ProfileMemberGamesRepository();
            }

            /**
             * Render view with profile data
             *
             * @return Iterable
             */
            public function render(): Iterable
            {
                $member = $this->getMember();
                $settings = $this->getProfileSettings($member);
                $memberships = $this->membershipRepository->all();
                $currentMembership = $this->getCurrentMembership($member);
                $games = $this->getGamesSettings($member);

                return [
                    'member' => $member,
                    'settings' => $settings,
                    'memberships' => $memberships,
                    "currentMembership" => $currentMembership,
                    "games" => $games,
                    "view" => $this->module . "/" .$this->view,
                ];
            }

            /**
             * Get profile games settings
             *
             * @return void
             */
            private function getGamesSettings($member)
            {
                $games = $this->profileMemberGamesRepository
                    ->select()
                    ->where('member_id', $member->id)
                    ->get();

                    return $games;
            }
            
            /**
             * Get member data
             *
             * @return Iterable
             */
            private function getMember(): Object
            {
                return $this->memberRepository
                    ->select()
                    ->where('user_id', get_current_user_id())
                    ->getRow();
            }

            /**
             * Get member profile data
             *
             * @param array $member
             * @return Iterable
             */
            private function getProfileSettings( $member ): Object
            {
                return $this->memberProfileRepository
                    ->select()
                    ->where('member_id', $member->id)
                    ->getRow();
            }

            /**
             * Get member current memberships
             *
             * @param object $member
             * @return Object
             */
            private function getCurrentMembership( $member ): Object
            {
                return $this->membershipRepository
                    ->select()
                    ->where('id', $member->membership)
                    ->getRow();
            }
        }
    }

?>