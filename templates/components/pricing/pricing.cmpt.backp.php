<section class="section-box">
    <div class="pb-60 pt-60 banner-hero banner-single banner-single-bg">
        <div class="block-banner text-center">
            <h3>
                Nos <span class="color-brand-2">Tarifs</span>
            </h3>
            <div class="font-sm color-text-paragraph-2 mt-10">
                Ajoutez vos annonces sur le site d'emploi le plus visité de la Réunion.
            </div>
        </div>
    </div>
</section>

<?php
$query = new Daq_Db_Query();
$activeListings = $query->select("t.*")
    ->from("Wpjb_Model_Pricing t")
    ->order("title")
    ->where("is_active = 1")
    ->where("price_for IN(?)", Wpjb_Model_Pricing::PRICE_SINGLE_JOB)
    ->execute();

// first display single offer prices
$activeListings = array_map(function ($price) {
    return (object)[
        'title' => $price->title,
        'price' => $price->price,
        'link' => PAGES_URLS->PublierAnnonce,
        'featured' => $price->meta->is_featured->value() == 1
    ];
}, $activeListings);
$singleListing = array_filter($activeListings, function ($p) {
    return !$p->featured;
});
$optionsListing = array_filter($activeListings, function ($p) {
    return $p->featured;
});

$pricesArr = $singleListing;
// $title = "Offres unitaires";
// $subtitle = "Publiez une offre d'emploi en la réglant à l'unité.";
$buyBtnTxt = 'Publier une offre';

include dirname(__FILE__) . '/pricing-loop.cmpt.php';

// packs are membership not featured
$packs = [];
// subscriptoins are membership with featured flag
$subscriptions = [];
foreach ($memberships as $pricing) {
    // filter active memberships
    if (!$pricing->is_active) continue;
    $price = (object)[
        'title' => $pricing->title,
        'price' => $pricing->price,
        'link' => get_the_permalink() . "?membership_id=" . esc_html(intval($pricing->id)),
        'featured' => $pricing->meta->is_featured->value() == 1
    ];
    if (!$price->featured) $packs[] = $price;
    else $subscriptions[] = $price;
}

$pricesArr = $packs;
$title = "Packs d'offres";
$subtitle = "Un nombre d'offres d'emploi au meilleur prix, utilisable pendant 365 jours";
$buyBtnTxt = 'Acheter';
include dirname(__FILE__) . '/pricing-loop.cmpt.php';

$pricesArr = $subscriptions;
$title = "Abonnement illimité";
$subtitle = "Postez un nombre illimité d'offres pendant 365 jours";
$buyBtnTxt = 'Acheter';
include dirname(__FILE__) . '/pricing-loop.cmpt.php';

$pricesArr = $optionsListing;
$title = "Ajout d'options";
$subtitle = "Mettez en avant une offre ou publiez sans mentionner le recruteur";
$buyBtnTxt = 'Publier une offre';

include dirname(__FILE__) . '/pricing-loop.cmpt.php';
