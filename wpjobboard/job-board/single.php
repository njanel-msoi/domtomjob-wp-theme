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

include dirname(__FILE__) . "/../../templates/job-single.page.php";
