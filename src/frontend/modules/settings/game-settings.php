<?php 
    if( $profile["settings"]["games"] ){
        ?>
            <h3>Se dine nuværende mest aktive spil</h3>
            <p>Disse spil vil du kunne bruge til at vise andre hvad du spiller og til dine begivenheder</p>
            
            <table class="widelist">
                <thead>
                    <th>Spil</th>
                    <th>Spil modes</th>
                </thead>
                <tbody>
                    <?php
                        foreach($profile["settings"]["games"] as $game) {
                            ?>
                                <tr>
                                    <td><b><?php echo $game->name; ?></b></td>
                                    <td>
                                        <span class="label label-success"><?php echo $game->gamemodes ?></span>
                                    </td>
                                    <td><button class="btn btn-danger button-danger delete-profile-game" data-game="<?php echo $game->id; ?>">Slet</button></td>
                                </tr>
                            <?php
                        }
                    ?>
                </tbody>
            </table>
        <?php
    } else {
        ?>
            <div class="alert alert-danger">Du har ingen spil tilknyttet, tryk på knappen nedenfor for at tilføje dine mest aktive spil</div>
        <?php
    }
?>
<button data-bs-toggle="modal" data-bs-target="#dxlAddProfileGameModal" class="btn btn-success add-profile-game">Opret spil</button>

<div class="modal modal-xl fade manager-modal" id="dxlAddProfileGameModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tilføj spil</h4>
      </div>
      <div class="modal-body">
        <form action="#" method="post" class="dxl-profile-add-game-form">
            <input type="hidden" name="member_id" value="<?php echo $profile["member"]->id; ?>">
			<div class="form-group">
                <label for="game_name">
                    Indtast spil navn <span style="color: red">*</span>
                </label>
				<input type="text" name="game_name" required>
			</div>

            <div class="form-group gamemode_field">
                <label for="game_mode_name">
                    Indtast spil mode <small style="color: green;">efter feltet tomt hvis du ikke ønsker at definere en spil type</small>
                </label>
                <div class="gamemodes">
                    <input type="text" name="game_mode_name" required>
                </div>
                
			</div>
		</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary submit-add-profile-game">Tilføj spil</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->