<?php get_header(); ?>

<section class="pt-50 login-register">
    <div class="container">
        <div class="row login-register-cover pb-50">
            <div class="col-lg-5 col-md-6 col-sm-12 mx-auto">
                <div class="text-center"><img class="w-75 " src="<?= get_stylesheet_directory_uri() ?>/assets/imgs/template/404.svg">
                    <h2 class="mt-10 mb-5 text-brand-1">Page non trouvée.</h2>
                    <p class="font-sm text-muted mb-30">Désolé, mais nous n'avons pas pu ouvrir cette page.</p>
                </div>

                <div class="text-center mt-20"><a href="<?= PAGES_URLS->Accueil ?>">Retour à la page d'accueil</a></div>
                <div class="text-center mt-20"><a href="<?= PAGES_URLS->Accueil ?>">Parcourir les offres d'emploi</a></div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>