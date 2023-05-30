
<div class="modal modal-lg fade manager-modal" id="cooperationEventUpdateModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Rediger <?php echo $profile["details"]["event"]["item"]->title; ?></h4>
      </div>
      <div class="modal-body">
        <form action="#" method="post" class="update-cooperation-event-form">
        	<input type="hidden" name="event" value="<?php echo $profile["details"]["event"]["item"]->id; ?>">

            <div class="row">
                <div class="form-group mb-4">
                    <h5 class="label">Title</h5>
                    <input type="text" name="title" value="<?php echo $profile["details"]["event"]["item"]->title ?>">
                </div>
            </div>

            <div class="row">
                <div class="form-group mb-4">
                    <h5 class="label">Vælg spil</h5>
                    <select name="game">
                        <option value="<?php echo $profile["details"]["event"]["game"]->id ?>">
                            <?php echo $profile["details"]["event"]["game"]->name ?>
                        </option>
                        <?php 
                            foreach($profile["details"]["games"] as $game) {
                                ?>
                                    <option value="<?php echo $game->id ?>">
                                        <?php echo $game->name ?>
                                    </option>
                                <?php
                            }
                         ?>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="form-group mb-4">
                    <h5 class="label">description</h5>
                    <textarea name="description" cols="30" rows="5"><?php echo $profile["details"]["event"]["item"]->description ?></textarea>
                </div>
            </div>


            <div class="row">
                <div class="form-group col-6">
                    <h5 class="label">Start dato</h5>
        			<input type="date" name="event_date" class="form-control" value="<?php echo date('Y-m-d', $profile["details"]["event"]["item"]->event_date) ?>">
                </div>
                <div class="form-group col-6">
                    <h5 class="label">Start tidspunkt</h5>
        			<input type="time" name="start_time" class="starttime form-control" value="<?php echo date('H:m', $profile["details"]["event"]["item"]->start_time) ?>">
                </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="dxl-btn button-danger" data-bs-dismiss="modal">Luk</button>
        <button type="button" class="dxl-btn update-event-btn button-success">Opdater</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->