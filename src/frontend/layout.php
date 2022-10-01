<div id="profile-layout-main" class="container-fluid">
    <div class="row">
        <div class="col-12 col-lg-4 col-lg-3 col-xl-3 col-xxl-2 sidebar">
            <?php require DXL_PROFILE_PARTIALS_PATH . '/sidebar.php'; ?>
        </div>
        <div class="col-12 col-lg-8 rounded-md shadow-sm layout-content">
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