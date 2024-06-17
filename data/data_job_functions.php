<?php

// Liste des éléments
$JOB_FUNCTIONS = array(
    "SECR" => "Secrétariat"
);
// build a format compatible with wpjb plugin
$JOB_FUNCTIONS_MAP = str_arr_to_data_map($JOB_FUNCTIONS, true);

function dtj_get_job_functions()
{
    global $JOB_FUNCTIONS_MAP;
    return $JOB_FUNCTIONS_MAP;
}

function dtj_get_job_function_from_key($key)
{

    global $JOB_FUNCTIONS;
    return isset($JOB_FUNCTIONS[$key]) ? $JOB_FUNCTIONS[$key] : '';
}
