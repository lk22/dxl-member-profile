<?php 
    namespace DxlProfile\Views;

    // interfaces
    use Dxl\Interfaces\ViewInterface;

    // Repositories
    use DxlMembership\Classes\Repositories\MemberRepository;
    use DxlMembership\Classes\Repositories\MemberProfileRepository;
    use DxlEvents\Classes\Repositories\CooperationEventRepository;
    use DxlEvents\Classes\Repositories\TrainingRepository;
    use DxlEvents\Classes\Repositories\TournamentRepository;
    use DxlProfile\Repositories\ProfileMemberGamesRepository;

    if ( ! defined('ABSPATH') ) exit;

    if ( ! class_exists('ProfileEventListView') ) 
    {
        class ProfileEventListView implements ViewInterface 
        {

            /**
             * Module view
             *
             * @var string
             */
            protected $view = "list";

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
             * Cooperation events repository
             *
             * @var DxlEvents\Classes\Repositories\CooperationEventRepository
             */
            public $cooperationEventsRepository;

            /**
             * Games attached to profile
             *
             * @var DxlProfile\Repositories\ProfileMemberGamesRepository;
             */
            public $profileMemberGamesRepository;

            /**
             * Tournament Repository
             *
             * @var DXLEvents\Classes\Repositories\TournamentRepository
             */
            public $tournamentRepository;

            /**
             * Construct events view
             */
            public function __construct() 
            {
                $this->memberRepository = new MemberRepository();
                $this->memberProfileRepository = new MemberProfileRepository();
                $this->cooperationEventsRepository = new CooperationEventRepository();
                $this->trainingRepository = new TrainingRepository();
                $this->profileMemberGamesRepository = new ProfileMemberGamesRepository();
                $this->tournamentRepository = new TournamentRepository();
            }

            /**
             * render events view
             */
            public function render() 
            {
                $member = $this->memberRepository->select()->where('user_id', get_current_user_id())->getRow();
                $profile = $this->memberProfileRepository->select()->where('member_id', $member->id)->getRow();
                $cooperationEvents = $this->cooperationEventsRepository->select()->where('author', $member->user_id)->get();
                $trainingEvents = $this->trainingRepository->select()->where('author', $member->user_id)->get();
                $tournaments = $this->tournamentRepository->select()->where('author', $member->user_id)->get();
                $games = $this->profileMemberGamesRepository->getMemberGames($member->id);
                $count = count($cooperationEvents) + count($trainingEvents);

                $allEvents = array_merge($cooperationEvents, $trainingEvents, $tournaments);

                return [
                    "member" => $member,
                    "profile" => $profile,
                    "games" => $games,
                    "count" => $count,
                    "events" => $allEvents,
                    "view" => "modules/events/" . $this->view . ""
                ];
            }
        }
    }

?>