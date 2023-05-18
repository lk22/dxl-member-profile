<form action="#" method="POST" class="create-cooperation-event-form" style="display:none">
    <div class="form-group">
        <label for="event_title" class="label">Title</label>
        <input 
            type="text" 
            class="form-control" 
            name="event_title" 
            id="event_title" 
            required
        >
    </div>

    <div class="form-group event-game-field">
        <label for="event-game" class="label">Vælg spil</label>
        <select 
            name="event-game" 
            id="event-game" 
            class="event-game form-control"
        >
            <?php 
                foreach($profile["games"] as $game) {
                    ?>
                        <option value="<?php echo $game->id ?>"><?php echo $game->name ?></option>
                    <?php
                }
            ?>
        </select>
    </div>

    <div class="form-group event-description-field">
        <label for="event-description" class="label">
            Beskrivelse:
        </label>
        <textarea 
            name="event-description" 
            id="event-description" 
            cols="30" 
            rows="3" 
            class="event-description form-control"
        ></textarea>
    </div>

    <div class="form-group event-start-date-field">
        <label for="event-start-date" class="label">Start dato:</label>
        <input 
            type="date" 
            name="event-start-date" 
            id="event-start-date" 
            class="event-start-date form-control"
        >
    </div>

    <!-- start time field -->
    <div class="form-group event-start-time-field">
        <label for="event-start-time" class="label">Start tidspunkt:</label>
        <input 
            type="time" 
            name="event-start-time" 
            id="event-start-time" 
            class="event-start-time form-control"
        >
    </div>


</form>