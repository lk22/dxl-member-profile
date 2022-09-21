<?php 

    /**
     * Member profile utility functions
     */

     if ( ! function_exists('register_profile_menu') ) 
     {
        function register_profile_menu( $items, $args ) {
            global $wpdb;

            if ( $args->theme_location != 'primary' ) {
                return $items;
            }

            if( is_user_logged_in() ) {
              $member = $wpdb->get_row(
                $wpdb->prepare(
                  "SELECT gamertag FROM " . $wpdb->prefix . "members WHERE user_id = %d",
                  wp_get_current_user()->ID
                )
              );

              if ( $member ) {
                  $items .= '<li class="menu-item menu-item-type-custom menu-item-object-custom parent hfe-creative-menu"><a href="/manager-profile">' . $member->gamertag . '</a></li>';
                  $items .= '<li class="menu-item menu-item-type-custom menu-item-object-custom parent hfe-creative-menu"><a href="' . wp_logout_url() . '">Logud</a></li>';
              }
            } else {
              $items .= '<li class="menu-item menu-item-type-post_type menu-item-object-page"><a href="' . wp_login_url() . '">' . __('Login') . '</a></li>';
            }

            return $items;
        }
     }

     add_filter('wp_nav_menu_items', 'register_profile_menu', 1, 2);

     if( !function_exists('manager_redirect') ) {
      function manager_redirect($url, $request, $user) {
        global $wpdb;
        if($user && is_object($user) && is_a($user, 'WP_User')) {
    
          $member = $wpdb->get_row(
            "SELECT id, is_payed, profile_activated FROM " . $wpdb->prefix . "members WHERE user_id = " . $user->data->ID,
            ARRAY_A
          );
    
          if( $member ) {
            $member_settings = $wpdb->get_row (
              "SELECT redirect_to_manager FROM " . $wpdb->prefix . "member_profile_settings 
              WHERE member_id IN( " . $member["id"] . ")",
              ARRAY_A
            );
            if($member["is_payed"] == "1" && $member["profile_activated"] = "1" && $member_settings["redirect_to_manager"] == "1") {
              $url = home_url('/manager-profile');
              show_admin_bar(false);
            } else {
              $url = home_url();
            }
          } else {
            if($user->has_cap('administrator')) {
              $url = admin_url();
            } else {
              $url = home_url();
            }
          }
        }
        return $url;
      }
    }
    add_filter('login_redirect', 'manager_redirect', 1, 3);

?>