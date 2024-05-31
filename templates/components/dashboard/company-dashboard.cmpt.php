<?php

/**
 * Dashboard of registered company
 */
?>

<?php $headerTitle = "Espace recruteur";
$hideCompanyBox = true; ?>
<?php include 'company-dashboard-header.cmpt.php' ?>

<?php $company = Wpjb_Model_Company::current(); ?>

<?php
$menuLinks = [
    (object)['label' => "Comptes collaborateurs", "url" => wpjb_link_to("employer_home") . '?panel=coworkers', 'icon' => 'human'],
    (object)['label' => "Modification du mot de passe", "url" => wpjb_link_to("employer_password"), 'icon' => 'security'],
    (object)['label' => "Supprimer le compte", "url" => wpjb_link_to("employer_delete"), 'icon' => 'aboutus-icon'],
    (object)['label' => "Déconnexion", "url" => wpjb_link_to("employer_logout"), 'icon' => 'aboutus-icon']
];
?>
<?php wpjb_flash() ?>

<?php do_action("wpjb_employer_panel_heading", "top") ?>

<div class="company-box mt-20 sidebar-border d-inline-block float-start mb-0">
    <div class="sidebar-heading">
        <div class="avatar-sidebar">
            <figure>
                <?php company_img($company, false) ?>
            </figure>
            <div class="sidebar-info">
                <span class="sidebar-company"><?= $company->company_name ?></span>
                <span class="card-location"><?= get_company_location($company) ?></span>
                <a class="link-underline mt-15" href="<?= wpjb_link_to("company", $company) ?>">
                    Voir le profil public
                </a>
            </div>
        </div>

        <div class="sidebar-list-job">
            <a class="btn btn-default hover-up" href="<?= wpjb_link_to("employer_edit") ?>">
                Editer le profil entreprise
            </a>
        </div>
    </div>
</div>

<!-- other links -->
<div class="float-start mt-30">
    <div class="box-nav-tabs mb-5 d-inline-block">
        <nav class="nav flex-column">
            <?php foreach ($menuLinks as $link) : ?>
                <a class="nav-link mr-15 btn-link" href="<?= $link->url ?>">
                    <?= $link->label ?>
                </a>
            <?php endforeach ?>
        </nav>
    </div>
</div>

</div>

<div class="clearfix"></div>

<?php do_action("wpjb_employer_panel_heading", "bottom") ?>