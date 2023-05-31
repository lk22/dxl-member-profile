<div class="modal modal-md fade" backdrop="false" id="addNewGameModal" tabindex="-1" aria-labelledby="addNewGameModal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3>Tilknyt spil titel</h3>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <i class="fa-solid fa-times"></i>
        </button>
      </div>
      <div class="modal-body p-4">
        <div class="row create-game-form">
          <p>Når du tilføjer et nyt spil til listen, kan du oprette begivenheder med tilknytning til spillet </p>
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