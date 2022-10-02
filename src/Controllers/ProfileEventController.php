<?php 
  namespace DxlProfile\Controllers;

  if ( ! defined('ABSPATH') ) exit;

  use DxlEvents\Classes\Repositories\CooperationEventRepository;
  use DxlEvents\Classes\Repositories\TrainingRepository;
  use DxlEvents\Classes\Repositories\TournamentRepository;
  use DxlEvents\Classes\Repositories\ParticipantRepository;

  use DxlProfile\ActionsCreateEvent;

  if ( ! class_exists('ProfileEventController') )
  {
    class ProfileEventController 
    {

      /**
       * Profile event controller constructor
       */
      public function __construct()
      {
        $this->cooperationEventRepository = new CooperationEventRepository();
        $this->trainingRepository = new TrainingRepository();
        $this->tournamentRepository = new TournamentRepository();
        $this->participantRepository = new ParticipantRepository();
      }

      /**
       * Creating event action
       */
      public function create()
      {
        switch ( $_REQUEST['event-type'] ) {
          case 'cooperation':
            // TODO: refactor to use CreateCooperationEvent class
            $this->createCooperationEvent();
            break;
          case 'training':
            // TODO: refactor to use CreateTrainingEvent class
            $this->createTrainingEvent();
            break;
        }
      }

      /**
       * Updating event action
       *
       * @return void
       */
      public function update() 
      {
        // echo json_encode($_REQUEST);
        // wp_die();
        if ( ! isset( $_REQUEST["type"] ) ) {
          echo wp_json_encode([
            'status' => 'error',
            'message' => 'Event type is not set'
          ]);
          wp_die();
        }

        $data = [];

        // implement all request values to data array
        foreach ( $_REQUEST as $key => $value ) {
          if( $key == "event" || $key == "action" || $key == "nonce" || $key == "type" ) {
            continue;
          } else {

            if ( $key == "game" ) {
              $key = "game_id";
            }

            $data[$key] = $value;
          }
        }

        switch ( $_REQUEST["type"] ) {
          case 'cooperation':
            $data["event_date"] = strtotime($data["event_date"]);
            $data["start_time"] = strtotime($data["start_time"]);
            $data["game_id"] = $_REQUEST["game"];

            $updated = $this->cooperationEventRepository->update($data, $_REQUEST['event']);

            break;

          case 'training':
            $data["starttime"] = strtotime($data["starttime"]);
            $data["endtime"] = strtotime($data["endtime"]);
            $data["game_id"] = $_REQUEST["game"];
            $data["start_date"] = strtotime($data["start_date"]);

            $this->trainingRepository->update($data, $_REQUEST['event']);
            break;
        }

        if ( ! $updated ) {
          echo wp_json_encode([
            "status" => "failed",
            "response" => "Noget gik galt, kunne ikke opdatere begiveneheden"
          ]);
          wp_die();
        }

        echo wp_json_encode(["status" => "success", "response" => "Event updated"]);
        wp_die();
      }

      /**
       * Publishing event action
       *
       * @return void
       */
      public function publishUnpublishEvent() {
        if ( ! isset($_REQUEST["event_action"]) || ! isset($_REQUEST["event_type"]) ) {
          echo wp_json_encode([
            "status" => "failed",
            "response" => "Event type or action is provided"
          ]);
          wp_die();
        }

        switch ($_REQUEST["event_type"]) {
          case 'cooperation':
            $updated = ($_REQUEST["event_action"] == "publish") 
              ? $this->cooperationEventRepository->update(["is_draft" => 0], $_REQUEST["event_id"]) 
              : $this->cooperationEventRepository->update(["is_draft" => 1], $_REQUEST["event_id"]);
            break;

            case 'training': 
              $updated = ($_REQUEST["event_action"] == "publish") 
                ? $this->trainingRepository->update(["is_draft" => 0], $_REQUEST["event_id"]) 
                : $this->trainingRepository->update(["is_draft" => 1], $_REQUEST["event_id"]);
              break;
        }
        
        if ( ! $updated ) {
          echo wp_json_encode([
            "status" => "failed",
            "response" => "something went wrong, could not perform your action"  // needs translation
          ]);
          wp_die();
        }

        echo wp_json_encode([
          "status" => "success",
          "response" => "Event published"
        ]);
        wp_die();
      }

      /**
       * Delete event action 
       * 
       * @return void
       */
      public function delete() {
        if ( ! isset($_REQUEST["event_type"]) || ! isset($_REQUEST["event_id"]) ) {
          echo wp_json_encode([
            "status" => "failed",
            "response" => "Event type or id is not provided"
          ]);
          wp_die();
        }

        $participants = $this->participantRepository->select()->where('event_id', $_REQUEST["event_id"])->get();

        if ( $participants ) {
          $this->participantRepository->delete($_REQUEST["event_id"]);
        }

        switch($_REQUEST["event_type"]) {
          case 'cooperation':
            $deleted = $this->cooperationEventRepository->delete($_REQUEST["event_id"]);
            break;
          case 'training':
            $deleted = $this->trainingRepository->delete($_REQUEST["event_id"]);
            break;
        }

        if ( ! $deleted ) {
          echo wp_json_encode([
            "status" => "failed",
            "response" => "something went wrong, could not perform your action"  // needs translation
          ]);
        }

        echo wp_json_encode([
          "status" => "success",
          "response" => "Event deleted successfully"
        ]);
        wp_die();
      }

      /**
       * Creating cooperation event ressource
       *
       * @return void
       */
      private function createCooperationEvent() 
      {
        $created = $this->cooperationEventRepository->create([
          "title" => $_REQUEST['event_title'],
          "slug" => str_replace(' ', '-', $_REQUEST['event_title']), // creating slug from title
          "description" => $_REQUEST['event_description'],
          "participants_count" => 0,
          "event_date" => strtotime($_REQUEST['date']),
          "start_time" => strtotime($_REQUEST['starttime']),
          "created_at" => time(),
          "game_id" => $_REQUEST['game'],
          "author" => $_REQUEST['profile'],
          "created_at" => time(),
          "is_draft" => 1
        ]);
  
        if ( ! $created ) {
          echo wp_json_encode([
            "status" => "error",
            "response" => "Begivenhed ikke oprettet, prøv igen senere",
            "data" => $_REQUEST
          ]);
          wp_die();
        }
  
        echo json_encode([
          "status" => "success",
          "response" => "Begivenhed oprettet"
        ]);
  
        wp_die();
      }
  
      /**
       * Creating training event ressource
       *
       * @return void
       */
      private function createTrainingEvent() 
      {
        $created = $this->trainingRepository->create([
          "name" => $_REQUEST['event_title'],
          "slug" => str_replace(' ', '-', $_REQUEST['event_title']), // creating slug from title
          "description" => $_REQUEST['event_description'],
          "participants_count" => 0,
          "game_id" => $_REQUEST['game'],
          "author" => $_REQUEST['profile'],
          "created_at" => time(),
          "updated_at" => 0,
          "is_draft" => 1,
          "start_date" => strtotime($_REQUEST['date']),
          "starttime" => strtotime($_REQUEST['starttime']),
          "endtime" => strtotime($_REQUEST['endtime']),
          "event_day" => $_REQUEST['event-day'],
          "is_recurring" => $_REQUEST["is-recurring"],
        ]);
  
        if ( ! $created ) {
          echo wp_json_encode([
            "status" => "error",
            "response" => "Begivenhed ikke oprettet, prøv igen senere",
            "data" => $_REQUEST
          ]);
          wp_die();
        }
  
        echo json_encode([
          "status" => "success",
          "response" => "Begivenhed oprettet"
        ]);
        wp_die();
      }
    }
  }
?>