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
<?php $isNotHomePage = $param["is_featured"] != "1" ?>


<section class="section-box mt-30">
    <div class="row flex-row-reverse">
        <!-- Start Job list -->
        <div class="col-lg-9 col-md-12 col-sm-12 col-12 float-right">
            <div class="content-page">
                <div class="box-filters-job">
                    <div class="row">
                        <div class="col-xl-6 col-lg-5">
                            <!-- <span class="text-small text-showing">Showing <strong>41-60 </strong>of <strong>944 </strong>jobs</span> -->
                        </div>

                        <div class="col-xl-6 col-lg-7 text-lg-end mt-sm-15">
                            <div class="box-view-type">
                                <a class="btn btn-default btn-default-small wpjb-subscribe" href="jobs-grid.html">
                                    S'abonner à cette recherche
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="row">
                            <div class="col-xl-6 col-lg-5"><span class="text-small text-showing">Showing <strong>41-60 </strong>of <strong>944 </strong>jobs</span></div>
                            <div class="col-xl-6 col-lg-7 text-lg-end mt-sm-15">
                                <div class="display-flex2">
                                    <div class="box-border mr-10"><span class="text-sortby">Show:</span>
                                        <div class="dropdown dropdown-sort">
                                            <button class="btn dropdown-toggle" id="dropdownSort" type="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-display="static"><span>12</span><i class="fi-rr-angle-small-down"></i></button>
                                            <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="dropdownSort">
                                                <li><a class="dropdown-item active" href="#">10</a></li>
                                                <li><a class="dropdown-item" href="#">12</a></li>
                                                <li><a class="dropdown-item" href="#">20</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="box-border"><span class="text-sortby">Sort by:</span>
                                        <div class="dropdown dropdown-sort">
                                            <button class="btn dropdown-toggle" id="dropdownSort2" type="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-display="static"><span>Newest Post</span><i class="fi-rr-angle-small-down"></i></button>
                                            <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="dropdownSort2">
                                                <li><a class="dropdown-item active" href="#">Newest Post</a></li>
                                                <li><a class="dropdown-item" href="#">Oldest Post</a></li>
                                                <li><a class="dropdown-item" href="#">Rating Post</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="box-view-type"><a class="view-type" href="jobs-list.html"><img src="<?= get_stylesheet_directory_uri() ?>/assets/imgs/template/icons/icon-list.svg" alt="jobBox"></a><a class="view-type" href="jobs-grid.html"><img src="<?= get_stylesheet_directory_uri() ?>/assets/imgs/template/icons/icon-grid-hover.svg" alt="jobBox"></a></div>
                                </div>
                            </div>
                        </div> -->
                </div>
                <div class="row">
                    <?php if ($result->count) : foreach ($result->job as $job) : ?>
                            <?php /* @var $job Wpjb_Model_Job */ ?>
                            <?php $this->job = $job; ?>

                            <?php $this->render("index-item.php") ?>
                        <?php
                        endforeach;
                    else :
                        ?>
                        <h3>
                            <?php _e("No job listings found.", "jobeleon"); ?>
                        </h3>
                    <?php endif; ?>
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
            <div class="sidebar-shadow none-shadow mb-30">
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
                                    <h5 class="medium-heading mb-15"><?= esc_html($field->getLabel()) ?></h5>
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