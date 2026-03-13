<?php
/**
 * Sneaker Shouts Theme Functions
 */

// ── THEME SETUP ──────────────────────────────────────────
function sneakershouts_setup() {
    // Let WordPress manage the document title
    add_theme_support( 'title-tag' );

    // Enable post thumbnails (featured images)
    add_theme_support( 'post-thumbnails' );

    // HTML5 support
    add_theme_support( 'html5', array(
        'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
    ));

    // Register navigation menus
    register_nav_menus( array(
        'primary' => __( 'Primary Navigation', 'sneakershouts' ),
        'footer'  => __( 'Footer Navigation', 'sneakershouts' ),
    ));

    // Widescreen images
    add_image_size( 'release-card', 600, 600, true );
    add_image_size( 'deal-thumb', 144, 144, true );
    add_image_size( 'hero-featured', 1200, 600, true );
    add_image_size( 'fashion-card', 800, 440, true );
}
add_action( 'after_setup_theme', 'sneakershouts_setup' );


// ── ENQUEUE STYLES & SCRIPTS ─────────────────────────────
function sneakershouts_scripts() {
    // Google Fonts
    wp_enqueue_style(
        'sneakershouts-fonts',
        'https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;1,9..40,300&family=Playfair+Display:wght@700;900&display=swap',
        array(),
        null
    );

    // Main stylesheet
    wp_enqueue_style(
        'sneakershouts-style',
        get_stylesheet_uri(),
        array( 'sneakershouts-fonts' ),
        wp_get_theme()->get( 'Version' )
    );

    // Main JS
    wp_enqueue_script(
        'sneakershouts-main',
        get_template_directory_uri() . '/js/main.js',
        array(),
        wp_get_theme()->get( 'Version' ),
        true
    );
}
add_action( 'wp_enqueue_scripts', 'sneakershouts_scripts' );


// ── CUSTOM POST TYPES ─────────────────────────────────────

// Sneaker Releases
function sneakershouts_register_post_types() {
    register_post_type( 'release', array(
        'labels' => array(
            'name'               => __( 'Releases', 'sneakershouts' ),
            'singular_name'      => __( 'Release', 'sneakershouts' ),
            'add_new'            => __( 'Add New Release', 'sneakershouts' ),
            'add_new_item'       => __( 'Add New Release', 'sneakershouts' ),
            'edit_item'          => __( 'Edit Release', 'sneakershouts' ),
            'new_item'           => __( 'New Release', 'sneakershouts' ),
            'view_item'          => __( 'View Release', 'sneakershouts' ),
            'search_items'       => __( 'Search Releases', 'sneakershouts' ),
            'not_found'          => __( 'No releases found', 'sneakershouts' ),
        ),
        'public'        => true,
        'has_archive'   => true,
        'rewrite'       => array( 'slug' => 'releases' ),
        'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
        'show_in_rest'  => true,
        'menu_icon'     => 'dashicons-sneakers',
    ));

    // Sneaker Deals
    register_post_type( 'deal', array(
        'labels' => array(
            'name'               => __( 'Deals', 'sneakershouts' ),
            'singular_name'      => __( 'Deal', 'sneakershouts' ),
            'add_new'            => __( 'Add New Deal', 'sneakershouts' ),
            'add_new_item'       => __( 'Add New Deal', 'sneakershouts' ),
            'edit_item'          => __( 'Edit Deal', 'sneakershouts' ),
            'new_item'           => __( 'New Deal', 'sneakershouts' ),
            'view_item'          => __( 'View Deal', 'sneakershouts' ),
            'search_items'       => __( 'Search Deals', 'sneakershouts' ),
            'not_found'          => __( 'No deals found', 'sneakershouts' ),
        ),
        'public'        => true,
        'has_archive'   => true,
        'rewrite'       => array( 'slug' => 'deals' ),
        'supports'      => array( 'title', 'thumbnail', 'custom-fields' ),
        'show_in_rest'  => true,
        'menu_icon'     => 'dashicons-tag',
    ));
}
add_action( 'init', 'sneakershouts_register_post_types' );


