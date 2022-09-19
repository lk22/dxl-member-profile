<?php 

    namespace DxlProfile\Views;

    use Dxl\Interfaces\ViewInterface;

    use DxlMembership\Classes\Repositories\MemberRepository;

    use DxlEvents\Classes\Repositories\TrainingRepository;
    use DxlEvents\Classes\Repositories\TournamentRepository;
    use DxlEvents\Classes\Repositories\ParticipantRepository;
    use DxlEvents\Classes\Repositories\CooperationEventRepository;

    use DxlProfile\Repositories\ProfileMemberGamesRepository;
    
    if ( ! defined('ABSPATH') ) exit;

    if ( ! class_exists('ProfileEventDetailsView') ) 
    {
        class ProfileEventDetailsView implements ViewInterface 
        {
            /**
             * Module view
             *
             * @var string
             */
            protected $view = "details";

            /**
             * Module name
             *
             * @var string
             */
            protected $module = "events";

            /**
             * Tournament Repository
             *
             * @var DxlEvents\Classes\Repostiories\TournamentRepository
             */ 
            public $tournamentRepository;

            /**
             * Training Repository
             *
             * @var DxlEvents\Classes\Repostiories\TrainingRepository
             */
            public $trainingTournamentRepository;

            /**
             * Participant Repository
             *
             * @var DxlEvents\Classes\Repostiories\ParticipantRepository
             */
            public $participantRepository;


            /**
             * Cooperation event repository
             *
             * @var DxlEvents\Classes\Repositories\CooperationEventRepository
             */
            public $cooperationEventRepository;

            /**
             * Profile games repository
             *
             * @var DxlProfile\Repositories\ProfileMemberGamesReposiory
             */
            public $profileGameRepository;

            /**
             * Member Repository
             *
             * @var DxlMembership\Classes\Repositories\MemberRepository
             */
            public $memberRepository;

            /**
             * Construct events view
             */
            public function __construct() 
            {
                $this->tournamentRepository = new TournamentRepository();
                $this->trainingRepository = new TrainingRepository();
                $this->participantRepository = new ParticipantRepository();
                $this->cooperationEventRepository = new CooperationEventRepository();
                $this->profileGameRepository = new ProfileMemberGamesRepository();
                $this->memberRepository = new MemberRepository();

                $this->render();
            }

            /**
             * render events view
             */
            public function render() 
            {
                if( isset($_GET["type"]) && $_GET["type"] == "training" ) {
                    $this->view = "training-details";
                    $details = $this->trainingDetails();
                } else if ( isset($_GET["type"]) && $_GET["type"] == "tournament" ) {
                    $this->view = "tournament-details";
                    $details = $this->tournamentDetails();
                } else {
                    $this->view = "details";
                    $details = $this->getCooperationEventDetails();
                }

                $member = $this->memberRepository->select()->where('user_id', wp_get_current_user()->ID)->getRow();
                $games = $this->profileGameRepository->select()->where('member_id', $member->id)->get();

                return [
                    "view" => "modules/events/" . $this->view . "",
                    "module" => $this->module,
                    "details" => $details,
                    "games" => $games
                ];
            }

            /**
             * Get cooperation details
             *
             * @return void
             */
            protected function getCooperationEventDetails(): Iterable
            {
                $event = $this->cooperationEventRepository->select()->where('slug', "'$_GET[slug]'")->getRow();
                $participants = $this->getParticipants('is_cooperation', $event->id);
                $game = $this->profileGameRepository->find($event->game_id);
                
                var_dump($event);

                return [
                    "event" => $event,
                    "participants" => $participants,
                    "game" => $game
                ];
            }

            /**
             * Get training event details
             *
             * @return void
             */
            protected function trainingDetails(): Iterable
            {
                $event = $this->trainingRepository->select()->where('slug', "'$_GET[slug]'")->getRow();
                $participants = $this->getParticipants("is_training", $event->id);
                $game = $this->profileGameRepository->find($event->game_id);

                return [
                    "event" => $event,
                    "participants" => $participants,
                    "game" => $game
                ];
            }

            /**
             * Get Tourbament event details information
             *
             * @return void
             */
            protected function tournamentDetails(): Iterable
            {
                $event = $this->tournamentRepository->find($_GET["id"]);
                $participants = $this->getParticipants('', $event->id);

                $event["date"] = date("d.m.Y", strtotime($event["date"]));
                $event["time"] = date("H:i", strtotime($event["time"]));

                return [
                    "event" => $event,
                    "participants" => $participants
                ];
            }

            /**
             * get participants for event by type
             *
             * @param string $type
             * @return void
             */
            private function getParticipants(string $type = "", int $event): Iterable
            {
                if (empty($type)) {
                    $participants = $this->participantRepository
                        ->select()
                        ->where("event_id", $event)
                        ->get();
                } else {
                    $participants = $this->participantRepository
                        ->select()
                        ->where("event_id", $event)
                        ->whereAnd($type, 1)
                        ->get();
                }

                return $participants;
            }
        }
    }

?>