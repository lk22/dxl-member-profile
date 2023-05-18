<div class="modal modal-lg fade manager-modal" id="createEventModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Opret Begivenhed</h4>
      </div>
      <div class="modal-body">
        <?php 
            require_once DXL_PROFILE_MODULE_PATH . "/events/partials/create-event-type-selector.php";
            require_once DXL_PROFILE_MODULE_PATH . "/events/partials/create-event-training-form.php";
            require_once DXL_PROFILE_MODULE_PATH . "/events/partials/create-event-cooperation-form.php";
        ?>
      </div>
      <div class="modal-footer" style="display:none">
        <button type="button" class="btn btn-primary create-event-btn w-100">Opret</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->