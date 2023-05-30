
<div class="modal modal-lg fade manager-modal" id="trainingEventUpdateModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Opdater Begivenhed</h4>
      </div>
      <div class="modal-body">
        <form action="#" method="POST" class="update-training-event-form">
        	<input type="hidden" name="event" value="<?php echo $profile["details"]["event"]->id; ?>">

            <div class="row">
                <div class="form-group mb-4">
                    <label class="label">Titel:</label>
                    <input type="text" class="form-control" value="<?php echo $profile["details"]["event"]->name ?>" name="name" required>
                </div>
            </div>

            <div class="row">
                <div class="form-group mb-4">
                    <label class="label">Vælg spil</label>
                    <select name="game">
                        <option value="<?php echo $profile["details"]["game"]->id ?>">
                            <?php echo $profile["details"]["game"]->name ?>
                        </option>
                        <?php 
                            foreach($profile["games"] as $game) {
                                ?>
                                    <option value="<?php echo $game->id ?>">
                                        <?php echo $game->name ?>
                                    </option>
                                <?php
                            }
                        ?>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="form-group mb-4">
                    <label class="label">Beskrivelse:</label>
                    <textarea name="description" id="event_description" cols="30" rows="3">
                        <?php echo str_replace('\n', "", $profile["details"]["event"]->description) ?>
                    </textarea>
                </div>
            </div>

            <div class="row">
                <div class="form-group mb-4">
                    <label class="label">Start Dato:</label>
                    <input type="date" name="start_date" value="<?php echo date("Y-m-d", $profile["details"]["event"]->start_date) ?>" class="end form-control">
                </div>
            </div>

            <div class="row">
                <div class="form-group mb-4">
                    <label class="label">Fast trænings dag?</label>
                    <label>Ja</label>
                    <input type="radio" name="is_recurring" <?php echo ($profile["details"]["event"]->is_recurring == 1) ? 'checked="checked"' : '' ?> value="1">
                    <label>Nej</label>
                    <input type="radio" name="is_recurring" <?php echo ($profile["details"]["event"]->is_recurring == 0) ? 'checked="checked"' : '' ?> value="0">
                </div>
            </div>

        	<div class="row">
				<div class="form-group training_day_field mb-4" style="<?php echo ($profile["details"]["event"]->is_recurring == 1) ? '' : 'display:none;'; ?>"> 
        			<label class="label">Vælg trænings dag</label>
        			<select name="event_day" id="training_days">
        				<option value="Mandag">Mandag</option>
        				<option value="Tirsdag">Tirsdag</option>
        				<option value="Onsdag">Onsdag</option>
        				<option value="Torsdag">Torsdag</option>
        				<option value="Fredag">Fredag</option>
        				<option value="Lørdag">Lørdag</option>
        				<option value="Søndag">Søndag</option>
        			</select>
        		</div>
        	</div>

			<div class="row">
				<div class="form-group col-md-6 mb-4">
	        		<label class="label">Start Tidspunkt:</label>
	        		<input type="time" name="starttime" value="<?php echo date("H:i", $profile["details"]["event"]->starttime) ?>" class="starttime form-control">
	        	</div>

	        	<div class="form-group col-md-6 mb-4">
	        		<label class="label">Slut Tidspunkt:</label>
	        		<input type="time" name="endtime" value="<?php echo date("H:i", $profile["details"]["event"]->endtime) ?>" class="endtime form-control">
	        	</div>
			</div>

			<div id="modalFormErrorContainer"></div>
        	
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="dxl-btn button-danger" data-bs-dismiss="modal">Close</button>
        <button type="button" class="dxl-btn button-success update-training-event-btn">Opdater</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->