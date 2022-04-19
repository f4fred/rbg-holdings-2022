<?php get_header(); ?>

<?php require_once('extensions/bir-banners/templates/inner-banners.php'); ?>

    <div class="container">

        <div class="wrap">

            <div id="content" class="full-width text-center">

                <h1><strong>404</strong> <span><?php esc_html_e( 'nothing found', 'ir' ); ?></span></h1>
                <p>Apologies but we can't find what you're looking for. Please check your spelling and try again or go back to the homepage by <a href="<?php echo esc_url( home_url( '/' ) ); ?>">clicking here.</a></p>

            </div>
            
        </div>

    </div>

<?php get_footer(); ?>