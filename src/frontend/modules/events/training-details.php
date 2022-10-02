<div class="row event-show-information-container">
	<div class="inner">
		<div class="col-md-12 event-detail-header p-3">
			<div class="row">
				<div class="col-md-8">
					<h3 class="heading"><?php echo $profile["details"]["event"]->name; ?></h3>
					<p class="mb-0">Trænings begivenhed</p>
				</div>
				<div class="col-md-4 d-flex align-items-center justify-content-start justify-content-md-end gap-4">
					<p class="text-sm mb-0">
						<?php 
							if($profile["details"]["event"]->is_draft) {
								?> <small>(Udkast)</small> <?php
							} else {
								?> <small>(Offentlig begivenhed)</small> <?php
							}
						 ?>
					</p>
					<button 
						class="btn btn-danger delete-event-button" 
						data-event="<?php echo $profile["details"]["event"]->id ?>"
						data-type="training"
					>
						Slet <i class="fas fa-trash"></i>
					</button>
				</div>
			</div>
		</div>

		<div class="row p-4">
			<div class="col-md-6 event_date mb-4">
				<h5>Start dato</h5>
				<h5 class="date"><?php echo date('d-m-Y', $profile["details"]["event"]->start_date) ?></h5>
			</div>

			<div class="col-md-6 event_time mb-4">
				<h5>Start tidspunkt</h5>
				<h5 class="time"><?php echo date('H:i', $profile["details"]["event"]->starttime) ?></h5>
			</div>

			<div class="col-md-6 event-end-time mb-4">
				<h5>Slut tidspunkt</h5>
				<h5 class="time"><?php echo date('H:i', $profile["details"]["event"]->endtime) ?></h5>
			</div>

		<?php 
			if($profile["details"]["game"]->name){
				?>
					<div class="col-md-6 game mb-4">
						<h5>Valgt spil</h5>
						<h5><?php echo $profile["details"]["game"]->name ?></h5>
					</div>
					<?php
			}
			?>
			
					 <?php 
						 if($profile["details"]["event"]->event_day){
							 ?>
								<div class="event-day col-md-6 mb-4">
									<h5>Trænings dag:</h5>
									<?php 
										if ( $profile["details"]["event"]->is_recurring ) {
											?>
												<p><b>Fast dag: hver <?php echo $profile["details"]["event"]->event_day; ?></b></p>
											<?php
										} else {
											?>
												<p><b> <?php echo $profile["details"]["event"]->event_day; ?></b></p>
											<?php
										}
									?>
								</div>
							 <?php
						 }
					 ?>
		<?php 
			if( $profile["details"]["event"]->description ){
				?>
					<div class="col-md-12 mb-4 event-information-description">
						<h5>Beskrivelse:</h5>
						<p class="heading"><b><?php echo str_replace(['\n', '/', '\\'], "\n", ucfirst($profile["details"]["event"]->description)); ?></b></p>
					</div>
				<?php
			} else {
				?>
					<div class="event-information-description col-md-12 mb-4">
						<p>Der er ikke angivet nogle beskrivelse</p>
					</div>
				<?php
			}
		 ?>
		</div>

		<div class="col-md-12 participants-container">
			
			<?php
				if( $profile["details"]["participants"] > 0 ) {	
					?>
						<h5>Deltagere til dette event</h5>
						<table class="table table-responsive">
							<thead>
								<th><b>Navn</b></th>
							</thead>
							<tbody>
								<?php
									foreach($profile["details"]["participants"] as $participant) {
										?>
											<tr data-participant="<?php echo $participant->id ?>">
												<td><?php echo $participant->name; ?></td>
											</tr>
										<?php 
									}
								 ?>
							</tbody>
						</table>
					<?php 
				} else {
					?>
						<div class="alert alert-info">Du har ingen tilmeldinger på denne begivenhed</div>
					<?php 
				}
			?>
		</div>
 
		 <button data-bs-toggle="modal" data-bs-target="#trainingEventUpdateModal" class="btn btn-primary">Rediger</button>
		 <?php 
		 	if( $profile["details"]["event"]->is_draft ) {
		 		?>
					<button 
						class="btn btn-primary publish-unpublish-event-btn" 
						data-event="<?php echo $profile["details"]["event"]->id ?> "
						data-event-type="training"
						data-action="publish"
					>
						offentliggør
					</button>
		 		<?php
		 	} else {
		 		?>
					<button 
						class="btn btn-primary publish-unpublish-event-btn" 
						data-event="<?php echo $profile["details"]["event"]->id; ?> "
						data-event-type="training"
						data-action="unpublish"
					>
						Sæt til udkast
					</button>
					<a href="<?php echo get_home_url() ?>/events/?event_action=show&event_type=training&slug=<?php echo $_GET["slug"] ?>" class="btn btn-primary">Se begivenhed</a>
		 		<?php
		 	}
		  ?>
	</div>
</div>

<div class="modal modal-lg fade manager-modal" id="trainingEventUpdateModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Opdater Begivenhed</h4>
      </div>
      <div class="modal-body">
        <form action="#" method="POST" class="update-training-event-form">
        	<input type="hidden" name="event" value="<?php echo $profile["details"]["event"]->id; ?>">
        	<div class="form-group">
        		<h4 class="label">Titel:</h4>
        		<input type="text" class="form-control" value="<?php echo $profile["details"]["event"]->name ?>" name="name" required>
        	</div>

	        <div class="form-group">
	            <h4 class="label">Beskrivelse:</h4>
	            <textarea name="description" id="event_description" cols="30" rows="3">
	            	<?php echo str_replace('\n', "\n", $profile["details"]["event"]->description) ?>
	            </textarea>
	        </div>

        	<div class="form-group">
        		<h4 class="label">Start Dato:</h4>
        		<input type="date" name="start_date" value="<?php echo date("Y-m-d", $profile["details"]["event"]->start_date) ?>" class="end form-control">
        	</div>

        	<div class="row">
        		<div class="form-group col-md-6">
        			<h4 class="label">Fast trænings dag?</h4>
        			<label>Ja</label><input type="radio" name="is_recurring" <?php echo ($profile["details"]["event"]->is_recurring == 1) ? 'checked="checked"' : '' ?> value="1">
        			<label>Nej</label><input type="radio" name="is_recurring" <?php echo ($profile["details"]["event"]->is_recurring == 0) ? 'checked="checked"' : '' ?> value="0">
        		</div>

				<div class="form-group col-md-6 training_day_field" style="<?php echo ($profile["details"]["event"]->is_recurring == 1) ? '' : 'display:none;'; ?>"> 
        			<h4 class="label">Vælg trænings dag</h4>
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

        	<div class="form-group">
        		<h5 class="label">Vælg spil</h5>
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

			<div class="row">
				<div class="form-group col-md-6">
	        		<h4 class="label">Start Tidspunkt:</h4>
	        		<input type="time" name="starttime" value="<?php echo date("H:i", $profile["details"]["event"]->starttime) ?>" class="starttime form-control">
	        	</div>

	        	<div class="form-group col-md-6">
	        		<h4 class="label">Slut Tidspunkt:</h4>
	        		<input type="time" name="endtime" value="<?php echo date("H:i", $profile["details"]["event"]->endtime) ?>" class="endtime form-control">
	        	</div>
			</div>

			<div id="modalFormErrorContainer"></div>
        	
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary button-danger" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary button-success update-training-event-btn">Opdater</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->