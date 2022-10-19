<div class="menu-bar col-xs-12 col-sm-12 d-none d-lg-block">
    <ul class="navigation">
    <?php 
        foreach($altMenu as $key => $item) {
            ?>
                <li class="list-item">
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
        </ul>

        <div class="sidebar-bottom-links">
            <a href="<?php echo get_home_url(); ?>" class="btn-white">Gå til DXL</a>
            <a href="<?php echo wp_logout_url() ?>" class="btn-white">Log ud</a>
        </div>
</div>