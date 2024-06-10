<?php

/**
 * Template Name: DTJ Contact Page
 */
get_header();
?>

<section class="section-box mt-20">
    <div class="row">
        <div class="col-lg-8 mb-40"><span class="font-md color-brand-2 mt-20 d-inline-block">
                Contactez-nous
            </span>
            <h2 class="mt-5 mb-10">Gardons le contact</h2>
            <p class="font-md color-text-paragraph-2">
                Vous avez une question ? Envoyez nous un message<br>et nous vous répondrons dans les plus bref délais.
            </p>
            <div class="mt-30"></div>

            <?= do_shortcode('[contact-form-7 id="68c38f4" title="Contact simple"]'); ?>
        </div>
        <div class="col-lg-4 text-center d-none d-lg-block"><img src="<?= get_stylesheet_directory_uri() ?>/assets/imgs/page/contact/img.png" alt="joxBox"></div>
    </div>
</section>

<section class="section-box mt-30 mb-30">
    <div class="box-info-contact">
        <div class="row">
            <!-- <div class="col-lg-3 col-md-6 col-sm-12 mb-0">
                <img src="<?= get_stylesheet_directory_uri() ?>/images/logo_dtj.png" class="w-50">
                <div class="font-sm color-text-paragraph">
                        DomTomJob<br>Une marque Antenne Réunion<br>Domiciliée à Saint-Denis de la Réunion
                    </div>
            </div> -->
            <div class="col-lg-3 col-md-6 col-sm-12 mb-0">
                <h6>Contact pro</h6>
                <p class="font-sm color-text-paragraph mb-20">Aurélie Mariotti<br class="d-none d-lg-block"> 02.62.45.62.22</p>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 mb-0">
                <h6>Contact candidats</h6>
                <p class="font-sm color-text-paragraph mb-20">Aurélie Mariotti<br class="d-none d-lg-block"> 02.62.45.62.22</p>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 mb-0">
                <h6>Horaires</h6>
                <p class="font-sm color-text-paragraph mb-20">Nous vous répondons<br class="d-none d-lg-block">en semaine de 9h à 17h</p>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 mb-0">
                <h6>Coordonnées bancaires</h6>
                <p class="font-sm color-text-paragraph mb-20">Envoyez vos virements à<br class="d-none d-lg-block">FR7651651651651651</p>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>