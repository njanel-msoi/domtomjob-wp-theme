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
            <div class="footer-col-1 col-md-3 col-sm-12"><a href="<?= PAGES_URLS->Accueil ?>">
                    <img class="footer-logo" alt="<?= esc_attr(get_bloginfo('name', 'display')) ?>" src="<?= get_stylesheet_directory_uri() . '/images/logo_dtj.png' ?>">
                </a>
                <div class="mt-20 mb-20 font-xs color-text-paragraph-2">
                    JobBox is the heart of the design community and the best resource to discover and connect with designers and jobs worldwide.
                </div>
                <div class="footer-social"><a class="icon-socials icon-facebook" href="#"></a><a class="icon-socials icon-twitter" href="#"></a><a class="icon-socials icon-linkedin" href="#"></a></div>
            </div>
            <div class="footer-col-2 col-md-2 col-xs-6">
                <h6 class="mb-20">Resources</h6>
                <ul class="menu-footer">
                    <li><a href="#">About us</a></li>
                    <li><a href="#">Our Team</a></li>
                    <li><a href="#">Products</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>
            <div class="footer-col-3 col-md-2 col-xs-6">
                <h6 class="mb-20">Community</h6>
                <ul class="menu-footer">
                    <li><a href="#">Feature</a></li>
                    <li><a href="#">Pricing</a></li>
                    <li><a href="#">Credit</a></li>
                    <li><a href="#">FAQ</a></li>
                </ul>
            </div>
            <div class="footer-col-4 col-md-2 col-xs-6">
                <h6 class="mb-20">Quick links</h6>
                <ul class="menu-footer">
                    <li><a href="#">iOS</a></li>
                    <li><a href="#">Android</a></li>
                    <li><a href="#">Microsoft</a></li>
                    <li><a href="#">Desktop</a></li>
                </ul>
            </div>
            <div class="footer-col-5 col-md-2 col-xs-6">
                <h6 class="mb-20">More</h6>
                <ul class="menu-footer">
                    <li><a href="#">Privacy</a></li>
                    <li><a href="#">Help</a></li>
                    <li><a href="#">Terms</a></li>
                    <li><a href="#">FAQ</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom mt-50">
            <div class="row">
                <div class="col-md-6"><span class="font-xs color-text-paragraph">Copyright &copy; 2022. JobBox all right reserved</span></div>
                <div class="col-md-6 text-md-end text-start">
                    <div class="footer-social"><a class="font-xs color-text-paragraph" href="#">Privacy Policy</a><a class="font-xs color-text-paragraph mr-30 ml-30" href="#">Terms &amp; Conditions</a><a class="font-xs color-text-paragraph" href="#">Security</a></div>
                </div>
            </div>
        </div>
    </div>
</footer>
<footer id="footer" role="contentinfo" style="display: none;>
    <nav class=" container list-inline">

    <?php wp_nav_menu(array('theme_location' => 'footer')); ?>

    <hr>
    <?php
    global $REGIONS;
    foreach ($REGIONS as $region) : ?>

        <a href="/regions/<?= urlencode($region) ?>" title="Offres d'emploi <?= $region ?>"><?= $region ?></a>&nbsp;

    <?php endforeach; ?>

    <hr>
    <?php
    global $CATEGORIES;
    foreach ($CATEGORIES as $category) : ?>

        <a href="/categories/<?= urlencode($category->get('id')) ?>/<?= urlencode($category->get('title')) ?>" title="Offres d'emploi <?= $category->get('title') ?>"><?= $category->get('title') ?></a>&nbsp;

    <?php endforeach; ?>


    </nav>
</footer><!-- #colophon .site-footer -->

<?php wp_footer(); ?>

<!-- <script src="<?= get_stylesheet_directory_uri() ?>/assets/js/vendor/modernizr-3.6.0.min.js"></script> -->
<script src="<?= get_stylesheet_directory_uri() ?>/assets/js/vendor/jquery-3.6.0.min.js"></script>
<!-- <script src="<?= get_stylesheet_directory_uri() ?>/assets/js/vendor/jquery-migrate-3.3.0.min.js"></script> -->
<!-- <script src="<?= get_stylesheet_directory_uri() ?>/assets/js/vendor/bootstrap.bundle.min.js"></script> -->
<!-- <script src="<?= get_stylesheet_directory_uri() ?>/assets/js/plugins/waypoints.js"></script> -->
<!-- <script src="<?= get_stylesheet_directory_uri() ?>/assets/js/plugins/wow.js"></script> -->
<!-- <script src="<?= get_stylesheet_directory_uri() ?>/assets/js/plugins/magnific-popup.js"></script> -->
<script src="<?= get_stylesheet_directory_uri() ?>/assets/js/plugins/perfect-scrollbar.min.js"></script>
<script src="<?= get_stylesheet_directory_uri() ?>/assets/js/plugins/select2.min.js"></script>
<!-- <script src="<?= get_stylesheet_directory_uri() ?>/assets/js/plugins/isotope.js"></script> -->
<!-- <script src="<?= get_stylesheet_directory_uri() ?>/assets/js/plugins/scrollup.js"></script> -->
<!-- <script src="<?= get_stylesheet_directory_uri() ?>/assets/js/plugins/swiper-bundle.min.js"></script> -->
<!-- <script src="<?= get_stylesheet_directory_uri() ?>/assets/js/noUISlider.js"></script> -->
<!-- <script src="<?= get_stylesheet_directory_uri() ?>/assets/js/slider.js"></script> -->
<script src="<?= get_stylesheet_directory_uri() ?>/assets/js/jobbox-custom.js?v=4.1"></script>

</body>

</html>