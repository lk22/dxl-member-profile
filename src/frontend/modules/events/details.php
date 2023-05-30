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
				<div class="col-12 col-lg-6">
					<h3 class="heading"><?php echo strtoupper($profile["details"]["event"]["item"]->title); ?></h3>
					<p class="lead me-4 mb-0">
						<?php 
							if($profile["details"]["event"]["item"]->is_draft) {
								?> <small class="text-success fw-normal">Dette event er ikke offentligjort</small> <?php
							} else {
								?> <small class="text-success fw-normal">Dette event er offentliggjort</small> <?php
							}
						?>
					</p>
				</div>
				<div class="col-12 col-lg-6 d-flex align-items-start align-items-lg-center justify-content-end">
					
					
					<a href="<?php echo get_home_url() ?>/manager-profile/?module=events" class="dxl-btn me-2">Gå tilbage</a>
					<div class="event-actions">
						<div class="dropdown">
							<button 
								class="dxl-btn"
								data-bs-toggle="dropdown"
								aria-expanded="false"
							>
								<span>Vælg handling</span>
								<i class="fa-solid fa-ellipsis-vertical"></i>
							</button>
							<ul class="dropdown-menu"> 
								<li>
									<span 
										data-bs-toggle="modal" 
										data-bs-target="#cooperationEventUpdateModal" 
										class="edit-event-btn dropdown-item"
									>
										Rediger
									</span>
								</li>
									<?php 
										if( $profile["details"]["event"]["item"]->is_draft ) {
											?>
												<li>
													<span 
														class="dropdown-item publish-unpublish-event-btn"
														data-event="<?php echo $profile["details"]["event"]["item"]->id?>"
														data-event-type="cooperation"
														data-action="publish"
													>
														Offentliggør
													</span>
												</li>
											<?php
										} else {
											?>
												<li>
													<span 
														class="dropdown-item publish-unpublish-event-btn"
														data-event="<?php echo $profile["details"]["event"]["item"]->id?>"
														data-event-type="cooperation"
														data-action="unpublish"
														>
														Sæt til udkast
													</span>
												</li>
												<li>
													<a href="<?php echo get_home_url() ?>/events/?event_action=show&event_type=cooperation&slug=<?php echo $_GET["slug"] ?>" class="dropdown-item">Se begivenhed</a>
												</li>
											<?php
										}
										?>
								<li>
									<span 
										class="dropdown-item delete-event-button ms-2" 
										data-event="<?php echo $profile["details"]["event"]["item"]->id ?>"
										data-type="cooperation"
									>Fjern event</span>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div> <!-- Event detail header end -->
		<div class="row p-3 d-flex gap-3">
			<div class="col-4 overview-container bg-gray p-4">
				<div class="row event-type-row mb-2">
					<div class="col-12 col-sm-6 col-md-3">
						<p class="mb-0 fw-bold">Event type</p>
					</div>
					<div class="col-12 col-sm-6">
						<p class="mb-0">Hygge begivenhed</p>
					</div>
				</div>
				<div class="row event-start-date mb-2">
					<div class="col-12 col-sm-6 col-md-3">
						<p class="mb-0 fw-bold">Start dato: </p>
					</div>
					<div class="col-12 col-sm-6">
						<p class="mb-0">
							<?php echo date('d-m-Y', $profile["details"]["event"]["item"]->event_date) ?>
						</p>
					</div>
				</div>
				<div class="row event-start-time mb-2">
					<div class="col-12 col-sm-6 col-md-3">
						<p class="mb-0 fw-bold">Start tidspunkt: </p>
					</div>
					<div class="col-12 col-sm-6">
						<p class="mb-0">
							<?php echo date('H:i', $profile["details"]["event"]["item"]->start_time) ?>
						</p>
					</div>
				</div>
				<div class="row event-game">
					<div class="col-12 col-sm-6 col-md-3">
						<p class="mb-0 fw-bold">Tilknyttet spil: </p>
					</div>
					<div class="col-12 col-sm-6">
						<p class="mb-0">
							<?php echo $profile["details"]["event"]["game"]->name ?>
						</p>
					</div>
				</div>
			</div>
			<div class="col-4 overview-container bg-gray p-4">
				<h5 class="fw-bold">Beskrivelse:</h5>
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
		 <div class="col-12 participants-container">
			 <h4>Deltagerliste</h4>
		 	<?php
			 	if( $profile["details"]["event"]["participants"] ) {
					foreach($profile["details"]["event"]["participants"] as $participant) {
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
			 	} else {
			 		?>
						<div class="alert alert-info">Du har ingen tilmeldninger til denne begivenhed</div>
			 		<?php
			 	}
		 	 ?>	
		 	
		 </div> <!-- Participants list component end -->
	</div>
</div>

<!-- todo make modal a partial file to require -->
<?php 
	require_once DXL_PROFILE_MODULE_PATH . "/events/partials/event-update-cooperation-modal.php";
?>