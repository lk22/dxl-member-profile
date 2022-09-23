<?php 
    namespace DxlProfile\Views;

    // interfaces
    use Dxl\Interfaces\ViewInterface;

    // Repositories
    use DxlMembership\Classes\Repositories\MemberRepository;
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
             * Undocumented variable
             *
             * @var DxlMembership\Classes\Repositories\MemberRepository;
             */
            public $memberRepository;

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
                $profile = $this->memberRepository->select()->where('user_id', get_current_user_id())->getRow();
                $cooperationEvents = $this->cooperationEventsRepository->select()->where('author', $profile->user_id)->get();
                $trainingEvents = $this->trainingRepository->select()->where('author', $profile->user_id)->get();
                $tournaments = $this->tournamentRepository->select()->where('author', $profile->user_id)->get();
                $games = $this->profileMemberGamesRepository->getMemberGames($profile->id);
                
                $count = count($cooperationEvents) + count($trainingEvents);

                $allEvents = array_merge($cooperationEvents, $trainingEvents, $tournaments);

                return [
                    "member" => $profile,
                    "games" => $games,
                    "count" => $count,
                    "events" => array_merge($cooperationEvents, $trainingEvents, $tournaments),
                    "view" => "modules/events/" . $this->view . ""
                ];
            }
        }
    }


?>