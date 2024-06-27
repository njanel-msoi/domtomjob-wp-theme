<?php

$JOB_ROOT_FIELDS = [
    "employer_id",
    "old_job_id",
    "job_title",
    "job_city",
    "job_description",
    "job_created_at",
    "job_modified_at",
    "job_expires_at",
    "is_approved",
    "is_active",
    "is_filled",
    "is_featured",
    "job_is_anonymous",
    "company_name",
    "company_url",
    "company_email",
    "job_address",
    "job_zip_code",
    "job_country"
];
$JOB_META_FIELDS = [
    "region",
    "job_profile",
    "type_fulltime",
    "job_function",
    "salary_min",
    "salary_max",
    "job_experience",
    "job_study_level",
    "job_salary_txt",
    "job_duration",
    "company_siret",
    "company_description",
    "job_phone",
    "job_apply_type",
    "job_apply_url",
    "job_apply_free_text",
    "company_contact_company_name",
    "company_contact",
    "company_contact_function",
    "company_phone",
    "company_city",
    "billing_company_name",
    "billing_contact",
    "billing_contact_function",
    "billing_email",
    "billing_phone",
    "billing_address",
    "billing_zipcode",
    "billing_city",
    "billing_country",
    "optin_group",
    "old_job_id"
];
$JOB_TAG_FIELDS = ['category', 'type'];
$JOB_FILE_FIELDS = ['company_logo'];

/* This values are used for job imported from external source in order to keep job engine and rules correct 
For exemple, external source cannot choose to be approved or featured and cannot choose the creation date
*/
$JOB_PROTECTED_VALUES = [
    'job_created_at' => date("Y-m-d"),
    "job_modified_at"   => date("Y-m-d"),
    "job_expires_at"    => date("Y-m-d", JOB_EXPIRATION),
    'is_approved' =>    0,
    'is_active' =>    0,
    'is_filled' =>    0,
    'is_featured' =>    0,
    'job_is_anonymous' => 0
];

$JOB_DEFAULT_VALUES = array_merge($JOB_PROTECTED_VALUES, [
    'job_country' =>    638,
    'job_apply_type' =>    "FORM",
    'billing_country' =>    638,
    'optin_group' => 0
]);

/**
 * $plainJob : the job where all fields are at root level
 * $protected : if true, protected fields cannot be set and have a mandatory default value
 */
function dtj_import_job($plainJob)
{
    // is this job already in DB ?
    $old_id = $plainJob['old_job_id'];
    if (has_job_from_old_id($old_id)) {
        throw new Exception("Job with old_id " . $plainJob['old_job_id'] . " has already been imported");
    }

    global $JOB_ROOT_FIELDS, $JOB_META_FIELDS, $JOB_TAG_FIELDS, $JOB_FILE_FIELDS, $JOB_PROTECTED_VALUES;
    $apiJob = ["meta" => [], "tags" => [], "files" => []];

    // field at root level
    foreach ($JOB_ROOT_FIELDS as $field) {
        $value = __get_field_value($plainJob, $field);
        $apiJob[$field] = $value;
    }
    // field at meta level
    foreach ($JOB_META_FIELDS as $field) {
        $value = __get_field_value($plainJob, $field);
        // $meta = ["name" => $field, "values" => [$value]];
        $meta = ["name" => $field, "values" => [$value]];
        $apiJob['meta'][] = $meta;
    }
    // field at tag level
    foreach ($JOB_TAG_FIELDS as $field) {
        $value = __get_field_value($plainJob, $field);
        $tag = ["type" => $field, "id" => $value];
        $apiJob['tags'][] = $tag;
    }
    // files
    foreach ($JOB_FILE_FIELDS as $field) {
        $fileContent = __get_field_value($plainJob, $field);
        if (!$fileContent) continue;

        $fileName = __get_field_value($plainJob, $field . '_filename');

        $apiJob['files'][] = [
            "path" => $field . '/' . $fileName,
            "content" => $fileContent
        ];
    }

    if ($GLOBALS['FAKE_IMPORT']) {
        preDump($apiJob);
        return $apiJob;
    }
    $result = postJob($apiJob);
    if (!$result) throw new Exception('problem with job insertion ' . $apiJob['job_title']);

    echo 'Job added to queue : ' . $apiJob['job_title'] . '<br>';
}

/**
 * Used to get the proper field value
 */
function __get_field_value($plainJob, $field)
{
    global $JOB_DEFAULT_VALUES, $JOB_PROTECTED_VALUES;
    $protected = $GLOBALS['PROTECT_JOB_FIELDS'];

    if ($protected && isset($JOB_PROTECTED_VALUES[$field]))
        return $JOB_PROTECTED_VALUES[$field];

    $value = null;
    if (isset($plainJob[$field]) && $plainJob[$field] && $plainJob[$field] != 'NULL')
        $value = $plainJob[$field];
    else if (!$value && isset($JOB_DEFAULT_VALUES[$field])) {
        $value = $JOB_DEFAULT_VALUES[$field];
    }

    return $value;
}
