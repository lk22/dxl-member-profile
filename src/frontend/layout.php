<div id="profile-layout-main" class="container-fluid">
    <div class="row">
        <div class="col-12 col-md-2 sidebar">
            <?php require DXL_PROFILE_PARTIALS_PATH . '/sidebar.php'; ?>
        </div>
        <div class="col-12 col-md-9 ms-md-4 p-md-5 rounded-md shadow-sm">
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