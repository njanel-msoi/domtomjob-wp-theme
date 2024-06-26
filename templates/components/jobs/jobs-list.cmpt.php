<?php

/**
 * Display a list of jobs
 * 
 * @var $param array List of job search params
 * @var $search_init array Array of initial search params (used only with live search)
 * @var $pagination bool Show or hide pagination
 */
?>

<?php wpjb_flash(); ?>
<?php $result = apply_filters("wpjb_filter_jobs", wpjb_find_jobs($param), $atts, "list") ?>
<?php $isFeaturedList = $param["is_featured"] == "1" ?>

<?php if ($isFeaturedList) : ?>
    <div class="row">
        <?php $maxJob = 6;
        include 'job-list-loop.cmpt.php' ?>
    </div>
<?php else : ?>

    <section class="section-box mt-30">
        <div class="row flex-row-reverse">
            <!-- Start Job list -->
            <div class="col-lg-9 col-md-12 col-sm-12 col-12 ">
                <div class="content-page">
                    <div class="box-filters-job">
                        <div class="row">
                            <div class="col-xl-6 col-lg-5">
                                <span class="text-small text-showing">Page <strong><?= $result->page ?> </strong>sur <strong><?= $result->pages ?></strong></span>
                            </div>

                            <div class="col-xl-6 col-lg-7 text-lg-end mt-sm-15">
                                <div class="box-view-type">
                                    <a class="btn btn-default btn-default-small wpjb-subscribe" href="jobs-grid.html">
                                        S'abonner à cette recherche
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if ($result->page == 1) : ?>
                        <?php echo do_shortcode('[wpjb_jobs_list is_featured="1" sort_order="job_created_at ASC"]'); ?>
                    <?php endif ?>
                    <div class="row">
                        <?php include 'job-list-loop.cmpt.php' ?>
                    </div>
                </div>

                <?php if ($pagination) : ?>
                    <div class="pagination">
                        <?php wpjb_paginate_links($url, $result->pages, $result->page, $query, $format) ?>
                    </div>
                <?php endif; ?>
            </div>
            <!-- Start filter sidebar -->
            <div class="col-lg-3 col-md-12 col-sm-12 col-12">
                <div class="sidebar-shadow filters-box none-shadow mb-30">
                    <div class="sidebar-filters">
                        <div class="filter-block head-border mb-30">
                            <h5>Filtres
                                <a class="link-reset" href="<?= isset($url) ? $url : PAGES_URLS->ListeOffres ?>">Reset</a>
                            </h5>
                        </div>

                        <form action="<?php echo esc_attr($action) ?>" method="GET" class="job-list-filters-form">

                            <?php global $wp_rewrite; ?>
                            <?php if (!$wp_rewrite->using_permalinks()) : ?>
                                <input type="hidden" name="page_id" value="<?php echo $page_id ?>" />
                                <input type="hidden" name="job_board" value="find" />
                            <?php endif; ?>

                            <?php echo $form->renderHidden() ?>

                            <?php foreach ($form->getReordered() as $group) : ?>

                                <div class="filter-block mb-20 <?= esc_html("search-group-" . $group->getName()) ?>">

                                    <?php foreach ($group->getReordered() as $name => $field) :  ?>
                                        <?php if ($field->getType() != 'text') : ?>
                                            <h5 class="medium-heading mb-15"><?= esc_html($field->getLabel()) ?></h5>
                                        <?php endif; ?>
                                        <div class="form-group <?= esc_attr($field->getMeta("classes")) ?>">
                                            <?php wpjb_form_render_input($form, $field) ?>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endforeach; ?>

                        </form>

                    </div>
                </div>
            </div>
            <!-- End filter sidebar -->

        </div>
    </section>

    <!-- Begin: Subscribe to anything -->
    <?php Wpjb_Project::getInstance()->setEnv("search_feed_url", $result->url->feed); ?>
    <?php Wpjb_Project::getInstance()->setEnv("search_params", $param); ?>
    <?php add_action("wp_footer", "wpjb_subscribe") ?>
    <!-- End: Subscribe to anything -->

<?php endif ?>