<div id="profile-layout-main" class="container-fluid  <?php if ( $profile["view"] == "not-activated" ) { echo "not-activated";} ?>">
    <div class="row">

        <?php
        
            if( $profile["view"] == "not-activated" ) {
                require DXL_PROFILE_VIEW_PATH . "/" . $profile["view"] . ".php";
            } else {
                ?>
                    <div class="col-12 col-lg-2 col-xl-1 col-xxl-1 sidebar">
                        <?php require DXL_PROFILE_PARTIALS_PATH . '/sidebar.php'; ?>
                    </div>
                    <div class="col-12 col-lg-10 shadow-sm layout-content">
                        <?php 
                            if ( isset($_GET["module"]) ) {
                                require DXL_PROFILE_VIEW_PATH . "/" . $profile["view"] . ".php";
                            } else if ( ! isset($profile["member"]) )  {
                                require DXL_PROFILE_VIEW_PATH . "/" . $profile["view"] . ".php";
                            } else {
                                require DXL_PROFILE_VIEW_PATH . "/" . "main.php";
                            }
                        ?>
                    </div>
                <?php
            }
        ?>

    </div>
</div>