<?php 
    if( $profile["events"]["tournaments"] ){
        ?>
        <p class="lead">Turneringer (<?php echo count($profile["events"]["tournaments"]) ?>)</p>
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
                        foreach ($profile["events"]["cooperation"] as $event) {
                            $is_draft = $event->is_draft;

                            if( $is_draft == 1 ) {
                                $draft = "Ja";
                            } else {
                                $draft = "Offentligjort";
                            }

                            ?>
                            <tr class="event-list-item" data-event="<?php echo $event->id ?>">
                                <td>
                                    <a href="<?php echo $_SERVER["REQUEST_URI"] . "&action=details&type=tournament&slug={$event->slug}" ?>">
                                        <?php echo $event->title ?>
                                    </a>
                                </td>
                                <td><?php echo $event->participants_count; ?></td>
                                <td><?php echo date('d-m-Y', $event->event_date); ?></td>
                                <td class="hidden-xs hidden-sm"><?php echo date('H:i', $event->start_time); ?></td>
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
        <p class="lead">Turneringer (<?php echo count($profile["events"]["tournaments"]) ?>)</p>

        <?php
    }
?>