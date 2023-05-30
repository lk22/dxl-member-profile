<?php 
	/**
	 * Profile manager list partial
	 */
 ?>
 <div class="events-heading row bg-white rounded p-4">
	<div class="col-7">
		<h3>Dine begivenhder <span><button data-bs-toggle="modal" data-bs-target="#createEventModal" class="dxl-btn create-cooperation-event-btn">Opret begivenhed</button></span></h3>
	</div>
	<div class="col-5 d-flex align-items-center justify-content-end">
		<?php 
			if ( $profile["count"] == 1 ) {
				echo "Du har " . $profile["count"] . " begivenehed";
			} else {
				echo "Du har " . $profile["count"] . " begivenheder";
			}
		?>
	</div>
 </div>

 <div class="event-list-container">
 	<div class="col-md-12 events-container">
		<div class="row events-list gap-4 mx-0 my-4">
			<?php 
				if( $profile["events"] ) {
					foreach ( $profile["events"] as $event ) {
						?>
							<div class="col-12 mb-3 event border-bottom pb-2 <?php if ( $event->is_draft ) { echo "border-danger"; } else {
								echo "border-success";
							} ?>">
								<div class="row w-100 align-items-center relative">
									<div class="event-title col-12 col-sm-6 col-md-2">
										<span><strong><?php echo $event->title ?? $event->name ?></strong></span>
									</div>
									<div class="event-startdate col-12 col-sm-6 col-md-2">
										<?php echo date('d-m-Y', $event->start_date ?? $event->event_date) ?> <?php echo date("H:i", $event->start_time ?? $event->starttime) ?>
									</div>
									<div class="event-participants col-12 col-sm-6 col-md-2">
										<?php echo $event->participants_count ?> deltagere
									</div>
									<div class="event-type col-12 col-sm-6 col-md-2">
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
									<div class="event-status col-12 col-sm-6 col-md-2">
										<?php 
											if ( $event->is_draft ) {
												?>
													<small class="p-2 rounded-full rounded bg-white text-danger fw-bold">Ikke offentliggjort</small>
												<?php
											} else {
												?>
													<small class="p-2 rounded-full rounded bg-white text-success fw-bold">Offentligjort</small>
												<?php
											}
										?>
									</div>
									<div class="event-actions col-12 col-sm-6 col-md-12 text-end">
										<div class="dropwdown">
											<button class="dxl-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
												<i class="fa-light fa-ellipsis-vertical"></i>
											</button>
											<ul class="dropdown-menu">
												<li><span class="dropdown-item">
													<?php 
														$link = $_SERVER["REQUEST_URI"] . "&action=details&slug={$event->slug}";
														if ( isset( $type ) ) $link .= "&type={$type}";
														echo "<a href='{$link}'>Vis begivenhed</a>";
													?>
												</span></li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						<?php
					}
				} else {
					?>
						<div class="not-found-events p-5">
							<div class="row">
								<div class="col-5">
									<img src="<?php echo DXL_PROFILE_ASSETS_PATH ."/images/dunno.png" ?>" alt="">
								</div>
								<div class="col-7">
									<p class="lead fw-bold">
										Du har ingen begivenheder registreret,
										Klik på “Opret begivenhed” knappen nedenfor
									</p>
								</div>
							</div>
						</div>
					<?php
				}
			?>
	 </div>
 	</div>
 	
 </div>

<?php require_once DXL_PROFILE_MODULE_PATH . "/events/partials/create-event-modal.php"; ?>