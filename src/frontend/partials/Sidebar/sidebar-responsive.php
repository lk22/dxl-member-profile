<?php 
    /**
     * Response sidebar component
     * 
     * Leo knudsen 30/09-22
     */
?>

<div class="responsive-sidebar d-block d-lg-none">
    <div class="row">
        <div class="col-3">
            <div class="nav-toggler">
                <i class="fas fa-bars"></i>
            </div>
        </div>
        <div class="col-9">
            <div class="row flex-nowrap justify-content-start">
                <div class="dxl-home-logout d-flex justify-content-end">
                    <a class="dxl-btn me-2" href="<?php echo wp_logout_url( home_url() ); ?>">
                        Logud <i class="fas fa-sign-out-alt"></i>
                    </a>
                    <a class="dxl-btn" href="<?php echo get_home_url(); ?>">
                        Gå til DXL <i class="fas fa-home"></i>
                    </a>
                </div>
                <div class="dxl">
                </div>
            </div>
        </div>
    </div>
    <div id="responsive-navigation">
        <nav class="nav-list">
            <div class="close-button">
                <i class="fas fa-times"></i>
            </div>
            <?php 
                foreach($altMenu as $key => $item) {
                    ?>
                        <li class="nav-item">
                            <?php
                                if ( !empty($item["sub"]) ){
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
                                if ( ! empty( $item["sub"] ) ){
                                    ?>
                                        <ul class="menu-sub">
                                            <?php 
                                                foreach ( $item["sub"] as $sk => $subItem ){
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
            <li class="d-none">
                <a class="dxl-btn" href="<?php echo get_home_url(); ?>">Gå til DXL</a>
            </li>
            <li class="d-none">
                <a class="dxl-btn" href="<?php echo wp_logout_url(); ?>">Logud</a>
            </li>
        </nav>
    </div>
</div>