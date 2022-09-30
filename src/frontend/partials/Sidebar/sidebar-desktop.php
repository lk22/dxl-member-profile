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
    <li>
        <a href="<?php echo get_home_url(); ?>">Gå til DXL</a>
        
    </li>
    <li>
        <a href="<?php echo wp_logout_url(); ?>">Logud</a>
    </li>
        </ul>
</div>