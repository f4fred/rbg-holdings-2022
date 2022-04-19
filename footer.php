    </main>

    <footer id="colophon" aria-label="site footer">

        <div class="footer-columns">

            <div class="wrap">

                <div class="col">
                    <?php dynamic_sidebar('col-1-footer-navigation'); ?>
                </div>

                <div class="col">
                    <?php dynamic_sidebar('col-2-footer-navigation'); ?>
                </div>

                <div class="col">
                    <?php dynamic_sidebar('col-3-footer-navigation'); ?>
                </div>

            </div><!-- .wrap -->

        </div><!-- .footer-columns -->

        <div class="sub-footer">

            <div class="wrap">

                <p class="copyright">&copy; <?php echo date('Y'); ?> <?php echo get_bloginfo('name'); ?></p>

                <?php if ( has_nav_menu( 'legal' ) ) { ?>

                    <nav class="legal">
                        <?php wp_nav_menu(array(
                            'theme_location' => 'legal',
                            'container' => false,
                            'walker' => new clean_walker)
                            );
                        ?>
                    </nav>

                <?php } ?>

                <p class="credit">Website by <a href="https://www.brighterir.com/" target="_blank" rel="noopener">Brighter<span>*</span>IR</a></p>

            </div><!-- .wrap -->

        </div><!-- .sub-footer -->

        <?php if(true === get_theme_mod('show_backtotop')) { ?>
            <a class="cd-top" href="#top">
                <span class="dashicons dashicons-arrow-up"></span>
            </a>
        <?php } ?>

    </footer>

    <a href="https://682m96m2bb.execute-api.eu-west-2.amazonaws.com/ProdStage" rel="nofollow" style="display: none" aria-hidden="true">link</a>

    <?php wp_footer(); ?>

</body>
</html>