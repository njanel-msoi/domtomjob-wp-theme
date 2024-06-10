<?php

/**
 * Template Name: DTJ Homepage
 */
get_header();
?>


<section class="section-box mb-70">
    <div class="banner-hero hero-1 banner-homepage5">
        <div class="banner-inner">
            <div class="row">
                <div class="col-xl-7 col-lg-12">
                    <div class="block-banner">
                        <h1 class="heading-banner wow animate__animated animate__fadeInUp">
                            La référence <span class="hide-xs">de</span><br><span class="hide-xs">l'</span>emploi <span class="color-brand-2">outre-mer</span>
                        </h1>
                        <div class="banner-description mt-20 wow animate__animated animate__fadeInUp" data-wow-delay=".1s">Utilisez la plateforme leader du marché de l'emploi à la Réunion et dans les DROM-COM.</div>
                        <div class="mt-30">
                            <a class="btn btn-default mr-15" href="<?= PAGES_URLS->ListeOffres ?>">Parcourir les annonces</a>
                            <a class="btn btn-border-brand-2" href="<?= PAGES_URLS->PublierAnnonce ?>">Publier une offre</a>
                        </div>

                        <div class="list-tags-banner mt-60 wow animate__animated animate__fadeInUp" data-wow-delay=".3s">
                            <strong>Emploi par région :</strong>
                            <?php
                            global $REGIONS;
                            foreach ($REGIONS as $region) : ?>
                                <a href="/regions/<?= urlencode($region) ?>" title="Offres d'emploi <?= $region ?>"><?= $region ?></a>,
                            <?php endforeach; ?>
                        </div>

                    </div>
                </div>
                <div class="col-xl-5 col-lg-12">
                    <div class="banner-imgs">
                        <div class="banner-1 shape-1"><img class="img-responsive" alt="jobBox" src="<?= get_stylesheet_directory_uri() ?>/assets/imgs/page/homepage5/banner1.png"></div>
                        <div class="banner-2 shape-2"><img class="img-responsive" alt="jobBox" src="<?= get_stylesheet_directory_uri() ?>/assets/imgs/page/homepage5/banner2.png"></div>
                        <div class="banner-3 shape-3"><img class="img-responsive" alt="jobBox" src="<?= get_stylesheet_directory_uri() ?>/assets/imgs/page/homepage5/banner3.png"></div>
                        <div class="banner-4 shape-3"><img class="img-responsive" alt="jobBox" src="<?= get_stylesheet_directory_uri() ?>/assets/imgs/page/homepage5/banner4.png"></div>
                        <div class="banner-5 shape-2"><img class="img-responsive" alt="jobBox" src="<?= get_stylesheet_directory_uri() ?>/assets/imgs/page/homepage5/banner5.png"></div>
                        <div class="banner-6 shape-1"><img class="img-responsive" alt="jobBox" src="<?= get_stylesheet_directory_uri() ?>/assets/imgs/page/homepage5/banner6.png"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>