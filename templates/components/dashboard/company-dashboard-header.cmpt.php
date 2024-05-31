<?php $company = Wpjb_Model_Company::current(); ?>

<?php
$menuLinks = [
    'HOME' => (object)['label' => "Accueil", "url" => wpjb_link_to("employer_home"), 'icon' => 'finance'],
    'ADD' => (object)['label' => "Ajouter une offre", "url" => wpjb_link_to("step_add"), 'icon' => 'marketing'],
    'JOBS' => (object)['label' => "Offres d'emploi", "url" => wpjb_link_to("employer_panel"), 'icon' => 'content'],
    'APPLICANTS' => (object)['label' => "Candidatures", "url" => wpjb_link_to("job_applications"), 'icon' => 'research'],
    'CV' => (object)['label' => "CVthèque", "url" => PAGES_URLS->CVtheque, 'icon' => 'human'],
    'SUBS' => (object)['label' => "Adhésions", "url" => wpjb_link_to("membership"), 'icon' => 'lightning'],
    'PAYMENTS' => (object)['label' => "Paiements", "url" => wpjb_link_to("payment_history"), 'icon' => 'retail']
];
if (!isset($hideCompanyBox)) $hideCompanyBox = false;
if (!isset($headerCode)) $headerCode = null;
if ($headerCode) {
    $headerTitle =  $menuLinks[$headerCode]->label;
}
?>

<section class="section-box company-dashboard dashboard-section mb-20">
    <div class="breacrumb-cover pt-15 pb-10">
        <div class="container">
            <div class="header-panel">
                <h2>
                    <?= $headerTitle ?>
                </h2>
                <!-- menu -->
                <div class="box-nav-tabs mt-20 mb-5">
                    <ul class="nav" role="tablist">
                        <?php foreach ($menuLinks as $code => $link) : ?>
                            <li><a class="btn btn-border mr-5 mb-5 <?= $headerCode == $code ? 'active' : '' ?>" href="<?= $link->url ?>">
                                    <img src="<?= get_stylesheet_directory_uri() ?>/assets/imgs/page/homepage1/<?= $link->icon ?>.svg">
                                    <?= $link->label ?>
                                </a></li>
                        <?php endforeach ?>
                    </ul>
                </div>
            </div>

            <?php if (!$hideCompanyBox) : ?>
                <div class="company-box righted sidebar-border d-inline-block mb-0 reveal-child-on-hover">
                    <div class="sidebar-heading">
                        <div class="avatar-sidebar">
                            <figure>
                                <?php company_img($company, false) ?>
                            </figure>
                            <div class="sidebar-info to-be-revealed">
                                <span class="sidebar-company"><?= $company->company_name ?></span>
                                <span class="card-location"><?= get_company_location($company) ?></span>
                                <a class="link-underline mt-15" href="<?= wpjb_link_to("employer_edit") ?>">
                                    Editer le profil
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

        </div>
    </div>
</section>
<?php do_action("wpjb_employer_panel_heading", "bottom") ?>