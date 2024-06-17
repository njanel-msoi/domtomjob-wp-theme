<?php

/* @var $resume Wpjb_Model_Resume */
/* @var $can_browse boolean True if user has access to resumes */

?>

<?php
// echo '<h4>FIELDS</h4><br>' . implode(' | ', array_keys($resume->getFields()));
// echo '<h4>META </h4><br>' . implode(' | ', array_keys((array)$resume->getMeta(array())));
// echo '<h4>USER META FIELDS</h4><br>' . implode(' | ', array_keys((array)$resume->getMeta(array("meta_type" => 3, "empty" => false))));
// echo '<h4>TAGS (->title)</h4><br>' . implode(' | ', array_keys((array)$resume->getTag()));
?>

<?php
// load resume user data
$resume->getUser(true);
// load cv file link
$cv = $resume->file->cv_file[0];
$motivation = count($resume->file->motivation_file) ? $resume->file->motivation_file[0] : null;
?>

<div class="resume-single">

    <section class="section-box-2">
        <div class="box-company-profile">
            <div class="image-company">
                <?php if ($resume->doScheme("image")) : ?>
                <?php elseif ($resume->getAvatarUrl()) : ?>
                    <img src="<?php esc_attr_e($resume->getAvatarUrl("85x85")) ?>" alt="" class="wpjb-resume-photo" />
                <?php else : ?>
                    <img src="<?php echo get_template_directory_uri() . '/wpjobboard/images/candidate-avatar.png'; ?>" alt="" />
                <?php endif; ?>
            </div>
            <div class="row mt-10">
                <div class="col-lg-8 col-md-12">
                    <h5 class="f-18"><?= esc_html(the_title()) ?> <span class="card-location font-regular ml-20"><?= get_meta_region($resume) ?></span></h5>
                    <h4 class="mt-0 color-text-paragraph-2 mb-15"><?= esc_html($resume->headline) ?></p>
                </div>
                <div class="col-lg-4 col-md-12 text-lg-end">
                    <a class="btn btn-download-icon btn-apply btn-apply-big" target="_blank" title="<?= $cv->basename ?>" href="<?= esc_attr($cv->url) ?>">
                        Télécharger CV
                    </a>
                </div>
            </div>
        </div>
        <div class="border-bottom pt-10 pb-10"></div>
    </section>


    <div class="row mt-40">
        <div class="col-lg-8 col-md-12 col-sm-12 col-12">

            <div class="job-overview mb-20">
                <h5 class="border-bottom pb-15 mb-30">Résumé</h5>
                <div class="row">
                    <?php
                    $salaries = (object)['min' => get_meta_value($resume, 'salary_min'), 'max' => get_meta_value($resume, 'salary_max')];
                    $salary = $salaries->min && $salaries->max ? 'de ' . $salaries->min . 'k€ à ' . $salaries->max . 'k€' : ($salaries->min ? $salaries->min . 'k€' : ($salaries->max ? $salaries->max . 'k€' : ''));

                    // icones : industry job-level salary experience job-type deadline updated location
                    $resume_infos = [
                        ['label' => 'Région', 'icon' => 'location', 'value' => get_meta_region($resume)],
                        ['label' => 'Localisation', 'icon' => 'location', 'value' => _or($resume->candidate_location)],

                        ['label' => 'Téléphone', 'icon' => 'job-type', 'value' => _or($resume->phone)],
                        ['label' => 'Email', 'icon' => 'job-type', 'value' => _or(esc_html($resume->getUser()->user_email))],


                        ['label' => 'Date de naissance', 'icon' => 'updated', 'value' => _or(get_meta_value($resume, 'birthdate'))],
                        ['label' => 'Contrat recherché', 'icon' => 'industry', 'value' => _or(dtj_get_contract_from_key(get_meta_value($resume, 'resume_contract_searched')))],

                        ['label' => 'Etudes', 'icon' => 'experience', 'value' => _or(get_meta_value($resume, 'study_level'))],

                        ['label' => 'Métier', 'icon' => 'industry', 'value' => _or(dtj_get_job_function_from_key(get_meta_value($resume, 'main_resume_function')))],


                        ['label' => 'Créé le', 'icon' => 'deadline', 'value' => wpjb_date_display("d M Y", $resume->created_at, false)],
                        ['label' => 'Modifié le', 'icon' => 'deadline', 'value' =>  wpjb_date_display("d M Y", $resume->modified_at, false)],

                        // icons : updated job-type industry
                    ];
                    ?>
                    <?php foreach ($resume_infos as $info) : ?>
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
        </div>
        <div class="col-lg-4 col-md-12 col-sm-12 col-12 pl-40 pl-lg-15 mt-lg-30 text-right">
            <!-- entreprise bloc -->
            <?php if ($resume->description) : ?>
                <h4 class="mb-20">A propos de moi</h4>
                <p><?php wpjb_rich_text($resume->description, 'html')  ?></p>
            <?php endif ?>
        </div>

    </div>