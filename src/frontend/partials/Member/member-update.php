<div class="modal modal-xl fade" backdrop="false" id="updateMemberInformationModal" tabindex="-1" aria-labelledby="updateMemberInformationModal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body p-4">
        <form action="#" method="POST" class="update_profile_settings_form">
            <input type="hidden" name="id" value="<?php echo $profile["member"]->id ?>">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-5 mb-2">
                        <div class="form-group name mb-2">
                            <label>Fulde navn: </label>
                            <input type="text" name="name" value="<?php echo $profile["member"]->name ?>">
                        </div>
                        <div class="form-group gamertag mb-2">
                            <label>Gamertag: </label>
                            <input type="text" name="gamertag" value="<?php echo $profile["member"]->gamertag ?>">
                        </div>
                        <div class="form-group gender mb-2">
                            <label>Køn:</label>
                            <select name="gender" style="width: 100%">
                                <option value="<?php echo $profile["member"]->gender ?>"><?php echo $profile["member"]->gender; ?></option>
                                <option value="mand">Mand</option>
                                <option value="kvinde">Kvinde</option>
                            </select>
                        </div>
                        <div class="form-group email mb-2">
                            <label>E-mail: </label>	
                            <input type="text" name="email" value="<?php echo $profile["member"]->email ?>">
                        </div>
                        <div class="form-group phone mb-2">
                            <label>Telefon:</label>
                            <input type="text" name="phone" value="<?php echo $profile["member"]->phone ?>">
                        </div>
                        <div class="form-group birthyear mb-2">
                            <label>Fødselsdato:</label>
                            <input type="date" name="birthyear" value="<?php echo $profile["member"]->birthyear ?>">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-5 col-lg-offset-1">
                        <div class="form-group municipality mb-2">
                            <label>Komunne:</label>
                            <input type="text" name="municipality" value="<?php echo $profile["member"]->municipality ?>">
                        </div>
                        <div class="form-group address mb-2">
                            <label>Adresse:</label>
                            <input type="text" name="address" value="<?php echo $profile["member"]->address ?>">
                        </div>
                        <div class="form-group address mb-2">
                            <label>Bynavn:</label>
                            <input type="text" name="city" value="<?php echo $profile["member"]->city ?>">
                        </div>
                        <div class="form-group address mb-2">
                            <label>Postnummer:</label>
                            <input type="text" name="zipcode" value="<?php echo $profile["member"]->zipcode ?>">
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <button type="button" class="dxl-btn update-member-btn">Gem oplysninger</button>
      </div>
    </div>
  </div>
</div>