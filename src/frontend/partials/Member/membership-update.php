<form action="#" class="update-membership-form">
    <div class="form-group membership-selector mb-3">
        <label>Vælg Medlemsskab:</label>
        <select name="membership" style="width: 100%">
            <?php 
                echo "<option value='" . $profile["currentMembership"]->id . "'>" . $profile["currentMembership"]->name . "</option>";
                foreach($profile["memberships"] as $membership) 
                {
                    echo "<option value='" . $membership->id . "'>" . $membership->name . "</option>";
                }
            ?>
        </select>
    </div>
    <div class="form-group auto-renewal-field">
        <h6>Ønsker du auto fornyelse af medlemsskab?</h6> 
        <?php 
            if ( $profile["member"]->auto_renew == 0) {
                ?>
                    <small>Du har i æjeblikket ikke auto fornyelse slået til, du vil ikke få en faktura ved enden af dit medlemsskab</small>
                <?php
            }
        ?>
        <label>Ja</label> 
        <input   
            type="radio"
            name="auto_renew"
            value="1"
            <?php echo ($profile["member"]->auto_renew == 1) ? "checked='checked'" : ""?>"
        >
        <label>Nej</label>
        <input 
            type="radio"  
            name="auto_renew" 
            value="0"
            <?php echo ($profile["member"]->auto_renew == 0) ? "checked='checked'" : ""?>"
        >
    </div>
    <div class="form-group submit">
        <button type="button" class="dxl-btn update-membership-btn">Gem medlemsskab</button>
    </div>
</form>