
<div class="profile-main">
	<div class="profile-information">
		<div class="info-row container-fluid">
			<div class="col-12">
				<div class="row d-flex align-items-center py-4">
					<div class="col-10">
						<h1>Hej <?php echo $profile["member"]->name ?></h1>
					</div>
					<div class="col-2 d-flex justify-content-end">
						<a href="<?php echo $manager_url . "/?module=update" ?>" class="btn btn-success">Rediger profil</a>
					</div>
				</div>
			</div>
			<div class="col-12 membership-overview">
				<div class="row membership-heading">
					<div class="col-12 col-md-10">
						<h3>Medlemsskab</h3>
					</div>
					<div class="col-12 col-md-2">
						<p class="text-sm float-right">
							<?php echo $profile["profileMembership"]->length; ?> måneder
						</p>
					</div>
				</div>
				<div class="membership-fields mt-4">
					<p class="label label-success">
						<?php 
							echo $profile["renewalDate"];
						?>
					</p>
					<p class="text-bold">
						Auto fornyelse: 
						<span class="badge badge-<?php echo ($profile["member"]->auto_renew) ? "success" : "danger" ?>">
							<?php echo ($profile["member"]->auto_renew) ? "Aktiveret" : "Deaktiveret"; ?>
						</span>
					</p>
					<p class="text-bold">
						Træner rettigheder: 
						<?php 
							if( $profile["profileSettings"]->trainer_permissions_requested ) {
								?>
									<span class="badge badge-primary">Afventer godkendelse</span>
								<?php 
							} else {
								?> 
									<span class="badge badge-<?php echo ($profile["profileSettings"]->is_trainer) ? "success": "danger" ?>"><?php echo ($profile["profileSettings"]->is_trainer) ? "Aktiveret" : "Deaktiveret"  ?></span>
								<?php 
							}
						?>
						
					</p> 
					<p class="text-bold">
						Turnerings ansvarlig rettigheder:  

						<?php 
							if( $profile["profileSettings"]->tournament_permissions_requested ) {
								?>
									<span class="label label-primary">Afventer godkendelse</span>
								<?php
							} else {
								?>
									<span class="badge badge-<?php echo ($profile["profileSettings"]->is_tournament_author) ? "success": "danger" ?>"><?php echo ($profile["profileSettings"]->is_tournament_author	) ? "Aktiveret" : "Deaktiveret"  ?></span>
								<?php
							}
						?>
						
					</p> 
					<?php 
						if ( !$profile["profileSettings"]->is_trainer && !$profile["profileSettings"]->trainer_permissions_requested ) {
							?>
								<button class="btn brn-primary aquire-trainer-permissions-btn" data-member="<?php echo $profile["member"]->id ?>">Ønsker du er at være træner?</button>
							<?php
						}
					?>
					<?php 
						/*
						if ( !$profile_settings->is_tournament_author && !$profile_settings->tournament_permissions_requested ) {
							?>
								<button class="btn brn-primary aquire-tournament-permissions-btn" data-member="<?php echo $profile->id ?>">Ønsker du er at være turnerings ansvarlig?</button>
							<?php
						}
						*/
					?>
				
				</div>
				<?php 
					if( $profile["lan"] ) {
						?>
							<div class="alert <?php echo ($profile["lan"]["participant"]) ? 'alert-success' : 'alert-info' ?> d-flex align-items-center">
								<?php 
									if( $profile["lan"]["participant"] ) {
										?>
											<p class="mb-0">Du er tilmeldt <?php echo $profile["lan"]["event"]->title ?></p>
										<?php
									} else {
										?>
											<p class="text-white">Du er ikke tilmeldt <?php echo $profile["lan"]["event"]->title ?></p>
											<a href="/events/?event_action=show&event_type=lan&slug=<?php echo $profile["lan"]["event"]->slug ?>">Tilmeld dig <?php echo $profile["lan"]["event"]->name ?></a>
										<?php
									}
								?>
							</div>
						<?php
					}
				?>
			</div>
                <?php //include DXL_PROFILE_PARTIALS_PATH . "profile-invitations.php"; ?>
			</div>
		</div>
	</div>
</div>