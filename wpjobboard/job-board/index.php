<?php

/**
 * [Overwrite the file in the parent template]
 * ! Careful of the parent template updates !
 * 
 * Jobs list
 * 
 * This template file is responsible for displaying list of jobs on job board
 * home page, secteur page, job types page and search results page.
 * 
 * 
 * @author Greg Winiarski + Nicolas Janel (n.janel@msoi.re)
 * @package Templates
 * @subpackage JobBoard
 * 
 * @var $param array List of job search params
 * @var $search_init array Array of initial search params (used only with live search)
 * @var $pagination bool Show or hide pagination
 */



include dirname(__FILE__) . "/../../templates/components/jobs/jobs-list.cmpt.php";
