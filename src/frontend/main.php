
<div class="profile animate fadeUp">
	<div class="profile-information">
		<div class="info-row container-fluid">
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
				<div class="col-12 col-lg-6 overview-container membership-overview bg-gray">
					<div class="row membership-heading p-3">
						<div class="col-12 col-md-8">
							<h3>Medlemsskabs information</h3>
						</div>
						<div class="col-12 col-md-4 d-flex justify-content-end">
							<p class="text-sm float-right">
								<?php echo $profile["profileMembership"]->length; ?> måneder
							</p>
						</div>
					</div>
					<div class="row membership-fields p-3">
						<p class="label label-success">
							<?php 
								echo $profile["renewalDate"];
							?>
						</p>
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
						<?php 
							if ( !$profile["profileSettings"]->is_trainer && !$profile["profileSettings"]->trainer_permissions_requested ) {
								?>
									<button class="btn brn-primary aquire-trainer-permissions-btn" data-member="<?php echo $profile["member"]->id ?>">Ønsker du er at være træner?</button>
								<?php
							}
						?>
						<?php 
							
							if ( !$profile["profileSettings"]->is_tournament_author && !$profile["profileSettings"]->tournament_permissions_requested ) {
								?>
									<button class="btn btn-primary aquire-tournament-permissions-btn" data-member="<?php echo $profile->id ?>">Ønsker du er at være turnerings ansvarlig?</button>
								<?php
							}
							
						?>
					
					</div>
					
				</div>
				<div class="col-12 col-lg-6 overview-container latest-event-overview bg-gray">
					<div class="p-3">
						<h3>Seneste Begivenheder</h3>
						<p>Du har deltaget i <?php echo $profile["participatedCount"]; ?> LAN begivenheder</p>
					</div>
				</div>

				<div class="full-width overview-container isLanParticipant bg-gray">
				<?php 
						if( $profile["lan"] ) {
							?>
								<div class="alert <?php echo ($profile["lan"]["participant"]) ? 'alert-success' : 'alert-info' ?> d-flex justify-content-center flex-column align-items-start">
									<?php 
										if( $profile["lan"]["participant"] ) {
											?>
												<p class="mb-0">Du er tilmeldt <?php echo $profile["lan"]["event"]->title ?></p>
											<?php
										} else {
											?>
												<p class="text-danger">Du er ikke tilmeldt <?php echo $profile["lan"]["event"]->title ?></p>
												<a href="/events/?action=details&type=lan&event=<?php echo $profile["lan"]["event"]->slug ?>">Tilmeld dig <?php echo $profile["lan"]["event"]->title ?></a>
											<?php
										}
									?>
								</div>
							<?php
						}
					?>
				</div>
			</div>
                <?php //include DXL_PROFILE_PARTIALS_PATH . "profile-invitations.php"; ?>
			</div>
		</div>
	</div>
</div>