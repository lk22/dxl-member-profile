<?php
    $manager_url = get_home_url() . "/manager-profile/";
    $altMenu = array(
        "Forside" => array(
            "url" => $manager_url,
            "icon" => '<i class="fas fa-home"></i>'
        ),
        // "dashboard" => array(
        // 	"url" => $home . '?page=dashboard',
        // 	"icon" => '<i class="fas fa-chart-line"></i>'
        // ),
        "Events" => array(
            "icon" => '<i class="far fa-calendar-check"></i>',
            "url" => $manager_url . "?module=events",
            // "sub" => array(
            //     "Hygge" => array(
            //         "url" => $manager_url . "?module=events",
            //         "icon" => '<i class="far fa-calendar-check"></i>',
            //     )
            // )
        ),
        "Rediger profil" => array(
            "url" => $manager_url . "?module=update",
            "icon" => '<i class="fas fa-user-cog"></i>'
        ),
        "Spil" => array(
            "url" => $manager_url . "?module=settings&type=games",
            "icon" => '<i class="fas fa-user-cog"></i>'
        ),
        "Indstillinger" => [
            "icon" =>'<i class="fas fa-user-cog"></i>',
            "sub" => [
                "Spil indstillinger" => [
                    "url" => $manager_url . "?module=profilesettings&type=games",
                    "icon" => '<i class="fas fa-gamepad"></i>'
                ]
            ]
        ],
        // "invitationer" => array(
        // 	"url" => $manager_url . "?module=invitations",
        // 	"icon" => '<i class="fas fa-user-friends"></i>'
        // )
    );

    /**
     * settings for game creating
     */
    if( wp_get_current_user()->user_login = "leok2200" ) {
        // $altMenu["Indstillinger"] = [
        //     "icon" =>'<i class="fas fa-user-cog"></i>',
        //     "sub" => [
        //         "Generelt" => [
        //             "url" => $manager_url . "?module=settings",
        //             "icon" => '<i class="fas fa-cog"></i>'
        //         ],
        //         "Spil indstillinger" => [
        //             "url" => $manager_url . "?module=settings&type=games",
        //             "icon" => '<i class="fas fa-gamepad"></i>'
        //         ]
        //     ]
        // ];

        // $altMenu["Invitationer"] = [
        //     "icon" => '<i class="fas fa-user-friends"></i>',
        //     "url" => $manager_url . "?module=invitations" 
        // ];
    }

    // if( isset($profile["profileSettings"]->is_trainer) ) {
    //     $altMenu["Events"]["sub"]["Træning"] = array(
    //         "url" => $manager_url . "?module=events&type=training",
    //         "icon" => '<i class="far fa-calendar-check"></i>'
    //     );
    // }

    // if( isset($profile["profileSettings"]->is_tournament_author )) {
    //     $altMenu["Events"]["sub"]["Turneringer"] = array(
    //         "url" => "?view=events&type=tournaments",
    //         "icon" => '<i class="far fa-calendar-check"></i>'
    //     );
    // }

    show_admin_bar(false);
    include DXL_PROFILE_PARTIALS_PATH . "/Sidebar/sidebar-desktop.php";
    include DXL_PROFILE_PARTIALS_PATH . "/Sidebar/sidebar-responsive.php";
 ?>

