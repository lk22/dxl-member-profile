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

            /**
             * View to render
             *
             * @var string
             */
            public $view = "main";

            /**
             * Member Repository
             *
             * @var DxlMembership\Classes\Repositories\MemberRepository
             */
            public $memberRepository;

            /**
             * Member Profile Repository
             *
             * @var DxlMembership\Classes\Repositories\MemberProfileRepository
             */
            public $membershipRepository;
            
            /**
             * Lan event repository
             *
             * @var DxlEvents\Classes\Repositories\LanRepository
             */
            public $lanRepository;

            /**
             * Lan event participant repository
             *
             * @var DxlEvents\Classes\Repositories\LanParticipantRepository
             */
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
             * @return Iterable
             */
            public function render(): Iterable {
                global $current_user, $wpdb;

                $profile = $this->memberRepository->select()->where('user_id', $current_user->ID)->getRow();
                $this->validateActivatedUserProfile($current_user, $profile);

                $profileMembership = $this->membershipRepository->select()->where('id', $profile->membership)->getRow();
                $profileSettings = $this->memberProfileRepository->select()->where('member_id', $profile->id)->getRow();
                $expireDate = $this->getExpireDate($profileMembership);
                $renewalDate = "Udløber: " . $expireDate;
                $lan = $this->isLanParticipant($profile->id);

                return [
                    "member" => $profile,
                    "profileMembership" => $profileMembership,
                    "profileSettings" => $profileSettings,
                    "expireDate" => $expireDate,
                    "renewalDate" => $renewalDate,
                    "lan" => $lan,
                    "participatedCount" => $this->getParticipationCount($profile),
                    "view" => $this->view
                ];
            }

            private function getParticipationCount($profile): int {
                return count($this->lanParticipantRepository
                    ->select()
                    ->where('member_id', $profile->id)
                    ->get());
            }

            /**
             * Get membership expire date
             *
             * @param [type] $membership
             * @return string
             */
            private function getExpireDate($membership): string {
                return ($membership->length == 6) 
                    ? date('F d, Y', strtotime('last day of june this year')) 
                    : date('F d, Y', strtotime('last day of december this year'));
            }

            /**
             * Validate if user profile is activated
             *
             * @param [type] $user
             * @param [type] $profile
             * @return boolean
             */
            private function validateActivatedUserProfile($user, $profile): bool 
            {
                if ( $user->ID == 0 || ! isset($profile) || isset($profile) && $profile->profile_activated == 0) {
                    $this->view = "not-activated";
                    return false;
                }

                return true;
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