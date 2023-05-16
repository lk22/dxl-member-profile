<?php 
	/**
	 * Update profile view
	 * @package DXL Member Profile
	 * @version 1.0.0
	 * @since 1.0.0
	 */
?>

<div class="container-fluid animate fadeUp">
	<div class="row updatem-membership-form mb-4 border-bottom py-4">
		<div class="col-4">
			<h3>Kontingent indstillinger</h3>
			<?php require_once DXL_PROFILE_PARTIALS_PATH . "/Member/membership-update.php"; ?>
		</div>
	</div>
	<div class="row update-member-info border-bottom pb-4">
		<div class="col-4">
			<h3>Medlems information</h3>
			<p>Tryk for at redigere dine medlems oplysninger</p>
			<button class="dxl-btn" data-bs-toggle="modal" data-bs-target="#updateMemberInformationModal">Rediger</button>
		</div>
	</div>
	<div class="row update-member-theme border-bottom py-4">
		<div class="col-12">
			<h3>Tema indstillinger</h3>
			<p>Personliggør dit dashboard med en valgfri farve</p>
			<?php require DXL_PROFILE_PARTIALS_PATH . "/Member/update-theme.php"; ?>
		</div>
	</div>
</div>

<?php require_once DXL_PROFILE_PARTIALS_PATH . "/Member/member-update.php"; ?>