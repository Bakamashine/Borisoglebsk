<?php
if (!defined('TOTALLY_VER')) {
    $totally_get_theme = wp_get_theme();
    $totally_version = $totally_get_theme->Version;
    define('TOTALLY_VER', $totally_version);
}

function totally_dequeue_script() {
    wp_dequeue_script('total-custom');
}

add_action('wp_print_scripts', 'totally_dequeue_script', 100);

function totally_slug_setup() {
    load_child_theme_textdomain('totally', get_stylesheet_directory() . '/languages');
}

add_action('after_setup_theme', 'totally_slug_setup');

add_action('wp_enqueue_scripts', 'totally_enqueue_scripts');

function totally_enqueue_scripts() {
    wp_enqueue_style('totally-parent-style', get_template_directory_uri() . '/style.css', array(), TOTALLY_VER);
    wp_enqueue_style('totally-styles', get_stylesheet_directory_uri() . '/styles.css', array('total-style'), TOTALLY_VER);
    wp_add_inline_style('totally-styles', totally_dymanic_styles());
    wp_enqueue_script('totally-custom', get_stylesheet_directory_uri() . '/js/totally-custom.js', array('jquery'), TOTALLY_VER, true);
}

function totally_widgets_init() {
    register_sidebar(array(
        'name' => esc_html__('Top Header Widget', 'totally'),
        'id' => 'totally-top-header-widget',
        'description' => esc_html__('Add widgets here to appear in your Top Header.', 'totally'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Main Header Widget', 'totally'),
        'id' => 'totally-main-header-widget',
        'description' => esc_html__('Add widgets here to appear in your Top Header.', 'totally'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ));
}

add_action('widgets_init', 'totally_widgets_init');

add_filter('wp_nav_menu_items', 'totally_add_link', 10, 2);

function totally_add_link($items, $args) {
    if ($args->theme_location == 'primary') {
        $totally_mh_button_text = get_theme_mod('totally_mh_button_text');
        $totally_mh_button_link = get_theme_mod('totally_mh_button_link');

        if ($totally_mh_button_link && $totally_mh_button_text) {
            $items .= '<li class="menu-item ht-button-menu"><a href="' . esc_url($totally_mh_button_link) . '">' . esc_html($totally_mh_button_text) . '</a></li>';
        }
    }
    return $items;
}

function totally_dymanic_styles() {
    $totally_titlebar_background = get_theme_mod('totally_titlebar_background', get_stylesheet_directory_uri() . '/images/banner-image.jpg');
    $custom_css = "
        body .ht-main-header{background-image: url(" . esc_url($totally_titlebar_background) . ")}
    ";
    return total_css_strip_whitespace($custom_css);
}

/**
 * Customizer additions.
 */
require get_stylesheet_directory() . '/inc/customizer.php';

add_action('wp_head', 'totally_remove_actions');
add_action('total_header', 'totally_display_header');

function totally_remove_actions() {
    remove_action('total_header', 'total_display_header');
    remove_action('total_footer_template', 'total_bottom_footer', 30);
}

function totally_display_header() {
    ?>
    <header id="ht-masthead" class="ht-site-header">
        <div class="ht-top-header">
            <div class="ht-container">
                <?php
                $totally_left_header_text = get_theme_mod('totally_left_header_text', 'Aveneu Park, Starling, Australia');
                if ($totally_left_header_text) {
                    ?>
                    <div class="ht-left-header">
                        <?php echo wp_kses_post($totally_left_header_text); ?>
                    </div>
                <?php } ?>

                <?php
                $totally_social_icons = array(
                    'facebook' => 'facebook',
                    'twitter' => 'x-twitter',
                    'instagram' => 'instagram',
                    'youtube' => 'youtube',
                    'pinterest' => 'pinterest',
                    'linkedin' => 'linkedin'
                );
                ?>
                <div class="ht-right-header">
                    <div class="ht-top-header-social-icons">
                        <?php
                        foreach ($totally_social_icons as $totally_social_key => $totally_social_icon) {
                            $totally_social_link = get_theme_mod('totally_' . $totally_social_key . '_link');
                            if ($totally_social_link) {
                                echo '<a href="' . esc_url($totally_social_link) . '" target="_blank"><i class="fab fa-' . esc_attr($totally_social_icon) . '"></i></a>';
                            }
                        }
                        ?>
                    </div>

                    <?php
                    if (is_active_sidebar('totally-top-header-widget')) {
                        ?>
                        <div class="ht-top-header-widget">
                            <?php dynamic_sidebar('totally-top-header-widget'); ?>
                        </div>
                        <?php
                    }
                    ?>

                </div>
            </div>
        </div>

        <div class="ht-middle-header">
            <div class="ht-container">
                <div id="ht-site-branding">
                    <?php
                    if (function_exists('has_custom_logo') && has_custom_logo()) :
                        the_custom_logo();
                    else :
                        if (is_front_page()) :
                            ?>
                            <h1 class="ht-site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
                        <?php else : ?>
                            <p class="ht-site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></p>
                        <?php endif; ?>
                        <p class="ht-site-description"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('description'); ?></a></p>
                    <?php endif; ?>
                </div><!-- .site-branding -->

                <?php
                if (is_active_sidebar('totally-main-header-widget')) {
                    ?>
                    <div class="ht-main-header-widget">
                        <?php dynamic_sidebar('totally-main-header-widget'); ?>
                    </div>
                    <?php
                } else {
                    ?>
                    <div class="ht-site-contact-info">
                        <?php
                        $totally_hci_icon1 = get_theme_mod('totally_hci_icon1', 'fa fa-envelope');
                        $totally_hci_header1 = get_theme_mod('totally_hci_header1', esc_html__('Email Us', 'totally'));
                        $totally_hci_text1 = get_theme_mod('totally_hci_text1', 'info@yourdomain.com');

                        if ($totally_hci_header1 || $totally_hci_text1) {
                            echo '<div class="ht-contact-block">';
                            echo '<i class="' . esc_attr($totally_hci_icon1) . '"></i>';

                            echo '<div class="ht-contact-block-text">';
                            if ($totally_hci_header1) {
                                echo '<h5>' . esc_html($totally_hci_header1) . '</h5>';
                            }

                            if ($totally_hci_text1) {
                                echo '<p>' . esc_html($totally_hci_text1) . '</p>';
                            }
                            echo '</div></div>';
                        }

                        $totally_hci_icon2 = get_theme_mod('totally_hci_icon2', 'fa fa-phone');
                        $totally_hci_header2 = get_theme_mod('totally_hci_header2', esc_html__('Call Us', 'totally'));
                        $totally_hci_text2 = get_theme_mod('totally_hci_text2', '+01 3434320324');


                        if ($totally_hci_header2 || $totally_hci_text2) {
                            echo '<div class="ht-contact-block">';
                            echo '<i class="' . esc_attr($totally_hci_icon2) . '"></i>';

                            echo '<div class="ht-contact-block-text">';
                            if ($totally_hci_header1) {
                                echo '<h5>' . esc_html($totally_hci_header2) . '</h5>';
                            }

                            if ($totally_hci_text2) {
                                echo '<p>' . esc_html($totally_hci_text2) . '</p>';
                            }
                            echo '</div></div>';
                        }

                        $totally_hci_icon3 = get_theme_mod('totally_hci_icon3', 'fa fa-map-pin');
                        $totally_hci_header3 = get_theme_mod('totally_hci_header3', esc_html__('Find Us', 'totally'));
                        $totally_hci_text3 = get_theme_mod('totally_hci_text3', '234 Littleton Street');

                        if ($totally_hci_header3 || $totally_hci_text3) {
                            echo '<div class="ht-contact-block">';
                            echo '<i class="' . esc_attr($totally_hci_icon3) . '"></i>';

                            echo '<div class="ht-contact-block-text">';
                            if ($totally_hci_header3) {
                                echo '<h5>' . esc_html($totally_hci_header3) . '</h5>';
                            }

                            if ($totally_hci_text3) {
                                echo '<p>' . esc_html($totally_hci_text3) . '</p>';
                            }
                            echo '</div></div>';
                        }
                        ?>
                    </div>
                <?php } ?>
            </div>
        </div>

        <nav id="ht-site-navigation" class="ht-main-navigation">
            <div class="ht-container">
                <div class="ht-nav-wrap ht-clearfix">
                    <a href="#" class="toggle-bar"><span></span></a>
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'container_class' => 'ht-menu ht-clearfix',
                        'menu_class' => 'ht-clearfix',
                        'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                        'fallback_cb' => false
                    ));
                    ?>
                </div>
            </div>
        </nav><!-- #ht-site-navigation -->
    </header><!-- #ht-masthead -->
    <?php
}

