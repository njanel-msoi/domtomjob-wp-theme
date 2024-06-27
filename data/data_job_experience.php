<?php

// Liste des éléments
// NOTE : keys are the same as old DB to make the data import easier
$JOB_EXPERIENCE = array(
    2 => "Débutant accepté",
    3 => "0 à 2 ans",
    4 => "2 à 5 ans",
    5 => "5 à 10 ans",
    6 => "Plus de 10 ans"
    // 1 => "Débutant",
    // 2 => "Junior",
    // 3 => "Confirmé",
    // 4 => "Sénior",
    // 5 => "Expert",
);

// build a format compatible with wpjb plugin
$JOB_EXPERIENCE_MAP = str_arr_to_data_map($JOB_EXPERIENCE, true);

function dtj_get_job_experiences()
{
    global $JOB_EXPERIENCE_MAP;
    return $JOB_EXPERIENCE_MAP;
}

function dtj_get_job_experience_from_key($key)
{
    if (!$key) return '';
    global $JOB_EXPERIENCE;
    return $JOB_EXPERIENCE[$key];
}
