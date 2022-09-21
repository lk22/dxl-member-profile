<div id="profile-layout-main" class="container-fluid">
    <div class="row">
        <div class="col-md-2 sidebar">
            <?php require DXL_PROFILE_PARTIALS_PATH . '/sidebar.php'; ?>
        </div>
        <div class="col-md-9 ms-4 layout-content">
            <?php 
                if ( isset($_GET["module"]) ) {
                    require DXL_PROFILE_VIEW_PATH . "/" . $profile["view"] . ".php";
                } else {
                    require DXL_PROFILE_VIEW_PATH . "/" . "main.php";
                }
            ?>
        </div>
    </div>
</div>