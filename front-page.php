<?php get_header(); ?>

<!-- HERO -->
<div class="hero">
    <div class="hero-text">
        <div class="hero-eyebrow">The Sneaker Authority</div>
        <h1 class="hero-headline">Every Drop.<br><em>Every Deal.</em><br>Every Day.</h1>
        <p class="hero-sub">The fastest source for sneaker releases, restocks, and deals &mdash; curated for heads who never miss a drop.</p>
        <div class="hero-actions">
            <a href="<?php echo esc_url( home_url( '/releases' ) ); ?>" class="btn-primary">Browse Releases</a>
            <a href="<?php echo esc_url( home_url( '/deals' ) ); ?>" class="btn-ghost">
                See Today's Deals
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:16px;height:16px;">
                    <path d="M5 12h14M12 5l7 7-7 7"/>
                </svg>
            </a>
        </div>
        <div class="hero-stats">
            <div class="stat-item">
                <div class="stat-num">436K</div>
                <div class="stat-label">X Followers</div>
            </div>
            <div class="stat-item">
                <div class="stat-num">592K</div>
                <div class="stat-label">Instagram</div>
            </div>
            <div class="stat-item">
                <div class="stat-num">Daily</div>
                <div class="stat-label">New Drops</div>
            </div>
        </div>
    </div>

    <!-- Hero Featured Cards (latest 3 releases) -->
    <div class="hero-cards">
        <?php
        $hero_releases = new WP_Query( array(
            'post_type'      => 'release',
            'posts_per_page' => 3,
            'orderby'        => 'date',
            'order'          => 'DESC',
        ));
        $first = true;
        if ( $hero_releases->have_posts() ) :
            while ( $hero_releases->have_posts() ) : $hero_releases->the_post();
                $label       = get_post_meta( get_the_ID(), '_release_label', true ) ?: 'new';
                $retail      = get_post_meta( get_the_ID(), '_retail_price', true );
                $buy_link    = get_post_meta( get_the_ID(), '_buy_link', true ) ?: get_permalink();
                $badge_text  = $label === 'restock' ? 'Restock' : ( $label === 'collab' ? 'Collab' : 'New Release' );
        ?>
            <a href="<?php echo esc_url( $buy_link ); ?>" class="hero-card" <?php if($buy_link !== get_permalink()) echo 'target="_blank" rel="noopener"'; ?>>
                <div class="hero-card-img">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <?php the_post_thumbnail( 'hero-featured' ); ?>
                    <?php else : ?>
                        <div style="width:100%;height:100%;background:var(--gray-200);"></div>
                    <?php endif; ?>
                </div>
                <div class="hero-card-overlay">
                    <div class="card-badge"><?php echo esc_html( $badge_text ); ?></div>
                    <div class="hero-card-title"><?php the_title(); ?></div>
                    <?php if ( $retail ) : ?>
                        <div class="hero-card-price">Retail <strong><?php echo esc_html( $retail ); ?></strong></div>
                    <?php endif; ?>
                </div>
            </a>
        <?php
            $first = false;
            endwhile;
            wp_reset_postdata();
        endif;
        ?>
    </div>
</div>

<!-- NEW RELEASES -->
<div class="section" id="releases">
    <div class="section-header">
        <h2 class="section-title">New <span>Releases</span></h2>
        <a href="<?php echo esc_url( home_url( '/releases' ) ); ?>" class="section-link">
            View All
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:14px;height:14px;">
                <path d="M5 12h14M12 5l7 7-7 7"/>
            </svg>
        </a>
    </div>
    <div class="releases-grid">
        <?php
        $releases = new WP_Query( array(
            'post_type'      => 'release',
            'posts_per_page' => 4,
            'orderby'        => 'date',
            'order'          => 'DESC',
        ));
        if ( $releases->have_posts() ) :
            while ( $releases->have_posts() ) : $releases->the_post();
                $retail     = get_post_meta( get_the_ID(), '_retail_price', true );
                $buy_link   = get_post_meta( get_the_ID(), '_buy_link', true ) ?: get_permalink();
                $label      = get_post_meta( get_the_ID(), '_release_label', true ) ?: 'new';
                $badge_text = $label === 'restock' ? 'Restock' : ( $label === 'collab' ? 'Collab' : 'New' );
                $brands     = get_the_terms( get_the_ID(), 'brand' );
                $brand_name = $brands && ! is_wp_error( $brands ) ? $brands[0]->name : '';
        ?>
            <a href="<?php echo esc_url( $buy_link ); ?>" class="release-card" <?php if($buy_link !== get_permalink()) echo 'target="_blank" rel="noopener"'; ?>>
                <div class="release-img">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <?php the_post_thumbnail( 'release-card' ); ?>
                    <?php else : ?>
                        <div style="width:100%;height:100%;background:var(--gray-200);"></div>
                    <?php endif; ?>
                    <div class="release-tag <?php echo esc_attr( $label ); ?>"><?php echo esc_html( $badge_text ); ?></div>
                </div>
                <div class="release-info">
                    <?php if ( $brand_name ) : ?>
                        <div class="release-brand"><?php echo esc_html( $brand_name ); ?></div>
                    <?php endif; ?>
                    <div class="release-name"><?php the_title(); ?></div>
                    <div class="release-footer">
                        <div class="release-price"><?php echo $retail ? esc_html( $retail ) : 'View'; ?></div>
                        <div class="release-cta">Shop Now</div>
                    </div>
                </div>
            </a>
        <?php
            endwhile;
            wp_reset_postdata();
        endif;
        ?>
    </div>
