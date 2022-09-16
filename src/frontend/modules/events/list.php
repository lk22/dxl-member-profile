<?php 
	/**
	 * Profile manager list partial
	 */
 ?>
 <div class="events-heading">
 	<h3 class="heading">Begivenheder (<?php echo $collection["count"]; ?>)</h3>
 </div>

 <div class="event-list-container">
 	<div class="col-md-12 events-container">
 	<?php 
 		if( $collection["events"] ){
 			?>
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
			 				foreach ($collection["events"] as $item) {
			 					$is_draft = $item->is_draft;

			 					if( $is_draft == 1 ) {
			 						$draft = "Ja";
			 					} else {
			 						$draft = "Offentligjort";
			 					}

			 					?>
									<tr class="event-list-item" data-event="<?php echo $item->id ?>">
										<td>
											<a href="<?php echo $_SERVER["REQUEST_URI"] . "&action=show&slug={$item->slug}" ?>">
												<?php echo $item->title ?>
											</a>
										</td>
										<td><?php echo $item->participants_count; ?></td>
										<td><?php echo date('d-m-Y', $item->event_date); ?></td>
										<td class="hidden-xs hidden-sm"><?php echo date('H:i', $item->start_time); ?></td>
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
						<div class="heading">Du har desværre ingen begivenheder oprettet</div>
						<div class="sub-heading">Tryk på knappen nedenunder for at oprette en begivenhed</div>
					</div>
				</div>
 			<?php
 		}
 	 ?>
 	</div>
 	<button class="btn btn-primary create-cooperation-event-btn">Ny begivenhed</button>
 </div>


<div class="modal fade manager-modal" id="cooperationEventCreateModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Opret Begivenhed</h4>
      </div>
      <div class="modal-body">
        <form action="#" method="POST" class="create-cooperation-event-modal-form">
        	<div class="form-group">
        		<h4 class="label">Titel:</h4>
        		<input type="text" class="form-control" name="event_title" required>
        	</div>

          <div class="form-group">
            <h4 class="label">Beskrivelse:</h4>
            <textarea name="event_description" id="event_description" cols="30" rows="3"></textarea>
          </div>
		<div class="form-group">
          	<h4 class="label">Vælg spil</h4>
          	<select name="game" id="games">
          		<?php 
          			foreach($collection["games"] as $game) {
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
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary create-event-btn">Gå videre</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->