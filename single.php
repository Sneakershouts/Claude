<?php get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

<div class="post-hero">
    <?php
    $categories = get_the_category();
    if ( $categories ) : ?>
        <div class="post-category"><?php echo esc_html( $categories[0]->name ); ?></div>
    <?php endif; ?>

    <h1 class="post-title"><?php the_title(); ?></h1>

    <div class="post-meta">
        <span><?php echo get_the_date(); ?></span>
        <span>&mdash;</span>
        <span><?php the_author(); ?></span>
    </div>
</div>

<div class="post-content">
    <div class="post-main">
        <?php if ( has_post_thumbnail() ) : ?>
            <?php the_post_thumbnail( 'hero-featured', array( 'class' => 'post-featured-img' ) ); ?>
        <?php endif; ?>
        <div class="post-body">
            <?php the_content(); ?>
        </div>
    </div>

    <!-- Sidebar -->
    <aside class="post-sidebar">
        <!-- Recent Releases Widget -->
        <div class="sidebar-widget">
            <div class="sidebar-widget-title">Recent Releases</div>
            <div class="sidebar-post-list">
                <?php
                $recent_releases = new WP_Query( array(
                    'post_type'      => 'release',
                    'posts_per_page' => 4,
                    'orderby'        => 'date',
                    'order'          => 'DESC',
                ));
                if ( $recent_releases->have_posts() ) :
                    while ( $recent_releases->have_posts() ) : $recent_releases->the_post();
                        $buy_link = get_post_meta( get_the_ID(), '_buy_link', true ) ?: get_permalink();
                ?>
                    <div class="sidebar-post-item">
                        <div class="sidebar-post-thumb">
                            <?php if ( has_post_thumbnail() ) the_post_thumbnail( 'deal-thumb' ); ?>
                        </div>
                        <div>
                            <a href="<?php echo esc_url( $buy_link ); ?>" class="sidebar-post-name"><?php the_title(); ?></a>
                            <div class="sidebar-post-date"><?php echo get_the_date(); ?></div>
                        </div>
                    </div>
                <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>
        </div>

        <!-- Recent Deals Widget -->
        <div class="sidebar-widget">
            <div class="sidebar-widget-title">Latest Deals</div>
            <div class="sidebar-post-list">
                <?php
                $recent_deals = new WP_Query( array(
                    'post_type'      => 'deal',
                    'posts_per_page' => 4,
                    'orderby'        => 'date',
                    'order'          => 'DESC',
                ));
                if ( $recent_deals->have_posts() ) :
                    while ( $recent_deals->have_posts() ) : $recent_deals->the_post();
                        $deal_link    = get_post_meta( get_the_ID(), '_deal_link', true ) ?: get_permalink();
                        $sale_price   = get_post_meta( get_the_ID(), '_sale_price', true );
                        $discount_pct = get_post_meta( get_the_ID(), '_discount_pct', true );
                ?>
                    <div class="sidebar-post-item">
                        <div class="sidebar-post-thumb">
                            <?php if ( has_post_thumbnail() ) the_post_thumbnail( 'deal-thumb' ); ?>
                        </div>
                        <div>
                            <a href="<?php echo esc_url( $deal_link ); ?>" class="sidebar-post-name" target="_blank" rel="noopener"><?php the_title(); ?></a>
                            <div class="sidebar-post-date">
                                <?php if ( $sale_price ) echo esc_html( $sale_price ); ?>
                                <?php if ( $discount_pct ) echo ' &mdash; ' . esc_html( $discount_pct ); ?>
                            </div>
                        </div>
                    </div>
                <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>
        </div>

        <?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
            <?php dynamic_sidebar( 'sidebar-1' ); ?>
        <?php endif; ?>
    </aside>
</div>

<?php endwhile; ?>

<?php get_footer(); ?>
