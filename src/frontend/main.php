

<div class="profile animate fadeUp">
	<div class="profile-information">
		<div class="info-row container-fluid p-4">
			<div class="row gap-3">
				<div class="col-12">
					<div class="row d-flex align-items-center py-4">
						<div class="col-12 col-sm-8 col-md-8">
							<h1 class="mb-0">Hej <?php echo $profile["member"]->name ?> <small class="text-success">(<?php echo $profile["member"]->gamertag ?>)</small></h1>
						</div>
						<div class="col-12 col-sm-4 col-md-4 d-flex justify-content-sm-end justify-content-start">
							<a href="<?php echo $manager_url . "/?module=update" ?>" class="dxl-btn">Rediger profil</a>
						</div>
					</div>
				</div>
				<?php 
					if (strtotime($profile['expireDate']) <= 30 * 24 * 60 * 60) {
						?>
							<div class="col-12">
								<div class="alert alert-danger">
									<h3 class="mb-0"><strong>Dit medlemsskab udløber snart</strong></h3>
								</div>
							</div>
						<?php
					}
					if ( ! $profile['member']->auto_renew ) {
						?>
							<div class="col-12">
								<div class="alert alert-danger">
									<h3>Dit medlemsskab fornyes ikke automatisk</h3>
								</div>
							</div>
						<?php
					}
				?>
				<?php 
					if( $profile["lan"] ) {
						?>
							<div class="isLanParticipant">
								<div class="alert <?php echo ($profile["lan"]["participant"]) ? 'alert-success' : 'alert-danger' ?> d-flex justify-content-center flex-column align-items-start">
									<?php 
										if( $profile["lan"]["participant"] ) {
											?>
												<p class="mb-0">Du er tilmeldt <?php echo $profile["lan"]["event"]->title ?></p>
											<?php
										} else {
											?>
												<h4 class="text-danger text-lg">Du er ikke tilmeldt <?php echo $profile["lan"]["event"]->title ?></h4>
												<a href="/events/?action=details&type=lan&event=<?php echo $profile["lan"]["event"]->slug ?>">Tilmeld dig her</a>
											<?php
										}
									?>
								</div>
							</div>
						<?php
					}
				?>
				<div class="col-12 overview-container mb-4 bg-gray">
					<div class="row overview-header">
						<div class="col-12">
							<h3>Dine medlemsoplysninger</h3>
						</div>
					</div>
					<div class="row overview-body">
						<div class="col-12">
							<p class="label label-success">
								<?php 
									echo $profile["renewalDate"];
								?>
							</p>
						</div>
						<div class="col-12">
							<div class="row">
								<div class="col-4">
									<p class="text-bold">
										Auto fornyelse: 
									</p>
								</div>
								<div class="col-3">
									<span class="badge badge-<?php echo ($profile["member"]->auto_renew) ? "success" : "danger" ?>">
										<?php echo ($profile["member"]->auto_renew) ? "Ja" : "Nej"; ?>
									</span>
								</div>
							</div>
							<div class="row">
								<div class="col-4">
									<p class="text-bold">
										Træner rettigheder: 
									</p> 
								</div>
								<div class="col-3">
									<?php 
										if( $profile["profileSettings"]->trainer_permissions_requested ) {
											?>
												<span class="badge badge-primary">Afventer godkendelse</span>
											<?php 
										} else {
											?> 
												<span class="badge badge-<?php echo ($profile["profileSettings"]->is_trainer) ? "success": "danger" ?>"><?php echo ($profile["profileSettings"]->is_trainer) ? "Ja" : "Nej"  ?></span>
											<?php 
										}
									?>
								</div>
								<div class="row">
									<div class="col-4">
										<p class="text-bold">
											Turnerings ansvarlig:
										</p> 
									</div>
									<div class="col-3">
										<?php 
											if( $profile["profileSettings"]->tournament_permissions_requested ) {
												?>
													<span class="label label-primary">Afventer godkendelse</span>
												<?php
											} else {
												?>
													<span class="badge badge-<?php echo ($profile["profileSettings"]->is_tournament_author) ? "success": "danger" ?>"><?php echo ($profile["profileSettings"]->is_tournament_author	) ? "Ja" : "Nej"  ?></span>
												<?php
											}
										?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-12 col-lg-12 overview-container latest-event-overview">
					<div class="p-3">
						<h3>Seneste Begivenheder</h3>
						<p>Du har deltaget i <?php echo $profile["participatedCount"]; ?> LAN begivenheder</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="profile animate fadeUp">
	<div class="profile-information">
		<div class="info-row container-fluid">
			<div class="row gap-3">
				
			</div>
                <?php //include DXL_PROFILE_PARTIALS_PATH . "profile-invitations.php"; ?>
			</div>
		</div>
	</div>
</div>