<?php 
	/**
	 * Profile manager event show view for cooperation events
	 * @package Danish Xbox League Manager
	 * @version 1.0
	 */
 ?>
<div class="row event-show-information-container">
	<div class="inner">
		<!-- Event detail header -->
		<div class="col-md-12 event-show-heading">
			<div class="row event-detail-header p-4">
				<div class="col-8">
					<h3 class="heading"><?php echo strtoupper($profile["details"]["event"]["item"]->title); ?></h3>
					<p class="mb-0">Hygge begivenhed</p>
				</div>
				<div class="col-4 d-flex align-items-center justify-content-end">
					<span class="lead me-4">
						<?php 
								if($profile["details"]["event"]["item"]->is_draft) {
									?> <small>Udkast</small> <?php
								} else {
									?> <small>Offentlig begivenhed</small> <?php
								}
						?>
					</span>
					<button 
						class="delete-event-btn btn btn-danger" 
						data-event="<?php echo $profile["details"]["item"]["event"]->id ?>"
					>
						Slet <i class="fas fa-trash"></i>
					</button>
				</div>
			</div>
		</div> <!-- Event detail header end -->
		<div class="row p-3">
			<div class="col-6">
				<h5>Start dato: </h5>
				<p class="lead">
					<?php echo date('d-m-Y', $profile["details"]["event"]["item"]->event_date) ?>
				</p>
			</div>
			<div class="col-6">
				<h5>Start tidspunkt: </h5>
				<p class="lead">
					<?php echo date('H:i', $profile["details"]["event"]["item"]->start_time) ?>
				</p>
			</div>
			<div class="col-6">
				<h5>
					Tilknyttet spil:
				</h5>
				<p class="lead">
					<?php echo $profile["details"]["event"]["game"]->name ?>
				</p>
			</div>
			<div class="col-6">
				<h5>Beskrivelse:</h5>
				<?php 
					if( $profile["details"]["event"]["item"]->description ){
						?>
							<div class="col-md-12 event-information-description">
								<p class="heading"><?php echo str_replace(['/', '\n'], "\n", ucfirst($profile["details"]["event"]["item"]->description)); ?></p>
							</div>
						<?php
					} else {
						?>
							<div class="event-information-description col-md-12">
								<p>Der er ikke angivet nogle beskrivelse</p>
							</div>
						<?php
					}
				?>
			</div>
			<div class="col-6"></div>
		</div>

		 <!-- participants list component  -->
		 <div class="col-md-6 participants-container">
			 <h4>Deltagerliste</h4>
		 	<?php
			 	if( $profile["details"]["event"]["participants"] ) {
			 		?>
						<table class="table table-responsive">
							<thead>
								<th>Gamertag</th>
							</thead>
							<tbody>
								<?php
									foreach($profile["details"]["event"]["participants"] as $participant) {
										?>
											<tr>
												<td><strong><?php echo $participant->name; ?></strong></td>
											</tr>
										<?php
									}
								 ?>
							</tbody>
						</table>
			 		<?php
			 	} else {
			 		?>
						<div class="alert alert-info">Du har ingen tilmeldninger til denne begivenhed</div>
			 		<?php
			 	}
		 	 ?>	
		 	
		 </div> <!-- Participants list component end -->

		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<button 
				data-bs-toggle="modal" 
				data-bs-target="#cooperationEventUpdateModal" 
				class="btn btn-primary edit-event-btn"
				>
					Rediger
				</button>
			<?php 
				if( $profile["details"]["event"]["item"]->is_draft ) {
					?>
						<button 
							class="btn btn-primary publish-unpublish-event-btn" 
							data-event="<?php echo $profile["details"]["event"]["item"]->id; ?> "
							data-event-type="cooperation"
							data-action="publish"
						>
							offentliggør
						</button>
					<?php
				} else {
					?>
						<button 
							class="btn btn-primary publish-unpublish-event-btn"
							data-event="<?php echo $profile["details"]["event"]["item"]->id; ?> "
							data-event-type="cooperation"
							data-action="unpublish"
						>
							Sæt til udkast
						</button>
						<a href="<?php echo get_home_url() ?>/events/?event_action=show&event_type=cooperation&slug=<?php echo $_GET["slug"] ?>" class="btn btn-primary">Se begivenhed</a>
					<?php
				}
			?>
			<a href="/manager-profile/?view=events" class="btn">Gå tilbage</a>
		</div>
	</div>
</div>

<div class="modal modal-xl fade manager-modal" id="cooperationEventUpdateModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Rediger <?php echo $profile["details"]["event"]["item"]->title; ?></h4>
      </div>
      <div class="modal-body">
        <form action="#" method="post" class="update-cooperation-event-form">
        	<input type="hidden" name="event" value="<?php echo $profile["details"]["event"]["item"]->id; ?>">

        	<div class="form-group">
        		<h5 class="label">Title</h5>
        		<input type="text" name="title" value="<?php echo $profile["details"]["event"]["item"]->title ?>">
        	</div>

        	<div class="form-group">
        		<h5 class="label">description</h5>
        		<textarea name="description" cols="30" rows="5"><?php echo $profile["details"]["event"]["item"]->description ?></textarea>
        	</div>

        	<div class="form-group">
        		<h5 class="label">Vælg spil</h5>
        		<select name="game">
        			<option value="<?php echo $profile["details"]["event"]["game"]->id ?>">
        				<?php echo $profile["details"]["event"]["game"]->name ?>
        			</option>
        			<?php 
        				foreach($profile["details"]["games"] as $game) {
        					?>
								<option value="<?php echo $game->id ?>">
									<?php echo $game->name ?>
								</option>
        					<?php
        				}
        			 ?>
        		</select>
        	</div>

        	<div class="form-group">
        		<div class="col-md-6">
        			<h5 class="label">Start dato</h5>
        			<input type="date" name="event_date" class="form-control" value="<?php echo date('Y-m-d', $profile["details"]["event"]["item"]->event_date) ?>">
        		</div>

        		<div class="col-md-6">
        			<h5 class="label">Start tidspunkt</h5>
        			<input type="time" name="start_time" class="starttime form-control" value="<?php echo date('H:m', $profile["details"]["event"]["item"]->start_time) ?>">
        		</div>
        	</div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary button-danger" data-bs-dismiss="modal">Luk</button>
        <button type="button" class="btn btn-primary update-event-btn button-success">Opdater</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->