<footer class="container-fluid sitemap">
    <div class="container">
        <div class="row">
            <?php
                for ( $i = 1; $i <= 4; $i++ ) {
                    if ( is_active_sidebar( 'footer' . $i ) ) {
            ?>
                <div class="col-md">
                    <?php dynamic_sidebar( 'footer' . $i ); ?>
                </div>
            <?php
                    }
                }
            ?>
        </div>
    </div>
</footer>

<footer class="container-fluid copyright">
	<div class="container">
        <div class="row text-center">
			<?php dynamic_sidebar( 'copyright' ); ?>
        </div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>