// ── CUSTOM TAXONOMIES ─────────────────────────────────────
function sneakershouts_register_taxonomies() {
    // Brand taxonomy (Nike, adidas, Jordan, etc.)
    register_taxonomy( 'brand', array( 'release', 'deal', 'post' ), array(
        'labels' => array(
            'name'          => __( 'Brands', 'sneakershouts' ),
            'singular_name' => __( 'Brand', 'sneakershouts' ),
            'search_items'  => __( 'Search Brands', 'sneakershouts' ),
            'all_items'     => __( 'All Brands', 'sneakershouts' ),
            'edit_item'     => __( 'Edit Brand', 'sneakershouts' ),
            'add_new_item'  => __( 'Add New Brand', 'sneakershouts' ),
        ),
        'hierarchical'  => true,
        'rewrite'       => array( 'slug' => 'brand' ),
        'show_in_rest'  => true,
    ));

    // Release Type (New Release, Restock, Collab, etc.)
    register_taxonomy( 'release_type', array( 'release' ), array(
        'labels' => array(
            'name'          => __( 'Release Types', 'sneakershouts' ),
            'singular_name' => __( 'Release Type', 'sneakershouts' ),
        ),
        'hierarchical'  => true,
        'rewrite'       => array( 'slug' => 'release-type' ),
        'show_in_rest'  => true,
    ));
}
add_action( 'init', 'sneakershouts_register_taxonomies' );


