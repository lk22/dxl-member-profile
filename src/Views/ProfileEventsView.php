<?php 
    namespace DxlProfile\Views;

    use Dxl\Interfaces\ViewInterface;

    use DxlMembership\Classes\Repositories\MemberRepository;
    use DxlEvents\Classes\Repositories\CooperationEventRepository;
    use DxlEvents\Classes\Repositories\TrainingRepository;

    if ( ! defined('ABSPATH') ) exit;

    if ( ! class_exists('ProfileEventsView') ) 
    {
        class ProfileEventsView implements ViewInterface 
        {

            /**
             * Module view
             *
             * @var string
             */
            protected $view = "module";

            /**
             * Cooperation events repository
             *
             * @var DxlEvents\Classes\Repositories\CooperationEventRepository
             */
            public $cooperationEventsRepository;

            /**
             * Construct events view
             */
            public function __construct() 
            {
                $this->memberRepository = new MemberRepository();
                $this->cooperationEventsRepository = new CooperationEventRepository();
                $this->traininRepository = new TrainingRepository();
                $this->render();
            }

            /**
             * render events view
             */
            public function render() 
            {
                $profile = $this->memberRepository->select()->where('user_id', get_current_user_id())->getRow();
                $cooperationEvents = $this->cooperationEventsRepository->select()->where('author', $profile->user_id)->get();
                $trainingEvents = $this->traininRepository->select()->where('author', $profile->user_id)->get();

                return [
                    "member" => $profile,
                    "cooperationEvents" => $cooperationEvents,
                    "trainingEvents" => $trainingEvents,
                    "view" => "module/events/" . $this->view . ""
                ];
            }
        }
    }


?>