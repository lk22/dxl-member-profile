<?php 
  namespace DxlProfile\Controllers;

  if ( ! defined('ABSPATH') ) exit;

  use DxlEvents\Classes\Repositories\CooperationEventRepository;
  use DxlEvents\Classes\Repositories\TrainingRepository;
  use DxlEvents\Classes\Repositories\TournamentRepository;

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
        if ( ! isset( $_REQUEST["type"] ) ) {
          echo wp_json_encode([
            'status' => 'error',
            'message' => 'Event type is not set'
          ]);
        }

        $data = [];

        // implement all request values to data array
        foreach ( $_REQUEST as $key => $value ) {
          if( $key == "event" ) {
            continue;
          } else {
            $data[$key] = $value;
          }
        }

        switch ( $_REQUEST["type"] ) {
          case 'cooperation':
            $this->createCooperationRepsository->update($data, $_REQUEST['event']);
            break;

          case 'training':
            $this->trainingRepository->update($data, $_REQUEST['event']);
            break;
        }
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
          wp_die(409);
        }
  
        echo json_encode([
          "status" => "success",
          "response" => "Begivenhed oprettet"
        ]);
  
        wp_die(201);
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
          wp_die('', 409);
        }
  
        echo json_encode([
          "status" => "success",
          "response" => "Begivenhed oprettet"
        ]);
        wp_die('', 201);
      }
    }
  }
?>