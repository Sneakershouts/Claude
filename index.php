<?php get_header(); ?>

<div class="section">
    <div class="section-header">
        <h1 class="section-title">
            <?php
            if ( is_category() ) {
                echo 'Category: <span>' . single_cat_title( '', false ) . '</span>';
            } elseif ( is_tag() ) {
                echo 'Tag: <span>' . single_tag_title( '', false ) . '</span>';
            } elseif ( is_tax( 'brand' ) ) {
                echo 'Brand: <span>' . single_term_title( '', false ) . '</span>';
            } elseif ( is_search() ) {
                echo 'Search: <span>' . get_search_query() . '</span>';
            } elseif ( is_archive() ) {
                echo 'Archive';
            } else {
                echo 'Latest <span>Posts</span>';
            }
            ?>
        </h1>
    </div>

    <div class="releases-grid">
        <?php if ( have_posts() ) : ?>
            <?php while ( have_posts() ) : the_post(); ?>
                <a href="<?php the_permalink(); ?>" class="release-card">
                    <div class="release-img">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <?php the_post_thumbnail( 'release-card' ); ?>
                        <?php else : ?>
                            <div style="width:100%;height:100%;background:var(--gray-200);"></div>
                        <?php endif; ?>
                    </div>
                    <div class="release-info">
                        <div class="release-brand"><?php echo get_the_date(); ?></div>
                        <div class="release-name"><?php the_title(); ?></div>
                        <div class="release-footer">
                            <div class="release-cta">Read More</div>
                        </div>
                    </div>
                </a>
            <?php endwhile; ?>
        <?php else : ?>
            <p>No posts found.</p>
        <?php endif; ?>
    </div>

    <!-- Pagination -->
    <div style="margin-top: 40px; text-align: center;">
        <?php the_posts_pagination( array(
            'mid_size'  => 2,
            'prev_text' => '&larr; Previous',
            'next_text' => 'Next &rarr;',
        )); ?>
    </div>
</div>

<?php get_footer(); ?>
