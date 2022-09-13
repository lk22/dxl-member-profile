<?php
    
    /**
     * Plugin Name: DXL Member Profile
     * Plugin URI: 
     * Description: Plugin for displaying member profiles
     * Version: 1.0.0
     * Author: DXL
     * Author URI: https://danishxboxleague.dk
     * License: GPL2
     * License URI: https://www.gnu.org/licenses/gpl-2.0.html
     * Text Domain: dxl-member-profile
     * Domain Path: /languages
     */

    if ( ! defined('ABSPATH') ) exit;

    require_once __DIR__ . '/vendor/autoload.php';

    use DxlProfile\MemberProfile;

    define('DXL_PROFILE_VIEW_PATH', __DIR__ . '/src/frontend/views');
    define('DXL_PROFILE_ASSETS_PATH', __DIR__ . '/src/frontend/assets');
    define('DXL_PROFILE_PARTIALS_PATH', __DIR__ . '/src/frontend/partials');
    define('DXL_PROFILE_MODULE_PATH', __DIR__ . '/src/frontend/modules');

    new MemberProfile();
?>  