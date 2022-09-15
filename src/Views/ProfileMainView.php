<?php 

    namespace DxlProfile\Views;

    use Dxl\Interfaces\ViewInterface;

    use DxlMembership\Classes\Repositories\MemberRepository;
    use DxlMembership\Classes\Repositories\MemberProfileRepository;
    use DxlMembership\Classes\Repositories\MembershipRepository;
    use DxlEvents\Classes\Repositories\LanRepository;
    use DxlEvents\Classes\Repositories\LanParticipantRepository;

    if ( ! defined('ABSPATH') ) exit;

    if ( ! class_exists('ProfileMainView') )
    {
        class ProfileMainView implements ViewInterface 
        {

            public $view = "main";

            public $memberRepository;
            public $membershipRepository;
            public $lanRepository;
            public $lanParticipantRepository;

            /**
             * Constructing main view
             */
            public function __construct() {
                $this->memberRepository = new MemberRepository();
                $this->membershipRepository = new MembershipRepository();
                $this->memberProfileRepository = new MemberProfileRepository();
                $this->lanRepository = new LanRepository();
                $this->lanParticipantRepository = new LanParticipantRepository();
                $this->render();
            }

            /**
             * Render the main view
             *
             * @return void
             */
            public function render() {
                global $current_user ,$wpdb;
                
                $profile = $this->memberRepository->select()->where('user_id', $current_user->ID)->getRow();
                
                $profileMembership = $this->membershipRepository->select()->where('id', $profile->membership)->getRow();

                $profileSettings = $this->memberProfileRepository->select()->where('member_id', $profile->id)->getRow();

                $expireDate = ($profileMembership->length == 6) 
                    ? date('F d, Y', strtotime('last day of june this year')) 
                    : date('F d, Y', strtotime('last day of december this year'));

                $renewalDate = "Udløber d. " . $expireDate;

                $lan = $this->isLanParticipant($profile->id);

                return [
                    "member" => $profile,
                    "profileMembership" => $profileMembership,
                    "profileSettings" => $profileSettings,
                    "expireDate" => $expireDate,
                    "renewalDate" => $renewalDate,
                    "lan" => $lan,
                    "view" => $this->view
                ];
            }

            /**
             * Get member profile details
             * 
             * @return Iterable
             */
            private function getMember($user): Iterable 
            {
                return $this->memberRepository
                    ->select()
                    ->where('user_id', $user)
                    ->getRow();
            }

            /**
             * Fetching profile membership details
             *
             * @param [type] $membership
             * @return Iterable
             */
            private function getMembership($membership): Iterable 
            {
                return $this->membershipRepository
                    ->select()
                    ->where('id', $membership)
                    ->getRow();
            }

            /**
             * fetch lan particpant if exist on member profile
             *
             * @param [type] $member
             * @return Iterable
             */
            private function isLanParticipant($member): Iterable
            {
                $lan = $this->lanRepository->select()->where('is_draft', 0)->getRow();
                $lanParticipant = $this->lanParticipantRepository
                    ->select()
                    ->where('event_id', $lan->id)
                    ->whereAnd('member_id', $member)
                    ->getRow();

                return ["event" => $lan, "participant" => $lanParticipant];
            }
        }
    }

?>