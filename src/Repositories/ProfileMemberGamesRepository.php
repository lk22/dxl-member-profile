<?php 

    namespace DxlProfile\Repositories;

    use Dxl\Classes\Abstracts\AbstractRepository;

    if ( ! defined('ABSPATH') ) exit;

    if ( ! class_exists('ProfileMemberGamesRepository') )
    {
        class ProfileMemberGamesRepository extends AbstractRepository
        {
            /**
             * Table name
             *
             * @var string
             */
            protected $repository = "member_games";

            /**
             * Primary key
             *
             * @var string
             */
            protected $primaryIdentifier = "id";

            /**
             * Get member games
             *
             * @param int $memberId
             * @return array
             */
            public function getMemberGames(int $memberId) : array
            {
                
                return [];
            }
        }
    } 

?>