<section class="section-box mb-30">
    <div class="pb-20 banner-hero banner-single banner-single-bg">
        <div class="block-banner text-center">
            <h3>
                <?= $bannerTitle ?>
            </h3>
            <!-- <div class="font-sm color-text-paragraph-2 mt-10">
                Ajouter une offre d'emploi sur DomTomJob pour être visible par 100 000 candidats par mois.
            </div> -->

            <div class="mt-40">
                <?php include $this->getTemplate("job-board", "step") ?>
            </div>
        </div>
    </div>
</section>