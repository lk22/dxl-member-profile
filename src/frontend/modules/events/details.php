<?php 
    echo "Cooperation event";
?>

<?php 
	/**
	 * Profile manager event show view for cooperation events
	 * @package Danish Xbox League Manager
	 * @version 1.0
	 */
 ?>
<div class="row event-show-information-container">
	<div class="inner">
		<div class="col-md-10 event-show-heading">
			<h3 class="heading"><?php echo strtoupper($profile["details"]["event"]->title); ?>
				<?php 
					if($profile["details"]["event"]->is_draft) {
						?> <small>(Udkast)</small> <?php
					} else {
						?> <small>(Offentlig begivenhed)</small> <?php
					}
				 ?>
			</h3>
			
		</div>
		<div class="col-md-2">
			<button class="delete-event-btn" data-event="<?php echo $collection["event"]->id ?>">Slet <i class="fas fa-trash"></i></button>
		</div>
		<div class="col-md-6 event_date">
			<h5>Start dato: <?php echo date('d-m-Y', $profile["details"]["event"]->event_date) ?></h5>
			<h5>Start tidspunkt: <?php echo date('H:i', $profile["details"]["event"]->start_time) ?></h5>
			<h5>Tilknyttet spil: <?php echo $profile["details"]["game"]->name ?></h5>
			<?php 
				if( $profile["details"]["event"]->description ){
					?>
						<div class="col-md-12 event-information-description">
							<p class="heading"><?php echo str_replace(['/', '\n'], "\n", ucfirst($profile["details"]["event"]->description)); ?></p>
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

		 <div class="col-md-6 participants-container">
			 <h4>Deltagerliste</h4>
		 	<?php
			 	if( $profile["details"]["participants"] ) {
			 		?>
						<table class="table table-responsive">
							<thead>
								<th>Gamertag</th>
							</thead>
							<tbody>
								<?php
									
									foreach($profile["details"]["participants"] as $participant) {
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
		 	
		 </div>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<button class="btn btn-primary edit-event-btn">Rediger</button>
			<?php 
				if( $profile["details"]["event"]->is_draft ) {
					?>
						<button class="btn btn-primary publish-event-btn" data-event="<?php echo $profile["details"]["event"]->id; ?> ">offentliggør</button>
					<?php
				} else {
					?>
						<button class="btn btn-primary unpublish-event-btn" data-event="<?php echo $profile["details"]["event"]->id; ?> ">Sæt til udkast</button>
						<a href="<?php echo get_home_url() ?>/events/?event_action=show&event_type=cooperation&slug=<?php echo $_GET["slug"] ?>" class="btn btn-primary">Se begivenhed</a>
					<?php
				}
			?>
			<a href="/manager-profile/?view=events" class="btn">Gå tilbage</a>
		</div>
	</div>
</div>

<div class="modal fade manager-modal" id="cooperationEventUpdateModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Opret Begivenhed</h4>
      </div>
      <div class="modal-body">
        <form action="#" method="post" class="manager-update-cooperation-event-form">
        	<input type="hidden" name="event" value="<?php echo $collection["event"]->id; ?>">

        	<div class="form-group">
        		<h5 class="label">Title</h5>
        		<input type="text" name="event_title" value="<?php echo $collection["event"]->title ?>">
        	</div>

        	<div class="form-group">
        		<h5 class="label">description</h5>
        		<textarea name="event_description" cols="30" rows="5"><?php echo $collection["event"]->description ?></textarea>
        	</div>

        	<div class="form-group">
        		<h5 class="label">Vælg spil</h5>
        		<select name="event_game">
        			<option value="<?php echo $collection["game"]->id ?>">
        				<?php echo $collection["game"]->name ?>
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

        	<div class="form-group">
        		<div class="col-md-6">
        			<h5 class="label">Start dato</h5>
        			<input type="date" name="startdate" class="form-control" value="<?php echo date('Y-m-d', $collection["event"]->event_date) ?>">
        		</div>

        		<div class="col-md-6">
        			<h5 class="label">Start dato</h5>
        			<input type="time" name="starttime" class="starttime form-control" value="<?php echo date('H:m', $collection["event"]->start_time) ?>">
        		</div>
        	</div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default button-danger" data-dismiss="modal">Luk</button>
        <button type="button" class="btn btn-primary update-event-btn button-success">Opdater</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->