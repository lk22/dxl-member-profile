<div class="modal modal-lg fade" backdrop="false" id="addNewGameModal" tabindex="-1" aria-labelledby="addNewGameModal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header"><h3>Tilknyt spil titel</h3></div>
      <div class="modal-body p-4">
        <div class="row create-game-form">
          <form action="#" method="POST" class="dxl-app-add-game-form needs-validation" novalidate>
              <div class="form-group game-title-field">
                <input type="text" name="game_name" placeholder="Indtast spillets titel her" class="form-control" required>
              </div>
          </form>
        </div>
        <div class="row loading" style="display:none;">
          <div class="col-12 text-center">
            <div class="spinner-border text-primary" role="status"></div>
            <h4>Opretter spil</h4>
          </div>
        </div>
        <button type="button" class="dxl-btn" data-bs-dismiss="modal">Luk</button>
        <button type="button" class="dxl-btn add-game-btn">Gem oplysninger</button>
      </div>
    </div>
  </div>
</div>