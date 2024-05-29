<?php

/**
 * Job details container
 * 
 * Inside this template job details page is generated (using function 
 * wpjb_job_template)
 * 
 * @author Greg Winiarski
 * @package Templates
 * @subpackage JobBoard
 * 
 * @var $application_url string
 * @var $job Wpjb_Model_Job
 * @var $related array List of related jobs
 * @var $show_related boolean
 * @var $show stdClass
 */

?>

<?php do_action("wpjb_tpl_single_top", $job->id, $job->post_id, "job") ?>

<?php wpjb_flash() ?>
<?php
include $this->getTemplate("job-board", "job") ?>

<?php do_action("wpjb_tpl_single_job_content", $job->id, $job->post_id, "job") ?>

<?php do_action("wpjb_tpl_single_end", $job->id, $job->post_id, "job") ?>
</div>