<?php

/**
 * Job details : page présentant le job
 * 
 * Appelé par "job-single.cmpt" et "job-preview.cmpt"
 */
/* @var $job Wpjb_Model_Job */
/* @var $company Wpjb_Model_Employer */
?>

<meta itemprop="title" content="<?php esc_attr_e($job->job_title) ?>" />
<meta itemprop="datePosted" content="<?php esc_attr_e($job->job_created_at) ?>" />
<meta property='og:title' content='<?php esc_attr_e($job->job_title) ?>' />
<!-- <meta property='og:image' content='//media.example.com/ 1234567.jpg'/> -->
<!-- <meta property='og:description' content='Description that will show in the preview'/> -->
<!-- <meta property='og:url' content='//www.example.com/URL of the article'/> -->

<?php if (!isset($can_apply)) $can_apply = false; ?>
<?php $is_registered_company = isset($company); ?>
<?php $company = $job->getCompany(true); ?>

<?php
// echo '<h4>JOB FIELDS</h4><br>' . implode(' | ', array_keys($job->getFields()));
// echo '<h4>JOB META </h4><br>' . implode(' | ', array_keys((array)$job->getMeta(array())));
// echo '<h4>JOB USER META FIELDS</h4><br>' . implode(' | ', array_keys((array)$job->getMeta(array("meta_type" => 3, "empty" => false))));
// echo '<h4>JOB TAGS (->title)</h4><br>' . implode(' | ', array_keys((array)$job->getTag()));

?>

<section class="section-box">
    <div class="row">
        <!-- left column -->
        <div class="col-lg-8 col-md-12 col-sm-12 col-12">
            <div class="box-border-single">
                <!-- Top bloc with job infos -->
                <div class="row mt-10">
                    <div class="col-lg-8 col-md-12">
                        <h3><?= esc_attr(the_title()) ?></h3>
                        <div class="mt-0 mb-15"><span class="card-briefcase"><?= get_job_type($job) ?></span>
                            <span class="card-time"><?= wpjb_date_display("d M Y", $job->job_created_at, false) ?></span>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 text-lg-end">
                        <?php if ($can_apply) : ?>
                            <?php foreach ($application_methods as $am) : ?>
                                <?php if ($am["is_active"]) : ?>
                                    <div class="btn btn-apply-icon btn-apply btn-apply-big hover-up click-on-link">
                                        <?php echo $am["button"] ?>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
                <!-- job resumé -->
                <div class="job-overview mt-10">
                    <h5 class="border-bottom pb-15 mb-30">Résumé</h5>
                    <div class="row">
                        <?php
                        // icones : industry job-level salary experience job-type deadline updated location
                        $job_infos = [
                            ['label' => 'Catégorie', 'icon' => 'industry', 'value' => get_job_category($job)],
                            ['label' => "Type d'emploi", 'icon' => 'job-type', 'value' => get_job_type($job)],
                            ['label' => 'Région', 'icon' => 'location', 'value' => get_meta_region($job)],
                            ['label' => 'Ville', 'icon' => 'experience', 'value' => $job->job_city],
                            ['label' => 'Publiée le', 'icon' => 'updated', 'value' => wpjb_date_display("d M Y", $job->job_created_at, false)],
                            ['label' => 'Expire le', 'icon' => 'deadline', 'value' =>  wpjb_date_display("d M Y", $job->job_expires_at, false)],
                            ['label' => 'Entreprise', 'icon' => 'experience', 'value' => $job->company_name],
                            ['label' => 'Salaire', 'icon' => 'salary', 'value' => ''],
                        ];
                        ?>
                        <?php foreach ($job_infos as $info) : ?>
                            <div class="col-md-6 d-flex">
                                <div class="sidebar-icon-item">
                                    <img src="<?= get_stylesheet_directory_uri() ?>/assets/imgs/page/job-single/<?= $info['icon'] ?>.svg" alt="icon">
                                </div>
                                <div class="sidebar-text-info ml-10">
                                    <span class="text-description <?= str_replace('-', '', $info['icon']) ?>-icon mb-10">
                                        <?= $info['label'] ?>
                                    </span>
                                    <strong class="small-heading">
                                        <?= $info['value'] ?>
                                    </strong>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>
                <!-- job description -->
                <div class="content-single">
                    <h4>Présentation du poste</h4>
                    <p><?php wpjb_rich_text($job->job_description, $job->meta->job_description_format->value())  ?></p>

                    <h4>Profil attendu</h4>
                    <p>
                        <?php
                        // textarea with wysiwyg
                        // wpjb_rich_text($value->value(), $value->conf("textarea_wysiwyg") ? "html" : "text")
                        ?>
                </div>

                <?php if ($can_apply) : ?>
                    <div class="single-apply-jobs">
                        <div class="row align-items-center">
                            <div class="col-md-5">
                                <!-- apply button -->
                                <?php if ($can_apply) : ?>
                                    <?php foreach ($application_methods as $am) : ?>
                                        <?php if ($am["is_active"]) : ?>
                                            <div class="btn btn-default mr-15 click-on-link">
                                                <?php echo $am["button"] ?>
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>

                                <!-- <a class="btn btn-border" href="#">Save job</a> -->
                            </div>
                            <!-- <div class="col-md-7 text-lg-end social-share">
                                <h6 class="color-text-paragraph-2 d-inline-block d-baseline mr-10">Share this</h6><a class="mr-5 d-inline-block d-middle" href="#"><img alt="jobBox" src="<?= get_stylesheet_directory_uri() ?>/assets/imgs/template/icons/share-fb.svg"></a><a class="mr-5 d-inline-block d-middle" href="#"><img alt="jobBox" src="<?= get_stylesheet_directory_uri() ?>/assets/imgs/template/icons/share-tw.svg"></a><a class="mr-5 d-inline-block d-middle" href="#"><img alt="jobBox" src="<?= get_stylesheet_directory_uri() ?>/assets/imgs/template/icons/share-red.svg"></a><a class="d-inline-block d-middle" href="#"><img alt="jobBox" src="<?= get_stylesheet_directory_uri() ?>/assets/imgs/template/icons/share-whatsapp.svg"></a>
                            </div> -->
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <!-- right column -->
        <div class="col-lg-4 col-md-12 col-sm-12 col-12 pl-40 pl-lg-15 mt-lg-30">
            <!-- entreprise bloc -->
            <div class="sidebar-border">
                <div class="sidebar-heading">
                    <div class="avatar-sidebar">
                        <figure>
                            <?php job_company_img($job, false) ?>
                        </figure>
                        <div class="sidebar-info">
                            <span class="sidebar-company"><?= $job->company_name ?></span>
                            <?php if ($is_registered_company) : ?>
                                <span class="card-location"><?= get_company_location($company) ?></span>
                                <a class="link-underline mt-15" href="<?= wpjb_link_to("company", $company) ?>">
                                    Fiche et offres d'emploi
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="sidebar-list-job">
                    <ul class="ul-disc">
                        <?php $company_fields = ['company_url']; ?>
                        <?php foreach ($company_fields as $field) : ?>
                            <?php if ($job->$field) : ?>
                                <li><?= $job->$field ?></li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- apply popup form -->
<?php if ($can_apply) : ?>

    <?php foreach ($application_methods as $amKey => $am) : ?>
        <?php if ($am["is_active"] && isset($am["callback"]) && is_callable($am["callback"])) : ?>
            <?php call_user_func_array($am["callback"], array($amKey, $am, $job, $can_apply)) ?>
        <?php endif; ?>
    <?php endforeach; ?>

<?php endif; ?>

<?php do_action("wpjb_template_job_meta_richtext", $job) ?>