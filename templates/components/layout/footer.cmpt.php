<?php

/**
 * The template for displaying the footer.
 * 
 * Responsible for closing tags opened in footer.cmpt.php
 */
?>


<!-- container end -->
</div>
<!-- main content end -->
</main>
<footer class="footer mt-50">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-12"><a href="<?= PAGES_URLS->Accueil ?>">
                    <img class="footer-logo" alt="<?= esc_attr(get_bloginfo('name', 'display')) ?>" src="<?= get_stylesheet_directory_uri() . '/images/logo_dtj.png' ?>">
                </a>
                <div class="mt-20 mb-20 font-xs color-text-paragraph-2">
                    DomTomJob est la plateforme leader des offres d'emploi à la Réunion et dans les DROM-COM
                </div>
                <div class="footer-social"><a class="icon-socials icon-facebook" href="#"></a><a class="icon-socials icon-twitter" href="#"></a><a class="icon-socials icon-linkedin" href="#"></a></div>
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="row">
                    <div class="col-md-3 col-xs-12">
                        <h6 class="mb-20">Arborescence</h6>
                        <div class="menu-footer">
                            <?php wp_nav_menu(array('menu' => 'menu-footer')); ?>
                        </div>
                    </div>
                    <div class="col-md-3 col-xs-12">
                        <h6 class="mb-20">&nbsp;</h6>
                        <div class="menu-footer">
                            <?php wp_nav_menu(array('menu' => 'footer-2')); ?>
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <h6 class="mb-20">Régions</h6>
                        <div class="row">
                            <?php
                            global $REGIONS;
                            foreach ($REGIONS as $region) : ?>
                                <div class="col-6">
                                    <a href="/regions/<?= urlencode($region) ?>" title="Offres d'emploi <?= $region ?>"><?= $region ?></a>&nbsp;
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="footer-bottom mt-50">
            <div class="row">
                <div class="col-md-6"><span class="font-xs color-text-paragraph">Copyright &copy; 2022. JobBox all right reserved</span></div>
                <div class="col-md-6 text-md-end text-start">
                    <div class="footer-social">
                        <a class="font-xs color-text-paragraph" href="<?= PAGES_URLS->ProtectionDonnees ?>">Protection des données</a>
                        <a class="font-xs color-text-paragraph mr-30 ml-30" href="<?= PAGES_URLS->MentionsLegales ?>">Mentions légales</a>
                        <a class="font-xs color-text-paragraph" href="<?= PAGES_URLS->Sitemap ?>">Sitemap</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>

<script src="<?= get_stylesheet_directory_uri() ?>/assets/js/vendor/jquery-3.6.0.min.js"></script>
<script src="<?= get_stylesheet_directory_uri() ?>/assets/js/plugins/select2.min.js"></script>

<!-- <script src="<?= get_stylesheet_directory_uri() ?>/assets/js/vendor/modernizr-3.6.0.min.js"></script> -->
<!-- <script src="<?= get_stylesheet_directory_uri() ?>/assets/js/vendor/jquery-migrate-3.3.0.min.js"></script> -->
<!-- <script src="<?= get_stylesheet_directory_uri() ?>/assets/js/vendor/bootstrap.bundle.min.js"></script> -->
<!-- <script src="<?= get_stylesheet_directory_uri() ?>/assets/js/plugins/waypoints.js"></script> -->
<!-- <script src="<?= get_stylesheet_directory_uri() ?>/assets/js/plugins/wow.js"></script> -->
<!-- <script src="<?= get_stylesheet_directory_uri() ?>/assets/js/plugins/magnific-popup.js"></script> -->
<!-- <script src="<?= get_stylesheet_directory_uri() ?>/assets/js/plugins/perfect-scrollbar.min.js"></script> -->
<!-- <script src="<?= get_stylesheet_directory_uri() ?>/assets/js/plugins/isotope.js"></script> -->
<!-- <script src="<?= get_stylesheet_directory_uri() ?>/assets/js/plugins/scrollup.js"></script> -->
<!-- <script src="<?= get_stylesheet_directory_uri() ?>/assets/js/plugins/swiper-bundle.min.js"></script> -->
<!-- <script src="<?= get_stylesheet_directory_uri() ?>/assets/js/noUISlider.js"></script> -->
<!-- <script src="<?= get_stylesheet_directory_uri() ?>/assets/js/slider.js"></script> -->

<script src="<?= get_stylesheet_directory_uri() ?>/assets/js/jobbox-custom.js?v=4.1"></script>

</body>

</html>