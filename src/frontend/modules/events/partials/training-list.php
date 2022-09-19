<?php 
    if( $profile["events"]["training"] ){
        ?>
        <p class="lead">Trænings begivenheder</p>
        <table class="table table-responsive event-list-table">
                <thead>
                    <th>Titel</th>
                    <th>Antal deltagere</th>
                <th>Start dato</th>
                <th class="hidden-xs hidden-sm">Start tidspunkt</th>
                <th>Udkast</th>
                </thead>
                <tbody>
                    <?php 
                        foreach ($profile["events"]["training"] as $event) {
                            $is_draft = $event->is_draft;

                            if( $is_draft == 1 ) {
                                $draft = "Ja";
                            } else {
                                $draft = "Offentligjort";
                            }

                            ?>
                            <tr class="event-list-item" data-event="<?php echo $event->id ?>">
                                <td>
                                    <a href="<?php echo $_SERVER["REQUEST_URI"] . "&action=details&type=training&slug={$event->slug}" ?>">
                                        <?php echo $event->name ?>
                                    </a>
                                </td>
                                <td><?php echo $event->participants_count; ?></td>
                                <td><?php echo date('d-m-Y', $event->start_date); ?></td>
                                <td class="hidden-xs hidden-sm"><?php echo date('H:i', $event->starttime); ?></td>
                                <td><div class="label label-<?php echo ($is_draft) ? "success" : "danger"; ?>"><?php echo $draft; ?></div></td>
                            </tr>
                            <?php
                        }
                    ?>
                </tbody>
            </table>
        <?php
    } else {
        ?>
        <div class="col-md-11">
            <div class="no-events-heading">
                <div class="icon">
                    <i class="fas fa-frown"></i>
                </div>
                <div class="heading">Du har desværre ingen trænings begivenheder oprettet</div>
                <div class="sub-heading">Tryk på knappen nedenunder for at oprette en begivenhed</div>
            </div>
        </div>
        <?php
    }
?>