if (!function_exists('totally_bottom_footer')) {

    function totally_bottom_footer() {
        ?>
        <div id="ht-bottom-footer">
            <div class="ht-container">
                <div class="ht-site-info ht-bottom-footer">
                    <?php
                    $show_credit = apply_filters('total_display_footer_credit', '__return_true');
                    $total_footer_copyright = get_theme_mod('total_footer_copyright');
                    if ($total_footer_copyright) {
                        echo do_shortcode($total_footer_copyright);
                        if ($show_credit) {
                            echo '<span class="sep"> | </span>';
                        }
                    }
                    if ($show_credit) {
                        printf(
                                // translators: 1-Theme URL, 2-Theme Author
                                esc_html__('%1$s by %2$s', 'totally'), '<a href="https://hashthemes.com/wordpress-theme/totally/" target="_blank">WordPress Theme - Totally</a>', 'HashThemes');
                    }
                    ?>
                </div><!-- #site-info -->
            </div>
        </div>
        <?php
    }

}

add_action('total_footer_template', 'totally_bottom_footer', 30);

add_filter('total_customizer_fonts', 'totally_customizer_fonts');

function totally_customizer_fonts($fonts) {
    return array(
        'total_body_family' => 'Poppins',
        'total_menu_family' => 'Oswald',
        'total_h_family' => 'Teko'
    );
}
