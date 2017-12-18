<header id="header" class="header-ontrails header-fixed-top"> 
    <div class="container">
        <div class="row align-items-end">
            <div class="logo-content col-lg-2">
                <div class="text-uppercase">
                    <a class="logo-text d-flex align-items-center" href="<?= esc_url(home_url('/'));?>">
                        <img class="hidden-md-down" src="<?= build_url('/assets/images/ontrails_logo.png');?>" alt="On Trails" />
                        <span>On Trails</span>
                    </a>
                    <a class="logo-image-mobile hidden-lg-up" href="<?= esc_url(home_url('/'));?>">
                        <img class="d-flex" src="<?= build_url('/assets/images/logo-ontrails.png');?>" alt="On Trails" />
                    </a>
                    <a class="mobile-menu hidden-lg-up collapsed"  data-fancybox="modal" data-src="#modal-1" href="javascript:;">
                        <span class="toggler-menu">menu</span>
                    </a>
                </div>
            </div>
            <div class="menu-content col-lg-8 hidden-md-down"> 
                <?php
                    if (has_nav_menu('primary_navigation')) {
                        if (is_single()) { 
                        // add cass current-menu
                            $categorie = get_the_category($post->ID);
                            if ($categorie){
                                $cateslug  = $categorie[0]->slug; 
                                $out_cateslug = 'current-menu-'.$cateslug.'';
                            }else{
                                $out_cateslug = ''; 
                            }   
                            wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav mainmenu flex-lg-row flex-column text-uppercase '.$out_cateslug.'']);
                        }else{
                            wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav mainmenu flex-lg-row text-uppercase flex-column']);
                        }
                    }
                ?>
            </div>
            <div class="social-desktop col-lg-2 hidden-md-down">
            <?php
                if (has_nav_menu('link_social_media')) {
                    wp_nav_menu(['theme_location' => 'link_social_media', 'menu_class' => 'nav justify-content-end social-icon']);
                } 
            ?>
            </div>  
        </div>   
        <hr> 
    </div>
</header>
<section id="modal-1" class="popup-menu" style="display: none;">
    <div class="container-popup-menu">
        <?php
            if (has_nav_menu('primary_navigation')) {
                wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav mainmenu-mobile text-uppercase flex-column']);
            }
            echo '<div class="social-mobile">';
            echo '<p>FOLLOW ME ON</p>';
            if (has_nav_menu('link_social_media')) {
                wp_nav_menu(['theme_location' => 'link_social_media', 'menu_class' => 'nav social-button flex-column']);
            } 
            echo '</div>';
        ?>
    </div>
</section>