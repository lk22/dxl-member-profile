<div class="inner">
	<h3>Rediger profil</h3>
	<form action="#" method="POST" id="update_profile_settings_form">
		<input type="hidden" name="member" value="<?php echo $profile["member"]->id ?>">
		<input type="hidden" name="action" value="<?php echo $profile["action"] ?>">
		<div class="container">
		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-5">
			<div class="form-group name">
				<label>Fulde navn: </label>
				<input type="text" name="member-name" value="<?php echo $profile["member"]->name ?>">
			</div>
			<div class="form-group gamertag">
				<label>Gamertag: </label>
				<input type="text" name="member-gamertag" value="<?php echo $profile["member"]->gamertag ?>">
			</div>
			<div class="form-group gender">
				<label>Køn:</label>
				<select name="member-gender" style="width: 100%">
					<option value="<?php echo $profile["member"]->gender ?>"><?php echo $profile["member"]->gender; ?></option>
					<option value="mand">Mand</option>
					<option value="kvinde">Kvinde</option>
				</select>
			</div>
			<div class="form-group birthyear">
				<label>Fødselsdato:</label>
				<input type="date" name="member-birthyear" value="<?php echo $profile["member"]->birthyear ?>">
			</div>
			<div class="form-group email">
				<label>E-mail: </label>	
				<input type="text" name="member-email" value="<?php echo $profile["member"]->email ?>">
			</div>
			<div class="form-group phone">
				<label>Telefon:</label>
				<input type="text" name="member-phone" value="<?php echo $profile["member"]->phone ?>">
			</div>
			
		</div>
		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-5 col-lg-offset-1">
			
			<div class="form-group municipality">
				<label>Komunne:</label>
				<input type="text" name="member-municipality" value="<?php echo $profile["member"]->municipality ?>">
			</div>
			<div class="form-group address">
				<label>Adresse:</label>
				<input type="text" name="member-address" value="<?php echo $profile["member"]->address ?>">
			</div>
			<div class="form-group address">
				<label>Bynavn:</label>
				<input type="text" name="member-city" value="<?php echo $profile["member"]->city ?>">
			</div>
			<div class="form-group address">
				<label>Postnummer:</label>
				<input type="text" name="member-zipcode" value="<?php echo $profile["member"]->zipcode ?>">
			</div>
			
			<div class="form-group memberships">
				<label">Vælg Medlemsskab:</label>
				<select name="member-memberships" style="width: 100%">
					<?php 
						echo "<option value='" . $profile["currentMembership"]->id . "'>" . $profile["currentMembership"]->name . "</option>";
						foreach($profile["memberships"] as $membership) 
						{
							if( $membership->id != $profile["currentMembership"]->id ) {
								// echo "<option value='" . $profile["currentMembership"]->id . "'>" . $profile["currentMembership"]->name . "</option>";
								echo "<option value='" . $membership->id . "'>" . $membership->name . "</option>";
							}
						}
					?>
				</select>
			</div>
			
		</div>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class="form-group recurring-membership-choice">
				<h6>Ønsker du auto fornyelse af medlemsskab?</h6> 
				<label>Ja</label> 
				<input   
					type="radio"
					name="member-membership-recurring"
					value="1"
					<?php echo ($profile["member"]->auto_renew == 1) ? "checked='checked'" : ""?>"
				>
				<label>Nej</label>
				<input 
					type="radio"  
					name="member-membership-recurring" 
					value="0"
					<?php echo ($profile["member"]->auto_renew == 0) ? "checked='checked'" : ""?>"
				>
			</div>
			<div class="form-group">
				<h6>Ønsker du at omdirigere til din profil ved login?</h6>
				<label>Ja</label>
				<input type="radio" name="redirect_to_manager" <?php echo ($profile["settings"]->redirect_to_manager == 1) ? "checked='checked'" : "" ?> value="1">
				<label>Nej</label>
				<input type="radio" name="redirect_to_manager" <?php echo ($profile["settings"]->redirect_to_manager == 0) ? "checked='checked'" : "" ?> value="0">
			</div>
		</div>
		</div>
		<div class="form-group">
			<input type="submit" value="Gem instillinger" class="btn submit-settings-form-btn">
		</div>
	</form>
</div>