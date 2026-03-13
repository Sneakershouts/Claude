<footer class="site-footer">
    <div class="footer-top">

        <!-- Brand -->
        <div class="footer-brand">
            <div class="footer-logo">
                <?php if ( has_custom_logo() ) : ?>
                    <?php the_custom_logo(); ?>
                <?php else : ?>
                    <span style="font-family: 'Playfair Display', serif; font-size: 22px; font-weight: 900; color: white;">
                        Sneaker<span style="color: #F97316;">Shouts</span>
                    </span>
                <?php endif; ?>
            </div>
            <p class="footer-desc"><?php bloginfo( 'description' ); ?></p>
            <div class="footer-social">
                <a href="https://x.com/sneakershouts" class="social-btn" target="_blank" rel="noopener">X</a>
                <a href="https://instagram.com/sneakershouts" class="social-btn" target="_blank" rel="noopener">IG</a>
                <a href="https://youtube.com/sneakershouts" class="social-btn" target="_blank" rel="noopener">YT</a>
                <a href="https://tiktok.com/@sneakershouts" class="social-btn" target="_blank" rel="noopener">TK</a>
            </div>
        </div>

        <!-- Explore -->
        <div class="footer-col">
            <div class="footer-col-title">Explore</div>
            <ul class="footer-links">
                <li><a href="<?php echo esc_url( home_url( '/releases' ) ); ?>">New Releases</a></li>
                <li><a href="<?php echo esc_url( home_url( '/deals' ) ); ?>">Sneaker Deals</a></li>
                <li><a href="<?php echo esc_url( home_url( '/fashion' ) ); ?>">Fashion</a></li>
                <li><a href="<?php echo esc_url( home_url( '/restocks' ) ); ?>">Restocks</a></li>
                <li><a href="<?php echo esc_url( home_url( '/collabs' ) ); ?>">Collabs</a></li>
            </ul>
        </div>

        <!-- Company -->
        <div class="footer-col">
            <div class="footer-col-title">Company</div>
            <ul class="footer-links">
                <li><a href="<?php echo esc_url( home_url( '/about' ) ); ?>">About</a></li>
                <li><a href="<?php echo esc_url( home_url( '/advertise' ) ); ?>">Advertise</a></li>
                <li><a href="<?php echo esc_url( home_url( '/contact' ) ); ?>">Contact</a></li>
                <li><a href="<?php echo esc_url( home_url( '/privacy-policy' ) ); ?>">Privacy Policy</a></li>
                <li><a href="<?php echo esc_url( home_url( '/terms' ) ); ?>">Terms</a></li>
            </ul>
        </div>

    </div>

    <div class="footer-bottom">
        <p>&copy; <?php echo date( 'Y' ); ?> <?php bloginfo( 'name' ); ?>. All rights reserved.</p>
        <p>Affiliate links may earn us a commission.</p>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