// ── CUSTOM META BOXES ─────────────────────────────────────
function sneakershouts_add_meta_boxes() {
    // Release details
    add_meta_box(
        'release_details',
        __( 'Release Details', 'sneakershouts' ),
        'sneakershouts_release_meta_box',
        'release',
        'normal',
        'high'
    );

    // Deal details
    add_meta_box(
        'deal_details',
        __( 'Deal Details', 'sneakershouts' ),
        'sneakershouts_deal_meta_box',
        'deal',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'sneakershouts_add_meta_boxes' );

function sneakershouts_release_meta_box( $post ) {
    wp_nonce_field( 'sneakershouts_release_nonce', 'release_nonce' );
    $retail_price  = get_post_meta( $post->ID, '_retail_price', true );
    $release_date  = get_post_meta( $post->ID, '_release_date', true );
    $buy_link      = get_post_meta( $post->ID, '_buy_link', true );
    $release_label = get_post_meta( $post->ID, '_release_label', true );
    ?>
    <table class="form-table">
        <tr>
            <th><label for="retail_price"><?php _e( 'Retail Price', 'sneakershouts' ); ?></label></th>
            <td><input type="text" id="retail_price" name="retail_price" value="<?php echo esc_attr( $retail_price ); ?>" placeholder="$180" class="regular-text"></td>
        </tr>
        <tr>
            <th><label for="release_date"><?php _e( 'Release Date', 'sneakershouts' ); ?></label></th>
            <td><input type="date" id="release_date" name="release_date" value="<?php echo esc_attr( $release_date ); ?>" class="regular-text"></td>
        </tr>
        <tr>
            <th><label for="buy_link"><?php _e( 'Buy Link (Affiliate URL)', 'sneakershouts' ); ?></label></th>
            <td><input type="url" id="buy_link" name="buy_link" value="<?php echo esc_url( $buy_link ); ?>" class="large-text"></td>
        </tr>
        <tr>
            <th><label for="release_label"><?php _e( 'Label', 'sneakershouts' ); ?></label></th>
            <td>
                <select id="release_label" name="release_label">
                    <option value="new" <?php selected( $release_label, 'new' ); ?>>New Release</option>
                    <option value="restock" <?php selected( $release_label, 'restock' ); ?>>Restock</option>
                    <option value="collab" <?php selected( $release_label, 'collab' ); ?>>Collab</option>
                </select>
            </td>
        </tr>
    </table>
    <?php
}

function sneakershouts_deal_meta_box( $post ) {
    wp_nonce_field( 'sneakershouts_deal_nonce', 'deal_nonce' );
    $sale_price      = get_post_meta( $post->ID, '_sale_price', true );
    $original_price  = get_post_meta( $post->ID, '_original_price', true );
    $discount_pct    = get_post_meta( $post->ID, '_discount_pct', true );
    $retailer        = get_post_meta( $post->ID, '_retailer', true );
    $free_shipping   = get_post_meta( $post->ID, '_free_shipping', true );
    $deal_link       = get_post_meta( $post->ID, '_deal_link', true );
    ?>
    <table class="form-table">
        <tr>
            <th><label for="sale_price"><?php _e( 'Sale Price', 'sneakershouts' ); ?></label></th>
            <td><input type="text" id="sale_price" name="sale_price" value="<?php echo esc_attr( $sale_price ); ?>" placeholder="$63.99" class="regular-text"></td>
        </tr>
        <tr>
            <th><label for="original_price"><?php _e( 'Original Price', 'sneakershouts' ); ?></label></th>
            <td><input type="text" id="original_price" name="original_price" value="<?php echo esc_attr( $original_price ); ?>" placeholder="$160" class="regular-text"></td>
        </tr>
        <tr>
            <th><label for="discount_pct"><?php _e( '% Off', 'sneakershouts' ); ?></label></th>
            <td><input type="text" id="discount_pct" name="discount_pct" value="<?php echo esc_attr( $discount_pct ); ?>" placeholder="60% OFF" class="regular-text"></td>
        </tr>
        <tr>
            <th><label for="retailer"><?php _e( 'Retailer', 'sneakershouts' ); ?></label></th>
            <td><input type="text" id="retailer" name="retailer" value="<?php echo esc_attr( $retailer ); ?>" placeholder="Nike.com" class="regular-text"></td>
        </tr>
        <tr>
            <th><label for="free_shipping"><?php _e( 'Free Shipping?', 'sneakershouts' ); ?></label></th>
            <td><input type="checkbox" id="free_shipping" name="free_shipping" value="1" <?php checked( $free_shipping, '1' ); ?>></td>
        </tr>
        <tr>
            <th><label for="deal_link"><?php _e( 'Deal Link (Affiliate URL)', 'sneakershouts' ); ?></label></th>
            <td><input type="url" id="deal_link" name="deal_link" value="<?php echo esc_url( $deal_link ); ?>" class="large-text"></td>
        </tr>
    </table>
    <?php
}


// ── SAVE META BOX DATA ────────────────────────────────────
function sneakershouts_save_release_meta( $post_id ) {
    if ( ! isset( $_POST['release_nonce'] ) || ! wp_verify_nonce( $_POST['release_nonce'], 'sneakershouts_release_nonce' ) ) return;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;

    $fields = array( 'retail_price', 'release_date', 'buy_link', 'release_label' );
    foreach ( $fields as $field ) {
        if ( isset( $_POST[ $field ] ) ) {
            update_post_meta( $post_id, '_' . $field, sanitize_text_field( $_POST[ $field ] ) );
        }
    }
}
add_action( 'save_post_release', 'sneakershouts_save_release_meta' );

function sneakershouts_save_deal_meta( $post_id ) {
    if ( ! isset( $_POST['deal_nonce'] ) || ! wp_verify_nonce( $_POST['deal_nonce'], 'sneakershouts_deal_nonce' ) ) return;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;

    $text_fields = array( 'sale_price', 'original_price', 'discount_pct', 'retailer', 'deal_link' );
    foreach ( $text_fields as $field ) {
        if ( isset( $_POST[ $field ] ) ) {
            update_post_meta( $post_id, '_' . $field, sanitize_text_field( $_POST[ $field ] ) );
        }
    }
    $free_shipping = isset( $_POST['free_shipping'] ) ? '1' : '0';
    update_post_meta( $post_id, '_free_shipping', $free_shipping );
}
add_action( 'save_post_deal', 'sneakershouts_save_deal_meta' );


// ── WIDGET AREAS ──────────────────────────────────────────
function sneakershouts_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Blog Sidebar', 'sneakershouts' ),
        'id'            => 'sidebar-1',
        'description'   => __( 'Widgets in this area will show in the blog sidebar.', 'sneakershouts' ),
        'before_widget' => '<div class="sidebar-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<div class="sidebar-widget-title">',
        'after_title'   => '</div>',
    ));
}
add_action( 'widgets_init', 'sneakershouts_widgets_init' );


// ── EXCERPT LENGTH ────────────────────────────────────────
function sneakershouts_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'sneakershouts_excerpt_length' );