</div>

<!-- LATEST DEALS -->
<div class="section" id="deals">
    <div class="section-header">
        <h2 class="section-title">Latest <span>Deals</span></h2>
        <a href="<?php echo esc_url( home_url( '/deals' ) ); ?>" class="section-link">
            View All
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:14px;height:14px;">
                <path d="M5 12h14M12 5l7 7-7 7"/>
            </svg>
        </a>
    </div>
    <div class="deals-layout">
        <div class="deals-list">
            <?php
            $deals = new WP_Query( array(
                'post_type'      => 'deal',
                'posts_per_page' => 6,
                'orderby'        => 'date',
                'order'          => 'DESC',
            ));
            if ( $deals->have_posts() ) :
                while ( $deals->have_posts() ) : $deals->the_post();
                    $sale_price     = get_post_meta( get_the_ID(), '_sale_price', true );
                    $original_price = get_post_meta( get_the_ID(), '_original_price', true );
                    $discount_pct   = get_post_meta( get_the_ID(), '_discount_pct', true );
                    $retailer       = get_post_meta( get_the_ID(), '_retailer', true );
                    $free_shipping  = get_post_meta( get_the_ID(), '_free_shipping', true );
                    $deal_link      = get_post_meta( get_the_ID(), '_deal_link', true ) ?: get_permalink();
                    $brands         = get_the_terms( get_the_ID(), 'brand' );
                    $brand_name     = $brands && ! is_wp_error( $brands ) ? $brands[0]->name : '';
            ?>
                <a href="<?php echo esc_url( $deal_link ); ?>" class="deal-row" target="_blank" rel="noopener sponsored">
                    <div class="deal-thumb">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <?php the_post_thumbnail( 'deal-thumb' ); ?>
                        <?php else : ?>
                            <div style="width:100%;height:100%;background:var(--gray-200);"></div>
                        <?php endif; ?>
                    </div>
                    <div class="deal-info">
                        <?php if ( $brand_name ) : ?>
                            <div class="deal-brand"><?php echo esc_html( $brand_name ); ?></div>
                        <?php endif; ?>
                        <div class="deal-name"><?php the_title(); ?></div>
                        <div class="deal-meta">
                            <?php if ( $retailer ) : ?>
                                <span class="deal-retailer"><?php echo esc_html( $retailer ); ?></span>
                            <?php endif; ?>
                            <?php if ( $free_shipping === '1' ) : ?>
                                <span class="deal-shipping">Free Shipping</span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="deal-pricing">
                        <?php if ( $original_price ) : ?>
                            <div class="deal-original-price"><?php echo esc_html( $original_price ); ?></div>
                        <?php endif; ?>
                        <?php if ( $sale_price ) : ?>
                            <div class="deal-sale-price"><?php echo esc_html( $sale_price ); ?></div>
                        <?php endif; ?>
                        <?php if ( $discount_pct ) : ?>
                            <div class="deal-off-badge"><?php echo esc_html( $discount_pct ); ?></div>
                        <?php endif; ?>
                    </div>
                </a>
            <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>
    </div>
</div>

<!-- FASHION -->
<div class="section" id="fashion">
    <div class="section-header">
        <h2 class="section-title">Fashion <span>Drops</span></h2>
        <a href="<?php echo esc_url( home_url( '/fashion' ) ); ?>" class="section-link">
            View All
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:14px;height:14px;">
                <path d="M5 12h14M12 5l7 7-7 7"/>
            </svg>
        </a>
    </div>
    <div class="fashion-strip">
        <?php
        $fashion_posts = new WP_Query( array(
            'post_type'      => 'post',
            'posts_per_page' => 3,
            'category_name'  => 'fashion',
            'orderby'        => 'date',
            'order'          => 'DESC',
        ));
        if ( $fashion_posts->have_posts() ) :
            while ( $fashion_posts->have_posts() ) : $fashion_posts->the_post();
                $cats = get_the_category();
                $cat_name = $cats ? $cats[0]->name : 'Fashion';
        ?>
            <a href="<?php the_permalink(); ?>" class="fashion-card">
                <div class="fashion-card-img">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <?php the_post_thumbnail( 'fashion-card' ); ?>
                    <?php else : ?>
                        <div style="width:100%;height:100%;background:var(--gray-200);"></div>
                    <?php endif; ?>
                </div>
                <div class="fashion-overlay">
                    <div class="fashion-label"><?php echo esc_html( $cat_name ); ?></div>
                    <div class="fashion-title"><?php the_title(); ?></div>
                </div>
            </a>
        <?php
            endwhile;
            wp_reset_postdata();
        endif;
        ?>
    </div>
</div>

<?php get_footer(); ?>
