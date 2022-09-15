<div id="profile-layout-main" class="container-fluid">
    <div class="row">
        <div class="col-md-3 sidebar">
            <?php require DXL_PROFILE_PARTIALS_PATH . '/sidebar.php'; ?>
        </div>
        <div class="col-md-9">
            <?php require DXL_PROFILE_VIEW_PATH . "/" . $profile["view"] . ".php"; ?>
        </div>
    </div>
</div>