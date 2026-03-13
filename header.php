<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header">
    <div class="nav-inner">

        <!-- Logo -->
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nav-logo" rel="home">
            <?php if ( has_custom_logo() ) : ?>
                <?php the_custom_logo(); ?>
            <?php else : ?>
                <span style="font-family: 'Playfair Display', serif; font-size: 22px; font-weight: 900; color: #0A0A0A;">
                    Sneaker<span style="color: #F97316;">Shouts</span>
                </span>
            <?php endif; ?>
        </a>

        <!-- Primary Navigation -->
        <ul class="nav-links">
            <?php
            wp_nav_menu( array(
                'theme_location' => 'primary',
                'container'      => false,
                'items_wrap'     => '%3$s',
                'fallback_cb'    => false,
            ));
            ?>
            <?php if ( ! has_nav_menu( 'primary' ) ) : ?>
                <li><a href="<?php echo esc_url( home_url( '/releases' ) ); ?>">New Releases</a></li>
                <li><a href="<?php echo esc_url( home_url( '/deals' ) ); ?>">Sneaker Deals</a></li>
                <li><a href="<?php echo esc_url( home_url( '/fashion' ) ); ?>">Fashion</a></li>
            <?php endif; ?>
        </ul>

        <!-- Search -->
        <div class="nav-right">
            <div class="nav-search" onclick="document.querySelector('.search-overlay').classList.toggle('active')">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="11" r="8"/>
                    <path d="m21 21-4.35-4.35"/>
                </svg>
                Search
            </div>
        </div>

    </div>
</header>

<!-- Search Overlay -->
<div class="search-overlay" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.6); z-index:999; align-items:center; justify-content:center;">
    <div style="background:white; padding:32px; border-radius:8px; width:90%; max-width:560px;">
        <?php get_search_form(); ?>
    </div>
</div>
