    <?php
    if (!isset($maxJob)) $maxJob = 99999;
    if ($result->count) :
        $count = 0;
        foreach ($result->job as $job) :
            // for featured list, restrict to displayed featured and restrict nb of job
            if ($isFeaturedList) {
                // if not displayed feature, do not count it
                if (!is_job_featured($job)) continue;
                if (++$count > $maxJob) break;
            } ?>
            <?php /* @var $job Wpjb_Model_Job */ ?>
            <?php $this->job = $job; ?>

            <?php if ($isFeaturedList && is_job_featured($job)) : ?>
                <div class="col-lg-4 col-md-12 col-sm-12 col-12 job-featured">
                    <?php $this->render("index-item.php") ?>
                </div>
            <?php else : ?>
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <?php $this->render("index-item.php") ?>
                </div>
            <?php endif ?>
        <?php
        endforeach;
    else :
        ?>
        <h6>
            <?php _e("No job listings found.", "jobeleon"); ?>
        </h6>
    <?php endif; ?>