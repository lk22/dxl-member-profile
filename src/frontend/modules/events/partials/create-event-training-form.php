<form action="#" method="POST" class="create-training-event-form" style="display:none">
    <div class="form-group event-name-field">
        <label for="event-title">Titel:</label>
        <input type="text" class="form-control" name="event_title" id="event-title" required>
    </div>

    <div class="form-group event-game-field">
        <label for="event-game"></label>
        <select name="event-game" id="event-game">
            <option value="0">Vælg spil</option>
            <?php 
                foreach ( $profile["games"] as $game ) {
                    ?>
                        <option value="<?php echo $game->id ?>"><?php echo $game->name ?></option>
                    <?php
                }
            ?>
        </select>
    </div>

    <div class="form-group description-field">
        <label for="event-description">Beskrivelse:</label>
        <textarea name="event-description" id="event-description" cols="30" rows="10"></textarea>
    </div>

    <div class="form-group start-date-field">
        <label for="start-date">Start dato:</label>
        <input type="date" class="form-control" name="training-date" id="start-date" required>
    </div>

    <div class="form-group">
        <label class="label">Er begivenheden gentagende?</label>
        <label for="">Ja</label>
        <input type="checkbox" name="is-recurring" id="is-recurring" value="1">
        <label for="">Nej</label>
        <input type="checkbox" name="is-recurring" id="is-recurring" value="0">
    </div>

    <div class="form-group holding-day">
        <label for="holding-day">Vælg afholdelsesdag</label>
        <select name="holding-day" id="holding-day">
            <option value="mandag">Mandag</option>
            <option value="tirsdag">Tirsdag</option>
            <option value="onsdag">Onsdag</option>
            <option value="torsdag">Torsdag</option>
            <option value="fredag">Fredag</option>
            <option value="lørdag">Lørdag</option>
            <option value="søndag">Søndag</option>
        </select>
    </div>

    <div class="form-group time-fields">
        <div class="row">
            <div class="col-6">
                <label for="start-time">Start tidspunkt:</label>
                <input type="time" name="starttime" class="starttime form-control" id="start-time">
            </div>
            <div class="col-6">
            <label for="end-time">Slut tidspunkt:</label>
                <input type="time" name="endtime" class="endtime form-control" id="end-time">
            </div>
        </div>
    </div>
</form>