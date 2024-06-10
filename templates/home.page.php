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
                        <h5 class="mb-15 color-brand-2">DomTomJob</h5>
                        <div></div>
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

            <div class="block-banner bloc-search-jobs">
                <div class="form-find mt-40 wow animate__animated animate__fadeIn" data-wow-delay=".2s">

                    <?php echo do_shortcode('[wpjb_jobs_search]'); ?>
                </div>
            </div>
        </div>
    </div>


</section>



<h2 class="section-title mb-10 wow animate__ animate__fadeInUp">Annonces à la une</h2>
<p class="font-lg color-text-paragraph-2 wow animate__ animate__fadeInUp mb-30">
    Découvrez les annonces mises en avant par les recruteurs.
</p>
<?php echo do_shortcode('[wpjb_jobs_list is_featured="1"]'); ?>


<section class="box-border-single bg-border-3 text-center">
    <!-- <h2 class="section-title mb-10 wow animate__ animate__fadeInUp">Nos partenaires</h2>
    <p class="font-lg color-text-paragraph-2 wow animate__ animate__fadeInUp mb-30">
        Découvrez nos partenaires de l'emploi.
    </p> -->
    <?php
    $bannerUrl = get_field('lien_externe_banniere_partenaire');
    $bannerImg = get_field('banniere_partenaire');
    $bannerTitle = get_field('banniere_title');
    ?>

    <a href="<?= $bannerUrl ?>" target="_blank">
        <img alt="<?= $bannerTitle ?>" title="<?= $bannerTitle ?>" src="<?= $bannerImg ?>">
    </a>
</section>


<div class="border-bottom mb-40"></div>

<h2 class="section-title mb-10 wow animate__ animate__fadeInUp">Les entreprises qui recrutent</h2>
<p class="font-lg color-text-paragraph-2 wow animate__ animate__fadeInUp">
    Découvrez les entreprises qui recrutent activement.
</p>
<?php echo do_shortcode('[wpjb_employers_list sort_order="jobs_posted DESC" count="9" filter="active"]'); ?>

<div class="border-bottom mt-10"></div>

<!-- start numbers blocs -->
<section class="section-box overflow-visible mt-50 mb-50">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="text-center">
                    <h1 class="color-brand-2"><span class="count">25</span><span> K+</span></h1>
                    <h5>Completed Cases</h5>
                    <p class="font-sm color-text-paragraph mt-10">We always provide people a <br class="d-none d-lg-block">complete solution upon focused of<br class="d-none d-lg-block"> any business</p>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="text-center">
                    <h1 class="color-brand-2"><span class="count">17</span><span> +</span></h1>
                    <h5>Our Office</h5>
                    <p class="font-sm color-text-paragraph mt-10">We always provide people a <br class="d-none d-lg-block">complete solution upon focused of <br class="d-none d-lg-block">any business</p>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="text-center">
                    <h1 class="color-brand-2"><span class="count">86</span><span> +</span></h1>
                    <h5>Skilled People</h5>
                    <p class="font-sm color-text-paragraph mt-10">We always provide people a <br class="d-none d-lg-block">complete solution upon focused of <br class="d-none d-lg-block">any business</p>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="text-center">
                    <h1 class="color-brand-2"><span class="count">28</span><span> +</span></h1>
                    <h5>CHappy Clients</h5>
                    <p class="font-sm color-text-paragraph mt-10">We always provide people a <br class="d-none d-lg-block">complete solution upon focused of <br class="d-none d-lg-block">any business</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end numbers blocs -->

<div class="border-bottom mb-30"></div>

<section class="box-border-single bg-border-3 text-center">
    <h2 class="section-title mb-10 wow animate__ animate__fadeInUp">Nos tarifs recruteurs</h2>
    <p class="font-lg color-text-paragraph-2 wow animate__ animate__fadeInUp mb-30">
        Découvrez nos tarifs adaptés au besoin de votre entreprise.
    </p>
    <!-- <h1>Nos tarifs</h1>
<?php // echo do_shortcode('[wpjb_membership_pricing]'); 
?> -->
</section>


<?php get_footer(); ?>