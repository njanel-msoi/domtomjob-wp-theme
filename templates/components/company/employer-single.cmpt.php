<?php

/**
 * Company profile page
 * 
 * This template displays company profile page
 * 
 * 
 * @author Greg Winiarski
 * @package Templates
 * @subpackage JobBoard
 */
/* @var $jobList array List of active company job openings */
/* @var $company Wpjb_Model_Company Company information */

?>

<?php
// not used for now
$is_company_visible = $company->isVisible() || (Wpjb_Model_Company::current() && Wpjb_Model_Company::current()->id == $company->id)
?>

<?php
// echo '<h4>FIELDS</h4><br>' . implode(' | ', array_keys($company->getFields()));
// echo '<h4>META </h4><br>' . implode(' | ', array_keys((array)$company->getMeta(array())));
// echo '<h4>USER META FIELDS</h4><br>' . implode(' | ', array_keys((array)$company->getMeta(array("meta_type" => 3, "empty" => false))));

?>
<?php wpjb_flash() ?>

<section class="section-box-2">
    <div class="container">
        <div class="banner-hero banner-image-single"><img src="<?= get_stylesheet_directory_uri() ?>/assets/imgs/page/company/img.png" alt="jobBox"></div>
        <div class="box-company-profile">
            <div class="image-compay">
                <?php company_img($company, false) ?>
            </div>
            <div class="row mt-10">
                <div class="col-lg-8 col-md-12">
                    <h5 class="f-18"><?= esc_html($company->company_name) ?> <span class="card-location font-regular ml-20"><?= get_meta_region($company) ?></span></h5>
                    <p class="mt-5 font-md color-text-paragraph-2 mb-15">

                    </p>
                </div>
                <!-- <div class="col-lg-4 col-md-12 text-lg-end"><a class="btn btn-call-icon btn-apply btn-apply-big" href="page-contact.html">Contact us</a></div> -->
            </div>
        </div>
        <!-- <div class="box-nav-tabs mt-40 mb-5">
            <ul class="nav" role="tablist">
                <li><a class="btn btn-border aboutus-icon mr-15 mb-5 active" href="#tab-about" data-bs-toggle="tab" role="tab" aria-controls="tab-about" aria-selected="true">About us</a></li>
                <li><a class="btn btn-border recruitment-icon mr-15 mb-5" href="#tab-recruitments" data-bs-toggle="tab" role="tab" aria-controls="tab-recruitments" aria-selected="false">Recruitments</a></li>
                <li><a class="btn btn-border people-icon mb-5" href="#tab-people" data-bs-toggle="tab" role="tab" aria-controls="tab-people" aria-selected="false">People</a></li>
            </ul>
        </div> -->
        <div class="border-bottom pt-10 pb-10"></div>
    </div>
</section>

<section class="section-box mt-30">
    <div class="container">
        <div class="row">
            <!-- left column -->
            <div class="col-lg-8 col-md-12 col-sm-12 col-12">
                <!-- description -->
                <?php $description = $company->company_info; ?>
                <?php if ($description) : ?>
                    <div class="content-single">
                        <h4 class="mb-30">Présentation de l'entreprise</h4>
                        <!-- <h4>Présentation de l'entreprise</h4> -->
                        <?= $description ?>
                    </div>
                    <div class="border-bottom pt-10 pb-10 mb-40"></div>

                <?php endif ?>
                <!-- latest jobs -->
                <div class="box-related-job content-page border-none">
                    <h5 class="mb-30">Dernières offres postées</h5>
                    <div class="box-list-jobs display-list">

                        <?php $jobList = wpjb_find_jobs($param) ?>
                        <?php if ($jobList->total > 0) : foreach ($jobList->job as $job) : ?>
                                <?php /* @var $job Wpjb_Model_Job */ ?>
                                <?php include dirname(__FILE__) . '/../jobs/jobs-list-item.cmpt.php' ?>
                            <?php
                            endforeach;
                        else :
                            ?>
                            <li>
                                <?php _e("Currently this employer doesn't have any openings.", "jobeleon"); ?>
                            </li>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
            <!-- right column -->
            <div class="col-lg-4 col-md-12 col-sm-12 col-12 pl-40 pl-lg-15 mt-lg-30">
                <div class="sidebar-border">
                    <div class="sidebar-heading">
                        <div class="avatar-sidebar">
                            <div class="sidebar-info pl-0"><span class="sidebar-company"><?= esc_html($company->company_name) ?></span>
                                <span class="card-location"><?= get_meta_region($company) ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="sidebar-list-job">
                        <ul>
                            <li>
                                <div class="sidebar-icon-item"><i class="fi-rr-briefcase"></i></div>
                                <div class="sidebar-text-info"><span class="text-description">Domaine d'activité</span>
                                    <strong class="small-heading"><?= _or(dtj_get_category_from_key(get_meta_value($company, 'category'))) ?></strong>
                                </div>
                            </li>
                            <li>
                                <div class="sidebar-icon-item"><i class="fi-rr-marker"></i></div>
                                <div class="sidebar-text-info"><span class="text-description">Localisation</span>
                                    <strong class="small-heading"><?= get_company_location($company) ?></strong>
                                </div>
                            </li>
                            <li>
                                <div class="sidebar-icon-item"><i class="fi-rr-clock"></i></div>
                                <div class="sidebar-text-info"><span class="text-description">Membre depuis</span>
                                    <strong class="small-heading"><?= wpjb_date_display("M Y", $company->getUser(true)->user_registered, false)  ?></strong>
                                </div>
                            </li>
                            <li>
                                <div class="sidebar-icon-item"><i class="fi-rr-time-fast"></i></div>
                                <div class="sidebar-text-info"><span class="text-description">Nombre d'offres actives</span>
                                    <strong class="small-heading">
                                        <?= $company->jobs_posted ?> offres
                                    </strong>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="sidebar-list-job">
                        <ul class="ul-disc">
                            <?php
                            $extras = [
                                'Site web' => get_meta_value($company, 'company_website'),
                                'SIRET' => get_meta_value($company, 'company_siret'),
                                'TVA' => get_meta_value($company, 'billing_tax')
                            ]
                            ?>
                            <?php foreach ($extras as $label => $value) : if (!$value) continue; ?>
                                <li><?= $label ?> : <?= $value ?></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>