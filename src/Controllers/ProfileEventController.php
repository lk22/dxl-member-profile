<?php 
  namespace DxlProfile\Controllers;

  if ( ! defined('ABSPATH') ) exit;

  use DxlEvents\Classes\Repositories\CooperationEventRepository;
  use DxlEvents\Classes\Repositories\TrainingRepository;
  use DxlEvents\Classes\Repositories\TournamentRepository;

  use DxlProfile\Requests\CreateEventRequest;

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
        
        // echo 'create event';
        // wp_die();
        switch ( $_REQUEST['event-type'] ) {
          case 'cooperation':
            $this->createCooperationEvent();
            break;
          case 'training':
            $this->createTrainingEvent();
            break;
        }
      }

      /**
       * Creating cooperation event ressource
       *
       * @return void
       */
      public function createCooperationEvent() 
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

      /**
       * Updating event action
       *
       * @return void
       */
      public function update() 
      {
        echo json_encode(["updating"]);
      }
    }
  }

?>