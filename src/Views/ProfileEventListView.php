<?php 
    namespace DxlProfile\Views;

    use Dxl\Interfaces\ViewInterface;

    use DxlMembership\Classes\Repositories\MemberRepository;
    use DxlEvents\Classes\Repositories\CooperationEventRepository;
    use DxlEvents\Classes\Repositories\TrainingRepository;
    use DxlEvents\Classes\Repositories\LanRepository;

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
             * Cooperation events repository
             *
             * @var DxlEvents\Classes\Repositories\CooperationEventRepository
             */
            public $cooperationEventsRepository;

            /**
             * Games attached to profile
             *
             * @var [type]
             */
            public $profileMemberGamesRepository;

            /**
             * Construct events view
             */
            public function __construct() 
            {
                $this->memberRepository = new MemberRepository();
                $this->cooperationEventsRepository = new CooperationEventRepository();
                $this->traininRepository = new TrainingRepository();
                $this->profileMemberGamesRepository = new ProfileMemberGamesRepository();
            }

            /**
             * render events view
             */
            public function render() 
            {
                $profile = $this->memberRepository->select()->where('user_id', get_current_user_id())->getRow();
                $cooperationEvents = $this->cooperationEventsRepository->select()->where('author', $profile->user_id)->get();
                $trainingEvents = $this->traininRepository->select()->where('author', $profile->user_id)->get();
                $games = $this->profileMemberGamesRepository->getMemberGames($profile->id);
                $this->repository->table("dxl_event_participants")->select(['id', 'name'])->whereIn('event_id', $event->id)->whereAnd('is_training', '1', 'IN')->get();
                return [
                    "member" => $profile,
                    "cooperationEvents" => $cooperationEvents,
                    "trainingEvents" => $trainingEvents,
                    "games" => $games,
                    "view" => "modules/events/" . $this->view . ""
                ];
            }
        }
    }


?>