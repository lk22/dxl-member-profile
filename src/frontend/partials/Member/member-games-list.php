<?php 
    if ( count($profile["games"]) ) {
        foreach ( $profile["games"] as $game ) {
            ?>
                <div class="row game-row" data-game="<?php echo $game->id ?>">
                    <div class="col-12 col-lg-4 game">
                        <div class="game-title">
                            <?php echo $game->name ?>
                        </div>
                        <div class="game-actions">
                            <div class="delete">
                                <span>
                                    <i class="fas fa-trash"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
        }
    } else {
        ?>
            <div class="row game-row no-games-info">
                <div class="col-12 col-lg-4">
                    <div class="alert alert-info">
                        Du har ingen spil titler tilknyttet din profil
                    </div>
                </div>
            </div>
        <?php
    }

?>
