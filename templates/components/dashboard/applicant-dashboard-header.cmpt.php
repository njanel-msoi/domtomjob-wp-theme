<?php
if (!isset($headerCode)) $headerCode = NULL;

$menuLinks = [
    'PROFILE' => (object)['label' => "Mon profil candidat", "url" => candidateDashboardUrl('my-resume'), 'icon' => 'aboutus'],
    'SUBS' => (object)['label' => "Mes candidatures", "url" => candidateDashboardUrl('my-applications'), 'icon' => 'recruitment'],
    'ALERTS' => (object)['label' => "Mes alertes email", "url" => candidateDashboardUrl('my-alerts'), 'icon' => 'people']
];
?>

<section class="section-box">

    <div class="border-bottom mt-0 mb-30"></div>

    <?php do_action("wpjb_candidate_panel_heading", "top") ?>


    <div class="row">
        <div class="col-lg-3 col-md-4 col-sm-12">
            <div class="box-nav-tabs nav-tavs-profile mb-5">
                <ul class="nav" role="tablist">
                    <?php foreach ($menuLinks as $code => $menu) : ?>
                        <li>
                            <a class="btn btn-border <?= $menu->icon ?>-icon mb-20 <?= $headerCode == $code ? 'active' : '' ?>" href="<?= $menu->url ?>"><?= $menu->label ?></a>
                        </li>
                    <?php endforeach ?>
                </ul>
                <div class="border-bottom pb-10"></div>
                <div class="mt-20"><a class="link-red color-brand-1" href="<?= candidateDashboardUrl('password') ?>">Modifier mot de passe</a></div>
                <div class=""><a class="link-red color-brand-1" href="<?= candidateDashboardUrl('logout') ?>">Déconnexion</a></div>
                <div class="mt-20 mb-20"><a class="link-red" href="<?= candidateDashboardUrl('delete') ?>">Delete Account</a></div>
            </div>
        </div>
        <div class="col-lg-9 col-md-8 col-sm-12 col-12 mb-50">
            <div>