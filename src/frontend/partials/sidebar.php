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
            "sub" => array(
                "Hygge" => array(
                    "url" => $manager_url . "?module=events",
                    "icon" => '<i class="far fa-calendar-check"></i>',
                )
            )
        ),
        "Rediger profil" => array(
            "url" => $manager_url . "?module=settings",
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
        $altMenu["Indstillinger"] = [
            "icon" =>'<i class="fas fa-user-cog"></i>',
            "sub" => [
                "Generelt" => [
                    "url" => $manager_url . "?module=profilesettings",
                    "icon" => '<i class="fas fa-cog"></i>'
                ],
                "Spil indstillinger" => [
                    "url" => $manager_url . "?module=profilesettings&type=games",
                    "icon" => '<i class="fas fa-gamepad"></i>'
                ]
            ]
        ];

        $altMenu["Invitationer"] = [
            "icon" => '<i class="fas fa-user-friends"></i>',
            "url" => $manager_url . "?module=invitations" 
        ];
    }

    if( isset($profile["profileSettings"]->is_trainer) ) {
        $altMenu["Events"]["sub"]["Træning"] = array(
            "url" => $manager_url . "?module=events&type=training",
            "icon" => '<i class="far fa-calendar-check"></i>'
        );
    }

    if( isset($profile["profileSettings"]->is_tournament_author )) {
        $altMenu["Events"]["sub"]["Turneringer"] = array(
            "url" => "?view=events&type=tournaments",
            "icon" => '<i class="far fa-calendar-check"></i>'
        );
    }

    show_admin_bar(false);

 ?>

<div class="menu-bar hidden-md hidden-lg col-xs-12 col-sm-12">
    <div class="menu-button hidden-md hidden-lg"><i style="font-size: 17px; display:flex; justify-content: flex-end; padding: 1.5rem; cursor: pointer;" class="fas fa-bars"></i></div>
    <div class="mobile-nav">
        <div class="close-btn">
            <i class="fas fa-times"></i>
        </div>
        <ul class="navigation">
        <?php 
            foreach($altMenu as $key => $item) {
                ?>
                    <li class="list-item">
                        <?php
                            if( !empty($item["sub"]) ){
                                ?>
                                    <div class="item-container">
                                        <span class="icon"><?php echo $item['icon'] ?> </span> 	
                                        <span class="item"><?php echo ucfirst($key) ?></span>
                                    </div>
                                <?php
                            } else {
                                ?>
                                    <a href="<?php echo $item["url"] ?>">
                                        <span class="icon"><?php echo $item['icon'] ?> </span> 	
                                        <span class="item"><?php echo ucfirst($key) ?></span>
                                    </a>
                                <?php
                            }
                        ?>
                        
                        <?php 
                            if( !empty($item["sub"]) ){
                                ?>
                                    <ul class="menu-sub">
                                        <?php 
                                            foreach($item["sub"] as $sk => $subItem){
                                                ?>
                                                    <li class="list-item">
                                                        <a href="<?php echo $subItem["url"] ?>">
                                                            <span class="icon"><?php echo $subItem['icon'] ?> </span> 	
                                                            <span class="item"><?php echo ucfirst($sk) ?></span>
                                                        </a>
                                                    </li>
                                                <?php
                                            }
                                        ?>
                                    </ul>
                                <?php
                            }
                        ?>
                    </li>
                <?php 
            }
        ?>
        <li>
            <a href="<?php echo get_home_url(); ?>">Gå til DXL</a>
            
        </li>
        <li>
            <a href="<?php echo wp_logout_url(); ?>">Logud</a>
        </li>
        </ul>
    </div>
</div>