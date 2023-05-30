<div class="row event-show-information-container">
	<div class="inner">
		<div class="col-md-12 event-detail-header p-4">
			<div class="row">
				<div class="col-md-7">
					<h3 class="heading"><?php echo $profile["details"]["event"]->name; ?></h3>
					<p class="text-sm mb-0">
						<?php 
							if($profile["details"]["event"]->is_draft) {
								?> <small class="text-success fw-normal">Dette event er ikke offentligjort</small> <?php
							} else {
								?> <small class="text-success fw-normal">Dette event er offentliggjort</small> <?php
							}
						 ?>
					</p>
				</div>
				<div class="col-md-5 d-flex align-items-center justify-content-start justify-content-md-end gap-4">
					<a class="dxl-btn" href="<?php echo get_home_url() ?>/manager-profile/?module=events" class="dxl-btn">Gå tilbage</a>
					<div class="dropdown"> 
						<button class="dxl-btn" data-bs-toggle="dropdown" aria-expanded="false">
							<span>Vælg handling</span>
							<i class="fa-solid fa-ellipsis-vertical"></i>
						</button>
						<ul class="dropdown-menu">
							<li>
								<span data-bs-toggle="modal" data-bs-target="#trainingEventUpdateModal" class="dropdown-item">Rediger event</span>
							</li>
							<li>
								<span
									class="dropdown-item delete-event-button" 
									data-event="<?php echo $profile["details"]["event"]->id ?>"
									data-type="training"
								>
									Fjern event 
								</span>
							</li>
								<?php 
									if( $profile["details"]["event"]->is_draft ) {
										?>
											<li>
												<span 
													class="dropdown-item publish-unpublish-event-btn" 
													data-event="<?php echo $profile["details"]["event"]->id ?> "
													data-event-type="training"
													data-action="publish"
												>
													offentliggør
												</span>
											</li>
										<?php
									} else {
										?>
											<li>
												<span 
													class="dropdown-item publish-unpublish-event-btn" 
													data-event="<?php echo $profile["details"]["event"]->id; ?> "
													data-event-type="training"
													data-action="unpublish"
												>
													Sæt til udkast
												</span>
											</li>
											<li>
												<a href="<?php echo get_home_url() ?>/events/?action=details&type=training&event=<?php echo $_GET["slug"] ?>" class="dropdown-item">Se begivenhed</a>
											</li>
										
										<?php
									}
								?>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>

		<div class="row gap-3 px-4">
			<div class="col-5 overview-container bg-gray">
				<div class="row event-type">
					<div class="col-6">
						<p class="fw-bold">Event type:</p>
					</div>
					<div class="col-6">
						<p class="time">
							<?php 
							// echo capitalized first letter
								echo ucfirst($_GET["type"]);
							?>
						</p>
					</div>
				</div>
				<div class="row event-start-date">
					<div class="col-6">
						<p class="fw-bold">Start dato:</p>
					</div>
					<div class="col-6">
						<p class="time">
							<?php 
								echo date('d-m-Y', $profile["details"]["event"]->start_date)
							?>
						</p>
					</div>
				</div>
				<div class="row event-time">
					<div class="col-6">
						<p class="fw-bold">Start tidspunkt</p>
					</div>
					<div class="col-6">
						<p class="time"><?php echo date('H:i', $profile["details"]["event"]->starttime) ?></p>
					</div>
				</div>
				<div class="row event-end-time">
					<div class="col-6">
						<p class="fw-bold">Slut tidspunkt</p>
					</div>
					<div class="col-6">
						<p>
							<?php echo date('H:i', $profile["details"]["event"]->endtime) ?>
						</p>
					</div>
				</div>
				<?php 
					if ( $profile["details"]["game"]->name ) {
						?>
							<div class="row event-game">
								<div class="col-6">
									<p class="fw-bold">Valgt spil: </p>
								</div>
								<div class="col-6">
									<p><?php echo $profile["details"]["game"]->name ?></p>
								</div>
							</div>
						<?php
					}

					if ( $profile["details"]["event"]->event_day ) {
						?>
							<div class="row event-day">
								<div class="col-6">
									<p class="fw-bold">Trænings dag: </p>
								</div>
								<div class="col-6">
									<p>
										<b>
											<?php 
												if ( $profile["details"]["event"]->is_recurring ) {
													echo "Fast dag: hver " . $profile["details"]["event"]->event_day . "";
												} else {
													echo $profile["details"]["event"]->event_day;
												}
											?>
										</b>
									</p>
								</div>
							</div>
						<?php
					}
				?>
			</div>
			<div class="col-5 overview-container bg-gray">
				<?php 
					if( $profile["details"]["event"]->description ){
						?>
							<div class="col-md-12 mb-4 event-information-description">
								<h5 class="fw-bold">Beskrivelse:</h5>
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
		</div>

		<div class="row p-4">
	
		</div>

		<div class="col-md-12 participants-container">
			
			<?php
				if( $profile["details"]["participants"] > 0 ) {	
					?>
						<h5>Deltagere liste</h5>

						<?php 
							foreach	($profile["details"]["participants"] as $participant) {
								?>
									<div class="row participant bg-gray p-3 mb-3 mx-1 rounded roundex-xl">
										<div class="col-6 participant-name">
											<?php echo $participant->name; ?>
										</div>
										<div class="col-6">
											<?php echo $participant->gamertag; ?>
										</div>
									</div>
								<?php
							}
						?>
					<?php 
				} else {
					?>
						<div class="alert alert-info">Du har ingen tilmeldinger på denne begivenhed</div>
					<?php 
				}
			?>
		</div>
		 
	</div>
</div>

<?php 
	require_once DXL_PROFILE_MODULE_PATH . "/events/partials/event-update-training-modal.php";
?>