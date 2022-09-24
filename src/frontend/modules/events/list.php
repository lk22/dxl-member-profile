<?php 
	/**
	 * Profile manager list partial
	 */
 ?>
 <div class="events-heading row">
	<div class="col-9">
		<h3>Events</h3>
	</div>
	<div class="col-3">
		Du har <?php echo $profile["count"] ?> begivenheder
	</div>
 </div>

 <div class="event-list-container">
 	<div class="col-md-12 events-container">
		<div class="row events-list gap-4 mx-0 my-4">

		
 	<?php 
 		if( $profile["events"] ){
			foreach ( $profile["events"] as $event ) {
				?>
					<div class="event-card col-4 col-xl-5 position-relative">
						<div class="card-heading row mx-0 align-items-center pt-3">
							<div class="col-10">
								<h4 class="fw-semibold mb-0"><?php echo $event->name ?? $event->title ?></h4>
							</div>
							<div class="col-2 event-type mt-2 d-flex align-items-center justify-content-end">
								<?php 
									if ( isset( $event->is_recurring ) ) $type = "træning";
									elseif ( isset( $event->type)  ) $type = "turnering";

									if( isset( $type ) ) {
										?>
											<small class="p-2 rounded-full rounded bg-white text-black"><?php echo $type; ?></small>
										<?php
									} else {
										?>
											<small class="p-2 rounded-full rounded bg-white text-black">Hygge</small>
										<?php
									}
								?>
							</div>
						</div>
						<div class="card-body mt-4">
							<section class="date-time">
								<div class="row mx-0">
									<div class="col-4">
										<p class="fw-semibold"><i class="far fa-calendar-alt"></i> Start dato: </p>
										</div>
										<div class="col-8">
											<p class="mb-0"><?php echo date('d-m-Y', $event->start_date ?? $event->event_date) ?></p>
									</div>
								</div>
								<div class="row mx-0">
									<div class="col-4">
										<p class="fw-semibold"><i class="far fa-clock"></i> Start tidspunkt: </p>
									</div>
									<div class="col-8">
										<p class="mb-0"> <?php echo date('H:i', $event->starttime ?? $event->start_time) ?></p>
								</div>
							</section>
							<section class="event-footer">
								<!-- font awesome controller -->
								<?php 
									$link = $_SERVER["REQUEST_URI"] . "&action=details&slug={$event->slug}";
									if ( isset( $type ) ) $link .= "&type={$type}";
								?>
								<a class="text-decoration-none" href="<?php echo $link?>">
									<p class="text-xs text-white">Se begivenhed <i class="fas fa-gamepad"></i></p>
								</a>
							</section>
						</div>
					</div>
				<?php
			}
 		}
 	 ?>
	 </div>
 	</div>
 	<button data-bs-toggle="modal" data-bs-target="#createEventModal" class="btn btn-primary create-cooperation-event-btn">Ny begivenhed</button>
 </div>

<div class="modal modal-lg fade manager-modal" id="createEventModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Opret Begivenhed</h4>
      </div>
      <div class="modal-body">
        <form action="#" method="POST" class="create-event-modal-form">
			<div class="form-group">
				<h4 class="label">Titel:</h4>
				<input type="text" class="form-control" name="event_title" required>
			</div>

			<div class="form-group">
				<label for="event-type">Begivenhedstype</label>
				<select name="event-type" id="#event-type-field">
					<option value="cooperation">Hygge</option>
				</select>
			</div>

			<div class="form-group">
				<h4 class="label">Beskrivelse:</h4>
				<textarea name="event_description" id="event_description" cols="30" rows="3"></textarea>
			</div>
			<div class="form-group">
				<h4 class="label">Vælg spil</h4>
				<select name="game" id="games">
					<?php 
						foreach($profile["games"] as $game) {
							?>
								<option value="<?php echo $game->id ?>"><?php echo $game->name ?></option>
							<?php
						}
					?>
				</select>
			</div>

        	<div class="form-group">
        		<h4 class="label">Start Dato:</h4>
        		<input type="date" name="date" class="end form-control">
        	</div>

        	<div class="form-group">
        		<h4 class="label">Start Tidspunlt:</h4>
        		<input type="time" name="starttime" class="starttime form-control">
        	</div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary create-event-btn">Gå videre</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->